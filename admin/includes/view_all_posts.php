<?php


if(isset($_POST['checkBoxArray'])){

    foreach ($_POST['checkBoxArray'] as $postValueId) {
        
        $bulk_options=$_POST['bulk_options'];

        switch($bulk_options){


            case 'published':

                $query="UPDATE posts SET post_status='{$bulk_options}' WHERE post_id='{$postValueId}'";
                $result=mysqli_query($connection,$query);
                break;


            case 'draft':

                $query="UPDATE posts SET post_status='{$bulk_options}' WHERE post_id='{$postValueId}'";
                $result=mysqli_query($connection,$query);
                break;


            case 'delete':

                $query="DELETE FROM posts WHERE post_id='{$postValueId}'";
                $result=mysqli_query($connection,$query);
                break;






        }

    }


}



?>



<form action="" method="post">


 <table class='table table-hover table-bordered'>


    <div id="bulkOptionsContainer" style="padding:0px" class="col-xs-4">

        <select name="bulk_options" id="" class="form-control">


            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>            
            <option value="delete">Delete</option>
            

        </select>

    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="add_post.php" class="btn btn-primary">Add New</a>
    </div>






    <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes" name=""></th>
            <th>Id</th>
            <th width='70px'>Author</th>
            <th width='120px'>Title</th>
            <th width='30px'>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th width='70px'>Tags</th>
            <th width='30px'>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>
        <?php

        $query='SELECT * FROM posts';
        $select_posts=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_posts)){
            $post_id=$row['post_id'];
            $post_title=$row['post_title'];
            $post_author=$row['post_author'];
            $post_date=$row['post_date'];
            $post_image=$row['post_image'];
            $post_category_id=$row['post_category_id'];
            $post_tags=$row['post_tags'];
            $post_comment_count=$row['post_comment_count'];
            $post_status=$row['post_status'];
            echo '<tr>';

            ?>


             <td><input type="checkbox" id="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>

            <?php
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";

            

                $tquery="SELECT * FROM categories WHERE cat_id={$post_category_id}";
                $updated=mysqli_query($connection,$tquery);
                confirmQuery($updated);
                while($row=mysqli_fetch_assoc($updated)){
                $cat_title=$row['cat_title'];
                $cat_id=$row['cat_id'];
                }

        

            echo "<td>{$cat_title}</td>";
            echo "<td>{$post_status}</td>";
            echo "<td><img class='img-responsive' width='100' src='../images/{$post_image}' alt='no imgae found'</td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo '</tr>';
        }


        if(isset($_GET['delete'])){

            $the_post_id=$_GET['delete'];
            $query="DELETE FROM posts WHERE post_id={$the_post_id}";
            $result=mysqli_query($connection,$query);
            if(!$result){
                echo 'post cannot be deleted';
            }
            header("Location:posts.php");
        }

        ?>
    </tbody>
</form>
</table>