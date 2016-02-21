/**
 * 每位工程师都有保持代码优雅的义务
 * Each engineer has a duty to keep the code elegant
 *
 * @author wangxiao
 */

// 一些工具方法

'use strict';

var AV = require('leanengine');
const tool = require('./tool');
var User = AV.Object.extend('user');

let pub = {};

pub.check = function (token) {
  var query = new AV.Query('User');
  query.equalTo('logintoken', token);
  query.find().then(function(results) {
    results = results[0];
    
    return results;
  }, function(error) {
    return {
      result:false,
      error:error
    }
  });
}

module.exports = pub;
