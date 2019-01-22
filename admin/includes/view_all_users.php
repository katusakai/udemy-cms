<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
      </tr>
    </thead>
    <tbody>


  <?php
  $query = "SELECT * FROM users";
  $select_users = mysqli_query($connection, $query);
  if(!$select_users){
  echo die("QUERY FAILED" . mysqli_error());
  } else {
  while($row = mysqli_fetch_array($select_users)){
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];

    echo "<tr>
      <td>{$user_id}</td>
      <td>{$user_name}</td>
      <td>{$user_firstname}</td>
      <td>{$user_lastname}</td>
      <td><a href='mailo:{$user_email}'>{$user_email}</a></td>
      <td>{$user_role}</td>";

      //Write Posts name from 'Posts' table according to comment_post_id from 'comments' table
      // $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
      // $select_post_id_query = mysqli_query($connection, $query);
      // confirm($select_post_id_query);
      // while($row = mysqli_fetch_assoc($select_post_id_query)){
      //   $post_title = $row['post_title'];
      //   $post_id = $row['post_id'];
      //   echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
      // }

    echo "</tr>";
    }
  }
  ?>
    </tbody>
  </table>
</div>


<?php
if(isset($_GET['delete_comment'])){
deleteComment();
}

if(isset($_GET['approve_comment'])){
approveComment();
}

if(isset($_GET['unapprove_comment'])){
unapproveComment();
}



 ?>
