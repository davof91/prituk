var app = angular.module("prinuk", []);

app.controller("suggestionCtrl", function($scope,$http) {
  $scope.button_active = false;
  $scope.all_suggestions = [];

  var limit = 0;

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

  $scope.get_more_events = function(){
    limit = limit + 10;

    var data = {
      'top':limit,
      'bottom':limit - 10,
      'limit':10
    }

    data['user'] = $( "#user" ).val();
    data['password'] = $( "#password" ).val();

    $http.post("/rest/get_suggestions.php",data,config).then(function(response) {
      console.log(response);
      if(response.data.status != "error"){
        $scope.all_suggestions = $scope.all_suggestions.concat(response.data);
        if(response.data.length < 10){
          $scope.button_active = true;
        }
      }
      else{
        res = response.data;
        string_resp = ""
        Object.keys(res['information']).forEach(function(key) {
          string_resp = string_resp +res['information'][key]+'\n';
        })
        alert(string_resp);
      }
    });
  }
});
