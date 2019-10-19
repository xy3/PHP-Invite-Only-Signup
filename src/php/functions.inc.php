<?php 

require_once 'dbc.inc.php';

function success($msg='') {
	echo json_encode(array('status' => 1, 'message' => $msg));
}
function failure($msg='') {
	echo json_encode(array('status' => 0, 'message' => $msg));
}


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


function use_code($dbc, $code)
{
	$code = strtolower($code);

	$result = $dbc->query("SELECT code, uses, max_uses FROM invite_codes WHERE code='$code'");
	if (!$result)
		return false;

	$result = $result->fetch_assoc();
	if ($result['uses'] >= $result['max_uses'])
		return false;

	$update = $dbc->query("UPDATE invite_codes SET uses = uses + 1 WHERE code='$code'");
	if (!$update)
		return false;
	
	return true;
}


function register($dbc, $data)
{
	$user = strtolower($data['username']);
	$email = strtolower($data['email']);
	$pass = password_hash($data['password'], PASSWORD_DEFAULT);
	$code = $data['code'];

	$user = $dbc->real_escape_string($user);
	$email = $dbc->real_escape_string($email);
	$pass = $dbc->real_escape_string($pass);

	$dbc->autocommit(FALSE);

	$sql = "INSERT INTO users (username, email, password, invite_code) VALUES('$user', '$email', '$pass', '$code')";
	$result = $dbc->query($sql);
	
	if (!$result)
		return failure('This email or username is already taken.');
	
	if (!use_code($dbc, $code)) {
		$dbc->rollback();
		return failure('This code is not valid.');
	}

	$dbc->commit();
	$dbc->autocommit(TRUE);
	return success();

}
