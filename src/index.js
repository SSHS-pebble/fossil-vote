const Koa = require('koa');
const views = require('koa-views');
const router = new require('koa-router')();
const bodyparser = require('koa-body');
const fetch = require('node-fetch');

const app = new Koa();

const SERVER = 'http://localhost:8000/vote';


app.use(views(__dirname + '/static', {extension: 'html'}));

app.use(bodyparser());

router.get('/', ctx => {
    console.log("Rendered a page");
    return ctx.render('vote');
});
router.post('/', ctx => {
    let obj = ctx.request.body
    console.log(obj);
    console.log(JSON.stringify(obj));

    fetch(SERVER, {
        method: 'POST',
        body: JSON.stringify(obj),
    })

    return ctx.render('voted');
});

app.use(router.routes()).use(router.allowedMethods);

app.listen(3000);