tdipllp.controller("creatematchjsapicontroller", [
  "$window",
  "$scope",
  "$http",
  "Upload",
  "$timeout",
  function ($window, $scope, $http, Upload, $timeout) {
    console.log("connnect huwa hai, html se mtch_title.js");

    $scope.back_buttun5 = function () {
      $window.location.href = baseurl + "/home";
    };


    $scope.fetch_datas = function () {
      $http
        .get(ApiUrl + "api_signin.php?action=fetch_create_match")
        .success(function (matchdata) {
          if (
            matchdata == "null" ||
            matchdata == undefined ||
            matchdata == "Invalid request" ||
            matchdata == "Error"
          ) {
            $scope.matchdata = "";
          } else {
            $scope.matchdata = matchdata;
          }
        });
    };

    $scope.fetch_datas();




    $scope.mtch_delete = function (mtch_slug) {
      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          mtch_slug: mtch_slug,
          action: "mtch_delete",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = "Error aya";
        } else {
          $scope.message = data.scalar;
          if ($scope.message == "Success") {
            alert("Apane Yah Match Delete kiya");
            $scope.fetch_datas();

          } 
        }
      });
    };

    //   new  niche se call huwa hai



    // Creare match ka js hai ye upar side ke fuction ko call kiya hai

    $scope.create_new_match = function (mtch_name,mtch_over,mtch_place) {

      if (!mtch_name) {
        alert("Please Write a Match Name");
        return;
      }

      if (!mtch_over) {
        alert("Please Select Over");
        return;
      }

      if (!mtch_place) {
        alert("Please Write Place Name");
        return;
      }

      // $scope.goToMatchBattin = function (mtch_name,mtch_over,mtch_place) {

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          mtch_name: mtch_name,
          mtch_over: mtch_over,
          // mtch_date: mtch_date,
          mtch_place: mtch_place,
          action: "create_new_match",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = "achchhe se dalo form ko ";
        } else {
          $scope.message = data.scalar;
          if ($scope.message == "Success") {
            $scope.mtch_name = "";
            $scope.mtch_over = "";
            // $scope.mtch_date = "";
            $scope.mtch_place = "";
            $scope.fetch_datas();

            alert("Saved");
          } else {
            alert($scope.message);
          }
        }
      });
    

    };

    // Sab input bhar diye hain, ab data submit karo ,  yaha se team_a_details ko call ho rha hai jo side hai

    $scope.go_buttun = function (slug) {
      console.log("create match call huwa");

      $window.location.href = "match_batting/" + slug;
    };

    $scope.view_buttun = function (slug) {
      console.log("view call huwa");

      $window.location.href = "view_match_detail/" + slug;
    };
  },
]);
