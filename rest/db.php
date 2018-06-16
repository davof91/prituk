<?php
  $username = 'root';
  $password = 'root';
  $dbname = 'prinuk';
  $servername = 'localhost';

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  /*
   * Parameters is returned for advanced searching.
   * date1 - Date for filtering on a specific date range, bottom date
   * date2 - Date for filtering on a specific date range, top date
   * textFilter - Text to filter on.
   * town - array of towns to filter on.
   * county - array of counties to filter on.
   * type - array of types to filter on.
  */
  function parse_search_parameters($param){
    $query = array();
    $params = array();
    $string = array();
    if( isset( $param['date1'] ) &&  isset( $param['date2'] )){
      array_push($query, "((event_start_date <= ? AND event_end_date >= ?) OR (event_start_date <= ? AND event_end_date >= ?) OR (event_start_date BETWEEN ? AND ?) OR (event_end_date BETWEEN ? AND ?))");
      array_push($params,$param['date1'],$param['date1'],$param['date2'],$param['date2'],$param['date1'],$param['date2'],$param['date1'],$param['date2']);
      array_push($string, 'ssssssss');
    }
    else{
      //echo 'error 1 <br/>';
    }

    if(isset($param['textFilter'])){
      $filter = explode(' ',$param['textFilter']);
      $temp_array = array();
      foreach ($filter as &$value) {
        $low_value = strtolower($value);
        array_push($temp_array, "(LOWER(event_title) LIKE LOWER(?) OR LOWER(short_description) LIKE LOWER(?) OR LOWER(event_description) LIKE LOWER(?) OR LOWER(town) LIKE LOWER(?) OR LOWER(county) LIKE LOWER(?))");
        array_push($params,'%'.$low_value.'%','%'.$low_value.'%','%'.$low_value.'%','%'.$low_value.'%','%'.$low_value.'%');
        array_push($string, 'sssss');
      }

      $newValue = implode(' OR ',$temp_array);

      array_push($query, "(".$newValue.")");
    }
    else{
      //echo 'error 2 <br/>';
    }

    if( isset( $param['town'])){
      array_push($query, "town=?");
      array_push($params,$param['town']);
      array_push($string, 's');
    }
    else{
      //echo 'error 3 <br/>';
    }

    if( isset( $param['county'])){
      array_push($query, "county=?");
      array_push($params,$param['county']);
      array_push($string, 's');
    }
    else{
      //echo 'error 4 <br/> ';
    }

    if( isset( $param['type'])){
      array_push($query, "type=?");
      array_push($params,$param['type']);
      array_push($string, 's');
    }
    else{
      //echo 'error 5 <br/> ';
    }

    return array($query, $params, $string);
  }
?>
