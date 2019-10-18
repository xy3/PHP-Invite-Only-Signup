<?php

session_start();

require 'functions.inc.php';
require 'dbc.inc.php';


if (isset($_POST['username']) && isset($_POST['password'])) {
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$_SESSION['logged_in'] = verify_login($dbc, $user, $pass);
	header('Location: .');
}

if (isset($_GET['logout'])) {
	logout();
}


if (isset($_SESSION['logged_in']) && isset($_SESSION['logged_in']))
{
	load_view($view);
}

else { ?>

	<h1>Login</h1>
	<form class="loginform" action="." method="post">
		<input name="username" type="text" placeholder="Username" autofocus>
		<input name="password" type="password" placeholder="Password">
		<button type="submit">Submit</button>
	</form>
	<a href="register.php">Register</a>

<?php }


?>
