<?php
/*the following 2 lines are not mandatory but we keep it to 
avoid risk of exceeding default execution time and mamory*/
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');

/*url of zipped file at old server*/
$file = 'http://your-domain.com/files.zip';

/*what should it name at new server*/
$dest = 'files.zip';

/*get file contents and create same file here at new server*/
$data = file_get_contents($file);
$handle = fopen($dest,"w");
fwrite($handle, $data);
fclose($handle);
echo 'Copied Successfully.';

/**
 * Transfer (Import) Files Server to Server using PHP FTP
 * @link https://shellcreeper.com/?p=1249
 */
 
/* Source File Name and Path */
$remote_file = 'files.zip';
 
/* FTP Account */
$ftp_host = 'your-ftp-host.com'; /* host */
$ftp_user_name = 'ftp-username@your-ftp-host.com'; /* username */
$ftp_user_pass = 'ftppassword'; /* password */
 
 
/* New file name and path for this file */
$local_file = 'files.zip';
 
/* Connect using basic FTP */
$connect_it = ftp_connect( $ftp_host );
 
/* Login to FTP */
$login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );
 
/* Download $remote_file and save to $local_file */
if ( ftp_get( $connect_it, $local_file, $remote_file, FTP_BINARY ) ) {
    echo "WOOT! Successfully written to $local_file\n";
}
else {
    echo "Doh! There was a problem\n";
}
 
/* Close the connection */
ftp_close( $connect_it );
?>