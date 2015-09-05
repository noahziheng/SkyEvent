'use strict';

describe('Controller: BodyCtrl', function () {

  // load the controller's module
  beforeEach(module('appApp'));

  var BodyCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    BodyCtrl = $controller('BodyCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(BodyCtrl.awesomeThings.length).toBe(3);
  });
});
