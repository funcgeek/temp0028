<!-- This Script is from www.phpfreecpde.com, Coded by: Kerixa Inc-->

<?php
function welcome($msg){
$username='Admin';
die('
<table style="border-width: 0px;width: 400px; height: 107px">
	<tr>
		<td style="border-style: solid;border-width: 0px;font-size: 17pt;background-color: #DFDFFF;">'.$msg.'</td></tr><tr>
		<td style="border-style: solid;border-width: 0px;font-size: 17pt;background-color: #DFDFFF;"><strong>Welcome '.$username.'</strong><br>
		<a href="'.$_SERVER['PHP_SELF'].'?type=logout"><span style="border-style: solid;border-width: 0px;background-color: #DFDFFF;">Logout</span></a></td>
	</tr>
</table>
');
}
$login='no';
if (isset($_COOKIE['username'])) $login='yes';

if (isset($_GET['type']) && $_GET['type']=='login'){
	if ($_GET['username']='Admin' && $_GET['password']='12345')
		setcookie('login','true',time()+3600);
		$login='yes';
}elseif (isset($_GET['type']) && $_GET['type']=='logout'){
		setcookie('login','',time()-3600);
		$login='no';
}

if ( $login=='yes')	
	welcome ('You are successfully logged in!');
else{
?>

<table style="border-width: 0px;width: 212px; height: 179px" align="center" cellpadding="0" cellspacing="0">
<tr>
		<td style="border-style: solid;border-width: 0px;background-color: #DFDFFF;">
		<form action="<?php echo $_SERVER['PHP_SELF'].'?type=login'?>" method="post" ><h1>Login</h1>
<table style='border:0px solid #000000;'>
<tr>
<td align='right'>
Username: 
<input type='text' size='15' maxlength='25' name='username' value="Admin">
</td>
</tr>
<tr>
<td align='right'>
Password: 
<input type='password' size='15' maxlength='25' name='password' value="12345">
</td>
</tr>
<tr>
<td align='center'>
<input type="submit" value="Login">
</td>
</tr>
</table>
		</form>
		</td>
	</tr>
</table>

<?php
}
?>

<br><font face="Tahoma"><a target="_blank" href="http://www.phpfreecode.com/"><span style="font-size: 8pt; text-decoration: none">PHP Free Code</span></a></font>