10/8/2020
I have only tested this locally.


One terminal can run the client and another can run the server.


You can run ./testRabbitMQServer.php as normal, but the client is now
called from ./testLogCatcher.php

You can run the testLogCatcher.php but if you would like to change the
type/action that is happening we still have to change the array element
manually inside of testRabbitMQClient.php. Also, testRabbitMQClient.php
is now a function so that we can call on the code, but it does not take
any parameters. We can change it so that we can add parameters to the
function runClient() so that we can change type,username,password,etc as
we need fit. I probably will have to change this if I get clarification
from the Prof on 10/8 and start understanding how to make an event
loggin system. The rest explains exception handling and how it can be used
in PHP.


For PHP we can set up a try and catch block as such:

try{
	<code that needs to be tried>
}
catch(Exception $e){
	<whatever need to be done when an exception happens>
	echo $e->getMessage();
}

The datatype for <$e->getMessage();> is a string so we can just use this as
a mesage inside of a rabbit client, or however we would like to. 
