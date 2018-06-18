<?php
  header('Content-Type: application/json');
  include 'db.php';

  $SQL = "SELECT * FROM events WHERE event_end_date >= CURRENT_DATE() ORDER BY event_start_date ASC";

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
