/* eslint-env node */

'use strict';

var Generator = require( 'yeoman-generator' );
var fs = require( 'fs' );
var path = require( 'path' );
var glob = require( 'glob' );
var chalk = require( 'chalk' );

module.exports = class extends Generator {
	prompting() {
		return this.prompt( [
			{
				name: 'themeName',
				message: 'Theme Name:',
				default: 'ThemePlate'
			},
			{
				name: 'themeURI',
				message: 'Theme URI:',
				default: 'https://wordpress.org/themes/'
			},
			{
				name: 'authorName',
				message: 'Author:',
				default: this.user.git.name
			},
			{
				name: 'authorEmail',
				message: 'Author Email:',
				default: this.user.git.email
			},
			{
				name: 'authorURI',
				message: 'Author URI:',
				default: function( answer ) {
					return 'mailto:' + answer.authorEmail;
				}
			},
			{
				name: 'description',
				message: 'Description:',
				default: function( answer ) {
					return 'Theme for ' + answer.themeName;
				}
			},
			{
				name: 'functionPrefix',
				message: 'Function Prefix:',
				default: function( answer ) {
					return answer.themeName.toLowerCase().replace( /[\s-]/g, '_' ).replace( /[^0-9a-z_]/g, '' ).replace( /_+$/, '' );
				},
				filter: function( answer ) {
					return answer.toLowerCase().replace( /[\s-]/g, '_' ).replace( /[^0-9a-z_]/g, '' ).replace( /_+$/, '' );
				}
			},
			{
				name: 'classPrefix',
				message: 'Class Prefix:',
				default: function( answer ) {
					return answer.themeName.replace( /[\s-]/g, '_' ).replace( /[^0-9a-zA-Z_]/g, '' ).replace( /_+$/, '' );
				},
				filter: function( answer ) {
					return answer.replace( /[\s-]/g, '_' ).replace( /[^0-9a-zA-Z_]/g, '' ).replace( /_+$/, '' );
				}
			},
			{
				name: 'constantPrefix',
				message: 'Constant Prefix:',
				default: function( answer ) {
					return answer.themeName.toUpperCase().replace( /[\s-]/g, '_' ).replace( /[^0-9a-zA-Z_]/g, '' ).replace( /_+$/, '' );
				},
				filter: function( answer ) {
					return answer.toUpperCase().replace( /[\s-]/g, '_' ).replace( /[^0-9a-zA-Z_]/g, '' ).replace( /_+$/, '' );
				}
			},
			{
				type: 'confirm',
				name: 'fontawesome',
				message: 'Use Font Awesome?',
				default: true
			},
			{
				type: 'confirm',
				name: 'bootstrap',
				message: 'Use Bootstrap?',
				default: false
			},
			{
				name: 'license',
				message: 'License:',
				default: 'GPL-2.0-only'
			},
			{
				name: 'licenseURI',
				message: 'License URI:',
				default: 'https://www.gnu.org/licenses/gpl-2.0.html'
			},
			{
				name: 'localServer',
				message: 'Local Server:',
				default: 'localhost'
			}
		] ).then( props => {
			this.opts = props;
		} );
	}

	configuring() {
		var done = this.async();
		var self = this;

		this.opts.projectSlug = this.opts.themeName.toLowerCase().replace( /[\s]/g, '-' ).replace( /[^0-9a-z-_]/g, '' ).replace( /[-_]+$/, '' );
		this.opts.generatorVersion = this.rootGeneratorVersion();

		fs.lstat( this.destinationPath( this.opts.projectSlug ), function( err, stats ) {
			if ( !err && stats.isDirectory() ) {
				self.log( '\n' + chalk.blue.bold( self.opts.themeName ) + ' already exists.\n' );
				self.prompt( [
					{
						type: 'confirm',
						name: 'overwrite',
						message: 'Overwrite "' + self.opts.projectSlug + '"?',
						default: false
					}
				] ).then( answer => {
					self.log( '' );

					if ( ! answer.overwrite ) {
						self.log( 'Close one! ' + chalk.red.bold( 'Generator aborted.' ) );
						process.exit();
					}

					done();
				} );
			}
		});

		this.destinationRoot( this.opts.projectSlug );
	}

	_processDirectory( source, destination, data ) {
		var files = glob.sync( '**', { cwd: source, dot: true, nodir: true } );

		for ( var i = 0; i < files.length; i++ ) {
			var file = files[i];
			var src = path.join( source, file );
			var dest;

			if ( path.basename( file ).indexOf( '_' ) === 0 ) {
				dest = path.join( destination, path.dirname( file ), path.basename( file ).replace( /^_/, '' ) );
				this.fs.copyTpl( src, dest, data );
			} else {
				dest = path.join( destination, file );
				this.fs.copy( src, dest );
			}
		}
	}

	writing() {
		// Theme Files
		this._processDirectory(
			this.templatePath( 'theme' ),
			this.destinationPath( '.' ),
			{ opts: this.opts }
		);

		this._processDirectory(
			this.templatePath( 'includes' ),
			this.destinationPath( 'includes' ),
			{ opts: this.opts }
		);

		this._processDirectory(
			this.templatePath( 'page-templates' ),
			this.destinationPath( 'page-templates' ),
			{ opts: this.opts }
		);

		this._processDirectory(
			this.templatePath( 'template-parts' ),
			this.destinationPath( 'template-parts' ),
			{ opts: this.opts }
		);

		this._processDirectory(
			this.templatePath( 'setup' ),
			this.destinationPath( 'setup' ),
			{ opts: this.opts }
		);

		this._processDirectory(
			this.templatePath( 'widgets' ),
			this.destinationPath( 'widgets' ),
			{ opts: this.opts }
		);

		// Project Files
		this._processDirectory(
			this.templatePath( 'project' ),
			this.destinationPath( '.' ),
			{ opts: this.opts }
		);

		// Assets
		this.fs.copyTpl(
			this.templatePath( 'assets/_style.scss' ),
			this.destinationPath( 'src/sass/' + this.opts.projectSlug + '.scss' ),
			{ opts: this.opts }
		);
		this.fs.copyTpl(
			this.templatePath( 'assets/_script.js' ),
			this.destinationPath( 'src/js/' + this.opts.projectSlug + '.js' ),
			{ opts: this.opts }
		);
		this.fs.copy(
			this.templatePath( 'assets/layouts' ),
			this.destinationPath( 'src/sass/layouts' )
		);
		this.fs.copy(
			this.templatePath( 'theme/screenshot.png' ),
			this.destinationPath( 'src/images/screenshot.png' )
		);
		// Bootstrap
		if ( this.opts.bootstrap ) {
			this.fs.copy(
				this.templatePath( 'assets/_bootstrap-*.scss' ),
				this.destinationPath( 'src/sass' )
			);
		}
	}

	install() {
		this.log( "\n\nI'm all done. Running " +
			chalk.yellow.bold( 'npm install' ) +
			' and ' +
			chalk.yellow.bold( 'composer install' ) +
			' for you to install the required dependencies. If this fails, try running the commands yourself.\n\n'
		);

		this.installDependencies( {
			skipMessage: true,
			bower: false
		} );

		this.spawnCommand( 'composer', ['install'] );
	}

	end() {
		this.log( '\n\nEverything is ready. ' + chalk.green.bold( 'ThemePlate!' ) + '\n\n' );
	}
};
