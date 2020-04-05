# generator-themeplate -- ![NPM Version](https://img.shields.io/npm/v/generator-themeplate.svg) ![NPM Downloads](https://img.shields.io/npm/dt/generator-themeplate.svg)
> *"Quickly scafold a complete WordPress theme project in seconds!"*

## Features
- Fully-fleshed out package
- Follows WordPress standards
- Streamlined with Gulp
	- Sass
	- Autoprefixer
	- Babel
	- Concatination
	- Sourcemaps
	- Minification
	- Browsersync
	- Linters
	- Localization
- Powered by [ThemePlate](https://github.com/kermage/ThemePlate)
- Font Awesome [v5](https://fontawesome.com/) *(optional)*
- CSS Framework options
	- Twitter Bootstrap [v4](https://getbootstrap.com/)
	- Blank Slate *(with [normalize.css](https://necolas.github.io/normalize.css/))*
- Pre-included theme boilerplates and functions
	- Base template files
	- Features
	- Navigations
	- Widgets
	- Scripts and Styles
	- Actions and Filters
	- Plugins *(required/recommended)*
	- Custom forms/fields *(metaboxes)*
	- Custom post types and taxonomies
	- Bootstrap nav walker *(optional)*
	- Google tracking codes
	- Asynchronous loading and deferred execution of scripts

## Requirements
- [Node.js](https://nodejs.org/): Install from the NodeJS website.
- [Gulp](https://gulpjs.com/): Run `npm install -g gulp-cli`
- [Yeoman](https://yeoman.io/): Run `npm install -g yo`

## Installation

`npm install -g generator-themeplate`

## Usage
### Theme Setup
#### 1. In the desired project directory, initiate the generator

`yo themeplate`

#### 2. Simply follow the prompts and enter the details
```
? Project Name:
? Project URI:
? Author:
? Author Email:
? Author URI:
? Description:
? Function Prefix:
? Class Prefix:
? Constant Prefix:
? Use Font Awesome? (Y/n)
? Use Bootstrap? (y/N)
? License:
? License URI:
? Local Server:
```

### Theme Development
#### 1. Navigate to the generated theme directory
#### 2. Run `gulp`
- Builds assets
	- Sass compiled and minified
	- JS concatenated and minified
	- Images optimized; loseless
- Watches theme files and assets for changes
- Starts Browsersync

#### Available Tasks:
- `gulp debug:{false|true}` - Set assets to serve; minified or not
- `gulp bump` - Bump version in files; theme package and assets
- `gulp lint` - Run scripts and styles against coding rules set
- `gulp pot` - Generate a POT file for the theme localization

##### Bump Options
- `--to-type={major|minor}`
- `--to-version={#}`

## License
Copyright &copy; 2019 [Gene Alyson Fortunado Torcende](https://github.com/kermage)

Licensed under [MIT](LICENSE).
