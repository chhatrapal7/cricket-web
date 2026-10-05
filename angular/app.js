var tdipllp = angular.module('tdipllp', ['ui.select','ngSanitize','ngRoute','ngAnimate','ngFileUpload','ui.bootstrap','angular-toArrayFilter', 'ngTagsInput']);

var ApiUrl = "http://13.233.173.96:8080/Api/";
var baseurl = "http://13.233.173.96:8080/";
var NodeJSApiUrl = "http://localhost:3000/api/";
var site_resources = "http://13.233.173.96:8080/resources/";

var phoneREG = /^[(]{0,1}[0-9]{3}[)\.\- ]{0,1}[0-9]{3}[\.\- ]{0,1}[0-9]{4}$/;

tdipllp.run(function($rootScope,$http,Upload,$timeout) {
  $rootScope.selected_stricker = {};
  $rootScope.selected_non_stricker = {};
  $rootScope.selected_bowler = {};
  $rootScope.selected_bowler_c = {};
});
tdipllp.filter("trust", ['$sce', function($sce) {
    return function(htmlCode){
      return $sce.trustAsHtml(htmlCode);
    }
  }]);
