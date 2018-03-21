    <?php
    include "includes/admin_header.php";
    ?>

    <div id="wrapper">

        <?php
        include "includes/admin_navigation.php";
        ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                             Welcome to Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->


                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php
                    //COUNT FOR POSTS
                    $query="SELECT * FROM posts";
                    $result=mysqli_query($connection,$query);
                    $post_counts=mysqli_num_rows($result);

                    //COUNT FOR CATEGORIES
                    $query1="SELECT * FROM categories";
                    $result1=mysqli_query($connection,$query1);
                    $categories_counts=mysqli_num_rows($result1);


                    //COUNT FOR COMMENTS
                    $query2="SELECT * FROM comments";
                    $result2=mysqli_query($connection,$query2);
                    $comments_counts=mysqli_num_rows($result2);



                    //COUNT FOR USERS
                    $query3="SELECT * FROM users";
                    $result3=mysqli_query($connection,$query3);
                    $users_counts=mysqli_num_rows($result3);


                    
                    
                    
                
                    echo "<div class='huge'>{$post_counts}</div>"


                    ?>

                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'><?php echo "<div class='huge'>{$comments_counts}</div>" ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo "<div class='huge'>{$users_counts}</div>" ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo "<div class='huge'>{$categories_counts}</div>" ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->




                <?php

                //QUERY FOR PUBLISHED POSTS. //COUNT FOR POSTS
                $query="SELECT * FROM posts WHERE post_status='published' ";
                $result=mysqli_query($connection,$query);
                $post_draft_counts=mysqli_num_rows($result);



                //COUNT FOR COMMENTS UNAPPROVED
                $query2="SELECT * FROM comments WHERE comment_status='unapproved'";
                $result2=mysqli_query($connection,$query2);
                $comments_unapproved_counts=mysqli_num_rows($result2);



                //COUNT FOR USERS SUBSCRIBER
                $query3="SELECT * FROM users WHERE user_role='subscriber'";
                $result3=mysqli_query($connection,$query3);
                $users_subscriber_counts=mysqli_num_rows($result3);

                ?>


                <div class="row">

                    <script type="text/javascript">
                       google.charts.load('current', {'packages':['bar']});
                       google.charts.setOnLoadCallback(drawChart);

                       function drawChart() {
                         var data = google.visualization.arrayToDataTable([
                           ['Data', 'Posts'],

                                <?php

                                    $element_text=['Active Posts','Draft Posts','Commnents','Unapproved Comments','Users','Subscribers','Categories'];
                                    $element_count=[$post_counts,$post_draft_counts,$comments_counts,$comments_unapproved_counts,$users_counts,$users_subscriber_counts,$categories_counts];


                                    for($i=0;$i<7;$i++){

                                        echo "['{$element_text[$i]}'".","."{$element_count[$i]}],";



                                    }

                                ?>

                           
                         ]);

                         var options = {
                           chart: {
                             title: '',
                             subtitle: '',
                           }
                         };

                         var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                         chart.draw(data, google.charts.Bar.convertOptions(options));
                       }
                     </script>

                     <div id="columnchart_material" style="width:'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php
        include 'includes/admin_footer.php';
        ?>