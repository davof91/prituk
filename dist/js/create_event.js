var app = angular.module("prinuk", []);

app.controller("createCtrl", function($scope,$http) {
  $scope.types = [];

  var config = {
    headers: {
     'Content-Type': 'application/json',
     'Accept' : 'application/json'
    },
  }

  $( "#datepickerFrom" ).datepicker({ dateFormat: 'yy-mm-dd' });
  $( "#datepickerTo" ).datepicker({ dateFormat: 'yy-mm-dd' });

  $http.get("/rest/get_types.php").then(function(response) {
      $scope.types = response.data;
  });

  $scope.submit_data = function(){
    console.log('asdads');
    var data = {};
    data['from'] = $( "#datepickerFrom" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    data['to'] = $( "#datepickerTo" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();

    data['title'] = $( "#title" ).val();
    data['description'] = $( "#description" ).val();
    data['short_description'] = $( "#short_description" ).val();
    data['url'] = $( "#url" ).val();
    data['active'] = $( "#active" ).val();
    data['address'] = $( "#address" ).val();
    data['price'] = $( "#price" ).val();
    data['town'] = $( "#town" ).val();
    data['county'] = $( "#county" ).val();
    data['type'] = $( "#type_select" ).val();
    data['user'] = $( "#user" ).val();
    data['password'] = $( "#password" ).val();

    $http.post("/rest/create_event.php",data,config).then(function(response) {
        console.log(response.data);
        res = response.data;
        string_resp = ""
        Object.keys(res['information']).forEach(function(key) {
          string_resp = string_resp + key + ": " +res['information'][key]+'\n';
        })
        alert(string_resp);
    });
  }

});
