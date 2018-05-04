<?php
  header('Content-Type: application/json');
  include 'db.php';

  $errors = [];

  $SQL = "SELECT county FROM events group by county";

  $stmt = $conn->prepare($SQL);

  //$error = $conn->errno . ' ' . $conn->error;
  //echo $error;

  $stmt->execute();

  $res = $stmt->get_result();
  $data = [];
  while ($row = $res->fetch_assoc()) {
      array_push($data,$row);
  }

  echo json_encode($data, JSON_PRETTY_PRINT);
  //do stuff
  $stmt.close();
  $con.close();
?>
