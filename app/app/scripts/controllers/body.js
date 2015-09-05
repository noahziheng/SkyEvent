'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:BodyCtrl
 * @description
 * # BodyCtrl
 * Controller of the appApp
 */
angular.module('appApp')
  .controller('BodyCtrl', function ($scope) {
  	$scope.$on("NavChange",function (event, msg) {
  		$scope.$broadcast("NavChangeP", msg);
  	});
  });
