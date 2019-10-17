<?php

session_start();


// if post password set:
// 	logged_in = checkpassword()
if (isset($_POST['password']) && $_POST['password']) {
	$_SESSION['logged_in'] = check_password($_POST['password']);
	header('Location: .');
}



// if logged_in:
// 	load_page
// else:
// 	display login form 
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && !isset($_GET['action'])) {
	LoadPage();
} else { ?>

	<form class="loginform" action="." method="post">
		<h1>Enter the password</h1>
		<input name="password" type="text" placeholder="Password" autofocus>
		<button type="submit"> Submit </button>
	</form>

<?php }




//=================== GET ACTIONS ==================

if (isset($_GET['action'])) {
	// Executes the action param e.g. ?action=logout
	$_GET['action']();
}





?>
