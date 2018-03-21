<?php

if(isset($_GET['user_id'])){

	$u_id=$_GET['user_id'];
}
$query="SELECT * FROM users WHERE user_id='$u_id'";
$select_user_by_id=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_user_by_id)){
	 		
    $username=$row['username'];
    $user_password=$row['user_password'];
    $user_firstname=$row['user_firstname'];
    $user_lastname=$row['user_lastname'];
    $user_email=$row['user_email'];
    $user_role=$row['user_role'];
            	
}


if(isset($_POST['update_user'])){

	$user_firstname=$_POST['user_firstname'];
	$user_lastname=$_POST['user_lastname'];
	$user_email=$_POST['user_email'];
	$user_role=$_POST['user_role'];
	$username=$_POST['username'];
	$user_password=$_POST['user_password'];


	//move_uploaded_file($post_image_temp,"../images/$post_image");

	/*if(empty($post_image)){

		$query="SELECT * FROM posts WHERE post_id=$p_id";
		$uresult=mysqli_query($connection,$query);
		while($row=mysqli_fetch_assoc($uresult)){

			$post_image=$row['post_image'];
		}

	}*/

		$query="UPDATE users SET user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}',user_role='{$user_role}',username='{$username}',user_password='{$user_password}' WHERE user_id={$u_id}";
		$uresult=mysqli_query($connection,$query);
		confirmQuery($uresult);

}


?>

<form method='post' action="" enctype="multipart/form-data">

	<div class="form-group">
		<label for='title'>Firstname</label>
		<input type="text" name="user_firstname" value="<?php echo $user_firstname;?>" class="form-control">
	</div>

	<div class="form-group">
		<label for='title'>Lastname</label>
		<input type="text" name="user_lastname" value="<?php echo $user_lastname;?>" class="form-control">
	</div>

	<div class="form-group">
		<label for='title'>Username</label>
		<input type="text" name="username" value="<?php echo $username;?>" class="form-control">
	</div>

	<div class="form-group">
		<select name="user_role">
			<option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>
		<?php
			
			if($user_role =='admin'){

				echo "<option value='subscriber'>subscriber</option>";

			}else{

				echo "<option value='admin'>admin</option>";
		}


		?>
		</select>
	</div>
	

	<div class="form-group">
		<label for='title'>Email</label>
		<input type="email" name="user_email" value="<?php echo $user_email;?>" class="form-control">
	</div>
	

	<div class="form-group">
		<label for='title'>Password</label>
		<input type="password" name="user_password" value="<?php echo $user_password;?>" class="form-control">
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
		<input type="submit"  name="update_user" value="Update User" class="btn btn-primary">
	</div>
	
</form>