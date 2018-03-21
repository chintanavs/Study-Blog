<?php
	if(isset($_POST['create_post'])){
		
		$post_title=$_POST['title'];
		$post_author=$_POST['author'];
		$post_date=date('d-m-y');
		$post_image=$_FILES['image']['name'];
		$post_image_temp=$_FILES['image']['tmp_name'];
		$post_category_id=$_POST['post_category'];
		$post_tags=$_POST['post_tags'];
		$post_comment_count=0;
		$post_content=$_POST['post_content'];
		$post_status=$_POST['post_status'];

		move_uploaded_file($post_image_temp,"../images/$post_image");

		$query="INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

		$result=mysqli_query($connection,$query);
		if(!$result){

			echo 'Failed to post';
		}
	}

?>

<form method='post' action="" enctype="multipart/form-data">

	<div class="form-group">
		<label for='title'>Post Title</label>
		<input type="text" name="title" class="form-control">
	</div>

	<div class="form-group">
		<select name="post_category">
		<?php

			$mquery="SELECT * FROM categories";
			$select_categories=mysqli_query($connection,$mquery);
			confirmQuery($select_categories);	
			while($row=mysqli_fetch_assoc($select_categories)){
				$cat_title=$row['cat_title'];
				$cat_id=$row['cat_id'];

				echo "<option value='$cat_id'>{$cat_title}</option>";
			}

		?>
		</select>
	</div>

	<div class="form-group">
		<label for='post_status'>Post Status</label>
		<input type="text" name="post_status" class="form-control">
	</div>

	<div class="form-group">
		<label for='title'>Author</label>
		<input type="text" name="author" class="form-control">
	</div>

	<div class="form-group">
		<label for='post_tags'>Post Tags</label>
		<input type="text" name="post_tags" class="form-control">
	</div>

	<div class="form-group">
		<label for='post_image'>Post Image</label>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for='post_content'>Post Content</label>
		<textarea type="text" name="post_content" class="form-control" cols='30' id="" rows="10"></textarea>
		
	</div>

	<div class="form-group">
		<input type="submit"  name="create_post" value="Publish Post" class="btn btn-primary">
	</div>
	
</form>