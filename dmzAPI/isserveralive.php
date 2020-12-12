<?php


$host="192.168.1.107";


exec("ping -c 4 " . $host, $output, $result);

print_r($output);

if ($result == 0)

        echo "Web Server is alive!";

else

        echo "Web Server is dead!";

?>


