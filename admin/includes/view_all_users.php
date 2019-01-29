<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Role</th>
        <th>Edit</th>
        <th>Delete</th>
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
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];

    echo "<tr>
      <td>{$user_id}</td>
      <td>{$user_name}</td>
      <td>{$user_firstname}</td>
      <td>{$user_lastname}</td>
      <td><a href='mailo:{$user_email}'>{$user_email}</a></td>
      <td width='100'><img width='100' class='img-responsive' src='../images/users_images/{$user_image}' alt='no image'></td>
      <td>{$user_role}</td>
      <td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit<a/></td>
      <td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='users.php?delete_user={$user_id}'>Delete</a></td>";


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
if(isset($_GET['delete_user'])){
deleteUser();
}

 ?>
