let css = {
    test: /\.css$/,

    use: (require("extract-text-webpack-plugin")).extract({
            fallback: "style-loader",
            use: [
                {loader: 'css-loader', options: {importLoaders: 1,minimize:true,sourceMap:true,url:true}},
                {loader: 'postcss-loader', options: {plugins: (loader) =>[require('autoprefixer')({browsers: ["last 2 versions", "ie >8"]})]}}
                 ]
    })
}

module.exports = css

