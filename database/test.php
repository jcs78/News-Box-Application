#!/usr/bin/php
<?php
echo "Test PHP BEGIN".PHP_EOL;

$pass = 'test';

$hash = password_hash($pass, sha1('a'));

echo password_verify($test, $hash);



echo "\n\n";

?>
