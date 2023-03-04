const path = require("path");
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');


module.exports = {
    watch: true,
    stats: 'errors-only',
    watchOptions: {
        ignored: /node_modules/,
    },
    // mode: "production",
    mode: "development",
    entry: {
        main: "./src/main.js",
        vendor: "./src/vendor.js",
    },
    output: {
        filename: "[name].[contenthash].bundle.js",
        path: path.resolve(__dirname, "dist"),
        clean: true,
    },
    plugins: [
        new MiniCssExtractPlugin({ filename: "[name].[contenthash].css" }),
        // [new HtmlWebpackPlugin()],
        new BrowserSyncPlugin({
            // browse to http://localhost:3000/ during development,
            // ./public directory is being served
            host: 'landing-test.local',
            // port: 3000,
            files: ['./*.php'],
            // server: { baseDir: ['public'] }
            proxy: 'http://landing-test.local/'
          })
    ],
    module: {
        rules: [
            {
                test: /\.(scss|css)$/,
                use: [
                    // Extract css into files
                    MiniCssExtractPlugin.loader,
                    // Creates `style` nodes from JS strings
                    // "style-loader",
                    // Translates CSS into CommonJS
                    "css-loader",
                    // Compiles Sass to CSS
                    "sass-loader",
                ]
            }
        ]
    }
}