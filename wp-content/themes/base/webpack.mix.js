require('dotenv').config({
  path: '../../../.env',
});

const local = process.env.MIX_LOCAL;
const mix = require('laravel-mix');

const ImageminPlugin = require('imagemin-webpack-plugin').default;
const imageminMozjpeg = require('imagemin-mozjpeg');
const CopyPlugin = require('copy-webpack-plugin');

mix
  .setPublicPath('./dist')
  .setResourceRoot('../')
  .js('assets/scripts/app.js', 'dist/scripts')
  .postCss('assets/styles/admin.css', 'dist/styles/admin.css')
  .postCss('assets/styles/main.css', 'dist/styles/app.css', [
    require('tailwindcss'),
  ])
  .copyDirectory('assets/fonts', 'dist/fonts')
  .options({
    processCssUrls: false,
  })
  .webpackConfig({
    plugins: [
      new CopyPlugin({
        patterns: [{ from: 'assets/images', to: 'images' }],
      }),
      new ImageminPlugin({
        disable: process.env.NODE_ENV !== 'production',
        test: /\.(jpe?g|png|gif|svg)$/i,
        plugins: [
          imageminMozjpeg({
            quality: 85,
            progressive: true,
          }),
        ],
      }),
    ],
    externals: {
      jquery: 'jQuery',
    },
  })
  .browserSync({
    proxy: local,
    open: false,
    files: [
      `dist/**/*.css`,
      `dist/**/*.js`,
      `**/*.php`,
      `views/**/*.php`,
      `views/**/*.twig`,
    ],
    ghostMode: {
      clicks: true,
      scroll: true,
      forms: false,
    },
  })
  .disableNotifications();
