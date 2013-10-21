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
        templateUrl: 'app/view/log.html',
        controller: 'LogregCtrl'
      }).
      when('/reg', {
        templateUrl: 'app/view/reg.html',
        controller: 'LogregCtrl'
      }).
      otherwise({
        redirectTo: '/log'
      });
  }]);
