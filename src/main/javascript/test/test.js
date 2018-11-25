/* eslint-env node */
/* eslint-disable no-sync, no-console */
/* eslint quote-props: [ "error", "always" ] */

const fs = require("fs");
const babel = require("@babel/core");

babel.transform(
    fs.readFileSync("in.js", "utf8"),
    {
        "plugins": [
            [
                "@babel/plugin-proposal-decorators",
                {
                    "decoratorsBeforeExport": true,
                },
            ],
        ],
        "presets": ["@babel/preset-env"],
    },
    (err, result) => {
        if (err) {
            console.error(err);
        } else {
            fs.writeFileSync("out.js", `/* eslint-disable */\n${result.code}`);
        }
    }
);
