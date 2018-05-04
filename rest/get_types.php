<?php
  header('Content-Type: application/json');
  include 'db.php';

  $SQL = "SELECT * FROM types";

  $stmt = $conn->prepare($SQL);
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
