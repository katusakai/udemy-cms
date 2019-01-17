<?php
function confirm($result){                    //checks if query fails and spawns error message
  global $connection;
  if(!$result){
    die("Inserting post failed. " . mysqli_error($connection));
  }
}





function insert_categories() {
  global $connection;
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
}


function findAllCategories(){
  global $connection;
  $query = "SELECT * FROM categories";
  $select_categories = mysqli_query($connection, $query);
  while($row = mysqli_fetch_array($select_categories)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<tr>
            <td>{$cat_id}</td>
            <td>{$cat_title}</td>
            <td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>
            <td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>
          </tr>  ";
    }
}




function deleteCategories() {
  global $connection;
  //Delete query
  if(isset($_GET['delete'])){
    $the_cat_id = $_GET['delete'];     //Assigns ID for the row, which will be deleted
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
    $delete_category = mysqli_query($connection, $query);
    header("Location: categories.php");
  }
}


function deletePosts() {
  global $connection;
  //Delete query
  if(isset($_GET['delete'])){
    $the_post_id = $_GET['delete'];     //Assigns ID for the row, which will be deleted
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
  }
}




?>

























 ?>
