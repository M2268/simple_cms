<?php ob_start(); ?>
<?php include "includes/header.php" ?>





<?php session_start(); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>

                        <div class="col-xs-6">

                            <?php //ADD CATEGORY
                            if(isset($_POST['submit']))
                            {
                                $cat_name = $_POST['cat_name'];
                                if($cat_name=="" || empty($cat_name)){
                                    echo "This field shouldn't be empty";
                                }
                                else{
                                    $query = "INSERT INTO categories(cat_name) ";
                                    $query .= "VALUE ('{$cat_name}')";
                                    $create_category_query = mysqli_query($connection, $query);
                                    if(!$create_category_query){
                                        die('QUERY FAILED'.mysqli_error($connection));
                                    }
                                }
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_name">Add Category</label>
                                    <input type="text" class="form-control" name="cat_name">
                                    <input class="btn btn-primary" type="submit" name="submit" value="ADD CATEGORY">
                                </div>
                            </form>

                            <?php
                            if(isset($_GET['edit'])){

                                $cat_id = $_GET['edit'];
                                include "includes/update_categories.php";

                            }
                            ?>

                        </div><!--add category form-->
                        <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php  // FIND ALL CATEGORIES
                            $query = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_categories))
                            {
                                $cat_id = $row['cat_id'];
                                $cat_name = $row['cat_name'];
                                echo "<tr><td>{$cat_id}</td>";
                                echo "<td>{$cat_name}</td>";
                                echo "<td><a href='categories.php?delete={$cat_id}'>delete</td>";
                                echo "<td><a href='categories.php?edit={$cat_id}'>edit</td>";
                                echo "</tr>";
                            }
                            ?>

                            <?php //DELETE QUERY

                            if(isset($_GET['delete'])){
                                $get_cat_id = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";
                                $delete_query = mysqli_query($connection,$query);
                                header("Location: categories.php");
                            }

                            ?>
                            </tbody>

                        </table>
                        </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/footer.php" ?>