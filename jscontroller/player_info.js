tdipllp.controller('playerallinformation', ['$window', '$scope', '$http', 'Upload', '$timeout', function ($window, $scope, $http, Upload, $timeout) {

    $scope.slug = slug; // JavaScript se AngularJS ke $scope variable me dena

    // alert("jj")

    $scope.player_information= function(){
    // alert("jjasas")

        $http.get(ApiUrl+"api_signin.php?action=player_information&slug="+$scope.slug)
        .success(function(info){
            if (info=="null" || info==undefined || info=="Invalid request" || info=="Error"){
	             $scope.info="";
	         } 
	         else{
	            $scope.info= info;
	        }
	    })
    }

$scope.player_information();



}]);
