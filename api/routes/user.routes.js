'use strict';

/**
 * Module dependencies.
 */
var userController = require('../controllers/user.controller');

module.exports = function(app) {
  // User Routes
  app.route('/api/user')
    .get(userController.list)
  //.post(users.create);
  // app.route('/api/users/:userId')
  //   .get(users.read)
  //   .put(users.update)
  //   .delete(users.delete);
};