<?php

function confirmQuery($case){

	global $connection;

	if(!$case){

		die('Query Failed'.mysqli_error($connection));
	}

}

function insert_categories(){

	global $connection;

	if(isset($_POST['submit'])){

		$cat_title=$_POST['cat_title'];
		if($cat_title=="" || empty($cat_title)){
			echo 'This field cannot be empty.';
		}else{
			$query="INSERT INTO categories(cat_title) VALUES('{$cat_title}')";
			$result=mysqli_query($connection,$query);
			if(!$result){
				echo 'Cannot add into catogeries';
			}
		}
	}

}

function findAllCategories(){

	global $connection;
	
	$query='SELECT * FROM categories';
	$select_catagories=mysqli_query($connection,$query);
	while($row=mysqli_fetch_assoc($select_catagories)){
		$cat_id=$row['cat_id'];
		$cat_title=$row['cat_title'];
		echo '<tr>';
		echo "<td>{$cat_id}</td>";
		echo "<td>{$cat_title}</td>";
		echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
		echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
		echo '</tr>';
	}







}

function delete_categories(){

	global $connection;
	if(isset($_GET['delete'])){

		$the_cat_id=$_GET['delete'];
		$tquery="DELETE FROM categories WHERE cat_id={$the_cat_id}";
		$deleted=mysqli_query($connection,$tquery);
		if(!$deleted){
			echo 'category cannot be deleted';
		}
		header("Location:categories.php");
	}
}

?>