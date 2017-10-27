

module.exports=new (require('uglifyjs-webpack-plugin'))(
        { sourceMap:true,
           comments: false}
        
        )