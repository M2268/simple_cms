<form action="" method="post">
    <div class="form-group">
        <label for="cat_name">Edit Category</label>
        <?php
        if(isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];

            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
            $select_categories_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['cat_id'];
                $cat_name = $row['cat_name'];
                ?>


                <input value="<?php if(isset($cat_name)) {echo $cat_name;} ?>" type="text" class="form-control" name="cat_name">

        <?php }}?>
        <?php //UPDATE CATEGORY
        if(isset($_POST['update_category'])) {
            $get_cat_name = $_POST['cat_name'];
            $query = "UPDATE categories SET cat_name = '{$get_cat_name}' WHERE cat_id = '{$cat_id}' ";
            $update_query = mysqli_query($connection, $query);
            if(!$update_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }        }

        ?>

        <input class="btn btn-primary" type="submit" name="update_category" value="UPDATE CATEGORY">
    </div>
</form>