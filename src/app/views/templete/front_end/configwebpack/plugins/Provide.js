

module.exports= new (require('webpack')).ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery" : "jquery",
      "window.$": "jquery"
  })


