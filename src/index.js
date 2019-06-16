const Koa = require('koa');
const views = require('koa-views');
const router = new require('koa-router')();
const bodyparser = require('koa-body');
const { Serve } = require("static-koa-router");

const app = new Koa();

app.use(views(__dirname + '/pages'));
app.use(bodyparser());

router.get('/vote', require('./vote/get.js'));
router.post('/vote', require('./vote/post.js'));

router.get('/', async (ctx, next) => {
    // console.log("Rendered main page");
    await ctx.render('main.html');
    await next();
});

Serve(__dirname + '/static', router);

app.use(router.routes()).use(router.allowedMethods());

app.listen(3000);