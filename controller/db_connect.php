<?php
$conn = mysqli_connect("localhost", "root", "", "pdam_kab_kupang");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
