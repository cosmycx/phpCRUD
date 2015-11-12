<?php
if( !isset ($_SESSION['userName']) && !isset ($_SESSION['password']) ) header("Location:index.php");// If session is not set redirect to Login Page

//db connection-----------------------------------------------------------------------------------------------
	$mysqli_handle = new mysqli ("localhost", "root","", "my_test_db", 3306);

	if ($mysqli_handle->connect_error){
		die(' Connect Error to DB (' . $mysqli_handle->connect_errno . ')' . $mysqli_handle->connect_error) . "\n";
	} 
		/*else{
			//echo'Conected!' . $mysqli_handle->host_info. "\n";
			//$mysqli_handle->close();
		}*/

//end db connection-------------------------------------------------------------------------------------------
?>
