<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Content Management System, CRUD, database, javascript, php">
    <meta name="author" content="Codeartist">

    <title>Codeartist - CMS CRUD</title>

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="signin.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<?php
if ( isset($_POST['logoutreturn']) ) $_SESSION = array();
if( !isset ($_SESSION['userName']) && !isset ($_SESSION['password']) ) {// Login Page	
?>
<body>
	<header>
	    <div class="container">

	      <form class="form-signin" action="authenticate.php" method="POST">

	        <h2 class="form-signin-heading">Please sign in</h2>

		        <label for="userName" class="sr-only">User address</label>
		        <input name="userName" type="text" id="userName" class="form-control" placeholder="User Name" required autofocus>
	        
		        <label for="inputPassword" class="sr-only">Password</label>
		        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>

	        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
	      </form>

	    </div> <!-- /container -->
	</header>
<?php
}//end session login page

else{//session signed in

	require_once('databaseConn.php'); 
	echo('
	<div class="container-fluid">
	<h3 class="text-center">BLOG - Content Management System</h3>
	
	<!--/////////////////////////////////////////////////add new record///////////////////////////////////////////////////////-->

	<form action="" method="POST">
		<p><button type="button submit" name="logoutreturn" class="btn btn-danger">Log Out</button> and return </p>
	</form>
	<p><a href="AddPost.php" class="btn btn-primary" >Add Post</a></p>


	<table class="table table-bordered table-hover">
		<tr class="success">
			<th>PostId</th>
			<th>PostOrder</th>
			<th>PostCategory</th>
			<th>PostTitle</th>
			<th>PostBrief</th>
			<th>PostDateTime</th>
			<th>PostPath</th>
			<th>PostButtonLink</th>

			<th>VIEW</th>
			<th>EDIT</th>
			<th>DELETE</th>
		
		</tr>');
		
	if( isset($_POST['delete']) ){
				   				$rowId = $_POST['delete'];	
				   				//echo 'row Id:' . $rowId;
								$deleteQuery = 'DELETE FROM BLOGTEST WHERE PostId='.$rowId;
								$result = $mysqli_handle->query($deleteQuery);
	}

	//data display into HTML--------------------------------------------------------------------------------------
	$query = 'SELECT * FROM BLOGTEST ORDER BY PostOrder ASC, PostDateTime DESC';

	if ($result = $mysqli_handle->query($query)) {

	    /* fetch object array */
	    while ($obj = $result->fetch_object()) {

	    	echo '<tr>';//*********START OF ONE ROW***********

	        	echo '<td>'. $obj->PostId 				. '</td>';
	        	echo '<td>'. $obj->PostOrder 			. '</td>';
	        	echo '<td>'. $obj->PostCategory			. '</td>';
	        	echo '<td>'. $obj->PostTitle		 	. '</td>';
	        	echo '<td>'. $obj->PostBrief 			. '</td>';
	        	echo '<td>'. $obj->PostDateTime			. '</td>';
	        	echo '<td>'. $obj->PostPath				. '</td>';
	        	echo '<td>'. $obj->PostButtonLink		. '</td>';       	

	//-------------------------------------------------------------------------VIEW-------------------------------------------------
	        	echo '<td><form action="ViewPost.php" method="POST">
							<button type="button submit" class="btn btn-success"
			 					name="view" value="'.$obj->PostId.'" >View
							</button>
						</form>
	        	</td>';
	//-------------------------------------------------------------------------END VIEW---------------------------------------------
	//-------------------------------------------------------------------------EDIT-------------------------------------------------
	        	echo '<td><form action="EditPost.php" method="POST">
							<button type="button submit" class="btn btn-info"
			 					name="edit" value="'.$obj->PostId.'" >Edit
							</button>
						</form>
	        	</td>';
	//-------------------------------------------------------------------------END EDIT---------------------------------------------
	//-------------------------------------------------------------------------DELETE-------------------------------------------------
	        	echo '<td>							
						<button type="button" class="btn btn-warning deletePostButton" id="'.$obj->PostId.'"/>Delete</button>
	        		</td>';
	//-------------------------------------------------------------------------END DELETE-------------------------------------------------
	        
	        echo '</tr>';//***********END OF ONE ROW***********

	    }

    $result->close();
    
}

//end data display into HTML----------------------------------------------------------------------------------	
?>
</table><!--//***********End of records***********-->

<!--////////////////////////////////////////////////////delete confirm, modal window////////////////////////////////////////////////////////-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm</h4>
      </div>
      <div class="modal-body">
        <p>Post Id: <span id="confirmDelete"></span></p>
        <b>Confirm delete?</b>
      </div>
      <div class="modal-footer">
      	<form method="POST" >

        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        	<button id="buttonConfirmDelete" type="button submit" class="btn btn-warning">Delete
        	</button>

        </form>

      </div>
    </div>
  </div>
</div>
<!--/////////////////////////////////////////////////end delete confirm, modal window///////////////////////////////////////////////////////-->

</div><!--///end container fluid-->

<!--JS files-->
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
//delete modal code******************************************************************//
		$('button.deletePostButton').click(function(){
		$('#myModal').modal('show');
		var rowId = $(this).attr("id");
		document.getElementById("confirmDelete").innerHTML = rowId;

		document.getElementById("buttonConfirmDelete").name = "delete";
		document.getElementById("buttonConfirmDelete").value = rowId;
		});
//end delete modal code**************************************************************//
</script>
<?php 	
}//end else

// long session check
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    if (isset( $COOKIE[session_name()] ) ){
	setcookie(session_name(), '', time()-86400, '/');
}
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>

</body>

</html>