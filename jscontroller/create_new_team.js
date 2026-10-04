tdipllp.controller("createamjsapicontroller", [
  "$window",
  "$scope",
  "$http",
  "Upload",
  "$timeout",
  function ($window, $scope, $http, Upload, $timeout) {
    $scope.m_slugg = m_slug; // JavaScript se AngularJS ke $scope variable me dena

    console.log(" create_new_team js se HTML connnect Hai");

    $scope.every_ball = function (slug) {
      $window.location.href = "/view/html_ever_ball/" + slug;
    };

    $scope.fetch_data = function () {
      $http
        .get(ApiUrl + "api_signin.php?action=fetch_all_player")
        .success(function (alldata) {
          // console.log("alldata____"+alldata);
          if (
            alldata == "null" ||
            alldata == undefined ||
            alldata == "Invalid request" ||
            alldata == "Error"
          ) {
            $scope.alldata = "";
          } else {
            $scope.alldata = alldata;
          }
        });
    };

    $scope.fetch_data();

    $scope.fetch_title_frount = function () {
      $http
        .get(ApiUrl + "api_signin.php?action=fetch_title&m_slug=" + m_slug)
        .success(function (mtitle) {
          if (
            mtitle == "null" ||
            mtitle == undefined ||
            mtitle == "Invalid request" ||
            mtitle == "Error"
          ) {
            $scope.mtitle = "";
          } else {
            $scope.mtitle = mtitle;
          }
        });
    };

    $scope.fetch_title_frount();

    $scope.fetch_teame_name = function () {
      $http
        .get(
          ApiUrl + "api_signin.php?action=fetch_team_name&team_slug=" + m_slug
        )

        .success(function (teamname) {
          if (
            teamname == "null" ||
            teamname == undefined ||
            teamname == "Invalid request" ||
            teamname == "Error"
          ) {
            $scope.teamname = "";
          } else {
            $scope.teamname = teamname;
          }
        });
    };

    console.log("value" + m_slug);

    $scope.fetch_teame_name();

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


    $scope.playerCountLocked = false; // Global variable how many player play match disable
    $scope.submit_click_count = 0; // Global variable
    $scope.disable_mark_players = []; // Global variable

    $scope.team_a_detail = function () {
      if (!$scope.team_name_a) {
        //agar team_name_a nhi dala hai to alert aayega
        alert("Please enter Team Name.");
        return;
      }

      // Count how many players are selected
      var checkboxes = document.getElementsByName("items");
      var selectedCount = 0; // kitane checkbox select huwe
      var pl_slug = []; //array me selected player ka id store
      var item_pl_checked = []; // selected plyer ka name store
      console.log("item_pl_checked__||__" + item_pl_checked);
      console.log("$scope.team_name_a_______" + $scope.team_name_a);

      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked && !checkboxes[i].disabled) {
          // checkboxes tick ho && checkboxes disable na ho
          selectedCount++;
          pl_slug.push($scope.alldata[i].new_pl_slug); // pl_slug variable me Slug insert ho tha hai.
          item_pl_checked.push($scope.alldata[i].pl_name);
        }
      }

      // Check if selectedCount matches input

      if ($scope.playerCount == null || $scope.playerCount == undefined) {
        alert("Please Enter Number of Player Between 5-11. (create_new_team.js)");
        return;
      } else if (selectedCount != $scope.playerCount) {
        console.log(
          "selectedCount__" +
            selectedCount +
            "$scope.playerCount__" +
            $scope.playerCount
        );
        alert(
          "How Many Players Will Play in a Team" +
            " " +
            $scope.playerCount +
            " players. \n You have selected: " +
            selectedCount
        );
        return;
      }

      // 2 se jyadaa time Submit kaam nhi krega
      if ($scope.submit_click_count >= 2) {
        alert("You have already submitted 2 times.");
        return;
      }
      console.log("$scope.submit_click_count__-" + $scope.submit_click_count);

      // jin player ko select kiye hai unko disable_mark_players me push karate hai.
      for (var j = 0; j < pl_slug.length; j++) {
        $scope.disable_mark_players.push(pl_slug[j]);
        // pl_slug ke karan kaam nhi kar rha hai, function
      }

      // Increase submit count
      $scope.submit_click_count++;

      $scope.playerCountLocked = true; // Now disable input box

      console.log("$scope.submit_click_count__---" + $scope.submit_click_count);

      // Start First Inning buttun Enable hota hai. jab submit buttun two time click hota hai.
      if ($scope.submit_click_count == 2) {
        document.getElementById("Start_First_Inning").disabled = false;
      }

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          pl_slug: pl_slug,
          item_pl_checked: item_pl_checked,
          team_name_a: $scope.team_name_a,
          mtch_slug: m_slug,
          action: "team_a_details",
        },

        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = "API Error";
        } else {
          $scope.message = data.scalar;
          if ($scope.message == "Success") {
            $scope.team_name_a = "";
            $scope.fetch_teame_name();
            alert("Team Saved Successfully");
          } else {
            alert($scope.message);
          }
        }
      });
    };

    $scope.every_over_ball = function () {
      $window.location.href = baseurl + "every_ball/" + m_slug;
    };

    $scope.back_buttun = function () {
      $window.location.href = baseurl + "/create_match";
    };


  },
]);
