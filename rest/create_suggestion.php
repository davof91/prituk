<?php
  header('Content-Type: application/json');
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));

  //Attempt to decode the incoming RAW post data from JSON.
  $decoded = json_decode($content, true);

  include 'db.php';

  $resp = [];
  $errors = [];
  $error = FALSE;

  if (!empty($decoded["description"])) {
    $description = $decoded["description"];
  }
  else{
    $description = "";
  }

  if (!empty($decoded["url"])) {
    $url = $decoded["url"];
  }
  else{
    $url = "";
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

  if (empty($decoded["description"]) && empty($decoded["url"])) {
      $errors['error'] = "One of the two fields has to have an input.";
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
      $sql = "INSERT INTO suggestions (description, url)
      VALUES (?,?)";
      $stmt = $conn->prepare($sql);

      $error = $conn->errno . ' ' . $conn->error;

      $bind_s = "ss";
      $bind_p = array($description, $url);

      $stmt->bind_param($bind_s, ...$bind_p);

      //$error = $conn->errno . ' ' . $conn->error;
      //echo $error;

      if ($stmt->execute() === TRUE) {
        $resp['status'] = 'success';
        $resp['information'] = ["information"=>"New record created successfully"];
        echo json_encode($resp, JSON_PRETTY_PRINT);
      } else {
        $resp['status'] = 'success';
        $resp['information'] = ["Error"=> $sql . ":" . $conn->error];
        echo json_encode($resp, JSON_PRETTY_PRINT);
      }
    }
    else{
      $resp['status'] = 'error';
      $resp['information'] = ["Authentication Error"=>"User/Password combo not on database"];
      echo json_encode($resp, JSON_PRETTY_PRINT);
    }


    $conn->close();
  }

?>
