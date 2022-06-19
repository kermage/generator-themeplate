# generator-themeplate -- ![NPM Version](https://img.shields.io/npm/v/generator-themeplate.svg) ![NPM Downloads](https://img.shields.io/npm/dt/generator-themeplate.svg)
> *"Quickly scafold a complete WordPress site project in seconds!"*

## Features
- Fully-fleshed out package
- Follows WordPress standards
- Streamlined with Gulp
	- Sass
	- Autoprefixer
	- Typescript
	- Babel
	- Rollup
	- Sourcemaps
	- Minification
	- Browsersync
	- Linters
	- Localization
- Powered by [ThemePlate](https://github.com/kermage/ThemePlate)
- Font Awesome [v5](https://fontawesome.com/) *(optional)*
- CSS Framework options
	- Tailwind CSS [v3](https://tailwindcss.com/)
	- Twitter Bootstrap [v5](https://getbootstrap.com/)
	- Blank Slate *(with [normalize.css](https://necolas.github.io/normalize.css/))*
- Pre-included boilerplates and functions
	- Base theme template files
	- Compatibility checks
	- Theme Features
	- Navigations
	- Widgets
	- Scripts and Styles
	- Actions and Filters
	- Plugins *(required/recommended)*
	- Custom forms/fields *(metaboxes)*
	- Custom post types and taxonomies
	- Clean navbar walker
	- Google tracking codes
	- Asynchronous loading and deferred execution of scripts

## Requirements
- [Node.js](https://nodejs.org/): Install from the NodeJS website.
- [Gulp](https://gulpjs.com/): Run `npm install -g gulp-cli`
- [Yeoman](https://yeoman.io/): Run `npm install -g yo`

## Installation

`npm install -g generator-themeplate`

## Usage
### Setup
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
? CSS Framework:
? License:
? License URI:
? Local Server:
```

### Development
#### 1. Navigate to the generated directory
#### 2. Run `gulp`
- Builds assets
	- Sass and Javascript/Typescript compiled
	- Images copied with WebP format
- Watches files and assets for changes
- Starts Browsersync

#### Available Tasks:
- `gulp lint` and `gulp fix` - Run scripts and styles against the coding rules set
- `gulp pot` - Generate a POT file for the localization
- `gulp bump` - Bump version in files; package and assets

##### Bump Options
- `--to-type={major|minor}`
- `--to-version={#}`

### Production
#### 1. Run `gulp build --production`
- Assets minified (images optimized; loseless)

#### 2. Set the theme debug constant to `false`
- Specifies to serve the minified assets
- Line is in the theme's `functions.php` file

#### 3. Move out the plugin folder inside the theme
- Standard and default path at `wp-content/plugins`
- Plugin folder is named the same with the theme folder

## License
Copyright &copy; 2022 [Gene Alyson Fortunado Torcende](https://github.com/kermage)

Licensed under [MIT](LICENSE).
