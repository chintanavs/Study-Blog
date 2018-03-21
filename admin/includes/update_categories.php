 
<?php

if(isset($_POST['update_categories'])){

	$the_cat_title=$_POST['cat_title'];
	$tquery="UPDATE categories SET cat_title='{$the_cat_title}' WHERE cat_id={$cat_id}";
	$updated=mysqli_query($connection,$tquery);
	if(!$updated){
		echo 'category cannot be updated'.mysqli_error($connection);
	}
	header("Location:categories.php");
}
?>