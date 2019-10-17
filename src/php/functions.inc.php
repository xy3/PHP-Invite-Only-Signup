<?php 

function logout(){
	unset($_SESSION['logged_in']);
	header('Location: .');
}

function load_view($view) {
	require_once "./src/php/$view.php";
}

function check_password($password){
	return password_verify($password, $hash);
}