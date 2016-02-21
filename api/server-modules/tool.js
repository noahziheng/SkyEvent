/**
 * 每位工程师都有保持代码优雅的义务
 * Each engineer has a duty to keep the code elegant
 *
 * @author wangxiao
 */

// 一些工具方法

'use strict';

let pub = {};

pub.l = (msg) => {
  console.log('\n\n', msg, '\n\n');
};

pub.fail = (res, err) => {
  err = {
    result:false,
    error:err
  }
  res.send(err);
};

module.exports = pub;
