<?php include 'includes/admin_header.php' ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php include 'includes/admin_navigation.php' ?>>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                  <!-- Form to add new category -->
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
<?php
if(isset($_POST['submit'])) {
  $cat_title = $_POST['cat_title'];
  if($cat_title == "" || empty($cat_title)){
    echo "This field should not be empty";
  } else {
    $query = "INSERT INTO categories (cat_title) VALUE ('{$cat_title}') ";
    $create_category = mysqli_query($connection, $query);
    if(!$create_category){
      die('QUERY FAILED' . mysqli_error($connection));
    }
  }
}
?>



                          <form action="" method="post">
                            <div class="form-group">
                              <label for="cat_title">Add Category</label>
                              <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                          </form>
        <?php
        if(isset($_GET['edit'])){
          $cat_id = $_GET['edit'];

          $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";                      //FIND ALL CATEGORIES
          $select_categories_id = mysqli_query($connection, $query);
          ?>
                          <form action="" method="post">
                            <div class="form-group">
                              <label for="cat_title">Edit Category</label>
          <?php

          while($row = mysqli_fetch_array($select_categories_id)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            ?>
                            <input value="<?php if(isset($cat_title)) { echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">
                            </div>
        <?php  }
        }
         ?>
          <?php if(isset($_GET['edit'])){
            ?>
                              <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="submit" value="Edit Category">
                             </div>
              <?php } ?>
                          </form>

                        </div>
                        <div class="col-xs-6">
                  <!-- Categories list -->
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>

<?php
$query = "SELECT * FROM categories";                      //FIND ALL CATEGORIES
$select_categories = mysqli_query($connection, $query);

while($row = mysqli_fetch_array($select_categories)){
  $cat_id = $row['cat_id'];
  $cat_title = $row['cat_title'];
  echo "<tr>
          <td>{$cat_id}</td>
          <td>{$cat_title}</td>
          <td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>
          <td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>
        </tr>  ";
  }
?>
<?php
//Delete query
if(isset($_GET['delete'])){
  $the_cat_id = $_GET['delete'];     //Assigns ID for the row, which will be deleted
  $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
  $delete_category = mysqli_query($connection, $query);
  header("Location: categories.php");
}
 ?>
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
    </div>


    <!-- /#wrapper -->

<?php include 'includes/admin_footer.php' ?>
