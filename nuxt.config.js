require('dotenv').config()

module.exports = {
  srcDir: 'client/',
  plugins: ['~/plugins/echo.js'],
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/dotenv',
  ],
  env: {
    PUSHER_APP_KEY: process.env.PUSHER_APP_KEY,
    PUSHER_APP_CLUSTER: process.env.PUSHER_APP_CLUSTER
  }
}