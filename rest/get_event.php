<?php
  header('Content-Type: application/json');
  include 'db.php';

  $errors = [];
  $error = FALSE;

  if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $errors['id'] = FALSE;
  }else{
      $errors['id'] = TRUE;
      $error = TRUE;
  }

  if($error){
    echo json_encode($errors, JSON_PRETTY_PRINT);
  }

  else{
    $SQL = "SELECT * FROM events, trains as t WHERE id=? AND t.town_train = events.town";

    $stmt = $conn->prepare($SQL);
    $stmt->bind_param("s", $id);
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
  }

?>
