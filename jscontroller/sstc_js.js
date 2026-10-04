tdipllp.controller('addsstcinfo', ['$window', '$scope', '$http', 'Upload', '$timeout', function ($window, $scope, $http, Upload, $timeout) {

    console.log('connnect huwa hai, sstc.js');


    $scope.Submit_Sstc = function ()
     {

     if (!$scope.Event_name) {
        alert("Please Enter Event_name");
        return;
     }

     if (!$scope.Proposed_ng) {
        alert("Please Proposed_ng");
        return;
     }

     if (!$scope.Particular_ng) {
        alert("Please Enter Your Age Between 5-80 Year");
        return;
     }

     if (!$scope.Doctor_sstc_ng) {
        alert("Please Enter Particular_ng");
        return;
     }

     if (!$scope.Banificiary_ng) {
        alert("Please enter Banificiary_ng");
        return;
     }
     // Sab input bhar diye hain, ab data submit karo ,  yaha se submit_player_detail ko call ho rha hai jo side hai 
     $scope.inser_INdatabaseSstc(
        $scope.Event_name,
        $scope.Proposed_ng,
        $scope.Particular_ng,
        $scope.Doctor_sstc_ng,
        $scope.Banificiary_ng
     );
    };

        $scope.inser_INdatabaseSstc = function (Event_name,Proposed_ng,Particular_ng,Doctor_sstc_ng,Banificiary_ng)
        {
	         console.log('Check kaun kaun sa data api ke paas ja rha hai '+Event_name+Proposed_ng+Particular_ng+Doctor_sstc_ng+Banificiary_ng);
             $http({
                     method: "POST",
                     url: ApiUrl + 'sstc_api.php',
                     data: {
					        Event_name: Event_name,
					        Proposed_ng: Proposed_ng,
                            Particular_ng: Particular_ng,
                            Doctor_sstc_ng: Doctor_sstc_ng,
                            Banificiary_ng: Banificiary_ng,
                            action: "Sstc_SomeInfo",
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
                                    $scope.Event_name = "";
                                    $scope.Proposed_ng = "";
                                    $scope.Particular_ng = "";
                                    $scope.Doctor_sstc_ng = "";
                                    $scope.Banificiary_ng = "";                        
                                    alert("Saved");
                             } 
                         else
                             {
                              alert($scope.message);
                        
                             }
                      }
                });

            }
        



}]);