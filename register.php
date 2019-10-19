<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="./src/css/style.css">

</head>
<body>
	<h1>Register</h1>
	<form id='register_form' action="#" method="POST">
		<input type="email" name='email' placeholder="Email" required>
		<input type="text" name='username' placeholder="User" required>
		<input type="password" name='password' placeholder="Password" id='password' required>
		<input type="password" name='confirm_pass' placeholder="Confirm Password" required>
		<input type="text" name='code' placeholder="Invite Code" required>
		<input type="submit">
	</form>
	<p id='result'></p>
	<a href=".">Login</a>


	<script src="./src/js/jquery-3.4.0.min.js"></script>
	<script src="./src/js/jquery.validate.min.js"></script>
	<script src="./src/js/functions.js"></script>
	<script src="./src/js/ajax.functions.js"></script>
</body>
</html>