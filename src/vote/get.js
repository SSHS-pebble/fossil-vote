module.exports = async (ctx) => {
    // console.log("Rendered vote page");
    await ctx.render('vote.html');
}