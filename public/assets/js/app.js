var app = angular.module("App", []);
	app.controller("CustomerCtrl", ['$scope', function($scope) {
		$scope.App_Title = "Customers";
		$scope.customers = [
			{name: "Ashwin"},
			{name: "Parmar"}
		];
	}]);