 <table class='table table-hover table-bordered'>
    <thead>
        <tr>
            <th>Id</th>
            <th width='70px'>Username</th>
            <th width='120px'>Firstname</th>
            <th width='150px'>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>
        <?php

        $query='SELECT * FROM users';
        $select_comments=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_comments)){
            $user_id=$row['user_id'];
            $username=$row['username'];
            $user_password=$row['user_password'];
            $user_firstname=$row['user_firstname'];
            $user_lastname=$row['user_lastname'];
            $user_email=$row['user_email'];
            $user_image=$row['user_image'];
            $user_role=$row['user_role'];
            
            
            
            
           
            echo '<tr>';
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
       //     echo "<td>{$comment_post_id}</td>";
            

            

              /*  $tquery="SELECT * FROM categories WHERE cat_id={$post_category_id}";
                $updated=mysqli_query($connection,$tquery);
                confirmQuery($updated);
                while($row=mysqli_fetch_assoc($updated)){
                $cat_title=$row['cat_title'];
                $cat_id=$row['cat_id'];
                }*/

        
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";            
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            

           /* $query="SELECT * FROM posts WHERE post_id={$comment_post_id}";
            $result=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($result)){

                $post_id=$row['post_id'];
                $post_title=$row['post_title'];
                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";

            }*/

            
            
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
        }

        //DELETE USER
        if(isset($_GET['delete'])){

            $the_user_id=$_GET['delete'];
            $query="DELETE FROM users WHERE user_id={$the_user_id}";
            $qresult=mysqli_query($connection,$query);
            if(!$qresult){
                echo 'user cannot be deleted';
            }
            header("Location:users.php");
            
        }

        //CHANGE TO ADMIN
        if(isset($_GET['change_to_admin'])){

            $the_user_id=$_GET['change_to_admin'];
            $yquery="UPDATE users SET user_role='admin' WHERE user_id={$the_user_id}";
            $result=mysqli_query($connection,$yquery);
            header("Location:users.php");
        }

         //CHANGE TO SUBSCRIBER
        if(isset($_GET['change_to_subscriber'])){

            $the_user_id=$_GET['change_to_subscriber'];
            $ytquery="UPDATE users SET user_role='subscriber' WHERE user_id={$the_user_id}";
            $result=mysqli_query($connection,$ytquery);
            header("Location:users.php");
        }
        ?>
    </tbody>
</table>