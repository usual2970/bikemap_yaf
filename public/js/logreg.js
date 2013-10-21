var app=angular.module("logreg",['ngResource','ngRoute']);
app.controller("LogregCtrl",function($scope){
	$scope.logcls="active";
	$scope.regcls="";
	$scope.showme=function(name){
		if(name=="log"){
			$scope.logcls="active";
			$scope.regcls="";
		}
		else{
			$scope.logcls="";
			$scope.regcls="active";
		}
	}

});

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/log', {
        templateUrl: 'html/log.phtml',
        controller: 'LogregCtrl'
      }).
      when('/reg', {
        templateUrl: 'html/reg.phtml',
        controller: 'LogregCtrl'
      }).
      otherwise({
        redirectTo: '/log'
      });
  }]);
