var app = angular.module("prinuk", []);

app.controller("homeCtrl", function($scope,$http) {
  $scope.towns = [];
  $scope.counties = [];
  $scope.types = [];
  $scope.button_active = false;

  var event_type = 'event_time';
  var search = {};
  var limit = 10;

  var config = {
    headers: {
     'Content-Type': 'application/json',
     'Accept' : 'application/json'
    },
  }

  $scope.split_description = function(description){
    var splitted = description.split('\n');
    var unique_descriptions = [];
    $.each(splitted, function(i, el){
        if($.inArray(el, unique_descriptions) === -1 && el != "") unique_descriptions.push(el);
    });

    return unique_descriptions;
  }

  $scope.search = function(){
    var limit = 10;

    search = {};

    if($( "#datepickerFrom" ).datepicker({ dateFormat: 'yy-mm-dd' }).val() != ""){
      search['date1'] =  $( "#datepickerFrom" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    }
    else if($( "#datepickerFrom_m" ).datepicker({ dateFormat: 'yy-mm-dd' }).val() != ""){
      search['date1'] =  $( "#datepickerFrom_m" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    }
    if($( "#datepickerTo" ).datepicker({ dateFormat: 'yy-mm-dd' }).val() != ""){
      search['date2'] =  $( "#datepickerTo" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    }
    else if($( "#datepickerTo_m" ).datepicker({ dateFormat: 'yy-mm-dd' }).val() != ""){
      search['date2'] =  $( "#datepickerTo_m" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    }
    if($( "#county_select" ).val() != ""){
      search['county'] =  $( "#county_select" ).val();
    }
    else if($( "#county_select_m" ).val() != ""){
      search['county'] =  $( "#county_select_m" ).val();
    }

    if($( "#type_select" ).val() != ""){
      search['type'] =  $( "#type_select" ).val();
    }
    else if($( "#type_select_m" ).val() != ""){
      search['type'] =  $( "#type_select_m" ).val();
    }

    if($( "#town_select" ).val() != ""){
      search['town'] =  $( "#town_select" ).val();
    }
    else if($( "#town_select_m" ).val() != ""){
      search['town'] =  $( "#town_select_m" ).val();
    }

    if($( "#search" ).val() != ""){
      search['textFilter'] =  $( "#search" ).val();
    }
    if($( "#search_m" ).val() != ""){
      search['textFilter'] =  $( "#search_m" ).val();
    }

    $scope.button_active = false;

    var data = {
      'type':event_type,
      'top':limit,
      'bottom':limit - 10,
      'limit':10,
      'search':[search]
    }

    $http.post("/rest/get_events.php",data,config).then(function(response) {
        $scope.all_events = response.data;
        if(response.data.length < 10){
          $scope.button_active = true;
        }
    });
  }

  $scope.clear_search = function(){
    search = {};
    limit = 10;
    $scope.button_active = false;

    var data = {
      'type':event_type,
      'top':limit,
      'bottom':limit - 10,
      'limit':10,
      'search':[search]
    }

    $http.post("/rest/get_events.php",data,config).then(function(response) {
        $scope.all_events = response.data;
        if(response.data.length < 10){
          $scope.button_active = true;
        }
    });
  }

  $scope.main_featured = function (row) {
    return row.position == 1;
  };

  $scope.others_featured = function (row) {
    return row.position != 1;
  };

  var data = { 'type': 'event_time' }
  $http.get("/rest/get_featured.php").then(function(response) {
      $scope.featured_events = response.data;
  });

  $http.get("/rest/get_types.php").then(function(response) {
      $scope.types = response.data;
  });

  $http.get("/rest/get_county.php").then(function(response) {
      $scope.counties = response.data;
  });

  $http.get("/rest/get_towns.php").then(function(response) {
      $scope.towns = response.data;
  });

  $http.post("/rest/get_events.php",data,config).then(function(response) {
      $scope.all_events = response.data;
  });

  $scope.get_more_events = function(){
    limit = limit + 10;

    var data = {
      'type':event_type,
      'top':limit,
      'bottom':limit - 10,
      'limit':10,
      'search':[search]
    }

    $http.post("/rest/get_events.php",data,config).then(function(response) {
        $scope.all_events = $scope.all_events.concat(response.data);
        if(response.data.length < 10){
          $scope.button_active = true;
        }
    });
  }

  $( "#datepickerFrom" ).datepicker({ dateFormat: 'yy-mm-dd' });
  $( "#datepickerTo" ).datepicker({ dateFormat: 'yy-mm-dd' });

  $scope.tab_click = function(type){
    limit = 10;
    event_type = type;
    $scope.button_active = false;

    var data = {
      'type':event_type,
      'top':limit,
      'bottom':limit - 10,
      'limit':10,
      'search':[search]
    }

    $http.post("/rest/get_events.php",data,config).then(function(response) {
        $scope.all_events = response.data;
        if(response.data.length < 10){
          $scope.button_active = true;
        }
    });
  }
});
