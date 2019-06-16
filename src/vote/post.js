const fetch = require('node-fetch');

const SERVER = 'http://localhost:8000/vote';

module.exports = async (ctx) => {
    let obj = ctx.request.body;
    obj.vote = Number(obj.vote);

    console.log(obj);

    let res = await fetch(SERVER, {
        method: 'POST',
        body: JSON.stringify(obj)
    })
    .then(res => res.json())
    .then(obj => {
        console.log(obj);
        return obj;
    });

    if(!res.status){
        // console.log("ERROR!");
        await ctx.redirect('/vote');
    }
    else{
        // console.log("Successful!");
        await ctx.redirect('/');
    }
}