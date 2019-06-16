const fetch = require('node-fetch');
const _ = require('dotenv').config();

module.exports = async (ctx) => {
    let obj = ctx.request.body;
    obj.vote = Number(obj.vote);

    console.log(obj);

    let res = await fetch(process.env.SERVER, {
        method: 'POST',
        body: JSON.stringify(obj)
    })
    .then(res => res.json())
    .then(res => {
        console.log(res);
        return res;
    });

    if(!res.status){
        // console.log("ERROR!");
        await ctx.render('fail.html');
    }
    else{
        // console.log("Successful!");
        await ctx.render('success.html');
    }
}