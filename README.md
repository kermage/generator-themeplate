# generator-themeplate v0.27.0 --
> *"Quickly scafold a complete WordPress theme project in seconds!"*

## Features
- Fully-fleshed out package
- Streamlined with Gulp
	- Sass
	- Autoprefixer
	- Concatination
	- Sourcemaps
	- Minification
	- Browsersync
	- Linters
	- Localization
- Powered by [ThemePlate](https://github.com/kermage/ThemePlate)
- CSS Framework options
	- Twitter Bootstrap [v4.0.0](https://github.com/twbs/bootstrap)
	- Blank Slate *(with [normalize](https://github.com/JohnAlbin/normalize-scss))*
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
- [Gulp](http://gulpjs.com/): Run `npm install -g gulp-cli`
- [Yeoman](http://yeoman.io/): Run `npm install -g yo`

## Installation

`npm install -g generator-themeplate`

## Usage
### Theme Setup
#### 1. In the desired project directory, initiate the generator

`yo themeplate`

#### 2. Simply follow the prompts and enter the details
```
? Theme Name:
? Theme URI:
? Author:
? Author Email:
? Author URI:
? Description:
? Function Prefix:
? Class Prefix:
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
- `gulp debug-{false|true}` - Set assets to serve; minified or not
- `gulp bump` - Bump version in files; theme package and assets
- `gulp lint` - Run scripts and styles against coding rules set
- `gulp pot` - Generate a POT file for the theme localization

## License
Copyright &copy; 2018 [Gene Alyson Fortunado Torcende](https://github.com/kermage)

Licensed under [MIT](LICENSE).
