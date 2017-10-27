let babel = {
    test: /\.js$/,
    exclude: /(node_modules|bower_components)/,

    use: [{
            loader: 'babel-loader',
            options: {
                plugins: ["syntax-dynamic-import"],
                 presets: ['env']
                 }}
          ],

}

module.exports = babel