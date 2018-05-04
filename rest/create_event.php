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

  if (!empty($decoded["title"])) {
    $title = $decoded["title"];
    $errors['event_title'] = FALSE;
  }else{
      $errors['event_title'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["description"])) {
    $description = $decoded["description"];
  }else{
      $errors['event_description'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["from"])) {
    $from = $decoded["from"];
  }else{
      $errors['event_start_date'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["to"])) {
    $to = $decoded["to"];
  }else{
      $errors['event_end_date'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["url"])) {
    $url = $decoded["url"];
  }else{
      $errors['event_url'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["active"])) {
    $active = $decoded["active"];
  }else{
      $errors['active'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["type"])) {
    $type = $decoded["type"];
  }else{
      $errors['type'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["user"])) {
    $user = $decoded["user"];
  }else{
      $errors['user'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["password"])) {
    $password = $decoded["password"];
  }else{
      $errors['password'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["short_description"])) {
    $s_desc = $decoded["short_description"];
  }else{
      $errors['short_description'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["price"])) {
    $price = $decoded["price"];
  }else{
      $errors['price'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["address"])) {
    $address = $decoded["address"];
  }else{
      $errors['address'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["county"])) {
    $county = $decoded["county"];
  }else{
      $errors['county'] = TRUE;
      $error = TRUE;
  }

  if (!empty($decoded["town"])) {
    $town = $decoded["town"];
  }else{
      $errors['town'] = TRUE;
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
      $sql = "INSERT INTO events (event_title, event_description, event_start_date, event_end_date, event_url, active, type, short_description, county, town, address, price)
      VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
      $stmt = $conn->prepare($sql);

      $error = $conn->errno . ' ' . $conn->error;
      echo $error;

      $bind_s = "sssssiisssss";
      $bind_p = array($title,$description,$from,$to,$url,$active,$type,$s_desc,$county,$town,$address,$price);

      $stmt->bind_param($bind_s, ...$bind_p);

      //$error = $conn->errno . ' ' . $conn->error;
      //echo $error;

      if ($stmt->execute() === TRUE) {
        $resp['status'] = 'success';
        $resp['information'] = "New record created successfully";
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
