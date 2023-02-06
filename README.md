# WordPress + Timber Starter Theme

A base starter theme that you can build from. The primary purpose of this project is to provide a base structure for beginning WordPress websites. This project utilizes Timber plugin for Twig templating and TailwindCSS for syling.

## Installation & setup

Steps to get this project up and running.

1. Clone or download this repo into the **Sites** folder on your local machine.
2. Download WordPress core files and extract them into the project root directory `wp core download --skip-content`.
3. Set up a local development environment using the tool of your choice.
4. Rename .env.example to .env and add your environmental variable values.

## Run and build your project

This project uses [Laravel Mix](https://laravel-mix.com/) to watch and build the project assets.

1. cd to your project directory `cd /Sites/*project-name*/wp-content/themes/base`.
2. Run `npm install` to install the project dependencies.
3. Next, run `npm run watch`. Browsersync will automatically monitor your files for changes, and inject any changes into the browser - all without requiring a manual refresh.
4. You can now visit http://localhost:3000 to view your website.

## Required plugins

This project requires the following plugins to run:
- [Advanced Custom Fields](https://www.advancedcustomfields.com/)
- [Advanced Custom Fields: Extended](https://wordpress.org/plugins/acf-extended/)
- [Timber](https://wordpress.org/plugins/timber-library/)
- [Soil](https://github.com/roots/soil/)

## Helpful resources

### Tools

[Timber Docs](https://timber.github.io/docs/)<br>
[Laravel Mix Docs](https://laravel-mix.com/)<br>
[TailwindCSS Docs](https://tailwindcss.com/)
