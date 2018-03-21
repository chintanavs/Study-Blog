<?php

if(isset($_GET['post_id'])){

	$p_id=$_GET['post_id'];
}
$query="SELECT * FROM posts WHERE post_id='$p_id'";
$select_posts_by_id=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_posts_by_id)){
	$post_id=$row['post_id'];
	$post_title=$row['post_title'];
	$post_author=$row['post_author'];
	$post_date=$row['post_date'];
	$post_image=$row['post_image'];
	$post_category_id=$row['post_category_id'];
	$post_tags=$row['post_tags'];
	$post_content=$row['post_content'];
	$post_comment_count=$row['post_comment_count'];
	$post_status=$row['post_status'];		
}


if(isset($_POST['update_post'])){

	$post_title=$_POST['title'];
	$post_author=$_POST['author'];
	$post_date=date('d-m-y');
	$post_image=$_FILES['image']['name'];
	$post_image_temp=$_FILES['image']['tmp_name'];
	$post_category_id=$_POST['post_category'];
	$post_tags=$_POST['post_tags'];
	$post_comment_count=4;
	$post_content=$_POST['post_content'];
	$post_status=$_POST['post_status'];

	move_uploaded_file($post_image_temp,"../images/$post_image");

	if(empty($post_image)){

		$query="SELECT * FROM posts WHERE post_id=$p_id";
		$uresult=mysqli_query($connection,$query);
		while($row=mysqli_fetch_assoc($uresult)){

			$post_image=$row['post_image'];
		}

	}

		$query="UPDATE posts SET post_title='{$post_title}',post_author='{$post_author}',post_date=now(),post_image='{$post_image}',post_category_id='{$post_category_id}',post_tags='{$post_tags}',post_content='{$post_content}',post_status='{$post_status}' WHERE post_id={$p_id}";

		$uresult=mysqli_query($connection,$query);
		confirmQuery($uresult);
		echo "Post updated successfully! <a class=bg-success href='../post.php?p_id={$p_id}'>View Post</a>";
}


?>


<form method='post' action="" enctype="multipart/form-data">

	<div class="form-group">
		<label for='title'>Post Title</label>
		<input type="text" value="<?php echo $post_title;?>" name="title" class="form-control">
	</div>

	<div class="form-group">
		<label for='post_categories'>Post Category</label>

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

		<select name="post_status">

			<?php


			echo "<option value='$post_status'>{$post_status}</option>";

			if($post_status=='draft'){

				echo "<option value='published'>published</option>";

			}else{

				echo "<option value='draft'>draft</option>";


			}




		?>			


		</select>
	</div>

	<div class="form-group">
		<label for='title'>Author</label>
		<input type="text" name="author" value="<?php echo $post_author;?>" class="form-control">
	</div>

	<div class="form-group">
		<label for='post_tags'>Post Tags</label>
		<input type="text" name="post_tags" value="<?php echo $post_tags;?>" class="form-control">
	</div>

	<div class="form-group">
		<img src="../images/<?php echo $post_image;?>" width='100' alt='no image found'>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for='post_content'>Post Content</label>
		<textarea type="text" name="post_content"  class="form-control" cols='30' id="" rows="10"><?php echo $post_content;?></textarea>
		
	</div>

	<div class="form-group">
		<input type="submit"  name="update_post" value="Update Post" class="btn btn-primary">
	</div>
	
</form>