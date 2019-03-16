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
            <td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='categories.php?delete={$cat_id}'>DELETE</a></td>
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


function deleteComment() {
  global $connection;
  //Delete query
  if(isset($_GET['delete_comment'])){
    $the_comment_id = $_GET['delete_comment'];     //Assigns ID for the row, which will be deleted
    $query = "DELETE FROM comments
              WHERE comment_id = {$the_comment_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
  }
}


function unapproveComment() {
  global $connection;
  //unapproved status query
  if(isset($_GET['unapprove_comment'])){
    $the_comment_id = $_GET['unapprove_comment'];     //Assigns ID for the row, which value will be altered
    $query = "UPDATE comments
              SET comment_status='unapproved'
              WHERE comment_id = {$the_comment_id} ";
    $unapprove_query = mysqli_query($connection, $query);
    header("Location: comments.php");
  }
}

function approveComment() {
  global $connection;
  //approved status query
  if(isset($_GET['approve_comment'])){
    $the_comment_id = $_GET['approve_comment'];     //Assigns ID for the row, which value will be altered
    $query = "UPDATE comments
              SET comment_status='approved'
              WHERE comment_id = {$the_comment_id} ";
    $unapprove_query = mysqli_query($connection, $query);
    header("Location: comments.php");
  }
}



function deleteUser() {
  global $connection;
  //Delete query
  if(isset($_GET['delete_user'])){
    $the_user_id = $_GET['delete_user'];     //Assigns ID for the row, which will be deleted
    $query = "DELETE FROM users
              WHERE user_id = {$the_user_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: users.php");
  }
}

function users_online(){

  if(isset($_GET['onlineusers'])){
    global $connection;
    if(!$connection){
      session_start();
      include_once '../includes/db.php';
    
      $session =  session_id();
      $time = time();
      $time_out_in_seconds = 60;
      $time_out = $time - $time_out_in_seconds;
    
      $query =    "SELECT * FROM users_online
                  WHERE session = '$session'";
      $send_query = mysqli_query($connection, $query);
      $count = mysqli_num_rows($send_query);

      if($count == NULL){
          $sql = "INSERT INTO users_online(session, time)
                  VALUES('$session', '$time')";
          mysqli_query($connection, $sql);
      }else{
          $sql = "UPDATE users_online SET time = '$time'
                  WHERE session = '$session'";
          mysqli_query($connection, $sql);       
      }

      $sql = "SELECT COUNT(*) FROM users_online WHERE time > '$time_out'";
      $users_online_query = mysqli_query($connection, $sql); 
      $count_users_online =  mysqli_fetch_row($users_online_query)[0];
    
      echo $count_users_online;
    }

  }
  
}
users_online();
?>
