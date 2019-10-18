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

function verify_login($dbc, $user, $pass)
{
	$user = strtolower($user);
	$result = $dbc->query("SELECT * FROM users WHERE username='$user'");
	
	if (!$result || !$result->num_rows)
		return false;

	$userdata = $result->fetch_assoc();
	$hash = $userdata['password'];
	return password_verify($pass, $hash);
}