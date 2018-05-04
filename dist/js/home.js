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
        if($.inArray(el, unique_descriptions) === -1) unique_descriptions.push(el);
    });
    return unique_descriptions;
  }

  $scope.search = function(){
    var limit = 10;

    if($( "#datepickerFrom" ).datepicker({ dateFormat: 'yy-mm-dd' }).val() != ""){
      search['date1'] =  $( "#datepickerFrom" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    }
    if($( "#datepickerTo" ).datepicker({ dateFormat: 'yy-mm-dd' }).val() != ""){
      search['date2'] =  $( "#datepickerFrom" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    }
    if($( "#county_select" ).val() != ""){
      search['county'] =  $( "#county_select" ).val();
    }

    if($( "#type_select" ).val() != ""){
      search['type'] =  $( "#type_select" ).val();
    }

    if($( "#town_select" ).val() != ""){
      search['town'] =  $( "#town_select" ).val();
    }

    if($( "#search" ).val() != ""){
      search['textFilter'] =  $( "#search" ).val();
    }

    $scope.button_active = false;

    var data = {
      'type':event_type,
      'top':limit,
      'bottom':limit - 10,
      'limit':limit,
      'search':[search]
    }

    $http.post("/rest/get_events.php",data,config).then(function(response) {
        $scope.all_events = response.data;
        if(response.data.length < 10){
          $scope.button_active = true;
        }
        console.log(response.data);
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
      'limit':limit,
      'search':[search]
    }

    $http.post("/rest/get_events.php",data,config).then(function(response) {
        $scope.all_events = response.data;
        if(response.data.length < 10){
          $scope.button_active = true;
        }
        console.log(response.data);
    });
  }

  $scope.main_featured = function (row) {
    console.log(row);
    return row.position == 1;
  };

  $scope.others_featured = function (row) {
    console.log(row);
    return row.position != 1;
  };

  var data = { 'type': 'event_time' }
  $http.get("/rest/get_featured.php").then(function(response) {
      $scope.featured_events = response.data;
      console.log(response.data);
  });

  $http.get("/rest/get_types.php").then(function(response) {
      $scope.types = response.data;
      console.log(response.data);
  });

  $http.get("/rest/get_county.php").then(function(response) {
      $scope.counties = response.data;
      console.log(response.data);
  });

  $http.get("/rest/get_towns.php").then(function(response) {
      $scope.towns = response.data;
      console.log(response.data);
  });

  $http.post("/rest/get_events.php",data,config).then(function(response) {
      $scope.all_events = response.data;
      console.log(response.data);
  });

  $scope.get_more_events = function(){
    limit = limit + 10;

    var data = {
      'type':event_type,
      'top':limit,
      'bottom':limit - 10,
      'limit':limit,
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
      'limit':limit,
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
