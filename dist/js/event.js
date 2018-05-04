var app = angular.module("prinuk", []);

app.controller("eventCtrl", function($scope,$http) {
  $http.get("/rest/get_event.php?id="+window.id).then(function(response) {
      $scope.event = response.data;
      get_lat_lon(response.data[0]['address']);

      console.log(response.data);
  });

  $scope.split_description = function(description){
    var splitted = description.split('\n');
    var unique_descriptions = [];
    $.each(splitted, function(i, el){
        if($.inArray(el, unique_descriptions) === -1) unique_descriptions.push(el);
    });
    return unique_descriptions;
  }

  function get_lat_lon(address){
    url = "https://maps.googleapis.com/maps/api/geocode/json?address="+encodeURI(address)+"&key=AIzaSyAXT4tuSkbHrpAWriuGrzjH9a75qDFEqPo";
    $http.get(url).then(function(response) {
      lat_lon = response.data['results'][0]['geometry']['location']
      var myCenter = new google.maps.LatLng(lat_lon['lat'],lat_lon['lng']);
      var mapCanvas = document.getElementById("map");
      var mapOptions = {center: myCenter, zoom: 15};
      var map = new google.maps.Map(mapCanvas, mapOptions);
      var marker = new google.maps.Marker({position:myCenter});
      marker.setMap(map);
    })

  }

  $http.get("/rest/get_featured.php").then(function(response) {
      $scope.featured_events = response.data;
      console.log(response.data);
  });
});
