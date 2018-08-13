const webpack = require("webpack");
const path = require("path");

const entry = {
    "main": "./src/main/javascript/main.js",
    "login/form": "./src/main/javascript/login/main.js",
    "contact/list": "./src/main/javascript/contact/list/main.js",
    "libs": "./src/main/javascript/libs.js"
};
const plugins = [
    new webpack.NoEmitOnErrorsPlugin()
];

if (process.env.NODE_ENV === "development") {
    entry["__webpack_hmr"] = "webpack-hot-middleware/client?path=/__webpack_hmr&timeout=20000";
    plugins.push(new webpack.HotModuleReplacementPlugin());
}

module.exports = {
    mode: "production",
    devtool: "#source-map",
    entry,
    plugins,
    target: "web",
    module: {
        rules: [{
                test: /\.js$/,
                use: [
                    "babel-loader",
                    "eslint-loader"
                ]
            },
            {
                test: /\.css$/,
                use: [
                    "style-loader",
                    "css-loader",
                    "resolve-url-loader"
                ]
            },
            {
                test: /\.scss$/,
                use: [
                    "style-loader",
                    "css-loader",
                    "resolve-url-loader",
                    "sass-loader?sourceMap"
                ]
            },
            {
                test: /\.(png|jpg|gif|svg)$/,
                use: [{
                    loader: "url-loader",
                    options: {
                        limit: 0
                    }
                }]
            }
        ]
    },
    output: {
        path: path.join(__dirname, "src", "main", "php", "public", "bundle"),
        publicPath: "/public/bundle/",
        filename: "[name].js"
    }
};