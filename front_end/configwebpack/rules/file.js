let file = {
    
        test: /\.(png|jpg|gif|jpeg|eot|svg|ttf|woff|woff2)$/,
        use: [
          {
            loader: 'url-loader',
            options: {
              limit: 8192
              //,name: '\\[name].[ext]'
            }
          }
        ]
      
}

module.exports = file

