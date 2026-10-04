tdipllp.controller("view_match_detail_controller", [
  "$window",
  "$scope",
  "$rootScope",
  "$http",
  "Upload",
  "$timeout",
  function ($window, $scope, $rootScope, $http, Upload, $timeout) {

    $scope.mt_slugg = mt_slug; // JavaScript se AngularJS ke $scope variable me dena

    $scope.back_buttun2 = function () {
      $window.location.href = baseurl + "/home";
    };




    $scope.match_batter_detail = function () {
      console.log("call huwa");

      $http
        .get(
          ApiUrl +          
            "api_signin.php?action=match_batter_detail&mtch_slugg=" +
            $scope.mt_slugg
        )
        .success(function (response) {
          if (!response || response == "Invalid request") {
            $scope.inning1 = [];
            $scope.inning2 = [];
          } else {
            $scope.inning1 = response[0] || [];
            $scope.inning2 = response[1] || [];

            console.log("Team 1 batting data:", $scope.inning1);
            console.log("Team 2 batting data:", $scope.inning2);
          }
        })
        .error(function () {
          console.error("Error fetching data:", error);
          $scope.inning1 = [];
          $scope.inning2 = [];
        });
    };

    $scope.match_batter_detail();













    $scope.match_bowler_detail = function () {
      $http
        .get(
          ApiUrl +
            "api_signin.php?action=match_bowler_detail&mtch_slugg=" +
            $scope.mt_slugg
        )
        .success(function (response) {
          if (!response || response == "Invalid request") {
            $scope.b_detail1 = [];
            $scope.b_detail2 = [];

              
          } else {
            $scope.b_detail1 = response[0] || [];
            $scope.b_detail2 = response[1] || [];

          }
        })
        .error(function () {
          $scope.b_detail1 = [];
          $scope.b_detail2 = [];

        });
    };

    $scope.match_bowler_detail();
  },
]);
