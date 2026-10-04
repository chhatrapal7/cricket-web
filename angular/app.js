var tdipllp = angular.module('tdipllp', ['ui.select','ngSanitize','ngRoute','ngAnimate','ngFileUpload','ui.bootstrap','angular-toArrayFilter', 'ngTagsInput']);

var ApiUrl = "http://localhost/apna_structure/Api/";
var baseurl = "http://localhost/apna_structure/";

var NodeJSApiUrl = "http://localhost:3000/api/";

var site_resources = "http://localhost/apna_structure/resources/";

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