tdipllp.controller("pdf_under_jsapicontroller", [
  "$window",
  "$scope",
  "$http",
  "Upload",
  "$timeout",
  function ($window, $scope, $http, Upload, $timeout) {

    $scope.pg_slug = pg_slug; // JavaScript se AngularJS ke $scope variable me dena

    // alert("Apane Yah Match Delete kiya");

    // alert(pg_slug);

  	// $scope.fetch_bill= function(){
    //     $http.get(ApiUrl+"api_signin.php?action=fetch_bill&pg_slug="+$scope.pg_slug)
    //     .success(function(bill){
    //         if (bill=="null" || bill==undefined || bill=="Invalid request" || bill=="Error"){
	  //            $scope.bill="";
	  //         } 
	  //        else{
	  //           $scope.bill= bill;
	  //       }
	  //   })
    // }
    
    // $scope.fetch_bill();


    $scope.fetch_bill_full_detail= function(){
        $http.get(ApiUrl+"api_signin.php?action=fetch_bill_full_detail&pg_slug="+$scope.pg_slug)
        .success(function(info){
            if (info=="null" || info==undefined || info=="Invalid request" || info=="Error"){
	             $scope.info="";
	          } 
	         else{
	            $scope.info= info;
	        }
	    })
    }


  $scope.fetch_bill_full_detail();




  $scope.fetch_test_name= function(){
        $http.get(ApiUrl+"api_signin.php?action=fetch_test_name&pg_slug="+$scope.pg_slug)
        .success(function(tests){
            if (tests=="null" || tests==undefined || tests=="Invalid request" || tests=="Error"){
	             $scope.tests="";
	          } 
	         else{
	            $scope.testss= tests.data;
	            $scope.totalAmount = tests.total;

	        }
	    })
    }


  $scope.fetch_test_name();




















      },
]);