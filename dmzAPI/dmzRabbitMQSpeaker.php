<?php
require('path.inc');
require('get_host_info.inc');
require('rabbitMQLib.inc');

function speak($userInputArray){
        $client = new rabbitMQClient("dmzRabbitMQ.ini","dbToDMZServer");

        $response = $client->send_request($userInputArray);
        return $response;
}
?>
