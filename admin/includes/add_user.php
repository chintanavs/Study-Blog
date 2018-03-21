<?php
	if(isset($_POST['create_user'])){
		
		
		$user_firstname=$_POST['user_firstname'];
		$user_lastname=$_POST['user_lastname'];
		$user_email=$_POST['user_email'];
		$user_role=$_POST['user_role'];
		$username=$_POST['username'];
		$user_password=$_POST['user_password'];

		//move_uploaded_file($post_image_temp,"../images/$post_image");

		$query="INSERT INTO users(user_firstname,user_lastname,user_email,user_role,username,user_password) VALUES('{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}','{$username}','{$user_password}')";

		$result=mysqli_query($connection,$query);
		if(!$result){

			echo 'Failed to add User';
		}

		echo "User Created: "."<a href='users.php'>View Users</a>";
	}

?>

<form method='post' action="" enctype="multipart/form-data">

	<div class="form-group">
		<label for='title'>Firstname</label>
		<input type="text" name="user_firstname" class="form-control">
	</div>

	<div class="form-group">
		<label for='title'>Lastname</label>
		<input type="text" name="user_lastname" class="form-control">
	</div>

	<div class="form-group">
		<label for='title'>Username</label>
		<input type="text" name="username" class="form-control">
	</div>

	<div class="form-group">
		<select name="user_role" id="">
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
		
	</div>
	

	<div class="form-group">
		<label for='title'>Email</label>
		<input type="email" name="user_email" class="form-control">
	</div>
	

	<div class="form-group">
		<label for='title'>Password</label>
		<input type="password" name="user_password" class="form-control">
	</div>

	<!-- <div class="form-group">
		<label for='post_image'>Post Image</label>
		<input type="file" name="image">
	</div> -->

	<!-- <div class="form-group">
		<label for='post_content'>Post Content</label>
		<textarea type="text" name="post_content" class="form-control" cols='30' id="" rows="10"></textarea>
		
	</div> -->

	<div class="form-group">
		<input type="submit"  name="create_user" value="Create User" class="btn btn-primary">
	</div>
	
</form>