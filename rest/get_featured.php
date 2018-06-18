<?php
  header('Content-Type: application/json');
  include 'db.php';

  $SQL = "SELECT e.id as id,e.event_title as title,e.short_description as description ,e.event_start_date as event_date,t.name as type, ordered.featured_position as position, ordered.date FROM (SELECT * FROM (SELECT * FROM `featured` ORDER BY `featured`.`date`  DESC) as d group by d.featured_position) as ordered, types as t, events as e where e.type=t.id AND e.id = ordered.event_id ORDER BY position ASC";

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
