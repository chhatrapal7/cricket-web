tdipllp.controller("everyballjsapicontroller", [
  "$window",
  "$scope",
  "$rootScope",
  "$http",
  "Upload",
  "$timeout",
  function ($window, $scope, $rootScope, $http, Upload, $timeout) {
    $scope.mt_slug = mt_slug; // JavaScript se AngularJS ke $scope variable me dena

    $scope.batts = "";
    $scope.row_data_fetch = "";
    $scope.reset_extra_ball = ""; // global variable DB ka NB,WD ko skip kar int lane wala.
    $scope.batsman = ""; //global
    $scope.mtch_inining = 1; //global variable
    $scope.skip_ext_ball = ""; //global variable
    $scope.totle_mtch_runs = "";
    let check_db_run = "";
    let mtch_over = ""; // global variable
    let ball = "";
    // let next_bowlers ="";
    // let run_ex ="";
    let run = ""; // global variable
    let exta_ball = ""; // global variable
    // let = extra_ball;   // global variable
    let ROinfo_G = ""; // global variable
    let W_St_G = "";
    let wicktype = ""; // global variable
    let currentBowler_new = "";
    let current_over = 0; // global variable
    let ballNumber = ""; // global variable
    let currentStriker = ""; // global variable
    let currentNonStriker = ""; // global variable
    let currentStriker_new = "";
    let currentNonStriker_new = "";

    //********************** NB WD W processNormalRun ***********************************

    $scope.addBall = function (
      runvalue,
      mtch_inining_ng,
      currentStriker_ng,
      currentNonStriker_ng,
      currentBowler_ng
    ) {
      currentBowler_new = currentBowler_ng;
      currentStriker_new = currentStriker_ng;
      currentNonStriker_new = currentNonStriker_ng;
      console.log(
        "77 currentStriker_new",
        currentStriker_new,
        " ",
        currentNonStriker_new,
        " ",
        currentBowler_new
      );
      console.log("77 $scope.mtch_inining", $scope.mtch_inining);
      console.log("77 current_over", current_over);
      console.log("77 mtch_over", mtch_over);
      console.log("77 mtch_inining_ng", mtch_inining_ng);

      if (current_over >= mtch_over) {
        check_inining_end();
      }

      //  console.log("77 $scope.mtch_inining",$scope.mtch_inining);

      if ($scope.mtch_inining >= 3) {
        alert(
          "Your total " +
            mtch_over +
            " overs is complete. Runs cannot be added now."
        );
      } else {
        if (!runvalue) return;

        console.log(" 73 $scope.mtch_inining", $scope.mtch_inining);

        if (runvalue === "NB") {
          createNbButtons();
          console.log(" 245 NB Click kiya hai.");
          exta_ball = runvalue;

          // NB par modal open karo
          $("#nbModal").modal("show");
        } else if (runvalue === "WD") {
          createWDButtons();
          console.log(" 252 WD Click kiya hai");
          exta_ball = runvalue;

          $("#WDModal").modal("show");
        } else if (runvalue === "W") {
          createWButtons();
          console.log(" 260 W Click kiya hai.");

          $("#WModal").modal("show"); // runvalue out W modal
        } else {
          exta_ball = "";
          processNormalRun(runvalue, mtch_inining_ng);
        }
      }
      $scope.fetch_team_run();
    };

    // *****************************************************************************************
    function createNbButtons() {
      console.log("NB click kiya hai");
      const container = document.getElementById("nbRunButtons");
      container.innerHTML = "";
      for (let i = 0; i <= 6; i++) {
        const btn = document.createElement("button");
        btn.className = "btn btn-outline-primary m-1";
        btn.innerText = i;
        run = btn.innerText;
        btn.onclick = function () {
          addNbRun(i);
        };
        container.appendChild(btn);
      }

      const nbbtn = document.createElement("button");
      nbbtn.className = "btn btn-outline-danger m-1";
      // nbbtn ki jagah pe  wicktype likha hu
      nbbtn.innerText = "Run out";

      // wicktype = nbbtn.innerText;

      nbbtn.onclick = function () {
        addnb_runbutton(nbbtn.innerText);
      };
      container.appendChild(nbbtn);
      console.log("NB run out click huwa ");
    }

    function addNbRun(i) {
      $("#nbModal").modal("hide");
      let runText = i;
      let batsman = currentStriker;

      addRow(runText, $scope.mtch_inining, "", batsman);

      if (i % 2 === 1) {
        swapStrike();
      }

      // checkOverComplete();//comment kiya hu 30-9 ko
    }

    //*********************************** WD butun ka hai WD me run Aur OUT *************************** */

    function createWDButtons() {
      console.log(" WD buttun click huwa ___=", exta_ball);
      const container = document.getElementById("WDRunButtons");
      container.innerHTML = "";

      for (let i = 0; i <= 4; i++) {
        const btn = document.createElement("button");
        btn.className = "btn btn-outline-primary m-1";
        btn.innerText = i;
        btn.onclick = function () {
          addWDRun(i); // butun click karane par call hota hai
        };
        container.appendChild(btn);
      }

      const wd_ro_btn = document.createElement("button");
      wd_ro_btn.className = "btn btn-outline-danger m-1";
      wd_ro_btn.innerText = "Run Out";
      wd_ro_btn.onclick = function () {
        $("#WDModal").modal("hide");
        addnb_runbutton(wd_ro_btn.innerText);
      };

      container.appendChild(wd_ro_btn);
      const wd_st_btn = document.createElement("button");
      wd_st_btn.className = "btn btn-outline-danger m-1";
      wd_st_btn.innerText = "St";

      wd_st_btn.onclick = function () {
        $("#WDModal").modal("hide");

        add_st_wk(wd_st_btn.innerText);
      };
      container.appendChild(wd_st_btn);

      console.log("WD Buttun Click huwa");
    }

    function addWDRun(i) {
      $("#WDModal").modal("hide");
      let runText = i;
      let batsman = currentStriker;

      console.log("i=", i);

      console.log("currentStriker=", currentStriker);

      console.log("1.i=", i);

      console.log("237.1 currentStriker_new", currentStriker_new);

      addRow(runText, $scope.mtch_inining, "", currentStriker_new);

    }

    //*************************** W click karane par ******************************************************* */

    function createWButtons() {
      console.log("W click huwa hai");

      const container = document.getElementById("WRunButtons");
      container.innerHTML = ""; // pehle se existing buttons hata do
      const wicketTypes = ["C", "St", "B", "Lbw", "Hit wk", "Run out"];

      wicketTypes.forEach(function (type) {
        const btn = document.createElement("button");
        btn.className = "btn btn-outline-danger m-1";
        btn.innerText = type;
        btn.onclick = function () {
          wicktype = type;

          if (type == "Run out") {
            ROinfo_G = "W";
            console.log(" 206 W me Run out click kiya");
            addnb_runbutton(wicktype);
            console.log("wicktype", wicktype);
          } else if (type == "C") {
            console.log(" 208 W me C click kiya");
            add_cbutton_wk();
          } else if (type === "B" || type === "Lbw" || type === "Hit wk") {
            console.log(" 212 W me B,Lbw,Hit wk click kiya" + wicktype + type);
            add_bowlername_wk(wicktype);
          } else if (type === "St") {
            W_St_G = "W_St";
            console.log(" 206 W me St click kiya");
            add_st_wk(type);
          } else {
            addWrun(type);
          }
        };
        container.appendChild(btn);
      });
    }

    function addWrun(run) {
      $("#WModal").modal("hide");
      let ballDisplay = ballNumber;
      let batsman = currentStriker;

      addRow(ballDisplay, runText, batsman);

      if (run % 2 === 1) {
        swapStrike();
      }

      if (["Run out", "C", "St", "W", "Lbw", "Hit wk"].includes(run)) {
        swapStrike();
      }

      ballNumber = ballNumber + 1;
      // checkOverComplete();
    }

    function addnb_runbutton(wicktype_wd) {
      console.log("Run out click huwa hai =", wicktype_wd);
      $("#nbModal").modal("hide");
      $("#WModal").modal("hide");
      $("#nboutModal").modal("show");
      const container = document.getElementById("nboutButtons");
      container.innerHTML = "";

      for (let i = 0; i <= 4; i++) {
        const btn = document.createElement("button");
        btn.className = "btn btn-outline-primary m-1";
        btn.innerText = i;

        btn.onclick = function () {
          any_run_out_(i, wicktype_wd);
        };
        container.appendChild(btn);
      }
    }

    // function add_cbutton_wk() {
    //   $("#WModal").modal("hide");
    //   console.log("366 wi= ", wicktype);

    //   $scope.$apply(function () {
    //     $scope.showStrikeSelect = "no";
    //   });

    //   $("#NBout_Filder_select_Modal").modal("show");
    //   if (wicktype == "C") {
    //     $scope.out_batsman = currentStriker;
    //   }
    //   run = "0";
    // }

    //***************************** B, Lbw , Hit wk out hone par ******************************* */

    function add_bowlername_wk(wicktype) {
      alert("ppppppp")

      $("#WModal").modal("hide");

      if (wicktype == "B" || wicktype == "Lbw" || wicktype == "Hit wk") {

        $scope.out_batsman = currentStriker;

        $scope.$apply(function () {
               $scope.wicket_by = $scope.bowler.pl_slug; 
        });
        // $scope.wicket_by = $scope.bowler.pl_slug; 

        // $scope.wicket_by = $scope.bowler.item_pl_checked; 
        // alert("ppppppp")

        console.log("310 =", $scope.wicket_by_p);

        console.log("307 =", currentStriker);
        console.log("334 =", $scope.wicket_by);
        console.log("335 =", $scope.bowler.pl_slug);
        console.log("338 =", $scope.bowler.item_pl_checked);

        $scope.$apply(function () {
          $scope.showStrikeSelect = "no";
        });

       $("#NBout_Filder_select_Modal").modal("show");

        // $scope.$apply(function () {
        //   $scope.lbw_bowler_disable = "true";
        // });

        $scope.$apply(function () {
          $scope.who_pl_out = "true";
        });

        run = "0";
      }

      // angular ko force update karao
      $scope.$apply();
    }

    // function add_st_wk(wicktype_b) {
    //   // console.log("modal open huwa");

    //   $("#WModal").modal("hide");

    //   $scope.$apply(function () {
    //     $scope.showStrikeSelect = "no";
    //   });

    //   console.log("modal open huwa");

    //   $("#NBout_Filder_select_Modal").modal("show");

    //   $scope.$apply(function () {
    //     $scope.out_batsman = currentStriker;
    //   });

    //   $scope.$apply(function () {
    //     $scope.who_pl_out = "true";
    //   });

    //   $scope.$apply(function () {
    //     $scope.lbw_bowler_disable = "false";
    //   });

    //   console.log("5 modal open huwa", $scope.out_batsman);

    //   if (wicktype_b == "St") {
    //     // $scope.out_batsman = currentStriker;
    //   }

    //   if (exta_ball == "WD") {
    //     ballNumber = exta_ball;
    //     run = "1";
    //     wicktype = wicktype_b;
    //   } else {
    //     run = "1";
    //     wicktype = wicktype_b;
    //   }
    // }

    function add_st_wk(wicktype_b) {
      console.log("367  Modal open huwa");

      $("#WModal").modal("hide");

      $scope.$apply(function () {
        $scope.showStrikeSelect = "no";
      });

      // $scope.$apply(function () {
      //   $scope.who_pl_out = "yes";
      // });

      //  $scope.out_batsman = currentStriker;

      console.log("379 Modal open huwa");

      $("#NBout_Filder_select_Modal").modal("show");

      console.log("Modal open huwa");

      $scope.$apply(function () {
        $scope.out_batsman = currentStriker;
      });

      $scope.$apply(function () {
        $scope.who_pl_out = "true";
      });

      $scope.$apply(function () {
        $scope.lbw_bowler_disable = "false";
      });

      console.log("Modal open huwa", $scope.out_batsman);



      if (exta_ball == "WD") {
        ballNumber = exta_ball;
        run = "1";
        wicktype = wicktype_b;
      } else if (wicktype_b == "St") {
        // $scope.out_batsman = currentStriker;
      } else if (W_St_G === "W_St") {
        run = "0";
        wicktype = "St";
      } else {
        run = "1";
        wicktype = wicktype_b;
      }
    }

    //********************************************************************************************** */

    function any_run_out_(i, wicktype_wd) {
      console.log(
        "400 $scope.showStrikeSelect ",
        $scope.showStrikeSelect,
        "ROinfo_G ",
        ROinfo_G
      );

      if (ROinfo_G === "W") {
        run = i;
        wicktype = wicktype_wd;

        // Force Angular digest

        $scope.$apply(function () {
          $scope.showStrikeSelect = "yes"; // New player strike lega ki Nonstrike wo select option show rhe
        });

        $scope.$apply(function () {
          $scope.who_pl_out = "false"; // Kaun player out huwa hai, wala select enable rhe, disable nhi
        });

        $scope.$apply(function () {
          $scope.lbw_bowler_disable = "false"; // lbw,hitwk, ke samy option disable, par run out ke samay enable rhega , kisane out kiya hai usaka hai
        });
      } else if (exta_ball === "NB" || exta_ball === "WD") {
        run = i + 1;
        ballNumber = exta_ball;
        wicktype = wicktype_wd;

        $scope.$apply(function () {
          $scope.showStrikeSelect = "yes";
        });

        $scope.$apply(function () {
          $scope.who_pl_out = "false";
        });

        $scope.$apply(function () {
          $scope.lbw_bowler_disable = "false";
        });
      }

      $("#nboutModal").modal("hide");

      console.log(
        "401 $scope.showStrikeSelect ",
        $scope.showStrikeSelect,
        "ROinfo_G ",
        ROinfo_G
      );

      $("#NBout_Filder_select_Modal").modal("show");

      console.log(
        "402 $scope.showStrikeSelect ",
        $scope.showStrikeSelect,
        "ROinfo_G ",
        ROinfo_G
      );
    }

    function add_cbutton_wk() {
      $("#WModal").modal("hide");

      if (wicktype == "C") {
        $scope.out_batsman = currentStriker;

        $scope.$apply(function () {
          $scope.showStrikeSelect = "no";
        });

        console.log("366 Modal open huwa");

        $("#NBout_Filder_select_Modal").modal("show");

        $scope.$apply(function () {
          $scope.who_pl_out = "true";
        });

        $scope.$apply(function () {
          $scope.lbw_bowler_disable = "false";
        });

        console.log("366 Modal open huwa", $scope.who_pl_out);
      }

      run = "0";
    }

    // function add_cbutton_wk() {
    //   $("#WModal").modal("hide");
    //   console.log("366 wi= ", wicktype);

    //   $scope.$apply(function () {
    //     $scope.showStrikeSelect = "no";
    //   });

    //   $("#NBout_Filder_select_Modal").modal("show");
    //   if (wicktype == "C") {
    //     $scope.out_batsman = currentStriker;
    //   }
    //   run = "0";
    // }

    //******************************************************************************************************/

    function swapStrike() {
      let temp = currentStriker;
      currentStriker = currentNonStriker;
      currentNonStriker = temp;
    }

    function processNormalRun(run, mtch_inining_ng) {
      console.log("mtch_inining_ng", mtch_inining_ng);

      let ballDisplay = ballNumber; // undefine jab wd ke baad normal aaye
      console.log("578 ballNumber", ballNumber);

      $scope.batsman = currentStriker;

      addRow(run, mtch_inining_ng, ballDisplay, $scope.batsman);

      // if (run === "1" || run === "3" || run === "5") {
      // }

      // checkOverComplete();
    }

    // *****************************************************************************

    $scope.ball_over_fetch = function () {
      // DB se cuurent,mtch over la rha hai

      $http
        .get(
          ApiUrl +
            "api_signin.php?action=ball_over_fetch&mtch_slug=" +
            $scope.mt_slug
        )
        .then(function (response) {
          // console.log("2T9 API response:_", $scope.mt_slug);
          // console.log("999 response:_", response);

          let data = response.data;
          if (
            data == "null" ||
            data == undefined ||
            data == "Invalid request" ||
            data == "Error"
          ) {
            $scope.ball_over_data = "";
          } else {
            $scope.ball_over_data = data;

            //  ball value ko store karo
            ballNumber = parseInt(data.ball); //pahle ye uncomment tha
            // ballNumber = data.ball;

            current_over = data.current_over;

            mtch_over = data.mtch_over;
            console.log("546 mtch_over", mtch_over);

            // $scope.fetch_toss();
          }
        })
        .catch(function (error) {
          console.error(" API error:", error);
        });
    };
    $scope.ball_over_fetch();

    function addRow(run, mtch_inining_ng, ball, battsman) {
      console.log("641 ball", ball);

      const table = document.getElementById("scoreTable");
      const row = table.insertRow(-1);

      const cellBall = row.insertCell(0);
      const cellRun = row.insertCell(1);
      const cellBatsman = row.insertCell(2);

      cellBall.innerText = ball;
      cellRun.innerText = run;
      cellBatsman.innerText = battsman;

      console.log("641 exta_ball", exta_ball);
      //  console.log("1032 ",$scope.start_ball);

      if (exta_ball == "NB" || exta_ball == "WD") {
        run++;
        ball = exta_ball;
        ballNumber = "";
        console.log("589 ballNumber-== ", ballNumber);

        console.log("628 battsman", battsman);

        $scope.row_data_send(
          run,
          mtch_inining_ng,
          ball,
          battsman,
          current_over
        );
        exta_ball = "";
      } else {
        $scope.row_data_send(
          run,
          mtch_inining_ng,
          ball,
          battsman,
          current_over
        );
      }
    }

    $scope.row_data_send = function (
      run,
      mtch_inining_ng,
      ball,
      battsman,
      current_over
    ) {
      console.log("613 mtch_inining_ng", mtch_inining_ng);

      console.log(
        "1075.01 row_data_send ball=" +
          ball +
          "_run_" +
          run +
          "battsman=" +
          battsman +
          " = " +
          currentStriker_new +
          "=_bowler==" +
          currentBowler_new +
          "_current_over=" +
          current_over +
          "$scope.mtch_inining=" +
          $scope.mtch_inining +
          "_mt_slug=" +
          mt_slug +
          "=" +
          "_wicktype=" +
          wicktype
      );

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          ball: ball,
          run: run,
          batsman: currentStriker_new,
          mt_slug: mt_slug,
          bowler: currentBowler_new, // currentBowler_new ng-model se aaya hai, past=
          current_over: current_over,
          // mtch_inining: $scope.mtch_inining,
          mtch_inining: mtch_inining_ng,
          action: "every_ball_data_send",
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
          } else {
            alert($scope.message);
          }
        }
        // $scope.fetch_inning_info();
        $scope.fetch_batsman_run();
        checkOverComplete();
        $scope.skip_extra_ball(ball, run);
        // $scope.fetch_inning_info();

        exta_ball = "";
        ROinfo_G = "";

        // $scope.fetch_inning_info();
      });
    };

    $scope.update_striker_val = function (slug, st_slug, non_stslug) {
      // alert("s "+slug+ " ss "+st_slug+ " sss "+non_stslug);
      $scope.st_val = "";
      if (slug == st_slug) {
        $scope.st_val = "St_out";
      } else if (slug == non_stslug) {
        $scope.st_val = "nonSt_out";
      }
    };

    $scope.send_wicket_detail = function (
      wicket_by,
      out_batsman,
      neww_batsman,
      stker_non_striker,
      st_val
    ) {
      console.log(
        "695 stker_non_striker= " +
          stker_non_striker +
          out_batsman +
          " st_val= " +
          st_val +
          " run= ",
        run + " ROinfo_G= ",
        ROinfo_G
      );

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          wicket_by: wicket_by,
          out_batsman: out_batsman,
          neww_batsman: neww_batsman,
          wicktype: wicktype, // global ko derect acces kar rha hu .// Run out
          ballNumber: ballNumber,
          run: run,
          // batsman:currentStriker,
          batsman: $rootScope.selected_stricker.selected.pl_slug,

          mt_slug: mt_slug,
          bowler: $rootScope.selected_bowler.selected.pl_slug,
          current_over: current_over,

          mtch_inining: $scope.mtch_inining,
          bowling_team_updt: $scope.bowling_team,
          non_striker_updt: $rootScope.selected_non_stricker.selected.pl_slug,
          batting_team_updt: $scope.batting_team,
          selected_toss_updt: $scope.selected_toss,
          stker_non_striker: stker_non_striker,
          st_val: st_val,
          action: "send_wicket_detail",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        alert("send_wicket_detail ka success huwa");

        if (data.errors) {
          $scope.message = "API Error";
        } else {
          $scope.message = data.scalar;
          if ($scope.message == "Success") {

            $scope.out_batsman = "";
            $scope.neww_batsman = "";
            $scope.stker_non_striker = "";
            exta_ball = "";
            ROinfo_G = "";
            ballNumber++;
            $scope.skip_extra_ball();
            $scope.select_batting();
            $scope.fetch_Notout_pl($scope.batting_team);
            $scope.fetch_batsman_run();
            console.log("828 $scope.wicket_by", $scope.wicket_by);
            $("#NBout_Filder_select_Modal").modal("hide");
      
          } else {
            alert($scope.message);
          }
        }
      });
    };

    $scope.fetch_toss = function () {
      $http
        .get(
          ApiUrl + "api_signin.php?action=fetch_toss_win&toss_slug=" + toss_slug
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
          }
        });
    };
    $scope.fetch_toss();

    $scope.Chasing_Team_all_pl = function (pll) {
      let teamA = $scope.toss[0].team_name_a;
      let teamB = $scope.toss[1].team_name_a;
      // console.log("755 teamA=", teamA, "teamB=", teamB);
      // console.log("755 $scope.batting_team5", $scope.batting_team);
      // console.log("755 pll= ", pll);

      if ($scope.batting_team == teamA) {
        $scope.bowling_team = teamB;
        // console.log("756 bowling_team", $scope.bowling_team); // BB // AA
      } else if ($scope.batting_team == teamB) {
        $scope.bowling_team = teamA;
        // console.log("757 bowling_team", $scope.bowling_team); //BB //
      }
      // console.log("758 $scope.bowling_team", $scope.bowling_team);
      // console.log("758 $scope.batting_team ", $scope.batting_team);
      $scope.fetch_bowling_team($scope.bowling_team); // yaha se bowling ke liye bhej rha hu, BB ke liye
    };

    $scope.fetch_bowling_team = function (bowling_) {
      // console.log("778 bowling_GO DB=", bowling_, toss_slug);

      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_bowling_team&team=" +
            bowling_ +
            "&slug=" +
            toss_slug
        )
        .then(function (response) {
          $scope.bowling_players = response.data;
          // console.log("llllllllllllllllllllllllllllllllllllll" +JSON.stringify(response.data));
        });
    };

    $("#inining_id").hide();
    $scope.fetch_inning_info = function () {
      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_inning_info&mtch_slug=" +
            mt_slug
        )

        .success(function (inning) {
          if (
            inning == "null" ||
            inning == undefined ||
            inning == "Invalid request" ||
            inning == "Error"
          ) {
            $scope.inning = "";
            $("#inining_id").show();
          } else {
            $("#inining_id").hide();
            $scope.inning = inning;

            $scope.selected_toss = inning.toss_win;
            $scope.batting_team = inning.batting_team;
            $scope.batts = inning.batting_team;

            if ($scope.inning) {
              $scope.striker = inning.striker;
              currentStriker = inning.striker;

              // $scope.striker = inning.striker;

              $scope.non_striker = inning.non_striker;
              currentNonStriker = inning.non_striker;

              $rootScope.selected_non_stricker.selected = inning.non_st;
              currentNonStriker = $rootScope.selected_non_stricker.selected.pl_slug;
              //  currentNonStriker = inning.non_st;

              $rootScope.selected_stricker.selected = inning.st;
              currentStriker = $rootScope.selected_stricker.selected.pl_slug;
              //  currentStriker = inning.st;

              $rootScope.selected_bowler.selected = inning.bowler;

              if ($scope.striker == "" || $scope.non_striker == "") {
                $("#inining_id").show();
              }

              $scope.bowler = inning.bowler;
              console.log("921 $scope.bowler",$scope.bowler )

              $scope.mtch_inining = parseInt(inning.in_ining);
            }
          }

          if ($scope.selected_toss) {
            $scope.inining_disable = true;
          }
        });
    };
    $scope.fetch_inning_info();

    $scope.fetch_inning_zero_leval = function () {
      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_inning_zero_leval&mtch_slug=" +
            mt_slug
        )
        .success(function (inning) {
          if (
            inning == "null" ||
            inning == undefined ||
            inning == "Invalid request" ||
            inning == "Error"
          ) {
            $scope.inning = "";
          } else {
            $scope.inning = inning;
            $scope.selected_toss = inning.toss_win;
            $scope.batting_team = inning.batting_team;
            $scope.mtch_inining = inning.in_ining;

            $scope.select_batting($scope.batting_team);
          }

          // if ($scope.selected_toss) {
          //   // $scope.inining_disable = true;
          // }
        });
    };
    $scope.fetch_inning_zero_leval();

    $scope.select_batting = function () {
      // console.log("884 $scope.batting_team",$scope.batting_team);

      if ($scope.batting_team) {
        $http
          .get(
            ApiUrl +
              "api_signin.php?action=select_batting_call&team=" +
              $scope.batting_team +
              "&slug=" +
              toss_slug
          )
          .then(function (response) {
            $scope.batting_players = response.data;
            console.log("894 $scope.batting_team", $scope.batting_team);

            $scope.Chasing_Team_all_pl($scope.batting_team); /// is Argument se batting bowling ka sahi data fetch hokar aata hai

            $scope.fetch_Notout_pl($scope.batting_team);

            $scope.fetch_batsman_run();
            $scope.fetch_inning_info();
            // $scope.fetch_bowling_team();
          });
      }
    };

    // $scope.select_batting();  // pahle call ho rha tha.

    $scope.fetch_batsman_run = function () {
      console.log("906 mtch_inining", $scope.mtch_inining); //1

      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_batsman_run&mtch_slug=" +
            mt_slug +
            "&mtch_inining=" +
            $scope.mtch_inining
        )

        .then(function (response) {
          $scope.batsman = response.data;
          // $scope.start_ball = response.ball;

          // console.log("1032 ",$scope.start_ball);
        });
    };

    // $scope.fetch_team_run = function () {
    //   console.log("906 mtch_inining", $scope.mtch_inining); //1

    //   $http
    //     .get(
    //       ApiUrl +
    //         "api_signin.php?action=fetch_team_run&mtch_slug=" +
    //         mt_slug +
    //         "&mtch_inining=" +
    //         $scope.mtch_inining
    //     )

    //     .then(function (response) {
    //       $scope.team_run = response.data;
    //       console.log("1027 $scope.team_run",$scope.team_run);

    //     });
    // };

    $scope.fetch_team_run = function () {
      console.log("11 Fetching team run for inning:", $scope.mtch_inining);

      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_team_run" +
            "&mtch_slug=" +
            mt_slug +
            "&mtch_inining=" +
            $scope.mtch_inining
        )
        .then(function (response) {
          console.log("Team Run API Response:", response.data);

          // API se { total_run: 45 } milega
          $scope.team_run = response.data.total_run || 0;

          console.log("Team Total Run:", $scope.team_run);
        });
    };

    // Initial load par call
    $scope.fetch_team_run();

    // $scope.fetch_totle_mtch_run = function () {

    //    console.log("906 mtch_inining",$scope.mtch_inining); //1

    //     $http.get(ApiUrl +"api_signin.php?action=fetch_totle_mtch_run&mtch_slug=" + mt_slug + "&mtch_inining=" +$scope.mtch_inining)

    //       .then(function (response) {

    //         $scope.totle_mtch_runs = response.data;
    //         console.log("946 $scope.totle_mtch_runs",$scope.totle_mtch_runs);

    //       });

    // };
    // $scope.fetch_totle_mtch_run();

    $scope.fetch_Notout_pl = function (batter_n) {
      // console.log("925 batting_team",$scope.batting_team );
      console.log("925 $scope.bowling_team", $scope.bowling_team);
      console.log("925 batting_team GO DB=", batter_n);

      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_Notout_pl&mtch_slug=" +
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
          // inning fist row disable
          // if ($scope.selected_toss) {
          //   $scope.inining_disable = true;
          // }
        });
    };

    $scope.skip_extra_ball = function (ball_ex, run_ex) {
      // DB ka NB,WD ko skip kar valid ball lane wala function.

      console.log("1020 ball_ex", ball_ex);

      console.log("1020 run_ex", run_ex);
      $http
        .get(
          ApiUrl + "api_signin.php?action=skip_extra_ball&mtch_slug=" + mt_slug
        )

        .success(function (extra) {
          if (
            extra == "null" ||
            extra == undefined ||
            extra == "Invalid request" ||
            extra == "Error"
          ) {
            $scope.extra = "";
            console.log("pppppppppppppppppppppppp");

            alert("skip_extra_ball blank aaya hai");
          } else if (ballNumber >= 7) {
            console.log("828 ballnumber", ballNumber);
            $scope.reset_extra_ball = extra.ball;

            console.log(
              "829 jab ballNumber 6 || 6+ huwa tab ball 1 ho jaye=",
              ballNumber
            );

            // $scope.reset_extra_ball = extra.ball;

            console.log(
              "830 DB se nhi aaya pahle ka hai =",
              $scope.reset_extra_ball
            );

            console.log("831 current over=", current_over);

            $scope.reset_extra_ball = 1;
            current_over++;

            console.log("832 inning++ befor ", $scope.mtch_inining);
            console.log("832.1 current over=", current_over);
            console.log(
              "835 over complete hone ke karan $scope.reset_extra_ball ko 1 kiya=",
              $scope.reset_extra_ball
            );
            console.log("836 ballNumber", ballNumber);
          } else if (
            (ball_ex == "WD" || ball_ex == "NB") &&
            (run_ex == 2 || run_ex == 4 || run_ex == 6)
          ) {
            console.log("1103 ball = ", ball_ex);

            $scope.ining_st_nst_updt();
          } else if (
            ballNumber == "NB" ||
            ballNumber == "WD" ||
            ballNumber == NaN
          ) {
            console.log(
              "884 NB/WD aaya hai ballNumber-- niche kiya hu",
              ballNumber
            );
            console.log(
              "884.0 $scope.reset_extra_ball-- ke baad",
              $scope.reset_extra_ball
            );

            $scope.reset_extra_ball = extra.ball;
            $scope.reset_extra_ball++;

            console.log(
              "884.1 $scope.reset_extra_ball-- ke baad",
              $scope.reset_extra_ball
            );
            console.log("885 ballNumber-- ke baad", ballNumber);
          } else {
            console.log("1077 Normal Runs liya hai");
            $scope.reset_extra_ball = extra.ball;
            check_db_run = extra.run; //check_db_run variable for check odd ball

            if (check_db_run == 1 || check_db_run == 3 || check_db_run == 5) {
              console.log("nurmall ball me hi call hoga");

              $scope.ining_st_nst_updt();
            }

            if ($scope.reset_extra_ball == 6) {
              console.log(
                "jab reset_extra_ball 6 aaye tab 1 hoga",
                $scope.reset_extra_ball
              );

              $scope.reset_extra_ball = 1;
              current_over++;
            } else if (
              $scope.reset_extra_ball == 1 ||
              $scope.reset_extra_ball == 0
            ) {
              $scope.reset_extra_ball++;
            }

            // if($scope.reset_extra_ball<=5){
            else if (
              $scope.reset_extra_ball >= 2 &&
              $scope.reset_extra_ball <= 5
            ) {
              $scope.reset_extra_ball++;
            }
          }

          if ($scope.mtch_inining == 2) {
            $scope.row_data_fetch_innings_two($scope.reset_extra_ball);
          } else if ($scope.mtch_inining == 1) {
            $scope.row_data_fetch($scope.reset_extra_ball);
          }
        });
    };
    $scope.skip_extra_ball();

    $scope.row_data_fetch = function (New_Reset_Ball) {
      $http
        .get(
          ApiUrl +
            "api_signin.php?action=row_data_fetch&mtch_slug=" +
            $scope.mt_slug
        )
        .success(function (balldata) {
          if (
            !balldata ||
            balldata == "Invalid request" ||
            balldata == "Error"
          ) {
            console.warn(" No valid data received from API");
            $scope.balldata = [];
            $scope.groupedData = {};
          } else {
            skip_ext_ball = balldata[0].ball;
            ballNumber = New_Reset_Ball;
            let grouped = {};
            if (balldata) {
              $scope.balldata = balldata;
            }

            // View me dikhane ke liye grouped data set karna
            $scope.groupedData = grouped;

            if (current_over >= mtch_over) {
              check_inining_end();
            }
          }
        })
        .error(function (err) {
          console.error(" API error:", err);
        });

      $scope.reset_extra_ball = ""; // pahle upar ke else me tha ye
    };
    $scope.row_data_fetch();

    $scope.row_data_fetch_innings_two = function (New_Reset_Ball) {
      // API se match ka poora ball-by-ball data fetch karna

      $http
        .get(
          ApiUrl +
            "api_signin.php?action=row_data_fetch_innings_two&mtch_slug=" +
            $scope.mt_slug
        )
        .success(function (ball_data) {
          // Agar data empty ya error hai

          if (
            !ball_data ||
            ball_data == "Invalid request" ||
            ball_data == "Error"
          ) {
            console.warn(" No valid data received from API");
            $scope.ball_data = [];
            $scope.groupedData = {};
          } else {
            skip_ext_ball = ball_data[0].ball;

            ballNumber = New_Reset_Ball;

            let grouped = {};
            if (ball_data) {
              $scope.ball_data = ball_data;
            }
            // console.log(" Grouped data:", grouped); // Final grouped structure
            // View me dikhane ke liye grouped data set karna
            $scope.groupedData = grouped;

            console.log("1128 current_over", current_over);
            console.log("1128.1 mtch_over", mtch_over);

            if (current_over >= mtch_over) {
              check_inining_end();
            }
          }
        })
        .error(function (err) {
          console.error(" API error:", err);
        });

      $scope.reset_extra_ball = "";
    };
    $scope.row_data_fetch_innings_two();

    $scope.Done_inning_info = function (
      selected_toss,
      batting_team,
      striker,
      non_striker,
      bowler,
      mtch_inining
    ) {
      if (!$scope.selected_toss) {
        alert("Please Select Toss Win Team");
        return;
      } else if (!$scope.batting_team) {
        alert("Please Select Batting Team");
        return;
      } else if (!$scope.mtch_inining) {
        alert("Please Select Match Inining");
        return;
      } else if (!$rootScope.selected_stricker.selected) {
        alert("Please Select Striker");
        return;
      } else if (!$rootScope.selected_non_stricker.selected) {
        alert("Please select Non Striker");
        return;
      } else if (!$rootScope.selected_bowler.selected) {
        alert("Please Select Bowler");
        return;
      }

      if (selected_toss) {
        $scope.inining_disable = true; //inning fist row disable
      }
      console.log("1232 mtch_inining", mtch_inining);

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          selected_toss: selected_toss,
          batting_team: batting_team,
          striker: striker,
          non_striker: non_striker,
          bowler: bowler,
          mt_slug: $scope.mt_slug,
          bowling_team: $scope.bowling_team,
          mtch_inining: mtch_inining,
          action: "Done_inning_info",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = "API Error";
        } else {
          $scope.message = data.scalar;
          alert("Save Inning Data");
          //  $scope.showAddButton = true;
        }
      });
    };

    $scope.send_next_bowler = function (next_bowler) {
      console.log("1232 next_bowler", next_bowler, mt_slug);

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          next_bowler: next_bowler,
          mtc_slug: mt_slug,
          action: "send_next_bowler",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = "API Error";
        } else {
          $scope.message = data.scalar;
          $("#who_next_bowler_Modal").modal("hide");
          // alert("Save next bowler")
          $scope.fetch_inning_info();
        }
      });
    };

    function checkOverComplete() {
      if (ballNumber >= 6) {
        $scope.ining_st_nst_updt();
        $scope.Chasing_Team_all_pl();

        console.log("1263 current_over", current_over, "mtch_over", mtch_over);
        mtch_over--;
        console.log("1436 mtch_over", mtch_over);

        if (current_over >= mtch_over) {
          $("#who_next_bowler_Modal").modal("hide");
          mtch_over++;
          console.log("1436.1 mtch_over", mtch_over);
        } else {
          $("#who_next_bowler_Modal").modal("show");
          mtch_over++;
          console.log("1436.2 mtch_over", mtch_over);
        }

        $("#scoreTable").empty();
      }
    }

    function check_inining_end() {
      console.log("1233 current_over", current_over);
      console.log("1233 mtch_over", mtch_over);
      console.log("1233 $scope.mtch_inining", $scope.mtch_inining);

      if (current_over >= mtch_over) {
        console.log("1241 $scope.mtch_inining", $scope.mtch_inining);
        // console.log("1241 $scope.mtch_inining",mtch_inining);

        if ($scope.mtch_inining == 1) {
          $scope.mtch_inining++;
          alert(
            "First Inning Complete And " + $scope.mtch_inining + " Inning Start"
          );

          current_over = 0;
          ballNumber = "1";
          // $scope.mtch_inining++;

          let temp = $scope.batting_team;
          $scope.batting_team = $scope.bowling_team;
          $scope.bowling_team = temp;

          // $scope.select_batting();  // call ng-change then change bowlwe and striker before 2nd inning start
          $scope.striker = ""; // striker blank before start 2nd inning
          $scope.non_striker = ""; // non striker blank before start 2nd inning
          $scope.bowler = ""; // bowler blank before start 2nd inning
          currentNonStriker = "";
          currentStriker = "";
          // $rootScope.selected_stricker.selected.pl_slug = "";
          $rootScope.selected_stricker.selected = "";
          $rootScope.selected_non_stricker.selected = "";
          $rootScope.selected_bowler.selected = {};
          $rootScope.selected_bowler.selected = "";

          $scope.ining_update(
            $scope.mtch_inining,
            $scope.batting_team,
            mt_slug,
            $scope.bowling_team
          );
          $scope.fetch_inning_info();
          $scope.select_batting();
        } else if ($scope.mtch_inining == 2) {
          $scope.mtch_inining++;
          alert("- - - - Match Complete - - - -");
        }

        // console.log("1241.1 $scope.mtch_inining", $scope.mtch_inining);
        // // console.log("1241.1 $scope.mtch_inining",mtch_inining);

        // if($scope.mtch_inining==2){
        // alert("seccond Inning Complete And " + $scope.mtch_inining + " Inning Start");
        // // alert("Fist Inining Complete And Inining Start");
        // // $scope.showAddButton = false;
        // current_over = 0;
        // ballNumber = "1";
        // // $scope.mtch_inining++;

        // let temp = $scope.batting_team;
        // $scope.batting_team = $scope.bowling_team;
        // $scope.bowling_team = temp;

        // // $scope.select_batting();  // call ng-change then change bowlwe and striker before 2nd inning start
        // $scope.striker = "";       // striker blank before start 2nd inning
        // $scope.non_striker = ""; // non striker blank before start 2nd inning
        // $scope.bowler = "";     // bowler blank before start 2nd inning
        // currentNonStriker = "";
        // currentStriker = "";
        // $rootScope.selected_stricker.selected.pl_slug = "";
        // $rootScope.selected_non_stricker.selected = "";
        // $rootScope.selected_bowler.selected.pl_slug = "";

        // $scope.ining_update($scope.mtch_inining,$scope.batting_team,mt_slug,$scope.bowling_team);
        // $scope.fetch_inning_info();
        // $scope.select_batting();

        // }

        // else{
        //  alert("- - - - Match Complete - - - -");
        // }
      }
    }

    $scope.ining_update = function (m_inining, batt_team, mt_slug, bowl_team) {
      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          m_inining: m_inining,
          batt_team: batt_team,
          mtch_slug: mt_slug,
          bowl_team: bowl_team,
          action: "ining_update",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = "API Error";
        } else {
          $scope.message = data.scalar;
          //  $scope.select_batting();
        }
      });
    };

    function swapStrike_db() {
      console.log("swapStrike_db call huwa");

      let temp = currentStriker_new;
      currentStriker_new = currentNonStriker_new;
      currentNonStriker_new = temp;
    }

    $scope.ining_st_nst_updt = function () {
      console.log("1463 currentStriker_new", currentStriker_new);
      console.log("1463 currentNonStriker_new", currentNonStriker_new);
      console.log("1463 currentNonStriker_new", currentNonStriker_new);

      if (currentStriker_new != "" && currentNonStriker_new != "") {
        console.log("striker Nonstriker Update karata hai har ball me");

        swapStrike_db();

        $http({
          method: "POST",
          url: ApiUrl + "api_signin.php",
          data: {
            currentStriker_new: currentStriker_new,
            currentNonStriker_new: currentNonStriker_new,
            // currentStriker_new: currentStriker,
            // currentNonStriker_new: currentNonStriker,
            mt_slug: mt_slug,
            action: "ining_st_nst_updt",
          },
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
        }).success(function (data) {
          $scope.fetch_inning_info();
          if (data.errors) {
            $scope.message = "API Error";
          } else {
            $scope.message = data.scalar;
          }
        });
      }
    };
  },
]);














//  22/11/2025--------------

tdipllp.controller("everyballjsapicontroller", [
  "$window",
  "$scope",
  "$rootScope",
  "$http",
  "Upload",
  "$timeout",
  function ($window, $scope, $rootScope, $http, Upload, $timeout) {
    $scope.mt_slug = mt_slug; // JavaScript se AngularJS ke $scope variable me dena

    $scope.batts = "";
    $scope.row_data_fetch = "";
    $scope.reset_extra_ball = ""; // global variable DB ka NB,WD ko skip kar int lane wala.
    $scope.batsman = ""; //global
    $scope.mtch_inining = 1; //global variable
    $scope.skip_ext_ball = ""; //global variable
    $scope.totle_mtch_runs = "";
    // let basman_te = "";
    let check_db_run = "";
    let mtch_over = ""; // global variable
    let ball = "";
    // let next_bowlers ="";
    // let run_ex ="";
    let run = ""; // global variable
    let exta_ball = ""; // global variable
    // let = extra_ball;   // global variable
    let ROinfo_G = ""; // global variable
    let W_St_G = "";
    let wicktype = ""; // global variable
    let currentBowler_new = "";
    let current_over = 0; // global variable
    let ballNumber = ""; // global variable
    let currentStriker = ""; // global variable
    let currentNonStriker = ""; // global variable
    let currentStriker_new = "";
    let currentNonStriker_new = "";
    let currentStriker_name = "";
    let mtch_inining_new = "";
    let view_table_ball = "";
    let view_table_batsman = "";
    let view_table_run = "";
    let current_over_temp = "";
    let db_balls = "";
    let db_skip_ball = "";
    // let mtch_over_low =-1;

    //  $scope.isStrikerDisabled = "no";
    //********************** NB WD W processNormalRun ***********************************

    // apna_structure/match_batting/8f6a016856aabbe6998194eda7cbde5c

    // alert(currentBowler_new,currentStriker_new,currentNonStriker_new,mtch_inining_new);

    if (
      !currentBowler_new ||
      !currentStriker_new ||
      !currentNonStriker_new ||
      !mtch_inining_new
    ) {
      $scope.hide_add_btn = true; // button hide ho jayega
    } else {
      $scope.hide_add_btn = false; // button visible rahega
    }

    $scope.back_buttun2 = function () {
      $window.location.href = baseurl + "/match_batting/" + mt_slug;
    };

    $scope.addBall = function (
      runvalue,
      mtch_inining_ng,
      currentStriker_ng,
      currentNonStriker_ng,
      currentBowler_ng,
      currentStriker_ng_name
    ) {
      currentBowler_new = currentBowler_ng;
      currentStriker_new = currentStriker_ng;
      currentNonStriker_new = currentNonStriker_ng;
      currentStriker_name = currentStriker_ng_name;
      mtch_inining_new = mtch_inining_ng;

      console.log(
        "77 currentStriker_new",
        currentStriker_new,
        "",
        currentStriker_ng,
        " ===",
        currentStriker_name,
        " ",
        currentNonStriker_new,
        "",
        currentNonStriker_ng,
        " ",
        currentBowler_new
      );

      console.log("77 $scope.mtch_inining", $scope.mtch_inining);
      console.log("77 current_over", current_over);
      console.log("77 mtch_over", mtch_over);
      console.log("77 mtch_inining_ng", mtch_inining_ng);
      console.log("77 ballnumber", ballNumber);
      // console.log("777 view_table_ball_ining_two", view_table_ball_ining_two);
      console.log("777 current_over", current_over);
      // alert("777 $scope.mtch_over_low ", $scope.mtch_over_low );
      console.log("777 $scope.mtch_inining", $scope.mtch_inining);

      // if (current_over >= mtch_over-1) {  //1
      //   check_inining_end();
      // }

      //  console.log("77 $scope.mtch_inining",$scope.mtch_inining);

      // if ($scope.mtch_inining >= 3) {
      //   alert(
      //     "Your total " +
      //       mtch_over +
      //       " overs is complete. Runs cannot be added now."
      //   );
      // }

      if (!runvalue) return;

      console.log(" 73 $scope.mtch_inining", $scope.mtch_inining);

      if (runvalue === "NB") {
        createNbButtons();
        console.log(" 245 NB Click kiya hai.");
        exta_ball = runvalue;

        // NB par modal open karo
        $("#nbModal").modal("show");

        
      } else if (runvalue === "WD") {
        createWDButtons();
        console.log(" 252 WD Click kiya hai");
        exta_ball = runvalue;

        $("#WDModal").modal("show");
      } else if (runvalue === "W") {
        createWButtons();
        console.log(" 260 W Click kiya hai.");

        $("#WModal").modal("show");
      } else {
        exta_ball = "";
        processNormalRun(runvalue, mtch_inining_ng);
      }
    };

    // *****************************************************************************************
    function createNbButtons() {
      console.log("NB click kiya hai");
      const container = document.getElementById("nbRunButtons");
      container.innerHTML = "";
      for (let i = 0; i <= 6; i++) {
        const btn = document.createElement("button");
        btn.className = "btn btn-outline-primary m-1";
        btn.innerText = i;
        run = btn.innerText;
        btn.onclick = function () {
          addNbRun(i);
        };
        container.appendChild(btn);
      }

      const nbbtn = document.createElement("button");
      nbbtn.className = "btn btn-outline-danger m-1";
      // nbbtn ki jagah pe  wicktype likha hu
      nbbtn.innerText = "Run out";

      // wicktype = nbbtn.innerText;

      nbbtn.onclick = function () {
        addnb_runbutton(nbbtn.innerText);
      };
      container.appendChild(nbbtn);
      console.log("NB run out click huwa ");
    }

    function addNbRun(i) {
      $("#nbModal").modal("hide");
      let runText = i;
      let batsman = currentStriker;

      addRow(runText, $scope.mtch_inining, "", batsman);

      if (i % 2 === 1) {
        swapStrike();
      }
    }

    //*********************************** WD butun ka hai WD me run Aur OUT *************************** */

    function createWDButtons() {
      console.log(" WD buttun click huwa ___=", exta_ball);
      const container = document.getElementById("WDRunButtons");
      container.innerHTML = "";

      for (let i = 0; i <= 4; i++) {
        const btn = document.createElement("button");
        btn.className = "btn btn-outline-primary m-1";
        btn.innerText = i;
        btn.onclick = function () {
          addWDRun(i); // butun click karane par call hota hai
        };
        container.appendChild(btn);
      }

      const wd_ro_btn = document.createElement("button");
      wd_ro_btn.className = "btn btn-outline-danger m-1";
      wd_ro_btn.innerText = "Run Out";
      wd_ro_btn.onclick = function () {
        $("#WDModal").modal("hide");
        addnb_runbutton(wd_ro_btn.innerText);
      };

      container.appendChild(wd_ro_btn);
      const wd_st_btn = document.createElement("button");
      wd_st_btn.className = "btn btn-outline-danger m-1";
      wd_st_btn.innerText = "St";

      wd_st_btn.onclick = function () {
        $("#WDModal").modal("hide");

        add_st_wk(wd_st_btn.innerText);
      };
      container.appendChild(wd_st_btn);

      console.log("WD Buttun Click huwa");
    }

    function addWDRun(i) {
      $("#WDModal").modal("hide");
      let runText = i;
      let batsman = currentStriker;

      console.log("i=", i);

      console.log("currentStriker=", currentStriker);

      console.log("1.i=", i);

      console.log("237.1 currentStriker_new", currentStriker_new);

      addRow(runText, $scope.mtch_inining, "", currentStriker_new);
    }

    //*************************** W click karane par ******************************************************* */

    function createWButtons() {
      console.log("W click huwa hai");

      const container = document.getElementById("WRunButtons");
      container.innerHTML = ""; // pehle se existing buttons hata do
      const wicketTypes = ["C", "St", "B", "Lbw", "Hit wk", "Run out"];

      wicketTypes.forEach(function (type) {
        const btn = document.createElement("button");
        btn.className = "btn btn-outline-danger m-1";
        btn.innerText = type;
        btn.onclick = function () {
          wicktype = type;

          if (type == "Run out") {
            ROinfo_G = "W";
            console.log(" 206 W me Run out click kiya");
            addnb_runbutton(wicktype);
            console.log("wicktype", wicktype);
          } else if (type == "C") {
            console.log(" 208 W me C click kiya");
            add_cbutton_wk();
          } else if (type === "B" || type === "Lbw" || type === "Hit wk") {
            console.log(" 212 W me B,Lbw,Hit wk click kiya" + wicktype + type);
            add_bowlername_wk(wicktype);
          } else if (type === "St") {
            W_St_G = "W_St";
            console.log(" 206 W me St click kiya");
            add_st_wk(type);
          } else {
            addWrun(type);
          }
        };
        container.appendChild(btn);
      });
    }

    function addWrun(run) {
      $("#WModal").modal("hide");
      let ballDisplay = ballNumber;
      let batsman = currentStriker;

      addRow(ballDisplay, runText, batsman);

      if (run % 2 === 1) {
        swapStrike();
      }

      if (["Run out", "C", "St", "W", "Lbw", "Hit wk"].includes(run)) {
        swapStrike();
      }

      ballNumber = ballNumber + 1;
    }

    function addnb_runbutton(wicktype_wd) {
      console.log("Run out click huwa hai =", wicktype_wd);
      $("#nbModal").modal("hide");
      $("#WModal").modal("hide");
      $("#nboutModal").modal("show");
      const container = document.getElementById("nboutButtons");
      container.innerHTML = "";

      for (let i = 0; i <= 4; i++) {
        const btn = document.createElement("button");
        btn.className = "btn btn-outline-primary m-1";
        btn.innerText = i;

        btn.onclick = function () {
          any_run_out_(i, wicktype_wd);
        };
        container.appendChild(btn);
      }
    }

    // function add_cbutton_wk() {
    //   $("#WModal").modal("hide");
    //   console.log("366 wi= ", wicktype);

    //   $scope.$apply(function () {
    //     $scope.showStrikeSelect = "no";
    //   });

    //   $("#NBout_Filder_select_Modal").modal("show");
    //   if (wicktype == "C") {
    //     $scope.out_batsman = currentStriker;
    //   }
    //   run = "0";
    // }

    //***************************** B, Lbw , Hit wk out hone par ******************************* */

    function add_bowlername_wk(wicktype) {
      $("#WModal").modal("hide");

      if (wicktype == "B" || wicktype == "Lbw" || wicktype == "Hit wk") {
        // alert("300 currentStriker" + currentStriker);
        // alert("300 currentStriker_new" + currentStriker_new);

        $scope.out_batsman = currentStriker;

        $scope.$apply(function () {
          // alert("300  currentBowler_new"+currentBowler_new)
          // alert("300  $scope.bowler.pl_slug" + $scope.bowler.pl_slug);
          // $scope.wicket_by = currentBowler_new;
          $scope.wicket_by = $scope.bowler.pl_slug;
          // alert("300 $scope.wicket_by" + $scope.wicket_by);
        });

        $scope.$apply(function () {
          $scope.disable_Select = "true";
        });

        // $scope.wicket_by = $scope.bowler.pl_slug;

        // $scope.wicket_by = $scope.bowler.item_pl_checked;
        // alert("ppppppp")

        console.log("310 =", $scope.wicket_by_p);

        console.log("307 =", currentStriker);
        console.log("334 =", $scope.wicket_by);
        // console.log("335 =", $scope.bowler.pl_slug);
        console.log("338 =", $scope.bowler.item_pl_checked);

        $scope.$apply(function () {
          $scope.showStrikeSelect = "no";
        });

        $("#NBout_Filder_select_Modal").modal("show");

        // $scope.$apply(function () {
        //   $scope.lbw_bowler_disable = "true";
        // });

        $scope.$apply(function () {
          $scope.who_pl_out = "true";
        });

        run = "0";
      }

      // angular ko force update karao
      $scope.$apply();
    }

    // function add_st_wk(wicktype_b) {
    //   // console.log("modal open huwa");

    //   $("#WModal").modal("hide");

    //   $scope.$apply(function () {
    //     $scope.showStrikeSelect = "no";
    //   });

    //   console.log("modal open huwa");

    //   $("#NBout_Filder_select_Modal").modal("show");

    //   $scope.$apply(function () {
    //     $scope.out_batsman = currentStriker;
    //   });

    //   $scope.$apply(function () {
    //     $scope.who_pl_out = "true";
    //   });

    //   $scope.$apply(function () {
    //     $scope.lbw_bowler_disable = "false";
    //   });

    //   console.log("5 modal open huwa", $scope.out_batsman);

    //   if (wicktype_b == "St") {
    //     // $scope.out_batsman = currentStriker;
    //   }

    //   if (exta_ball == "WD") {
    //     ballNumber = exta_ball;
    //     run = "1";
    //     wicktype = wicktype_b;
    //   } else {
    //     run = "1";
    //     wicktype = wicktype_b;
    //   }
    // }

    function add_st_wk(wicktype_b) {
      console.log("367  Modal open huwa");

      $("#WModal").modal("hide");

      $scope.$apply(function () {
        $scope.showStrikeSelect = "no";
      });

      $scope.$apply(function () {
        $scope.disable_Select = "false";
      });

      $scope.$apply(function () {
        // alert("300  $scope.bowler.pl_slug" + $scope.bowler.pl_slug);
        $scope.wicket_by = "";
      });

      // $scope.$apply(function () {
      //   $scope.who_pl_out = "yes";
      // });

      //  $scope.out_batsman = currentStriker;

      console.log("379 Modal open huwa");

      $("#NBout_Filder_select_Modal").modal("show");

      console.log("Modal open huwa");

      // alert("300  currentStriker" + currentStriker);
      // alert("300  currentBowler_new" + currentBowler_new);

      $scope.$apply(function () {
        $scope.out_batsman = currentStriker;
      });

      $scope.$apply(function () {
        $scope.who_pl_out = "true";
      });

      $scope.$apply(function () {
        $scope.lbw_bowler_disable = "false";
      });

      console.log("Modal open huwa", $scope.out_batsman);

      if (exta_ball == "WD") {
        ballNumber = exta_ball;
        run = "1";
        wicktype = wicktype_b;
      } else if (wicktype_b == "St") {
        // $scope.out_batsman = currentStriker;
      } else if (W_St_G === "W_St") {
        run = "0";
        wicktype = "St";
      } else {
        run = "1";
        wicktype = wicktype_b;
      }
    }

    //********************************************************************************************** */

    function any_run_out_(i, wicktype_wd) {
      console.log(
        "400 $scope.showStrikeSelect ",
        $scope.showStrikeSelect,
        "ROinfo_G ",
        ROinfo_G
      );

      if (ROinfo_G === "W") {
        run = i;
        wicktype = wicktype_wd;

        // Force Angular digest
        $scope.$apply(function () {
          $scope.disable_Select = "";
        });

        $scope.$apply(function () {
          $scope.showStrikeSelect = "yes"; // New player strike lega ki Nonstrike wo select option show rhe
        });

        $scope.$apply(function () {
          $scope.who_pl_out = "false"; // Kaun player out huwa hai, wala select enable rhe, disable nhi
        });

        $scope.$apply(function () {
          $scope.lbw_bowler_disable = "false"; // lbw,hitwk, ke samy option disable, par run out ke samay enable rhega , kisane out kiya hai usaka hai
        });

        console.log("472 $scope.showStrikeSelect", $scope.showStrikeSelect);
      } else if (exta_ball === "NB" || exta_ball === "WD") {
        run = i + 1;
        ballNumber = exta_ball;
        wicktype = wicktype_wd;

        $scope.$apply(function () {
          $scope.showStrikeSelect = "yes";
        });

        $scope.$apply(function () {
          $scope.who_pl_out = "false";
        });

        $scope.$apply(function () {
          $scope.lbw_bowler_disable = "false";
        });
      }

      $("#nboutModal").modal("hide");

      console.log(
        "401 $scope.showStrikeSelect ",
        $scope.showStrikeSelect,
        "ROinfo_G ",
        ROinfo_G
      );

      $("#NBout_Filder_select_Modal").modal("show");

      console.log(
        "402 $scope.showStrikeSelect ",
        $scope.showStrikeSelect,
        "ROinfo_G ",
        ROinfo_G
      );
    }

    function add_cbutton_wk() {
      $("#WModal").modal("hide");

      if (wicktype == "C") {
        // alert("515 currentStriker" + currentStriker);
        // alert("515 currentStriker_new" + currentStriker_new);

        $scope.out_batsman = currentStriker;

        $scope.$apply(function () {
          $scope.showStrikeSelect = "no";
        });

        $scope.$apply(function () {
          $scope.disable_Select = "false";
        });

        $scope.$apply(function () {
          // alert("300  $scope.bowler.pl_slug" + $scope.bowler.pl_slug);
          $scope.wicket_by = "";
        });

        console.log("366 Modal open huwa");

        $("#NBout_Filder_select_Modal").modal("show");

        $scope.$apply(function () {
          $scope.who_pl_out = "true";
        });

        $scope.$apply(function () {
          $scope.lbw_bowler_disable = "false";
        });

        console.log("366 Modal open huwa", $scope.who_pl_out);
      }

      run = "0";
    }

    // function add_cbutton_wk() {
    //   $("#WModal").modal("hide");
    //   console.log("366 wi= ", wicktype);

    //   $scope.$apply(function () {
    //     $scope.showStrikeSelect = "no";
    //   });

    //   $("#NBout_Filder_select_Modal").modal("show");
    //   if (wicktype == "C") {
    //     $scope.out_batsman = currentStriker;
    //   }
    //   run = "0";
    // }

    //******************************************************************************************************/

    function swapStrike() {
      let temp = currentStriker;
      currentStriker = currentNonStriker;
      currentNonStriker = temp;
    }

    function processNormalRun(run, mtch_inining_ng) {
      console.log("mtch_inining_ng", mtch_inining_ng);

      let ballDisplay = ballNumber; // undefine jab wd ke baad normal aaye
      console.log("578 ballNumber", ballNumber);

      $scope.batsman = currentStriker;

      addRow(run, mtch_inining_ng, ballDisplay, $scope.batsman);
    }

    //*****************************************************************************

    $scope.ball_over_fetch = function () {
      // DB se cuurent,mtch over la rha hai

      $http
        .get(
          ApiUrl +
            "api_signin.php?action=ball_over_fetch&mtch_slug=" +
            $scope.mt_slug
        )
        .then(function (response) {
          let data = response.data;
          if (
            data == "null" ||
            data == undefined ||
            data == "Invalid request" ||
            data == "Error"
          ) {
            $scope.ball_over_data = "";
          } else {
            $scope.ball_over_data = data;

            //  ball value ko store karo
            ballNumber = parseInt(data.ball); //pahle ye uncomment tha
            // ballNumber = data.ball;

            current_over = data.current_over;
            mtch_inining_new = data.mtch_inining;

            mtch_over = data.mtch_over;
            console.log("546 mtch_over", mtch_over);

            $scope.mtch_over_low = mtch_over - 1;
            // alert("667733 ==="+ballNumber+current_over+mtch_over+mtch_inining_new)

            if (
              ballNumber >= 1 &&
              ballNumber <= 6 &&
              current_over >= mtch_over - 1 &&
              mtch_inining_new >= 2
            ) {
              $scope.hide_add_btn = true; // isse button hide ho jayega
              // alert("ppppppp  band kar")
            }

            // $scope.fetch_toss();
          }
        })
        .catch(function (error) {
          console.error(" API error:", error);
        });
    };
    $scope.ball_over_fetch();

    function over_view_table(
      view_table_ball,
      view_table_run,
      view_table_batsman
    ) {
      //  console.log("Ball :",view_table_ball,"view_table_run :",view_table_run,"view_table_batsman :",view_table_batsman);
      const table = document.getElementById("scoreTable");
      const row = table.insertRow(-1);

      const cellBall = row.insertCell(0);
      const cellRun = row.insertCell(1);
      const cellBatsman = row.insertCell(2);

      cellBall.innerText = view_table_ball;
      cellRun.innerText = view_table_run;
      cellBatsman.innerText = view_table_batsman;
    }

    function addRow(run, mtch_inining_ng, ball, battsman) {
      console.log("666 ball", ball);
      // alert("666 exta_ball=====" + exta_ball);

      // const table = document.getElementById("scoreTable");
      // const row = table.insertRow(-1);

      // const cellBall = row.insertCell(0);
      // const cellRun = row.insertCell(1);
      // const cellBatsman = row.insertCell(2);
      // console.log("634 skip_ext_ball",$scope.skip_ext_bal);
      // console.log("634 view_table_ball",view_table_ball);

      // cellBall.innerText = view_table_ball;
      // cellRun.innerText = run;
      // cellBatsman.innerText = currentStriker_name;

      // console.log("641 exta_ball", exta_ball);
      //  console.log("1032 ",$scope.start_ball);

      if (exta_ball == "NB" || exta_ball == "WD") {
        run++;
        ball = exta_ball;
        ballNumber = "";

        console.log("589 ballNumber-== ", ballNumber);
        console.log("628 battsman", battsman);
        alert("ball=" + ball + "ballNumber" + ballNumber);

        $scope.row_data_send(
          run,
          mtch_inining_ng,
          ball,
          battsman,
          current_over
        );
        exta_ball = "";
      } else {
        $scope.row_data_send(
          run,
          mtch_inining_ng,
          ball,
          battsman,
          current_over
        );
      }
    }

    $scope.row_data_send = function (
      run,
      mtch_inining_ng,
      ball,
      battsman,
      current_over
    ) {
      console.log("613 mtch_inining_ng", mtch_inining_ng);

      console.log(
        "1075.01 row_data_send ball=" +
          ball +
          "_run_" +
          run +
          "battsman=" +
          battsman +
          " = " +
          currentStriker_new +
          "=_bowler==" +
          currentBowler_new +
          "_current_over=" +
          current_over +
          "$scope.mtch_inining=" +
          $scope.mtch_inining +
          "_mt_slug=" +
          mt_slug +
          "=" +
          "_wicktype=" +
          wicktype +
          "mtch_over===" +
          mtch_over
      );

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          ball: ball,
          run: run,
          batsman: currentStriker_new,
          mt_slug: mt_slug,
          bowler: currentBowler_new, // currentBowler_new ng-model se aaya hai, past=
          current_over: current_over,
          // mtch_inining: $scope.mtch_inining,
          mtch_inining: mtch_inining_ng,
          mtch_over: mtch_over,
          action: "every_ball_data_send",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        console.log("737 SUcess aaya ");

        if (data.errors) {
          $scope.message = "API Error";
        } else {
          $scope.message = data.scalar;

          if ($scope.message == "Success") {
            // alert(" Match Khatam Huwa 2")
            // $scope.hideAddBtn = true; // isse button hide ho jayega
          } else if ($scope.message == "complete") {
            // alert(" Match Khatam Huwa 1");
            $scope.hide_add_btn = true; // isse button hide ho jayega
          } else {
            alert($scope.message);
            alert(" Match Khatam Huwa 3");
          }
        }

        console.log("738 SUcess aaya ");

        // $scope.fetch_inning_info();
        $scope.fetch_batsman_run();
        console.log("739 SUcess aaya ");

        if (ball >= "6") {
          checkOverComplete();
        }

        if (ball >= "6") {
          $scope.fetch_inning_info(ball);
        }

        $scope.skip_extra_ball(ball, run); // Ever Ball Over Increment and last ball 6 then convert 1

        console.log("740 SUcess aaya ");

        // $scope.fetch_inning_info();

        exta_ball = "";
        ROinfo_G = "";

        console.log("760 ball", ball);

        // if (ball >= "6") {
        //   $scope.fetch_inning_info(ball);
        // }
      });
    };

    $scope.update_striker_val = function (slug, st_slug, non_stslug) {
      // yaha check karate hai ki, Striker Or NonStriker OUT huwa
      // alert("s "+slug+ " ss "+st_slug+ " sss "+non_stslug);
      $scope.st_val = "";
      if (slug == st_slug) {
        $scope.st_val = "St_out";
      } else if (slug == non_stslug) {
        $scope.st_val = "nonSt_out";
      }
    };

    $scope.send_wicket_detail = function (
      wicket_by,
      out_batsman,
      neww_batsman,
      stker_non_striker,
      st_val
    ) {
      console.log(
        "695 stker_non_striker= " +
          stker_non_striker +
          out_batsman +
          " st_val= " +
          st_val +
          " run= ",
        run + " ROinfo_G= ",
        ROinfo_G + " ballNumber=",
        ballNumber
      );

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          wicket_by: wicket_by,
          out_batsman: out_batsman,
          neww_batsman: neww_batsman,
          wicktype: wicktype, // global ko derect acces kar rha hu .// Run out
          ballNumber: ballNumber,
          run: run,
          // batsman:currentStriker,
          batsman: $rootScope.selected_stricker.selected.pl_slug,

          mt_slug: mt_slug,
          bowler: $rootScope.selected_bowler.selected.pl_slug,
          current_over: current_over,

          mtch_inining: $scope.mtch_inining,
          bowling_team_updt: $scope.bowling_team,
          non_striker_updt: $rootScope.selected_non_stricker.selected.pl_slug,
          batting_team_updt: $scope.batting_team,
          selected_toss_updt: $scope.selected_toss,
          stker_non_striker: stker_non_striker,
          st_val: st_val,
          action: "send_wicket_detail",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = "API Error";
        } else {
          // alert("data.scalar==",data.scalar)
          $scope.message = data.scalar;
          if ($scope.message == "Success") {
            $scope.out_batsman = "";
            $scope.neww_batsman = "";
            $scope.stker_non_striker = "";
            // let temp = currentStriker_new;

            currentStriker_new = neww_batsman;
            // currentNonStriker_new = temp;
            exta_ball = "";
            ROinfo_G = "";

            if (ball >= 6 || ballNumber >= 6) {
              // pahle ye niche me likha hota tha, Call commment wale me
              checkOverComplete();
            }

            ballNumber++;
            $scope.skip_extra_ball();
            $scope.select_batting();
            $scope.fetch_Notout_pl($scope.batting_team);
            $scope.fetch_batsman_run();
            console.log("828 $scope.wicket_by", $scope.wicket_by);
            $("#NBout_Filder_select_Modal").modal("hide");
            console.log("840 ballNumber", ballNumber);
            console.log("840 ballNumber", ballNumber);
            check_inining_end();
            //  alert("BBBBBBBBBBBBBBB")

            // if (ball >= 6 || ballNumber >=6 ) {
            //   checkOverComplete();
            // }
          } else {
            alert($scope.message);
          }
        }
      });
    };

    $scope.fetch_toss = function () {
      $http
        .get(
          ApiUrl + "api_signin.php?action=fetch_toss_win&toss_slug=" + toss_slug
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

            // alert("======"+$scope.batting_teamss+$scope.bowling_teamss)
          }
        });
    };
    $scope.fetch_toss();

    $scope.Chasing_Team_all_pl = function (pll) {
      let teamA = $scope.toss[0].team_name_a;
      let teamB = $scope.toss[1].team_name_a;

      console.log("755 teamA=", teamA, "teamB=", teamB);
      console.log("755 $scope.batting_team5", $scope.batting_team);
      console.log("755 pll= ", pll);

      if ($scope.batting_team == teamA) {
        $scope.bowling_team = teamB;
        // console.log("756 bowling_team", $scope.bowling_team); // BB // AA
      } else if ($scope.batting_team == teamB) {
        $scope.bowling_team = teamA;
        // console.log("757 bowling_team", $scope.bowling_team); //BB //
      }
      // console.log("758 $scope.bowling_team", $scope.bowling_team);
      // console.log("758 $scope.batting_team ", $scope.batting_team);
      $scope.fetch_bowling_team($scope.bowling_team); // yaha se bowling ke liye bhej rha hu, BB ke liye
    };

    $scope.fetch_bowling_team = function (bowling_) {
      // console.log("778 bowling_GO DB=", bowling_, toss_slug);
      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_bowling_team&team=" +
            bowling_ +
            "&slug=" +
            toss_slug
        )
        .then(function (response) {
          $scope.bowling_players = response.data;
          // console.log("llllllllllllllllllllllllllllllllllllll" +JSON.stringify(response.data));
        });
    };

    $("#inining_id").hide();
    $scope.fetch_inning_info = function () {
      // alert("$scope.fetch_inning_info me swagat hai")
      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_inning_info&mtch_slug=" +
            mt_slug
        )

        .success(function (inning) {
          if (
            inning == "null" ||
            inning == undefined ||
            inning == "Invalid request" ||
            inning == "Error"
          ) {
            $scope.inning = "";
            $("#inining_id").show();
          } else {
            $("#inining_id").hide();
            $scope.hideAddBtn = false; // button visible rahega hide_add_btn dalana hai isme isko dalane par match ining two ke baad buttun enable rakha deta hai ye

            $scope.inning = inning;

            $scope.selected_toss = inning.toss_win;
            $scope.batting_team = inning.batting_team;
            $scope.batts = inning.batting_team;

            if ($scope.inning) {
              $scope.striker = inning.striker;
              currentStriker = inning.striker;

              // $scope.striker = inning.striker;

              $scope.non_striker = inning.non_striker;
              currentNonStriker = inning.non_striker;

              $rootScope.selected_non_stricker.selected = inning.non_st;
              currentNonStriker =
                $rootScope.selected_non_stricker.selected.pl_slug;
              //  currentNonStriker = inning.non_st;

              $rootScope.selected_stricker.selected = inning.st;
              currentStriker = $rootScope.selected_stricker.selected.pl_slug;
              //  currentStriker = inning.st;

              $rootScope.selected_bowler.selected = inning.bowler;

              if ($scope.striker == "" || $scope.non_striker == "") {
                $("#inining_id").show();
              }

              $scope.bowler = inning.bowler;
              console.log("921 $scope.bowler", $scope.bowler.pl_slug);

              $scope.mtch_inining = parseInt(inning.in_ining);

              if (
                $scope.selected_toss == "" ||
                $scope.batting_team == "" ||
                $scope.striker == "" ||
                $scope.non_striker == "" ||
                $scope.mtch_inining == "" ||
                $scope.bowler == ""
              ) {
                $scope.inining_disable = false;
                $scope.isStrikerDisabled = false;
              } else {
                $scope.inining_disable = true;
                $scope.isStrikerDisabled = true;
              }

              if (
                $scope.selected_toss == "" ||
                $scope.batting_team == "" ||
                $scope.mtch_inining == ""
              ) {
                $scope.inining_disable = false;
                //  $scope.isStrikerDisabled = false;
              } else {
                $scope.inining_disable = true;
                //  $scope.isStrikerDisabled = true;
              }
            }
          }
        });
    };
    $scope.fetch_inning_info();

    $scope.fetch_inning_zero_leval = function () {
      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_inning_zero_leval&mtch_slug=" +
            mt_slug
        )
        .success(function (inning) {
          if (
            inning == "null" ||
            inning == undefined ||
            inning == "Invalid request" ||
            inning == "Error"
          ) {
            $scope.inning = "";
          } else {
            $scope.inning = inning;
            $scope.selected_toss = inning.toss_win;
            $scope.batting_team = inning.batting_team;
            $scope.mtch_inining = inning.in_ining;

            $scope.select_batting($scope.batting_team);
          }
        });
    };
    $scope.fetch_inning_zero_leval();

    $scope.select_batting = function () {
      console.log("884 $scope.batting_team", $scope.batting_team);

      if ($scope.batting_team) {
        let batting_temp = $scope.batting_team;
        $http
          .get(
            ApiUrl +
              "api_signin.php?action=select_batting_call&team=" +
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

            $scope.Chasing_Team_all_pl($scope.batting_team); /// is Argument se batting bowling ka sahi data fetch hokar aata hai

            $scope.fetch_Notout_pl($scope.batting_team);

            $scope.fetch_batsman_run();
            $scope.fetch_inning_info();
            // $scope.fetch_bowling_team();
          });
      }
    };

    // $scope.select_batting();  // pahle call ho rha tha.

    $scope.fetch_batsman_run = function () {
      // console.log("906 mtch_inining", $scope.mtch_inining);
      // console.log("906 mtch_inining_new", mtch_inining_new);

      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_batsman_run&mtch_slug=" +
            mt_slug +
            "&mtch_inining=" +
            $scope.mtch_inining
        )

        .then(function (response) {
          $scope.batsman = response.data;
          // $scope.start_ball = response.ball;

          // console.log("1032 ",$scope.start_ball);
        });
    };

    // $scope.fetch_team_run = function () {
    //   console.log("906 mtch_inining", $scope.mtch_inining); //1

    //   $http
    //     .get(
    //       ApiUrl +
    //         "api_signin.php?action=fetch_team_run&mtch_slug=" +
    //         mt_slug +
    //         "&mtch_inining=" +
    //         $scope.mtch_inining
    //     )

    //     .then(function (response) {
    //       $scope.team_run = response.data;
    //       console.log("1027 $scope.team_run",$scope.team_run);

    //     });
    // };

    $scope.fetch_team_run = function () {
      console.log("11 Fetching team run for inning:", $scope.mtch_inining);

      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_team_run" +
            "&mtch_slug=" +
            mt_slug +
            "&mtch_inining=" +
            $scope.mtch_inining
        )
        .then(function (response) {
          console.log("Team Run API Response:", response.data);

          // API se { total_run: 45 } milega
          $scope.team_run = response.data.total_run || 0;

          console.log("Team Total Run:", $scope.team_run);
        });
    };

    // Initial load par call
    $scope.fetch_team_run();

    // $scope.fetch_totle_mtch_run = function () {

    //    console.log("906 mtch_inining",$scope.mtch_inining); //1

    //     $http.get(ApiUrl +"api_signin.php?action=fetch_totle_mtch_run&mtch_slug=" + mt_slug + "&mtch_inining=" +$scope.mtch_inining)

    //       .then(function (response) {

    //         $scope.totle_mtch_runs = response.data;
    //         console.log("946 $scope.totle_mtch_runs",$scope.totle_mtch_runs);

    //       });

    // };
    // $scope.fetch_totle_mtch_run();

    $scope.fetch_Notout_pl = function (batter_n) {
      // console.log("925 batting_team",$scope.batting_team );
      console.log("925 $scope.bowling_team", $scope.bowling_team);
      console.log("925 batting_team GO DB=", batter_n);

      $http
        .get(
          ApiUrl +
            "api_signin.php?action=fetch_Notout_pl&mtch_slug=" +
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

    $scope.skip_extra_ball = function (ball_ex, run_ex) {
      // DB ka NB,WD ko skip kar valid ball lane wala function.

      console.log("1020 ball_ex", ball_ex);
      console.log("1020 ballnumber", ballNumber);
      console.log("1020 run_ex", run_ex);
      $http
        .get(
          ApiUrl + "api_signin.php?action=skip_extra_ball&mtch_slug=" + mt_slug
        )

        .success(function (extra) {
          if (
            extra == "null" ||
            extra == undefined ||
            extra == "Invalid request" ||
            extra == "Error"
          ) {
            $scope.extra = "";
          } else if (ballNumber >= 7) {
            console.log("828 ballnumber", ballNumber);
            $scope.reset_extra_ball = extra.ball;

            console.log(
              "829 jab ballNumber 6 || 6+ huwa tab ball 1 ho jaye=",
              ballNumber
            );

            // $scope.reset_extra_ball = extra.ball;

            console.log(
              "830 DB se nhi aaya pahle ka hai =",
              $scope.reset_extra_ball
            );

            console.log("831 current over=", current_over);

            $scope.reset_extra_ball = 1;
            current_over++;

            console.log("832 inning++ befor ", $scope.mtch_inining);
            alert("832.1 current over=", current_over);
            console.log(
              "835 over complete hone ke karan $scope.reset_extra_ball ko 1 kiya=",
              $scope.reset_extra_ball
            );
            console.log("836 ballNumber", ballNumber);
          } else if (
            (ball_ex == "WD" || ball_ex == "NB") &&
            (run_ex == 2 || run_ex == 4 || run_ex == 6)
          ) {
            console.log("1103 ball = ", ball_ex);
            $scope.ining_st_nst_updt();
          } else if (
            ballNumber == "NB" ||
            ballNumber == "WD" ||
            ballNumber == NaN
          ) {
            console.log(
              "884 NB/WD aaya hai ballNumber-- niche kiya hu",
              ballNumber
            );
            console.log(
              "884.0 $scope.reset_extra_ball-- ke baad",
              $scope.reset_extra_ball
            );

            $scope.reset_extra_ball = extra.ball;
            $scope.reset_extra_ball++;

            console.log(
              "884.1 $scope.reset_extra_ball-- ke baad",
              $scope.reset_extra_ball
            );
            console.log("885 ballNumber-- ke baad", ballNumber);
          } else {
            console.log("1077 Normal Runs liya hai");
            $scope.reset_extra_ball = extra.ball;
            db_skip_ball = extra.ball;
            $scope.db_skipp_baall = extra.ball;
            // alert("db_skip_ball =" + db_skip_ball);

            check_db_run = extra.run; //check_db_run variable for check odd ball

            if (check_db_run == 1 || check_db_run == 3 || check_db_run == 5) {
              // DB se Ye Run aane par Swap hoga
              console.log("nurmall ball me hi call hoga");
              $scope.ining_st_nst_updt();
            }

            if ($scope.reset_extra_ball == 6) {
              console.log(
                "jab reset_extra_ball 6 aaye tab 1 hoga",
                $scope.reset_extra_ball
              );

              $scope.reset_extra_ball = 1;
              current_over++;

              // alert("2 current_over" + current_over);
            } else if (
              $scope.reset_extra_ball == 1 ||
              $scope.reset_extra_ball == 0
            ) {
              $scope.reset_extra_ball++;
            }

            // if($scope.reset_extra_ball<=5){
            else if (
              $scope.reset_extra_ball >= 2 &&
              $scope.reset_extra_ball <= 5
            ) {
              $scope.reset_extra_ball++;
            }
          }

          if ($scope.mtch_inining == 2) {
            $scope.row_data_fetch_innings_two($scope.reset_extra_ball);
          } else if ($scope.mtch_inining == 1) {
            $scope.row_data_fetch($scope.reset_extra_ball);
          }
        });
    };
    $scope.skip_extra_ball();

    $scope.row_data_fetch = function (New_Reset_Ball) {
      $http
        .get(
          ApiUrl +
            "api_signin.php?action=row_data_fetch&mtch_slug=" +
            $scope.mt_slug
        )
        .success(function (balldata) {
          if (
            !balldata ||
            balldata == "Invalid request" ||
            balldata == "Error"
          ) {
            console.warn(" No valid data received from API");
            $scope.balldata = [];
            $scope.groupedData = {};
          } else {
            db_ball_temp = balldata[0].ball;
            skip_ext_ball = balldata[0].ball;
            view_table_ball = balldata[0].ball;
            view_table_run = balldata[0].run;
            view_table_batsman = balldata[0].batsman;

            // alert("db_ball_temp=="+db_ball_temp)

            over_view_table(
              view_table_ball,
              view_table_run,
              view_table_batsman
            );
            console.log(
              "Ball :",
              view_table_ball,
              "view_table_run :",
              view_table_run,
              "view_table_batsman :",
              view_table_batsman
            );

            // over_view_table();
            ballNumber = New_Reset_Ball;
            console.log(" 1322 ballNumber", ballNumber);
            let grouped = {};

            if (balldata) {
              $scope.balldata = balldata;
            }

            // View me dikhane ke liye grouped data set karna
            $scope.groupedData = grouped;

            console.log("1331 current_over", current_over);
            console.log("1331 mtch_over", mtch_over);
            console.log("1331 ballNumber", ballNumber); // 1 aata hai, jab 6 ball hota hai
            console.log("1331 db_skip_ball", db_skip_ball);

            if (current_over >= mtch_over - 1 && db_skip_ball == "6") {
              // 6/11/25
              // alert("call huwa.............")
              check_inining_end(ballNumber);
            }

            if (current_over >= mtch_over - 1 && db_ball_temp == "6") {
              // alert("call huwa.............")
              check_inining_end(ballNumber);
            }

            $scope.fetch_team_run();
          }
        })
        .error(function (err) {
          console.error(" API error:", err);
        });

      $scope.reset_extra_ball = ""; // pahle upar ke else me tha ye
    };
    $scope.row_data_fetch();

    $scope.row_data_fetch_innings_two = function (New_Reset_Ball) {
      // API se match ka poora ball-by-ball data fetch karna
      $http
        .get(
          ApiUrl +
            "api_signin.php?action=row_data_fetch_innings_two&mtch_slug=" +
            $scope.mt_slug
        )
        .success(function (ball_data) {
          // Agar data empty ya error hai

          if (
            !ball_data ||
            ball_data == "Invalid request" ||
            ball_data == "Error"
          ) {
            console.warn(" No valid data received from API");
            $scope.ball_data = [];
            $scope.groupedData = {};
          } else {
            skip_ext_ball = ball_data[0].ball;
            // view_table_ball = ball_data[0].ball;
            ballNumber = New_Reset_Ball;

            view_table_ball_ining_two = ball_data[0].ball;
            view_table_batsman_ining_two = ball_data[0].batsman;
            view_table_run_ining_two = ball_data[0].run;

            over_view_table(
              view_table_ball_ining_two,
              view_table_run_ining_two,
              view_table_batsman_ining_two
            );

            let grouped = {};

            if (ball_data) {
              $scope.ball_data = ball_data;
            }
            // console.log(" Grouped data:", grouped); // Final grouped structure
            // View me dikhane ke liye grouped data set karna
            $scope.groupedData = grouped;

            console.log("1128 current_over", current_over);
            console.log("1128.1 mtch_over", mtch_over);
            console.log("1128.1 skip_ext_ball", skip_ext_ball);

            $scope.fetch_team_run();

            if (current_over >= mtch_over - 1 && skip_ext_ball == "6") {
              // 3
              check_inining_end(skip_ext_ball);
            }
          }
        })
        .error(function (err) {
          console.error(" API error:", err);
        });

      $scope.reset_extra_ball = "";
    };
    $scope.row_data_fetch_innings_two();

    $scope.Done_inning_info = function (
      selected_toss,
      batting_team,
      striker,
      non_striker,
      bowler,
      mtch_inining
    ) {
      if (!$scope.selected_toss) {
        alert("Please Select Toss Win Team");
        return;
      } else if (!$scope.batting_team) {
        alert("Please Select Batting Team");
        return;
      } else if (!$scope.mtch_inining) {
        alert("Please Select Match Inining");
        return;
      } else if (!$rootScope.selected_stricker.selected) {
        alert("Please Select Striker");
        return;
      } else if (!$rootScope.selected_non_stricker.selected) {
        alert("Please select Non Striker");
        return;
      } else if (!$rootScope.selected_bowler.selected) {
        alert("Please Select Bowler");
        return;
      }

      if (selected_toss) {
        // $scope.inining_disable = true; //inning fist row disable
      }
      console.log("1232 mtch_inining", mtch_inining);

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          selected_toss: selected_toss,
          batting_team: batting_team,
          striker: striker,
          non_striker: non_striker,
          bowler: bowler,
          mt_slug: $scope.mt_slug,
          bowling_team: $scope.bowling_team,
          mtch_inining: mtch_inining,
          action: "Done_inning_info",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = "API Error";
        } else {

          $scope.hide_add_btn = false; // button visible rahega

          $scope.message = data.scalar;

          if ($scope.selected_toss) {
            $scope.inining_disable = true;
          }

          // $scope.doneClicked = function() {
          $scope.isStrikerDisabled = true;

          console.log("Striker select disabled after done button click");
          // };

          // $scope.inining_disable = true; //inning fist row disable
          // alert("Save Inning Data");
          // $scope.showAddButton = true;
        }
      });
    };

    $scope.send_next_bowler = function (next_bowler) {
      console.log("1232 next_bowler", next_bowler, mt_slug);

      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          next_bowler: next_bowler,
          mtc_slug: mt_slug,
          action: "send_next_bowler",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = "API Error";
        } else {
          $scope.message = data.scalar;
          $("#who_next_bowler_Modal").modal("hide");
          // alert("Save next bowler")
          $scope.fetch_inning_info();
          $("#who_next_bowler_Modal").modal("hide");
        }
      });
    };

    function checkOverComplete() {
      console.log("1433.1 ballNumber", ballNumber);

      if (ballNumber >= 6) {
        $scope.ining_st_nst_updt();
        $scope.Chasing_Team_all_pl();
        mtch_over--;

        if (current_over >= mtch_over) {
          // Current over match Over ke Equal hone par Bowler select Modal nhi aata Hai
          $("#who_next_bowler_Modal").modal("hide");
          mtch_over++;
        } else {
          // alert("oooooooooo="+$scope.bowler.pl_slug)
          $("#who_next_bowler_Modal").modal("show");

          mtch_over++;
          // console.log("1436.2 mtch_over", mtch_over);
          // alert("4");
        }

        $("#scoreTable").empty();
        // alert("5");
      }
    }

    $scope.exclude_non_Striker = function (item) {
      // esame jo item(sabhi player ka slug) se match krega wo hide ho hoga aur jo match nhi krega wo select me jayega
      if (!$scope.selected_stricker.selected) return true;
      return item.pl_slug !== $scope.selected_stricker.selected.pl_slug;
    };

    $scope.exclude_Striker = function (item) {
      // esame jo item(sabhi player ka slug) se match krega wo hide ho hoga aur jo match nhi krega wo select me jayega
      if (!$scope.selected_non_stricker.selected) return true;
      return item.pl_slug !== $scope.selected_non_stricker.selected.pl_slug;
    };

    $scope.exclude_bowler = function (item) {
      if (!$scope.selected_bowler.selected) return true;
      return item.pl_slug !== $scope.selected_bowler.selected.pl_slug;
    };

    function check_inining_end(db_balls) {
      // $scope.skip_extra_ball();

      // alert("SWAGAt HAI " + mtch_over + " = " + current_over);

      // alert("SWAGAt HAI db_balls" + db_balls); // db_ball value row data send inining two se aaya hai
      // alert("SWAGAt db_skip_ball " + db_skip_ball);

      console.log("1233 current_over", current_over);
      console.log("1233 mtch_over", mtch_over);
      console.log("1233 $scope.mtch_inining", $scope.mtch_inining);
      console.log("1233.1 ball", ball);
      console.log("1233.1 ballNumber", ballNumber);
      console.log("1500 db_skip_ball", db_skip_ball);
      console.log("1500 $scope.db_skipp_baall", $scope.db_skipp_baall);
      console.log("1500 db_ball_temp", db_ball_temp);

      if (
        current_over < mtch_over &&
        mtch_over - current_over == 1 &&
        ballNumber >= 6 &&
        ballNumber <= 7
      ) {
        complete_over = current_over + 1;
      } else {
        complete_over = current_over;
      }

      // alert("1743 tak aaya hu" + complete_over + mtch_over);
      // console("complete_over=",complete_over)
      // console("mtch_over=",mtch_over)

      if (complete_over >= mtch_over) {
        console.log("1600 current_over", current_over);
        console.log("1600 mtch_over", mtch_over);
        console.log("1600 $scope.mtch_inining", $scope.mtch_inining);
        console.log("1600 ballNumber", ballNumber);
        console.log("1600 db_skip_ball", db_skip_ball);
        console.log("1600 $scope.db_skipp_baall", $scope.db_skipp_baall);

        if (
          $scope.mtch_inining == 1 &&
          (db_skip_ball == 6 || db_ball_temp == 6)
        ) {
          $scope.mtch_inining++;
          current_over = 0;
          ballNumber = "1";

          alert(
            "First Inning Complete And " + $scope.mtch_inining + " Inning Start"
          );

          let temp = $scope.batting_team;
          $scope.batting_team = $scope.bowling_team;
          $scope.bowling_team = temp;

          // $scope.select_batting();  // call ng-change then change bowlwe and striker before 2nd inning start
          $scope.striker = ""; // striker blank before start 2nd inning
          $scope.non_striker = ""; // non striker blank before start 2nd inning
          $scope.bowler = ""; // bowler blank before start 2nd inning
          currentNonStriker = "";
          currentStriker = "";
          // $rootScope.selected_stricker.selected.pl_slug = "";
          $rootScope.selected_stricker.selected = "";
          $rootScope.selected_non_stricker.selected = "";
          $rootScope.selected_bowler.selected = {};
          $rootScope.selected_bowler.selected = "";

          $scope.ining_update(
            $scope.mtch_inining,
            $scope.batting_team,
            mt_slug,
            $scope.bowling_team
          );
          $scope.fetch_inning_info();
          $scope.select_batting();
        } else if (
          $scope.mtch_inining >= 2 &&
          db_skip_ball >= "6" &&
          current_over >= mtch_over - 1
        ) {
          // $scope.mtch_inining++;

          alert("- - - - Match Complete - - - -");

          $scope.hide_add_btn = true; // isse button hide ho jayega
          // alert("buttun Hide huwa");
          $scope.mtch_status();

          $scope.hidedoneBtn = true; 

          // $scope.mtch_status();
        }

        // console.log("1241.1 $scope.mtch_inining", $scope.mtch_inining);
        // // console.log("1241.1 $scope.mtch_inining",mtch_inining);

        // if($scope.mtch_inining==2){
        // alert("seccond Inning Complete And " + $scope.mtch_inining + " Inning Start");
        // // alert("Fist Inining Complete And Inining Start");
        // // $scope.showAddButton = false;
        // current_over = 0;
        // ballNumber = "1";
        // // $scope.mtch_inining++;

        // let temp = $scope.batting_team;
        // $scope.batting_team = $scope.bowling_team;
        // $scope.bowling_team = temp;

        // // $scope.select_batting();  // call ng-change then change bowlwe and striker before 2nd inning start
        // $scope.striker = "";       // striker blank before start 2nd inning
        // $scope.non_striker = ""; // non striker blank before start 2nd inning
        // $scope.bowler = "";     // bowler blank before start 2nd inning
        // currentNonStriker = "";
        // currentStriker = "";
        // $rootScope.selected_stricker.selected.pl_slug = "";
        // $rootScope.selected_non_stricker.selected = "";
        // $rootScope.selected_bowler.selected.pl_slug = "";

        // $scope.ining_update($scope.mtch_inining,$scope.batting_team,mt_slug,$scope.bowling_team);
        // $scope.fetch_inning_info();
        // $scope.select_batting();

        // }

        // else{
        //  alert("- - - - Match Complete - - - -");
        // }
      }
    }

    $scope.ining_update = function (m_inining, batt_team, mt_slug, bowl_team) {
      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          m_inining: m_inining,
          batt_team: batt_team,
          mtch_slug: mt_slug,
          bowl_team: bowl_team,
          action: "ining_update",
        },
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }).success(function (data) {
        if (data.errors) {
          $scope.message = "API Error";
        } else {
          $scope.message = data.scalar;
          //  $scope.select_batting();
        }
      });
    };

    function swapStrike_db() {
      console.log("swapStrike_db call huwa");
      console.log("1.1currentStriker_new", currentStriker_new);
      console.log("1.2currentNonStriker_new", currentNonStriker_new);
      let temp = currentStriker_new;
      currentStriker_new = currentNonStriker_new;
      currentNonStriker_new = temp;
      console.log("1.3currentStriker_new", currentStriker_new);
      console.log("1.4currentNonStriker_new", currentNonStriker_new);
    }

    let $status ="complete";

    $scope.mtch_status = function () {
      alert("status845=" + $status);
      $http({
        method: "POST",
        url: ApiUrl + "api_signin.php",
        data: {
          m_status: $status,
          mtt_slug:$scope.mt_slug,
          action: "mtch_status",
        },
      })
      .success(function (data) {
        if (data.errors) {
          $scope.message = "API Error";
        } else {
          $scope.message = data.scalar;
          // alert("Data Gya complter ke liye 2.0");
        
        }
      });

    };

    // $scope.mtch_status();

    $scope.ining_st_nst_updt = function () {
      console.log("1463 currentStriker_new", currentStriker_new);
      console.log("1463 currentNonStriker_new", currentNonStriker_new);

      if (currentStriker_new != "" && currentNonStriker_new != "") {
        console.log("striker Nonstriker Update karata hai har ball me");

        swapStrike_db();

        console.log("1463.1 currentStriker_new", currentStriker_new);
        console.log("1463.1 currentNonStriker_new", currentNonStriker_new);

        $http({
          method: "POST",
          url: ApiUrl + "api_signin.php",
          data: {
            currentStriker_new: currentStriker_new,
            currentNonStriker_new: currentNonStriker_new,
            // currentStriker_new: currentStriker,
            // currentNonStriker_new: currentNonStriker,
            mt_slug: mt_slug,
            action: "ining_st_nst_updt",
          },
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
        }).success(function (data) {
          $scope.fetch_inning_info();
          if (data.errors) {
            $scope.message = "API Error";
          } else {
            $scope.message = data.scalar;
          }
        });
      }
    };



  },
]);
