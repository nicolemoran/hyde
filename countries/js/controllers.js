var countryControllers = angular.module('countryControllers', ['ngAnimate']);

countryControllers.controller('ListController', ['$scope', '$http', function($scope, $http) {
  $http.get('js/data.json').success(function(data) {
    $scope.countries = data.countries;
    $scope.countryOrder = 'name';
  });
}]);

countryControllers.controller('DetailsController', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams) {
  $http.get('js/data.json').success(function(data) {
    $scope.countries = data.countries;
    $scope.whichItem = $routeParams.itemId;

    if($routeParams.itemId > 0) {
    	$scope.previtem = Number($routeParams.itemId)-1;
    } else {
    	$scope.prevItem = $scope.countries.length-1;
    }

    if($routeParams.itemId < $scope.countries.length-1) {
    	$scope.nextitem = Number($routeParams.itemId)+1;
    } else {
    	$scope.nextItem = 0;
    }

  });
}]);

