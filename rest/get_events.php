<?php
  /*
    * type - Contians what type of event query we want to return
    *       - event_time: search by time the event is
    *       - created_time: search by time the event was created on the page.
    *       - by_date: When doing an extra search by date. Date will be in json obejct.
    * order - Asc or desc
    * search_parameters - JSON object containing any parameter needed for searching,
    *   this could be text, date search, etc.
    *
    * top - top value for the search paging.
    * bottom - lower value for search paging.
    * limit - if not set will be 10.
  */
  header('Content-Type: application/json');
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));

  //Attempt to decode the incoming RAW post data from JSON.
  $decoded = json_decode($content, true);

  include 'db.php';

  $errors = [];
  $error = FALSE;
  $type = 'event_time';
  $search = [];
  $top = 10;
  $bottom = 0;
  $limit = 10;

  if (!empty($decoded["type"])) {
    $type = $decoded["type"];
  }

  if (!empty($decoded["top"])) {
    $top = $decoded["top"];
  }

  if (!empty($decoded["bottom"])) {
    $bottom = $decoded["bottom"];
  }

  if (!empty($decoded["limit"])) {
    $limit = $decoded["limit"];
  }

  $SQL = "SELECT * FROM events as events, (SELECT id as type_id, name as name from types) as t, trains as trains WHERE events.town = trains.town_train AND t.type_id = events.type AND ";

  $imploded_sql = "";
  $bind_p = array($bottom,$limit);
  $bind_s = array('i','i');

  if (!empty($decoded["search"]) && count((array)$decoded["search"][0])) {
    $search = $decoded["search"][0];
    $parsed_data = parse_search_parameters($search);
    $imploded_sql = implode(' AND ', $parsed_data[0]);
    if(ISSET($search['date1'])){
      $type="";
      $SQL = $SQL.$imploded_sql;
    }
    else{
      $SQL = $SQL.$imploded_sql." AND ";
    }
    $bind_p = array_merge($parsed_data[1],$bind_p);
    $bind_s = array_merge($parsed_data[2],$bind_s);
  }

  if ($type == 'event_time') {
    $SQL = $SQL.' event_end_date >= CURRENT_DATE() ORDER BY event_start_date ASC';
  }
  elseif ($type == 'created_time') {
    $SQL = $SQL." event_end_date >= CURRENT_DATE() ORDER BY create_date DESC";
  }
  else {
    $SQL = $SQL.' ORDER BY event_start_date ASC';
  }

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
?>
