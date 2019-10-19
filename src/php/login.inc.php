<?php

require_once 'dbc.inc.php';
require_once 'functions.inc.php';


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'])
{
	show_view($view);
}

else { ?>

	<h1>Login</h1>
	<form id="login_form" action="." method="post">
		<input name="user" type="text" placeholder="Email or Username" autofocus>
		<input name="pass" type="password" placeholder="Password">
		<button type="submit">Submit</button>
	</form>
	<p id="result"></p>
	<a href="register.php">Register</a>

<?php }


?>
