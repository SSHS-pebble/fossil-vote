const Koa = require('koa');
const views = require('koa-views');
const router = new require('koa-router')();
const bodyparser = require('koa-body');

const app = new Koa();

app.use(views(__dirname + '/static'));
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