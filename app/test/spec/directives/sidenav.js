'use strict';

describe('Directive: sidenav', function () {

  // load the directive's module
  beforeEach(module('appApp'));

  var element,
    scope;

  beforeEach(inject(function ($rootScope) {
    scope = $rootScope.$new();
  }));

  it('should make hidden element visible', inject(function ($compile) {
    element = angular.element('<sidenav></sidenav>');
    element = $compile(element)(scope);
    expect(element.text()).toBe('this is the sidenav directive');
  }));
});
