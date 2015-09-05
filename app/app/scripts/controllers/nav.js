'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:NavCtrl
 * @description
 * # NavCtrl
 * Controller of the appApp
 */
angular.module('appApp')
  .controller('NavCtrl', function ($scope) {
  	this.current = "";
  	$scope.$on("NavChangeP",function (event, msg) {
  		$scope.nav[$scope.nav.current] = '';
  		$scope.nav[msg] = 'current';
  		$scope.nav.current = msg;
  	});
  });
