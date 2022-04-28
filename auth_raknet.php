<?php
//WEB Auth UCP RakNet

$login = isset($_POST['login']) ? $_POST['login'] : false;
$password = isset($_POST['password']) ? $_POST['password'] : false;

if($password == "" or $login == "")
{
	echo "Заполните все поля";
}
else
{
	$query = mysql_query("SELECT `members_pass_salt`, `members_pass_hash` WHERE `name` = '{$login}' LIMIT 1");
	$query = mysql_fetch_array($query);
	if(!$query)
	{
		echo "Пользователь не найден";
	}
	else
	{
		if($query['members_pass_hash'] != md5(md5($query['members_pass_salt']) . md5($password)))
		{
			echo "Неверно введён пароль";
		}
		else
		{
			//...
			echo "Успешная авторизация";
		}
	}
}