/* eslint-env node */

var http = require("http");

var express = require("express");

require("console-stamp")(console, "HH:MM:ss.l");

var app = express();

app.use(require("morgan")("short"));

app.use(function (req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

(function () {

    // Step 1: Create & configure a webpack compiler
    var webpack = require("webpack");
    var webpackConfig = require("../../../webpack.config");
    var compiler = webpack(webpackConfig);

    // Step 2: Attach the dev middleware to the compiler & the server
    app.use(require("webpack-dev-middleware")(compiler, {
        logLevel: "warn",
        publicPath: webpackConfig.output.publicPath
    }));

    // Step 3: Attach the hot middleware to the compiler & the server
    app.use(require("webpack-hot-middleware")(compiler, {
        log: console.log,
        path: "/__webpack_hmr",
        heartbeat: 10 * 1000
    }));
})();

if (require.main === module) {
    var server = http.createServer(app);
    server.listen(3000, function () {
        console.log("Listening on %j", server.address());
    });
}