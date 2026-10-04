tdipllp.controller("everyballjsapicontroller", [
  "$window",
  "$scope",
  "$rootScope",
  "$http",
  "Upload",
  "$timeout",
  function ($window, $scope, $rootScope, $http, Upload, $timeout) {

    // two team name
    $scope.fetch_toss = function () {
      $http
        .get(
          ApiUrl + "api_every_ball.php?action=fetch_toss_win&toss_slug=" + toss_slug
        )

        .success(function (toss) {
          if (
            toss == "null" ||
            toss == undefined ||
            toss == "Invalid request" ||
            toss == "Error"
          ) {
            $scope.toss = "";
          } else {
            $scope.toss = toss;
            $scope.batting_teamss = toss[0].team_name_a;
            $scope.bowling_teamss = toss[1].team_name_a;
          }
        });
    };
    $scope.fetch_toss();


    // Not Out All Player Name
    $scope.fetch_Notout_pl = function (batter_n) {
      console.log("925 $scope.bowling_team", $scope.bowling_team);
      console.log("925 batting_team GO DB=", batter_n);

      $http
        .get(
          ApiUrl +
            "api_every_ball.php?action=fetch_Notout_pl&mtch_slug=" +
            mt_slug +
            "&batting_team=" +
            batter_n
        )

        .success(function (NOT_OUT_Player) {
          if (
            NOT_OUT_Player == "null" ||
            NOT_OUT_Player == undefined ||
            NOT_OUT_Player == "Invalid request" ||
            NOT_OUT_Player == "Error"
          ) {
            $scope.NOT_OUT_Player = "";
          } else {
            $scope.NOT_OUT_Player = NOT_OUT_Player;
          }
        });
    };

  
    // Batting team Change Then Other Team Player Data Fetch
    $scope.select_batting = function () {
      console.log("884 $scope.batting_team", $scope.batting_team);

      if ($scope.batting_team) {
        let batting_temp = $scope.batting_team;
        $http
          .get(
            ApiUrl +
              "api_every_ball.php?action=select_batting_call&team=" +
              $scope.batting_team +
              "&slug=" +
              toss_slug
          )
          .then(function (response) {
            $scope.batting_players = response.data;
            console.log("893 batting_temp", batting_temp);

            if (batting_temp != $scope.batting_team) {
              $scope.batting_team = batting_temp;
            }

            console.log("894 $scope.batting_team", $scope.batting_team);

            // $scope.Chasing_Team_all_pl($scope.batting_team); /// is Argument se batting bowling ka sahi data fetch hokar aata hai

            // $scope.fetch_Notout_pl($scope.batting_team);

            // $scope.fetch_batsman_run();
            // $scope.fetch_inning_info();
          });
      }
    };





    

  },
]);