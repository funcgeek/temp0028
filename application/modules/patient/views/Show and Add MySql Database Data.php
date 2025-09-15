<!-- This Script is from www.phpfreecpde.com, Coded by: Kerixa Inc-->
<?php
	$host="localhost"; // Host name
	$username="root"; // Mysql username
	$password=""; // Mysql password

function setup(){
echo('
<p style="color: #008000;	text-align: left;	font-size: 15pt;"">-Automatic setup is started...</p>
');
global $host,$username,$password,$link;
//$link=mysql_connect($host, $username, $password);
$sql= 'CREATE DATABASE info';
if (!mysql_query ($sql, $link)) die('
<p style="text-align: center;	font-size: 20pt;"><span style="color: #FF0000;">Failed to 
create database! </span><br><span style="font-size: 12pt;">&gt;&gt;Please check the parameters and database server&lt;&lt;</span></p>
');
$sql = "CREATE TABLE `info`.`info1` (
`ID` INT NOT NULL ,
`information` TEXT NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";

mysql_query($sql) or die('Setup Failed');
echo('
<p style="color: #008000;	text-align: left;	font-size: 15pt;"">-Automatic setup completed successfully. Your Database is ready!</p>
');
}

$link=mysql_connect($host, $username, $password);
if(!$link) die('
<p style="text-align: center;	font-size: 20pt;"><span style="color: #FF0000;">Failed to connect to the database! </span>
<br><span style="font-size: 12pt;">&gt;&gt;Please check the parameters and database server&lt;&lt;</span></p>
');

$db_name="info"; 
$result=mysql_select_db($db_name);
if(!$result){
	setup();
}
if (isset($_GET['id'])&& isset($_POST['info'])){
	$id=$_GET['id'];
	$info=$_POST['info'];
	$sql="INSERT INTO info1(ID,information)VALUES('$id', '$info')";
	$result=mysql_query($sql);
	if (!$result) die (mysql_error());

}
?>


<table style="border: 1px solid #000000;width: 600" align="center">
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center;width: 151px;color: #2214B9;border-style: solid;border-width: 1px;"><strong>ID</strong></td>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center;color: #2214B9;border-style: solid;border-width: 1px;">
			<strong>Information</strong></td>
	</tr>
<?php
$sql="SELECT * FROM info1";
$result=mysql_query($sql);
$cntr=1;
while($rows=mysql_fetch_array($result)){
	$cntr++;
?>
	<tr>
		<td style="width: 151px;border-style: solid;border-width: 1px;text-align: center; height: 39px; font-size: 14pt;">
		<strong><?php echo $rows['ID'] ?></strong></td>
		<td style="border-style: solid;border-width: 1px; height: 39px;padding-left: 8px"><?php echo $rows['information'] ?></td>
	</tr>
<?php } ?>
	<tr><form method="post" action="<?php echo $_SERVER['PHP_SELF']."?id=$cntr" ?>">
		<td style="border-style: solid;border-width: 1px;text-align: center;width: 151px; height: 51px; font-size: 14pt;">
		<strong><?php echo $cntr?></strong></td>
		<td style="border-style: solid;border-width: 1px;padding-left: 8px; height: 51px;">
			<input name="info" type="text" style="width: 314px; height: 28px;">&nbsp;&nbsp;
			<input name="Sub1" type="submit" value="Add" style="width: 72px; height: 32px"></td>
	</form></tr>
</table>

<div style="text-align: center; height: 15px">

<br><font face="Tahoma"><a target="_blank" href="http://www.phpfreecode.com/"><span style="font-size: 8pt; text-decoration: none">PHP Free Code</span></a></font></div>
