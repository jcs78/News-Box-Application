<?php

require_once('get_host_info.inc');
require_once('logRabbitMQLib.inc');

error_reporting (E_ALL);
set_error_handler("handleError");

$wpClient = new webpageClient("webServerRabbitMQ.ini", "webpageServer");
$_SESSION["wpClient"] = $wpClient;

class webpageClient
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

			$callback_queue = new AMQPQueue($channel);
      			$callback_queue->setName($this->queue."_response");
      			$callback_queue->declare();
                        $callback_queue->bind($exchange->getName(),$this->routing_key.".response");

                        $this->conn_queue = new AMQPQueue($channel);
                        $this->conn_queue->setName($this->queue);
                        $this->conn_queue->bind($exchange->getName(),$this->routing_key);

                        $exchange->publish($json_message,$this->routing_key,AMQP_NOPARAM,array('reply_to'=>$callback_queue->getName(),'correlation_id'=>$uid));
      			$this->response_queue[$uid] = "waiting";
                        $callback_queue->consume(array($this,'process_response'));

                        $response = $this->response_queue[$uid];
                        unset($this->response_queue[$uid]);
                        return $response;
                }
                catch(Exception $e)
                {
                        die("Failed to send message to exchange: ". $e->getMessage()."\n");
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
                        die("failed to send message to exchange: ". $e->getMessage()."\n");
                }
	}
}

?>
