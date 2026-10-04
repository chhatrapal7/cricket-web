tdipllp.controller('signincontroller', ['$window', '$scope', '$http', 'Upload', '$timeout', function ($window, $scope, $http, Upload, $timeout) {

	$scope.login_user = function (userid, password) {
        $http({
                method: "POST",
                url: ApiUrl + 'api_login.php',
                data: {
					userid: userid,
					password: password,
                    action: "login_user"
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
            .success(function (data) {
                if (data.errors) {
                    $scope.message = "Something went wrong, please try again.";
                } else {
                    $scope.message = data.scalar;
                    if ($scope.message == "Success") {
						$scope.userid = "";
						$scope.password = "";
                        window.location.replace(baseurl+"home");
                    } 
                    else{
                        alert($scope.message);
                        window.location.replace(baseurl+"home");

                        

                    }
                }
            })
	}

}]);



// ********************************************************************************************


