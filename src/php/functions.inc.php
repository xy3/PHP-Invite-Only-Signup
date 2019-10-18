<?php 

function logout()
{
	unset($_SESSION['logged_in']);
	header('Location: .');
}

function load_view($view)
{
	require_once "src/views/$view.php";
}

function verify_login($user, $pass)
{
	return true;
	// return password_verify($password, $hash);
}