var app = angular.module("prinuk", []);

app.controller("featuresCtrl", function($scope,$http) {
  $scope.types = [];
  $scope.all_events = [];
  $scope.featured = [];

  var config = {
    headers: {
     'Content-Type': 'application/json',
     'Accept' : 'application/json'
    },
  }

  $http.post("/rest/get_all_events.php",config).then(function(response) {
      console.log(response.data);
      $scope.all_events = response.data;

      $http.post("/rest/get_featured.php",config).then(function(response) {
          console.log(response.data);
          $scope.featured = response.data;
      });
  });

  $scope.submit_data = function(featured){
    var data = {};

    data['id'] = $( "#id"+featured ).val();
    data['featured'] = featured;

    data['user'] = $( "#user" ).val();
    data['password'] = $( "#password" ).val();

    $http.post("/rest/update_featured.php",data,config).then(function(response) {
        console.log(response.data);
        res = response.data;
        string_resp = ""
        Object.keys(res['information']).forEach(function(key) {
          string_resp = string_resp +res['information'][key]+'\n';
        })
        alert(string_resp);
    });
  }

});
