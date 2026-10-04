tdipllp.controller('addnewplyerjsapicontroller', ['$window', '$scope', '$http', 'Upload', '$timeout', function ($window, $scope, $http, Upload, $timeout) {


// console.log('connnect huwa hai, html se create_new_pl.js');

// .$baseurl.'login.php'

    $scope.back_buttun4 = function () {
      $window.location.href = baseurl + "/home";
    };


  	$scope.fetch_data= function(){
        $http.get(ApiUrl+"api_signin.php?action=fetch_all_player")
        .success(function(alldata){
            if (alldata=="null" || alldata==undefined || alldata=="Invalid request" || alldata=="Error"){
	             $scope.alldata="";
	         } 
	         else{
	            $scope.alldata= alldata;
	        }
	    })
    }






   $scope.submit_player_detail = function (pl_name,pl_status,pl_age,pl_city,pl_number,new_pl_slug){
	         console.log('Check kaun kaun sa data api ke paas ja rha hai '+pl_name+pl_status+pl_age+pl_city+pl_number,new_pl_slug);
             $http({
                     method: "POST",
                     url: ApiUrl + 'api_signin.php',
                     data: {
					             pl_name: pl_name,
					             pl_status: pl_status,
                            pl_age: pl_age,
                            pl_city: pl_city,
                            pl_number: pl_number,
                            new_pl_slug: new_pl_slug,
                            action: "submit_player_detail"
                      },
                     headers:
                      {
                      'Content-Type': 'application/x-www-form-urlencoded'
                      }
                    })
               .success(function (data)
                {
                   if (data.errors)
                     {
                       $scope.message = " database me nhi gya hai ";
                     } 
                   else
                      {
                         $scope.message = data.scalar;
                         if ($scope.message == "Success")
                             {
                                    $scope.pl_name = "";
                                    $scope.pl_status = "";
                                    $scope.pl_age = "";
                                    $scope.pl_city = "";
                                    $scope.pl_number = "";
                                    $scope.fetch_data();
                                    alert("Saved");
                             } 
                         else
                             {
                              alert($scope.message);
                        
                             }
                      }
                })
    }


    $scope.submitIfValid = function ()
     {
     if (!$scope.pl_name) {
        alert("Please Enter Player Name");
        return;
     }

     if (!$scope.pl_status) {
        alert("Please Select Player Status");
        return;
     }

     if (!$scope.pl_age) {
        alert("Please Enter Your Age Between 5-80 Year");
        return;
     }

     if (!$scope.pl_city) {
        alert("Please Enter Your Village/City");
        return;
     }

     if (!$scope.pl_number) {
        alert("Please enter valid 10-digit mobile Number");
        return;
     }
     // Sab input bhar diye hain, ab data submit karo ,  yaha se submit_player_detail ko call ho rha hai jo side hai 
     $scope.submit_player_detail(
        $scope.pl_name,
        $scope.pl_status,
        $scope.pl_age,
        $scope.pl_city,
        $scope.pl_number,
        $scope.new_pl_slug
     );
    };

// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

   // $scope.Check= function(pl_naam,pl_sstatus){
   //    console.log("113",pl_naam,pl_sstatus);
      
   //       $http.get(ApiUrl +"api_signin.php?action=Check&pl_naam=" +pl_naam +"&pl_sstatus=" + pl_sstatus)
   
   //      .success(function(new_temp){
   //          if (new_temp=="null" || new_temp==undefined || new_temp=="Invalid request" || new_temp=="Error"){
	//              $scope.alldata="";
	//          } 
	//          else{
	//             $scope.alldata= new_temp;
	//         }
	//     })
   //  }

   // $scope.Check();

// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\




// ===========================
// FILTER FUNCTION
// ===========================

$scope.Check = function(pl_naam, pl_sstatus){
    // save filter
    localStorage.setItem('pl_naam', pl_naam);
    localStorage.setItem('pl_sstatus', pl_sstatus);

    $http.get(ApiUrl+"api_signin.php?action=Check&pl_naam=" +pl_naam +"&pl_sstatus=" + pl_sstatus)
    .success(function(new_temp){
        if (new_temp=="null" || new_temp==undefined || new_temp=="Invalid request" || new_temp=="Error"){
            $scope.alldata="";
        } else {
            $scope.alldata = new_temp;
        }
    });
};


// ===========================
// CLEAR FILTER FUNCTION (optional)
// ===========================

$scope.clearFilter = function(){
    localStorage.removeItem('pl_naam');
    localStorage.removeItem('pl_sstatus');
    $scope.pl_naam = "";
    $scope.pl_sstatus = "";
    $scope.fetch_data(); // reset करके सब दिखाओ
};

// ===========================
// PAGE LOAD पर check करें
// ===========================


if (localStorage.getItem('pl_naam') || localStorage.getItem('pl_sstatus')) {
    $scope.pl_naam = localStorage.getItem('pl_naam');
    $scope.pl_sstatus = localStorage.getItem('pl_sstatus');

    // Filter apply
    $scope.Check($scope.pl_naam, $scope.pl_sstatus);
} else {
    // कोई filter नहीं → सभी data लाओ
    $scope.fetch_data();
}


window.addEventListener("load", function() {
    let navType = "navigate"; // default

    console.log("pppppp= ",performance.getEntriesByType)

    if (performance.getEntriesByType && performance.getEntriesByType("navigation").length > 0) {
        navType = performance.getEntriesByType("navigation")[0].type;
        console.log("1st if",navType);     
    }

    console.log("Navigation Type:", navType);

    if (navType === "reload") {
        // Refresh or browser back → filter को रहने दो
        console.log("Page refreshed or came via back → filter को मत हटाओ");
    }

    else if(navType === "back_forward"){
    // नए page से आया → filter clear
    console.log("Came from another page → clear filter");
    localStorage.removeItem('pl_naam');
    localStorage.removeItem('pl_sstatus');
    $scope.pl_naam = "";
    $scope.pl_sstatus = "";
    $scope.fetch_data(); // reset करके सब दिखाओ
    }
});



//////////////////////////////////////////////////////////////////////////////////////////////////////////////








   // edit button clicked angular js code 

  $scope.editPlayer = function(player) {
  $scope.playerToEdit = angular.copy(player);
  console.log("Editing player:", $scope.playerToEdit);
  $('#editPlayerModal').modal('show'); // show modal
  };



  
   // update player

   $scope.updatePlayer = function() {

   if (!$scope.playerToEdit.pl_name) {
        alert("Please Enter Player Name");
        return;
     }

     if (!$scope.playerToEdit.pl_status) {
        alert("Please Select Player Status");
        return;
     }

     if (!$scope.playerToEdit.pl_age) {
        alert("Please Enter Your Age Between 5-80 Year");
        return;
     }

     if (!$scope.playerToEdit.pl_city) {
        alert("Please Enter Your Village/City");
        return;
     }


     if (!$scope.playerToEdit.pl_number) {
        alert("Please enter valid 10-digit mobile number");
        return;
     }


  $http({
    method: "POST",
    url: ApiUrl + 'api_signin.php',
    data: {
      action: "update_player_detail",
      id: $scope.playerToEdit.id,
      pl_name: $scope.playerToEdit.pl_name,
      pl_status: $scope.playerToEdit.pl_status,
      pl_age: $scope.playerToEdit.pl_age,
      pl_city: $scope.playerToEdit.pl_city,
      pl_number: $scope.playerToEdit.pl_number
    },
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
   })

  .success(function (data) {
    if (data.scalar == "Success") {
      alert("Updated successfully!");
      $('#editPlayerModal').modal('hide'); // close modal
      $scope.fetch_data(); // isko call karate hai taki,fetch data refresh hokar show ho jaye.
    } else {

      alert("Update failed: " + data.scalar);
    }
  });
  };


   $scope.deletePlayer = function(player) {  
   if (confirm("Are you sure you want to delete this player?")) {

       $http.post(ApiUrl + "api_signin.php", {
       action: "delete_player",
       id: player.id
    },
    {
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })

    .success(function (data) { 
      if (data.scalar === "Success") {
        alert("Player deleted successfully");
        $scope.fetch_data(); // refresh the fetch data list

       }
       else {
        alert("Failed to delete player: " + data.scalar);
       }
    });
    }
   };














  // cancel edit

  $scope.cancelEdit = function() {
  $scope.playerToEdit = null;
  $('#editPlayerModal').modal('hide'); // close modal
  };













}]);