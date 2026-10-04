tdipllp.controller("homejsapicontroller", [
  "$window",
  "$scope",
  "$http",
  "Upload",
  "$timeout",
  function ($window, $scope, $http, Upload, $timeout) {

    
    console.log("connect_huwa");

    $scope.p_add = function () {
      $window.location.href = "add_player";
    };

    $scope.create_match_btn = function () {
      $window.location.href = "create_match";
    };

    
    $scope.tempp = function () {
      $window.location.href = "example_page";
    };
    

    // $scope.newlink = function() {
    //   $window.location.href = 'new';
    // };

    // $scope.every_ball_home_btn = function() {
    //   $window.location.href = 'every_ball';
    // };

    console.log("connect_huwa....");
  },
]);
