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
			<div class="col-sm-11 col-sm-offset-1">
				<h2>Edit Post:</h2>
			</div>
	</div><!--end row-->

<?php
	require_once('databaseConn.php');

	if(isset($_POST['edit'])){

		// print_r($_POST);
		//echo '<br>';  
		$rowId = $_POST['edit'];
		//echo 'row Id:' . $rowId;

		$viewQuery = 'SELECT * FROM BLOGTEST WHERE PostId='.$rowId;
		//echo $viewQuery;

		if ($result = $mysqli_handle->query($viewQuery)) {

		    /* fetch object array */
		    $obj = $result->fetch_object();
			//define variables and set to placeholder value------
			$aId = $obj->PostId;
			$aOrder = $obj->PostOrder;
			$aCategory = $obj->PostCategory;
			$aTitle = $obj->PostTitle;
			$aBrief = $obj->PostBrief;
			$aDateTime = $obj->PostDateTime;
			$aPath =$obj->PostPath;
			$aButtonLink = $obj->PostButtonLink;
			//end define variables and set to placeholder value---
		}
	}

	//--- isset savePost------------------------------------------------------------------------------------------------------------------------------
	if ( isset($_POST['savePost']) ){

	//save into DB--------------------------------------------------------------------------------------
		
		//----- clean for Html SQL---------------------------------------
		$aId =$_POST['postId'];
		$aDateTime = $_POST['postDateTime'];
		$aOrder = $_POST['postOrder'];
		//
		$aCategory = tUI($_POST['postCategory'], $mysqli_handle); 
		$aPath = tUI($_POST['postPath'], $mysqli_handle);
		$aTitle = tUI($_POST['postTitle'], $mysqli_handle);
		$aBrief = tUI($_POST['postBrief'], $mysqli_handle);
		$aButtonLink = tUI($_POST['postButtonLink'], $mysqli_handle);

		//--end clean for Html SQL---------------------------------------

		//saving record post--------------------------------------------------------------------------------------------------------------------
			$updateQuery = "UPDATE BLOGTEST SET PostDateTime=NOW(),PostCategory='$aCategory', PostOrder='$aOrder',
							 PostTitle='$aTitle', PostBrief='$aBrief', PostPath='$aPath', PostButtonLink='$aButtonLink'
							 WHERE PostId='$aId'";

		$result = $mysqli_handle->query($updateQuery);
			
		//end saving record podt---------------------------------------------------------------------------------------------------------------

	}//end isset savePost------------------------------------------------------------------------------------------------------------------------------
	
	function tUI($data,$mysqli_h) {//user input----------
		//$data = trim($data);
	   	//$data = stripslashes($data);
	   	$data = $mysqli_h->real_escape_string($data);
	   	$data = htmlspecialchars($data);
	  	return $data;
	}	//end tUI----------------------------------------
?>

	<div class="row">
		<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<!--..................................-->
			<div class="form-group"><br>
				<div class="col-xs-9 col-xs-offset-1">
					<a href="index.php" class="btn btn-success" >Return</a>
					
					<input type="submit" name="savePost" class="btn btn-primary" value="Save"><i> save before returning</i>
				</div>
			</div>	
			<!--..................................-->
			<div class="form-group">
				<label class="col-sm-2 control-label">Post Id:</label>
				<div class="col-sm-10">
					<input type="number" name="postId" placeholder="auto" value="<?php echo $aId;?>" readonly> <!---->
				</div>
			</div>
			<!--..................................-->
			<div class="form-group">
			    <label class="col-sm-2 control-label">Post Order:</label>
			    <div class="col-sm-10">
			    	<input type="number" name="postOrder" placeholder="Post Order" value="<?php echo $aOrder ?>">
			    </div>
			</div>
			<!--..................................-->
			<div class="form-group">
			    <label class="col-sm-2 control-label">Post Category:</label>
			    <div class="col-sm-10">
			    	<input type="text" name="postCategory" placeholder="Post Category" value="<?php echo $aCategory ?>">
			    </div>
			</div>
			<!--..................................-->
			<div class="form-group">
			    <label class="col-sm-2 control-label">Title:</label>
			    <div class="col-sm-10">
			    	<input type="text" name="postTitle" placeholder="Post Title" value="<?php echo $aTitle ?>">
			    </div>
			</div>
			<!--..................................-->
			<div class="form-group">
			    <label class="col-sm-2 control-label">Brief:</label>
			    <div class="col-sm-10">
			    	<textarea rows="4" cols="50" name="postBrief" placeholder="Post Brief"><?php echo $aBrief ?></textarea> 
			    </div>
			</div>
			<!--..................................-->
			<div class="form-group">
				<label class="col-sm-2 control-label">Date and Time:</label>
				<div class="col-sm-10">
			    	<input type="text" name="postDateTime" placeholder="auto" value="<?php echo $aDateTime;?>" readonly>
			    </div>
			</div>
			<!--..................................-->
			<div class="form-group">
			    <label class="col-sm-2 control-label">Post Path:</label>
			    <div class="col-sm-10">
					<input type="text" name="postPath" placeholder="Post Path" value="<?php echo $aPath;?>">
				</div>
			</div>
			<!--..................................-->
			<div class="form-group">
			    <label class="col-sm-2 control-label">Button Name:</label>
			    <div class="col-sm-10">
					<input type="text" name="postButtonLink" placeholder="Post Button Text" value="<?php echo $aButtonLink;?>">
				</div>
			</div>
			<!--..................................-->
		</form>
	</div><!--end row-->

</div><!--end container fluid-->
</body></html>