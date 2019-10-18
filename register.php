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
		<input type="text" name='email' placeholder="Email">
		<input type="text" name='user' placeholder="User">
		<input type="password" id='password' name='pass' placeholder="Password">
		<input type="password" name='confirm_pass' placeholder="Confirm Password">
		<input type="submit">
	</form>
	<a href=".">Login</a>


	<script src="./src/js/jquery-3.4.0.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script src="./src/js/functions.js"></script>
</body>
</html>