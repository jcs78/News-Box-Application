#!/usr/bin/php
<?php

require_once('get_host_info.inc');

error_reporting (E_ALL);
set_error_handler("handleError");

// Functions that establish the log speaker's and listener's connection to RabbitMQ.
function speakLog()
{
        $cltLog = new logSpeakerClient("deploySysLogRabbitMQ.ini", "deployLog");
        return $cltLog;
}

function listenLog()
{
        $svrLog = new logListenerServer("deploySysLogRabbitMQ.ini", "deployLog");
        return $svrLog;
}


// Functions that establish the deployment system and other VM's connection to RabbitMQ.
function speakWS()
{
        $wpClient = new deployClient("wsRabbitMQ_Send.ini", "deployWS");
        return $wpClient;
}

function speakDB()
{
        $wpClient = new deployClient("dbRabbitMQ_Send.ini", "deployDB");
        return $wpClient;
}

function speakDMZ()
{
        $wpClient = new deployClient("dmzRabbitMQ_Send.ini", "deployDMZ");
        return $wpClient;
}

function speakRCH()
{
        $wpClient = new deployClient("rchRabbitMQ_Send.ini", "deployRCH");
        return $wpClient;
}

function listenDepSys()
{
        $wpServer = new deployServer("depsysRabbitMQ_Receive.ini", "deployDepSys");
        return $wpServer;
}


// Classes for Rabbit Connection to Web Page
class deployClient
{
        private $machine = "";
        public  $BROKER_HOST;
        private $BROKER_PORT;
        private $USER;
        private $PASSWORD;
        private $VHOST;
/*	private $exchange;
	private $exchange_rsp;
	private $queue;
	private $queue_rsp;  */
        private $routing_key = '*';
        private $response_queue = array();
        private $exchange_type = "direct";

        function __construct($machine, $server = "rabbitMQ")
        {
                $this->machine = getHostInfo(array($machine));
                $this->BROKER_HOST   = $this->machine[$server]["BROKER_HOST"];
                $this->BROKER_PORT   = $this->machine[$server]["BROKER_PORT"];
                $this->USER     = $this->machine[$server]["USER"];
                $this->PASSWORD = $this->machine[$server]["PASSWORD"];
                $this->VHOST = $this->machine[$server]["VHOST"];

		if (isset( $this->machine[$server]["EXCHANGE_TYPE"]))
                {
                        $this->exchange_type = $this->machine[$server]["EXCHANGE_TYPE"];
                }

		if (isset( $this->machine[$server]["AUTO_DELETE"]))
                {
                        $this->auto_delete = $this->machine[$server]["AUTO_DELETE"];
                }

		$this->exchange = $this->machine[$server]["EXCHANGE"];
		
/* 		Added an exchange to receive a response. [-jcs78]
		$this->exchange_rsp = $this->machine[$server]["EXCHANGE_RSP"];  */

		$this->queue = $this->machine[$server]["QUEUE"];

/*		Added a queue to receive a response. [-jcs78]
		$this->queue_rsp = $this->machine[$server]["QUEUE_RSP"];  */
        }

	function process_response($response)
        {
                $uid = $response->getCorrelationId();

		if (!isset($this->response_queue[$uid]))
                {
                  	echo  "Unknown UID\n";
                  	return true;
                }

		$this->conn_queue->ack($response->getDeliveryTag());
                $body = $response->getBody();
                $payload = json_decode($body, true);

		if (!(isset($payload)))
                {
                        $payload = "[Empty Response]";
                }

		$this->response_queue[$uid] = $payload;
                return false;
        }

	function send_request($message)
        {
                $uid = uniqid();
                $json_message = json_encode($message);

		try
                {
                        $params = array();
                        $params['host'] = $this->BROKER_HOST;
                        $params['port'] = $this->BROKER_PORT;
                        $params['login'] = $this->USER;
                        $params['password'] = $this->PASSWORD;
                        $params['vhost'] = $this->VHOST;

                        $conn = new AMQPConnection($params);
                        $conn->connect();

                        $channel = new AMQPChannel($conn);

                        $exchange = new AMQPExchange($channel);
                        $exchange->setName($this->exchange);
                        $exchange->setType($this->exchange_type);


/*			$callback_queue = new AMQPQueue($channel);
     			$callback_queue->setName($this->queue."_response");
     			$callback_queue->declare();
			$callback_queue->bind($exchange->getName(),$this->routing_key.".response");  */

/*			Established a queue to callback to that is already inside the host. [-jcs78]
			$callback_queue = new AMQPQueue($channel);
			$callback_queue->setName($this->queue_rsp);
			$callback_queue->bind($exchange->getName(),$this->routing_key.".response");  */


                        $this->conn_queue = new AMQPQueue($channel);
                        $this->conn_queue->setName($this->queue);
                        $this->conn_queue->bind($exchange->getName(),$this->routing_key);


/*                      Commented out because we do not want to create a new exchange that is directed back at the client. [-jcs78]
			$exchange->publish($json_message,$this->routing_key,AMQP_NOPARAM,array('reply_to'=>$callback_queue->getName(),'correlation_id'=>$uid));  */


			$exchange->publish($json_message, $this->routing_key,AMQP_NOPARAM);


/*			Commented out because there is nothing being sent by the server. [-jcs78]
			$this->response_queue[$uid] = "waiting";
                        $callback_queue->consume(array($this,'process_response'));

                        $response = $this->response_queue[$uid];
                        unset($this->response_queue[$uid]);
			return $response;  */
                }
		
		catch(Exception $e)
                {
//			die("Failed to send message to exchange: ". $e->getMessage()."\n");

			$clientLog = speakLog();
			$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

			$clientLog->send_log($throwableError);
			die();
		}
	}

	function publish($message)
        {
                $json_message = json_encode($message);

		try
                {
			$params = array();
      			$params['host'] = $this->BROKER_HOST;
      			$params['port'] = $this->BROKER_PORT;
      			$params['login'] = $this->USER;
		       	$params['password'] = $this->PASSWORD;
			$params['vhost'] = $this->VHOST;
                        $conn = new AMQPConnection($params);
                        $conn->connect();
                        $channel = new AMQPChannel($conn);
                        $exchange = new AMQPExchange($channel);
      			$exchange->setName($this->exchange);
      			$exchange->setType($this->exchange_type);
                        $this->conn_queue = new AMQPQueue($channel);
                        $this->conn_queue->setName($this->queue);
                        $this->conn_queue->bind($exchange->getName(),$this->routing_key);
                        return $exchange->publish($json_message,$this->routing_key);
		}
		
		catch(Exception $e)
                {
//			die("failed to send message to exchange: ". $e->getMessage()."\n");

			$clientLog = speakLog();
			$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

			$clientLog->send_log($throwableError);
                        die();
                }
	}
}

class deployServer
{
        private $machine = "";
        public  $BROKER_HOST;
        private $BROKER_PORT;
        private $USER;
        private $PASSWORD;
        private $VHOST;
        private $exchange;
        private $queue;
        private $routing_key = '*';
        private $exchange_type = "topic";
        private $auto_delete = false;

        function __construct($machine, $server = "rabbitMQ")
        {
                $this->machine = getHostInfo(array($machine));
                $this->BROKER_HOST   = $this->machine[$server]["BROKER_HOST"];
                $this->BROKER_PORT   = $this->machine[$server]["BROKER_PORT"];
                $this->USER     = $this->machine[$server]["USER"];
                $this->PASSWORD = $this->machine[$server]["PASSWORD"];
                $this->VHOST = $this->machine[$server]["VHOST"];
		
		if (isset( $this->machine[$server]["EXCHANGE_TYPE"]))
                {
                        $this->exchange_type = $this->machine[$server]["EXCHANGE_TYPE"];
                }
		
		if (isset( $this->machine[$server]["AUTO_DELETE"]))
                {
                        $this->auto_delete = $this->machine[$server]["AUTO_DELETE"];
                }
		
		$this->exchange = $this->machine[$server]["EXCHANGE"];
                $this->queue = $this->machine[$server]["QUEUE"];
        }
	
	function process_message($msg)
        {
//		Send the ack to clear the item from the queue.
                if ($msg->getRoutingKey() !== "*")
    		{
      			return;
    		}
		
		$this->conn_queue->ack($msg->getDeliveryTag());

		try
                {
                        if ($msg->getReplyTo())
                        {
// 				Message wants a response; process request.
                                $body = $msg->getBody();
                                $payload = json_decode($body, true);
                                $response;

				if (isset($this->callback))
                                {
                                        $response = call_user_func($this->callback,$payload);
                                }

				$params = array();
      				$params['host'] = $this->BROKER_HOST;
      				$params['port'] = $this->BROKER_PORT;
      				$params['login'] = $this->USER;
      				$params['password'] = $this->PASSWORD;
      				$params['vhost'] = $this->VHOST;
                        	$conn = new AMQPConnection($params);
                        	$conn->connect();
                        	$channel = new AMQPChannel($conn);
                        	$exchange = new AMQPExchange($channel);
      				$exchange->setName($this->exchange);
      				$exchange->setType($this->exchange_type);

                        	$conn_queue = new AMQPQueue($channel);
                        	$conn_queue->setName($msg->getReplyTo());
                        	$replykey = $this->routing_key.".response";
                        	$conn_queue->bind($exchange->getName(),$replykey);
                        	$exchange->publish(json_encode($response),$replykey,AMQP_NOPARAM,array('correlation_id'=>$msg->getCorrelationId()));

                                return;
                        }
                }
		
		catch(Exception $e)
                {
/*			ampq throws exception if get fails...
			echo "error: rabbitMQServer: process_message: exception caught: ".$e;  */

			$clientLog = speakLog();
			$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

			$clientLog->send_log($throwableError);
                        die();
                }
		
//		Message does not require a response, send ack immediately.
                $body = $msg->getBody();
                $payload = json_decode($body, true);
		
		if (isset($this->callback))
                {
                        call_user_func($this->callback,$payload);
                }
        }
	
	function process_request($callback)
        {
                try
                {
                	$this->callback = $callback;
      			$params = array();
      			$params['host'] = $this->BROKER_HOST;
      			$params['port'] = $this->BROKER_PORT;
      			$params['login'] = $this->USER;
      			$params['password'] = $this->PASSWORD;
      			$params['vhost'] = $this->VHOST;
                        $conn = new AMQPConnection($params);
                        $conn->connect();

                        $channel = new AMQPChannel($conn);

                        $exchange = new AMQPExchange($channel);
      			$exchange->setName($this->exchange);
      			$exchange->setType($this->exchange_type);

                        $this->conn_queue = new AMQPQueue($channel);
                        $this->conn_queue->setName($this->queue);
                        $this->conn_queue->bind($exchange->getName(),$this->routing_key);

                        $this->conn_queue->consume(array($this,'process_message'));

//			Loop as long as the channel has callbacks registered
                        while (count($channel->callbacks))
                        {
                                $channel->wait();
                        }
                }
		
		catch (Exception $e)
                {
//                      trigger_error("Failed to start request processor: ".$e,E_USER_ERROR);

			$clientLog = speakLog();
			$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

			$clientLog->send_log($throwableError);
                        die();
                }
	}
}

// Classes Related to the Log Listener & Speaker
class logListenerServer
{
        private $machine = "";
        public  $BROKER_HOST;
        private $BROKER_PORT;
        private $USER;
        private $PASSWORD;
        private $VHOST;
        private $exchange;
        private $queue;
        private $routing_key = '*';
        private $exchange_type = "topic";
        private $auto_delete = false;

        function __construct($machine, $server = "rabbitMQ")
        {
                $this->machine = getHostInfo(array($machine));
                $this->BROKER_HOST   = $this->machine[$server]["BROKER_HOST"];
                $this->BROKER_PORT   = $this->machine[$server]["BROKER_PORT"];
                $this->USER     = $this->machine[$server]["USER"];
                $this->PASSWORD = $this->machine[$server]["PASSWORD"];
                $this->VHOST = $this->machine[$server]["VHOST"];

		if (isset( $this->machine[$server]["EXCHANGE_TYPE"]))
                {
                        $this->exchange_type = $this->machine[$server]["EXCHANGE_TYPE"];
                }

		if (isset( $this->machine[$server]["AUTO_DELETE"]))
                {
                        $this->auto_delete = $this->machine[$server]["AUTO_DELETE"];
                }

		$this->exchange = $this->machine[$server]["EXCHANGE"];
                $this->queue = $this->machine[$server]["QUEUE"];
        }
	
	function process_message($msg)
        {
//		Send the ack to clear the item from the queue.
                if ($msg->getRoutingKey() !== "*")
                {
                        return;
                }
		
		$this->conn_queue->ack($msg->getDeliveryTag());
                try
                {
                        if ($msg->getReplyTo())
                        {
//				Message wants a response; process request.
                                $body = $msg->getBody();
                                $payload = json_decode($body, true);
                                $response;
				
				if (isset($this->callback))
                                {
                                        $response = call_user_func($this->callback,$payload);
                                }

                                $params = array();
                                $params['host'] = $this->BROKER_HOST;
                                $params['port'] = $this->BROKER_PORT;
                                $params['login'] = $this->USER;
                                $params['password'] = $this->PASSWORD;
                                $params['vhost'] = $this->VHOST;
                                $conn = new AMQPConnection($params);
                                $conn->connect();
                                $channel = new AMQPChannel($conn);
                                $exchange = new AMQPExchange($channel);
                                $exchange->setName($this->exchange);
                                $exchange->setType($this->exchange_type);

                                $conn_queue = new AMQPQueue($channel);
                                $conn_queue->setName($msg->getReplyTo());
                                $replykey = $this->routing_key.".response";
                                $conn_queue->bind($exchange->getName(),$replykey);
                                $exchange->publish(json_encode($response),$replykey,AMQP_NOPARAM,array('correlation_id'=>$msg->getCorrelationId()));

                                return;
                        }
                }
		
		catch(Exception $e)
                {
/* 			AMQP throws exception if get fails.
			echo "Error: rabbitMQServer: process_message: Exception caught: ".$e;  */
			
			$clientLog = speakLog();
			$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

			$fp = fopen('log.txt', 'a');
		        fwrite($fp, $throwableError . "\n");
		        fclose($fp);
                }
		
//		Message does not require a response, send ack immediately.
                $body = $msg->getBody();
                $payload = json_decode($body, true);
		
		if (isset($this->callback))
                {
                        call_user_func($this->callback,$payload);
                }
        }
	
	function process_log($callback)
        {
                try
                {
                        $this->callback = $callback;
                        $params = array();
                        $params['host'] = $this->BROKER_HOST;
                        $params['port'] = $this->BROKER_PORT;
                        $params['login'] = $this->USER;
                        $params['password'] = $this->PASSWORD;
                        $params['vhost'] = $this->VHOST;
                        $conn = new AMQPConnection($params);
                        $conn->connect();

                        $channel = new AMQPChannel($conn);

                        $exchange = new AMQPExchange($channel);
                        $exchange->setName($this->exchange);
                        $exchange->setType($this->exchange_type);

                        $this->conn_queue = new AMQPQueue($channel);
                        $this->conn_queue->setName($this->queue);
                        $this->conn_queue->bind($exchange->getName(),$this->routing_key);

                        $this->conn_queue->consume(array($this,'process_message'));

//			Loop as long as the channel has callbacks registered.
                        while (count($channel->callbacks))
                        {
                                $channel->wait();
                        }
                }
		
		catch (Exception $e)
                {
//			trigger_error("Failed to start request processor: ".$e,E_USER_ERROR);

			$clientLog = speakLog();
			$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

                        $fp = fopen('log.txt', 'a');
                        fwrite($fp, $throwableError . "\n");
                        fclose($fp);
                }
        }
}

class logSpeakerClient
{
        private $machine = "";
        public  $BROKER_HOST;
        private $BROKER_PORT;
        private $USER;
        private $PASSWORD;
        private $VHOST;
        private $exchange;
        private $queue;
        private $routing_key = '*';
        private $response_queue = array();
        private $exchange_type = "topic";

        function __construct($machine, $server = "rabbitMQ")
        {
                $this->machine = getHostInfo(array($machine));
                $this->BROKER_HOST   = $this->machine[$server]["BROKER_HOST"];
                $this->BROKER_PORT   = $this->machine[$server]["BROKER_PORT"];
                $this->USER     = $this->machine[$server]["USER"];
                $this->PASSWORD = $this->machine[$server]["PASSWORD"];
                $this->VHOST = $this->machine[$server]["VHOST"];
		
		if (isset( $this->machine[$server]["EXCHANGE_TYPE"]))
                {
                        $this->exchange_type = $this->machine[$server]["EXCHANGE_TYPE"];
                }
		
		if (isset( $this->machine[$server]["AUTO_DELETE"]))
                {
                        $this->auto_delete = $this->machine[$server]["AUTO_DELETE"];
                }
		
		$this->exchange = $this->machine[$server]["EXCHANGE"];
                $this->queue = $this->machine[$server]["QUEUE"];
	}
	
	function process_response($response)
        {
                $uid = $response->getCorrelationId();
		
		if (!isset($this->response_queue[$uid]))
                {
                	echo  "Unknown uid\n";
                	return true;
                }
		
		$this->conn_queue->ack($response->getDeliveryTag());
                $body = $response->getBody();
                $payload = json_decode($body, true);
		
		if (!(isset($payload)))
                {
                        $payload = "[empty response]";
                }
		
		$this->response_queue[$uid] = $payload;
		return false;
        }

        function send_log($message)
        {
                $uid = uniqid();

                $json_message = json_encode($message);

		try
                {
                        $params = array();
                        $params['host'] = $this->BROKER_HOST;
                        $params['port'] = $this->BROKER_PORT;
                        $params['login'] = $this->USER;
                        $params['password'] = $this->PASSWORD;
                        $params['vhost'] = $this->VHOST;

                        $conn = new AMQPConnection($params);
                        $conn->connect();

                        $channel = new AMQPChannel($conn);

                        $exchange = new AMQPExchange($channel);
                        $exchange->setName($this->exchange);
			$exchange->setType($this->exchange_type);

                        $this->conn_queue = new AMQPQueue($channel);
                        $this->conn_queue->setName($this->queue);
                        $this->conn_queue->bind($exchange->getName(),$this->routing_key);

                        $exchange->publish($json_message, $this->routing_key,AMQP_NOPARAM);

                }
		
		catch(Exception $e)
                {
//                      die("Failed to send message to exchange: ". $e->getMessage()."\n");

			$clientLog = speakLog();
			$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

                        $fp = fopen('log.txt', 'a');
                        fwrite($fp, $throwableError . "\n");
			fclose($fp);

                        die();
                }
        }

        function publish($message)
        {
                $json_message = json_encode($message);

		try
                {
                        $params = array();
                        $params['host'] = $this->BROKER_HOST;
                        $params['port'] = $this->BROKER_PORT;
                        $params['login'] = $this->USER;
                        $params['password'] = $this->PASSWORD;
                        $params['vhost'] = $this->VHOST;
                        $conn = new AMQPConnection($params);
                        $conn->connect();
                        $channel = new AMQPChannel($conn);
                        $exchange = new AMQPExchange($channel);
                        $exchange->setName($this->exchange);
                        $exchange->setType($this->exchange_type);
                        $this->conn_queue = new AMQPQueue($channel);
                        $this->conn_queue->setName($this->queue);
                        $this->conn_queue->bind($exchange->getName(),$this->routing_key);
                        return $exchange->publish($json_message,$this->routing_key);
                }
		
		catch(Exception $e)
                {
//                      die("Failed to send message to exchange: ". $e->getMessage()."\n");

			$clientLog = speakLog();
			$throwableError = "Throwable Error Caught at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": " . $e->getMessage() . " inside " . $e->getFile()  . " on line " . $e->getLine() . ".\n";

                        $fp = fopen('log.txt', 'a');
                        fwrite($fp, $throwableError . "\n");
			fclose($fp);

                        die();
                }
        }
}

// Function that is desined to handle all types of errors reported.
function handleError($errNo, $errMsg, $error_file, $error_line)
{
        $clientLog = speakLog();
	$errorType = "";
        $e_Error = "";

        switch ($errNo) {
                case 1:
                        $errorType = "E_ERROR";
                        break;
                case 2:
                        $errorType = "E_WARNING";
                        break;
                case 4:
                        $errorType = "E_PARSE";
                        break;
                case 8:
                        $errorType = "E_NOTICE";
                        break;
                case 16:
                        $errorType = "E_CORE_ERROR";
                        break;
                case 32:
                        $errorType = "E_CORE_WARNING";
                        break;
                case 64:
                        $errorType = "E_CORE_ERROR";
                        break;
                case 128:
                        $errorType = "E_COMPLILE_WARNING";
                        break;
                case 256:
                        $errorType = "E_USER_ERROR";
                        break;
                case 512:
                        $errorType = "E_USER_WARNING";
                        break;
                case 1024:
                        $errorType = "E_USER_NOTICE";
                        break;
               	case 2048:
                        $errorType = "E_STRICT";
                        break;
                case 4096:
                        $errorType = "E_RECOVERABLE_ERROR";
                        break;
                case 8192:
                        $errorType = "E_DEPRECATED";
                        break;
                case 16384:
                        $errorType = "E_USER_DEPRECATED";
                        break;
                default:
                        $errorType = "No Type Determined.";
        }

        $e_Error = "Error [$errorType] detected at " . date("h:i:sa") . " on "  . date("m-d-Y") . ": $errMsg inside $error_file on line $error_line.\n";
        $clientLog->send_log($e_Error);
        die();
}

?>

