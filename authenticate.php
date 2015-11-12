<?php
session_start();

if ($_POST && !empty( $_POST['userName'] ) && !empty( $_POST['password'] ) ){

//!!to use hash and check if user name and password are valid
	//if( ($_POST['userName']==='the_user_name' ) && ($_POST['password']==='the_pass') ){

			$_SESSION['userName'] = $_POST['userName'];
			$_SESSION['password'] = $_POST['password'];
	//}
}

header("Location: index.php");

?>