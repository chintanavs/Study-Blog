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
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <div class='col-xs-6'>
                            <?php   insert_categories();   ?>




                            <form  action='' method='post'>
                                <div class='form-group'>
                                    <label for='cat_title'>Add Category</label>
                                    <input type="text"  name='cat_title' class='form-control'>
                                </div>
                                <div class='form-group'>
                                    <input type="submit"  name='submit' class='btn btn-primary' value="Add Category">
                                </div>

                            </form>

                            <form  action='' method='post'>

                                <?php 

                                 //UPDATE CATEGORY QUERY

                                if(isset($_GET['edit'])){

                                    $the_cat_id=$_GET['edit'];
                                    $uquery="SELECT * FROM categories WHERE cat_id={$the_cat_id}";
                                    $updated=mysqli_query($connection,$uquery);
                                    while($row=mysqli_fetch_assoc($updated)){
                                     $cat_id=$row['cat_id'];
                                     $cat_title=$row['cat_title'];
                                     ?>

                                     <div class='form-group'>
                                        <label for='cat_title'>Update Category</label>
                                        <input type="text"  name='cat_title' class='form-control' value="<?php if(isset($cat_title)){echo $cat_title;} ?>">

                                    </div>

                                    <?php

                                    if(isset($_GET['edit'])){

                                        $cat_id=$_GET['edit'];

                                        include 'includes/update_categories.php';


                                    }


                                    ?>

                                    <div class='form-group'>
                                        <input type="submit"  name='update_categories' class='btn btn-primary' value="Update Category">
                                    </div>




                                </form>
                                <?php } }?>

                            </div>





                        </div>
                        <div class='col-xs-6'>

                            <table class='table table-bordered table-hover'>
                                <thead>

                                    <tr>
                                        <th>ID</th>
                                        <th>CATEGORY TITLE</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>


                                </thead>
                                <tbody>
                                    <tr>
                                        <?php

                            //find all categories query
                                        findAllCategories();

                                        ?>


                                        <?php 

                //DELETE CATEGORY QUERY
                                        delete_categories();

                                        ?>

                                    </tr>
                                </tbody>



                            </table>

                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php
        include 'includes/admin_footer.php';
        ?>