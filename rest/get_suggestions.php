<?php
  header('Content-Type: application/json');
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));

  //Attempt to decode the incoming RAW post data from JSON.
  $decoded = json_decode($content, true);

  include 'db.php';

  $errors = [];
  $error = FALSE;
  $top = 10;
  $bottom = 0;
  $limit = 10;

  if (!empty($decoded["top"])) {
    $top = $decoded["top"];
  }

  if (!empty($decoded["bottom"])) {
    $bottom = $decoded["bottom"];
  }

  if (!empty($decoded["limit"])) {
    $limit = $decoded["limit"];
  }

  if (!empty($decoded["user"])) {
    $user = $decoded["user"];
  }else{
      $errors['user'] = "Missing User. Please provide one.";
      $error = TRUE;
  }

  if (!empty($decoded["password"])) {
    $password = $decoded["password"];
  }else{
      $errors['password'] = "Missing Password. Please provide one.";
      $error = TRUE;
  }

  if($error){
    $resp['status'] = 'error';
    $resp['information'] = $errors;
    echo json_encode($resp, JSON_PRETTY_PRINT);
  }
  else{
    $sql = "SELECT * FROM user WHERE user=? AND password=?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $user,$password);
    $stmt->execute();

    $res = $stmt->get_result();

    if($res->num_rows > 0){
      $SQL = "SELECT * FROM suggestions  ";

      $imploded_sql = "";
      $bind_p = array($bottom,$limit);
      $bind_s = array('i','i');

      $SQL = $SQL.' ORDER BY create_time ASC';


      $SQL = $SQL." LIMIT ?,?";

      $bind_s = implode('',$bind_s);
      $stmt = $conn->prepare($SQL);

      //$error = $conn->errno . ' ' . $conn->error;
      //echo $error;

      $stmt->bind_param($bind_s, ...$bind_p);
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
    else{
      $resp['status'] = 'error';
      $resp['information'] = ["Authentication Error"=>"User/Password combo not on database"];
      echo json_encode($resp, JSON_PRETTY_PRINT);
    }
  }

?>
