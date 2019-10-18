<?php 

if (isset($_POST['action'])) {
	$_POST['action']($dbc, $_POST);
}

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

function register($dbc, $data)
{
	$user = strtolower($data['user']);
	$pass = password_hash($data['pass'], PASSWORD_DEFAULT);
	$code = strtoupper($data['code']);
	$email = strtolower($data['email']);
	
	$user = $dbc->real_escape_string($user);
	$email = $dbc->real_escape_string($email);
	$pass = $dbc->real_escape_string($pass);

	$sql = "INSERT INTO users (username, email, password, invite_code) VALUES('$user', '$email', '$pass', '$code')";
	$result = $dbc->query($sql);
	
	if ($result)
		return true;

	return false;
}
