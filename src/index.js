const Koa = require('koa');
const views = require('koa-views');
const bodyparser = require('koa-body');
const { Serve } = require("static-koa-router");

const router = new require('koa-router')();
const app = new Koa();

Serve(__dirname + '/static', router);

app.use(views(__dirname + '/pages'));
app.use(bodyparser());

router.get('/vote', require('./vote/get.js'));
router.post('/vote', require('./vote/post.js'));

router.get('/', async (ctx, next) => {
    // console.log("Rendered main page");
    await ctx.render('main.html');
    await next();
});

app.use(router.routes()).use(router.allowedMethods());

app.listen(3000);