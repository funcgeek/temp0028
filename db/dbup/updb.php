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

/* FTP Account 
$ftp_host = '192.168.0.157'; /* host * /
$ftp_user_name = 'kevin@192.168.0.157'; /* username * /
$ftp_user_pass = 'Pass2021'; /* password * /
*/
/* Connect using basic FTP */
// $connect_it = ftp_connect( $ftp_host );
 
/* Login to FTP */
// $login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );


?>