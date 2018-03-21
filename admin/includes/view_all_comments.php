 <table class='table table-hover table-bordered'>
    <thead>
        <tr>
            <th>Id</th>
            <th width='70px'>Author</th>
            <th width='120px'>Comments</th>
            <th width='150px'>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th width='30px'>Approve</th>
            <th width='30px'>Disapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $query='SELECT * FROM comments';
        $select_comments=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_comments)){
            $comment_id=$row['comment_id'];
            $comment_author=$row['comment_author'];
            $comment_content=$row['comment_content'];
            $comment_email=$row['comment_email'];
            $comment_status=$row['comment_status'];
            $comment_date=$row['comment_date'];
            $comment_post_id=$row['comment_post_id'];
            
            
            
            
           
            echo '<tr>';
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
       //     echo "<td>{$comment_post_id}</td>";
            

            

              /*  $tquery="SELECT * FROM categories WHERE cat_id={$post_category_id}";
                $updated=mysqli_query($connection,$tquery);
                confirmQuery($updated);
                while($row=mysqli_fetch_assoc($updated)){
                $cat_title=$row['cat_title'];
                $cat_id=$row['cat_id'];
                }*/

        
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            
            echo "<td>{$comment_status}</td>";

            $query="SELECT * FROM posts WHERE post_id={$comment_post_id}";
            $result=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($result)){

                $post_id=$row['post_id'];
                $post_title=$row['post_title'];
                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";

            }

            
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove={$comment_id}'>Disapprove</a></td>";
            echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
        }

        //DELETE COMMENT
        if(isset($_GET['delete'])){

            $the_comment_id=$_GET['delete'];
            $query="DELETE FROM comments WHERE comment_id={$the_comment_id}";
            $result=mysqli_query($connection,$query);
            if(!$result){
                echo 'comment cannot be deleted';
            }
            header("Location:comments.php");
            $newquery="UPDATE posts SET post_comment_count=post_comment_count-1 WHERE post_id={$comment_post_id}";
            $count_comment=mysqli_query($connection,$newquery);
        }

        //DISAPPROVE COMMENT
        if(isset($_GET['unapprove'])){

            $the_comment_id=$_GET['unapprove'];
            $unapprove_query="UPDATE comments SET comment_status='unapproved' WHERE comment_id={$the_comment_id}";
            $result=mysqli_query($connection,$unapprove_query);
            header("Location:comments.php");
        }

        //APPROVE COMMENT
        if(isset($_GET['approve'])){

            $the_comment_id=$_GET['approve'];
            $approve_query="UPDATE comments SET comment_status='approved' WHERE comment_id={$the_comment_id}";
            $result=mysqli_query($connection,$approve_query);
            header("Location:comments.php");
        }

        ?>
    </tbody>
</table>