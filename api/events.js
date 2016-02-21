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
var Event = AV.Object.extend('event');

let pub = {};

pub.getAll = (req, res) => {
  //tool.l('It works.');
  var query = new AV.Query(Event);
  query.find().then(function(results) {
    // 成功获得实例
    res.send(results);
  }, function(error) {
    // 失败了
    res.send({error:error});
  });
};

pub.get = (req, res) => {
  //tool.l('It works.');
  var query = new AV.Query(Event);
  query.get(req.params.id).then(function(result) {
    // 成功获得实例
    res.send(result);
  }, function(error) {
    // 失败了
    res.send({error:error});
  });
};

pub.save = (req, res) => {
  //tool.l('It works.');
  /*
  var event = new Event();
  event.save(req.body).then(function(result) {
    res.send({result:result});
  }, function(err) {
    res.send({error:err});
  })*/
  var Airport = AV.Object.extend('airport');
  var airport = new Airport();
  airport.save(req.body).then(function(result) {
    res.send({result:result});
  }, function(err) {
    res.send({error:err});
  })
  //res.send(req.body);
};

pub.update = (req, res) => {
  //tool.l('It works.');
  res.send(req.params);
};

module.exports = pub;
