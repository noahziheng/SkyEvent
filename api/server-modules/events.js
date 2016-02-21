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
const auth = require('./auth');
var Event = AV.Object.extend('event');

let pub = {};

pub.getAll = (req, res) => {
  var query = new AV.Query(Event);
  query.doCloudQuery(req.body.cql).then(function(results) {
    res.send(results);
  }, function(err) {
    tool.fail(res,err);
  });
};

pub.get = (req, res) => {
  var query = new AV.Query(Event);
  query.get(req.params.id).then(function(result) {
    res.send(result);
  }, function(err) {
    tool.l(err);
    tool.fail(res,err);
  });
};

pub.save = (req, res) => {
  var event = new Event();
  event.save(req.body).then(function(result) {
    res.send({result:result});
  }, function(err) {
    tool.fail(res,err);
  })
};

pub.update = (req, res) => {
  res.send(req.params);
};

pub.delete = (req, res) => {
  res.send(req.params);
};

module.exports = pub;
