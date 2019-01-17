<?php

$db['DB_HOST'] = "localhost";
$db['DB_USER'] = "root";
$db['DB_PASS'] = "";
$db['DB_NAME'] = "cms";

foreach ($db as $key => $value) {
  define($key, $value);
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// if($connection) {
//   echo "We are connected";
// }

 ?>
