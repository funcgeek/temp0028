<?php
//this file gets the remote information for doctor notes on the NAS

//begin connecting to the databases
$db_host1 = 'ispecs.familyds.com';
$db_host2 = 'localhost';

$db_user1 = 'ispecs';
$db_user2 = 'ispecs';

$db_pass1 = 'Loverboy@1';
$db_pass2 = 'Pass@2020';

$db_name = 'ispecs';

$dbremote = @new mysqli($db_host1, $db_user1, $db_pass1, $db_name);
$dblocal = @new mysqli($db_host2, $db_user2, $db_pass2, $db_name);
?>