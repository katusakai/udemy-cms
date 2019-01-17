<?php

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
 ?>
 <?php //UPDATE QUERY
  if(isset($_POST['update_category'])){
    $the_cat_title = $_POST['cat_title'];
    $query = "UPDATE categories SET cat_title = '{$the_cat_title}'
    WHERE cat_id = {$cat_id} ";
    $update_query = mysqli_query($connection, $query);
    if($update_query){
      echo "<h2>Category was updated successfully</h2>";
    }

  }


  ?>

                      <div class="form-group">
                      <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                     </div>
                  </form>
