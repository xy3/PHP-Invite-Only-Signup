<?php 

session_start();

require_once 'dbc.inc.php';

function status($status, $msg='') {
	echo json_encode(array('status' => $status, 'message' => $msg));
}
function success($msg='') { return status(1, $msg); }
function failure($msg='') { return status(0, $msg); }

function show_view($view) {
	require_once "src/views/$view.php";
}


if (isset($_REQUEST['action'])) {
	$_REQUEST['action']($dbc, $_REQUEST);
}



//=================== Begin Login + Register ==================


function login($dbc, $data)
{
	$user = strtolower($data['user']);
	$pass = strtolower($data['pass']);
	$type = strpos($user, '@') ? 'email' : 'username';

	$result = $dbc->query("SELECT * FROM users WHERE $type='$user'");
	if (!$result || !$result->num_rows)
		return failure("Login is incorrect");

	$hash = $result->fetch_assoc()['password'];
	
	$status = password_verify($pass, $hash);
	$_SESSION['logged_in'] = $status;
	
	return $status ? success() : failure("Login is incorrect");
}


function logout()
{
	unset($_SESSION['logged_in']);
	header('Location: .');
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

