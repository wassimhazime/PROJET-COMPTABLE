let mode = process.env.NODE_ENV;
let config = {
    entry: {dist: ["./src/require.js", "./src/main.js"]}, // string | object | array
    output: {
        path: (require('path')).resolve(__dirname + "/dist/"), // string
        filename: "[name].js",
        publicPath: ('/comptable/src/app/views/templete/front_end/dist/')
    },

    module: {
        rules: []
    }
    ,
    plugins: [

    ]
}


config.module.rules.push(require('./configwebpack/rules/rulebabel'))

config.module.rules.push(require('./configwebpack/rules/css'))
config.module.rules.push(require('./configwebpack/rules/scss'))
config.module.rules.push(require('./configwebpack/rules/file'))

config.plugins.push(require('./configwebpack/plugins/Provide'))
config.plugins.push(require('./configwebpack/plugins/extract-text'))



config.devtool = "source-map";
if (mode != "dev") {
    config.plugins.push(require('./configwebpack/plugins/uglifyjs'))

    config.plugins.push(require('./configwebpack/plugins/manifest'))
} else {
    config.devtool = "cheap-module-eval-source-map";
    config.watch = true
}

module.exports = config;

