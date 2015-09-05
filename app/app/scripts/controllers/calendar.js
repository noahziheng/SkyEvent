'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:CalendarCtrl
 * @description
 * # CalendarCtrl
 * Controller of the appApp
 */
angular.module('appApp')
  .controller('CalendarCtrl', function ($scope) {
  	$scope.$emit("NavChange", 'cal');
  });
