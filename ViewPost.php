<?php
session_start();
    if( !isset ($_SESSION['userName']) && !isset ($_SESSION['password']) ) header("Location:index.php");// If session is not set redirect to Login Page
?>
 <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="website of Codeartist, web development, web design, custom software, databases, Atlanta, javascript, php">
    <meta name="author" content="Codeartist">

    <title>Codeartist - Blog - Content Management System</title>

 	    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

</head>

<body>

<div class="container-fluid">
<!--/////////////////////////////////////////////////return main///////////////////////////////////////////////////////-->
<div class="row">
	<div class="col-sm-11 col-sm-offset-1"><br>
		<a href="index.php" class="btn btn-success" >Return to Main</a>
	</div>
</div>

<?php require_once('databaseConn.php');
	if(isset($_POST['view'])){
								$rowId = $_POST['view'];
								//echo 'row Id:' . $rowId;
								$viewQuery = 'SELECT * FROM BLOGTEST WHERE PostId='.$rowId;
								//echo $viewQuery;

								if ($result = $mysqli_handle->query($viewQuery)) {
																				    /* fetch object array */
																				    $obj = $result->fetch_object();
								}
							}
?>

<!--/////////////////////////////////////////////////view post///////////////////////////////////////////////////////-->
<div class="row">
	<div class="col-sm-11 col-sm-offset-1">
		<h2>View Post:</h2>
	</div>
</div>

<!-- ........................................... -->
<div class="row">
		<div class="col-sm-1 col-sm-offset-1">
			<p class="text-right"><b>Post Id:</b></p>
		</div>
		<div class="col-sm-9">
			<p><?php echo $obj->PostId ?></p>
		</div>
</div><!--end row-->
<!-- ........................................... -->
<div class="row">
		<div class="col-sm-1 col-sm-offset-1">
			<p class="text-right"><b>Post Order:</b></p>
		</div>
		<div class="col-sm-9">
			<p><?php echo $obj->PostOrder ?></p>
		</div>
</div><!--end row-->
<!-- ........................................... -->
<div class="row">
		<div class="col-sm-1 col-sm-offset-1">
			<p class="text-right"><b>Post Category:</b></p>
		</div>
		<div class="col-sm-10">
			<p><?php echo $obj->PostCategory	 ?></p>
		</div>
</div><!--end row-->
<!-- ........................................... -->
<div class="row">
		<div class="col-sm-1 col-sm-offset-1">
			<p class="text-right"><b>Post Title:</b></p>
		</div>
		<div class="col-sm-10">
			<p><?php echo $obj->PostTitle  ?></p>
		</div>
</div><!--end row-->
<!-- ........................................... -->
<div class="row">
		<div class="col-sm-1 col-sm-offset-1">
			<p class="text-right"><b>Post Brief :</b></p>
		</div>
		<div class="col-sm-10">
			<p><?php echo $obj->PostBrief ?></p>
		</div>
</div><!--end row-->
<!-- ........................................... -->
<div class="row">
		<div class="col-sm-1 col-sm-offset-1">
			<p class="text-right"><b>Post Date Time:</b></p>
		</div>
		<div class="col-sm-10">
			<p><?php echo $obj->PostDateTime ?></p>
		</div>
</div><!--end row-->
<!-- ........................................... -->

<div class="row">
		<div class="col-sm-1 col-sm-offset-1">
			<p class="text-right"><b>Post Path:</b></p>
		</div>
		<div class="col-sm-10">
			<p><?php echo $obj->PostPath ?></p>
		</div>
</div><!--end row-->
<!-- ........................................... -->


<div class="row">
		<div class="col-sm-1 col-sm-offset-1">
			<p class="text-right"><b>Post Button:</b></p>
		</div>
		<div class="col-sm-10">
			<p><?php echo $obj->PostButtonLink ?></p>
		</div>
</div><!--end row-->
<!-- ........................................... -->

<!--/////////////////////////////////////////////end view post///////////////////////////////////////////////////////-->


</div><!--end container fluid-->
</body>
</html>