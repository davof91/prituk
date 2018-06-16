var app = angular.module("prinuk", []);

app.controller("createSuggestionCtrl", function($scope,$http) {
  $scope.types = [];

  var config = {
    headers: {
     'Content-Type': 'application/json',
     'Accept' : 'application/json'
    },
  }

  $scope.submit_data = function(){
    var data = {};

    data['description'] = $( "#description" ).val();
    data['url'] = $( "#url" ).val();

    data['user'] = $( "#user" ).val();
    data['password'] = $( "#password" ).val();

    $http.post("/rest/create_suggestion.php",data,config).then(function(response) {
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
