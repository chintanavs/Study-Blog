<?php include "db.php"; ?>
<?php session_start(); ?>


<?php 

	if(isset($_POST['login'])){


	$username=$_POST['username'];
	$password=$_POST['password'];
	$username=mysqli_real_escape_string($connection,$username);
	$password=mysqli_real_escape_string($connection,$password);

	$query="SELECT * FROM users WHERE username='{$username}'";
	$result=mysqli_query($connection,$query);
	if(!$result){
		die("LOGIN FAILED".mysqli_error($connection));
	}

	 while($row=mysqli_fetch_assoc($result)){

	 	//$the_password=$row['user_password'];
	 	$db_id=$row['user_id'];
	 	$db_role=$row['user_role'];
	 	$db_firstname=$row['user_firstname'];
	 	$db_lastname=$row['user_lastname'];
	 	$db_username=$row['username'];
	 	$db_password=$row['user_password'];
	 }
	 	if($password === $db_password && $username === $db_username){

	 		$_SESSION['username']=$db_username;
	 		$_SESSION['firstname']=$db_lastname;
	 		$_SESSION['lastname']=$db_firstname;
	 		$_SESSION['user_role']=$db_role;
	 		$_SESSION['user_id']=$db_id;
	 		header("Location:../admin");

	 	}else{

	 		header("Location:../index.php");

	 	}

	 
	}

?>