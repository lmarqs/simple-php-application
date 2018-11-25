/* eslint-env node */

const http = require("http");

const express = require("express");

require("console-stamp")(console, "HH:MM:ss.l");

const app = express();

app.use(require("morgan")("short"));

app.use((req, res, next) => {
    res.header("Access-Control-Allow-Origin", "*");
    res.header(
        "Access-Control-Allow-Headers",
        "Origin, X-Requested-With, Content-Type, Accept"
    );
    next();
});

(function createEnv (require) {
    // Step 1: Create & configure a webpack compiler
    const webpack = require("webpack");
    const webpackConfig = require("../../../webpack.config");
    const compiler = webpack(webpackConfig);

    // Step 2: Attach the dev middleware to the compiler & the server
    app.use(require("webpack-dev-middleware")(compiler, {
        logLevel: "warn",
        publicPath: webpackConfig.output.publicPath,
    }));

    // Step 3: Attach the hot middleware to the compiler & the server
    const TEN_THOUSAND = 10000;
    app.use(require("webpack-hot-middleware")(compiler, {
        heartbeat: TEN_THOUSAND,
        log: console.log, // eslint-disable-line no-console, max-len
        path: "/__webpack_hmr",
    }));
}(require));

if (require.main === module) {
    const server = http.createServer(app);
    const port = 3000;
    server.listen(port, () => {
        console.log("Listening on %j", server.address()); // eslint-disable-line no-console, max-len
    });
}
