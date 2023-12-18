const mix = require('laravel-mix');
const lodash = require("lodash");
// const WebpackRTLPlugin = require('webpack-rtl-plugin');
const folder = {
        src: "resources/", // source files
        dist: "public/", // build files
        dist_assets: "public/assets/" //build assets files
    }
    /*
     |--------------------------------------------------------------------------
     | Mix Asset Management
     |--------------------------------------------------------------------------
     |
     | Mix provides a clean, fluent API for defining some Webpack build steps
     | for your Laravel application. By default, we are compiling the Sass
     | file for the application as well as bundling up all the JS files.
     |
     */


// copy all fonts
var out = folder.dist_assets + "fonts";
mix.copyDirectory(folder.src + "fonts", out);

// copy all images
var out = folder.dist_assets + "images";
mix.copyDirectory(folder.src + "images", out);

var out = folder.dist_assets + "plugins";
mix.copyDirectory(folder.src + "plugins", out);

var out = folder.dist_assets + "js";
mix.copyDirectory(folder.src + "js", out);

var out = folder.dist_assets + "css";
mix.copyDirectory(folder.src + "css", out);

mix.sass('resources/scss/bootstrap.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/bootstrap.css");
mix.sass('resources/scss/icons.scss', folder.dist_assets + "css").options({ processCssUrls: false }).minify(folder.dist_assets + "css/icons.css");
mix.sass('resources/scss/app.scss', folder.dist_assets + "css").options({ processCssUrls: false }).minify(folder.dist_assets + "css/app.css");