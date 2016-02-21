/**
 * 每位工程师都有保持代码优雅的义务
 * Each engineer has a duty to keep the code elegant
 *
 * @author wangxiao
 */

// 所有 API 的路由

'use strict';

const router = require('express').Router();

const events = require('./events');
const airports = require('./airports');
const bookings = require('./bookings');
const users = require('./users');

router.get('/event/:id', events.get);
router.post('/events', events.save);
router.post('/events/query', events.getAll);
router.post('/event/:id', events.update);
router.delete('/event/:id', events.delete);

router.get('/airport/:id', airports.get);
router.post('/airports', airports.save);
router.post('/airports/query', airports.getAll);
router.post('/airport/:id', airports.update);
router.delete('/airport/:id', airports.delete);

router.get('/booking/:id', bookings.get);
router.post('/bookings', bookings.save);
router.post('/bookings/query', bookings.getAll);
router.post('/booking/:id', bookings.update);
router.delete('/booking/:id', bookings.delete);

router.get('/users', users.getAll);
router.get('/user/:id', users.get);
router.post('/users', users.save);
router.post('/user/:id', users.update);
router.delete('/user/:id', users.delete);

module.exports = router;
