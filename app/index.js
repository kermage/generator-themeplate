'use strict';
var Generator = require( 'yeoman-generator' );
var fs = require( 'fs' );
var path = require( 'path' );
var glob = require( 'glob' );

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
				default: 'http://wordpress.org/themes'
			},
			{
				name: 'authorName',
				message: 'Author:',
				default: this.user.git.name
			},          {
				name: 'authorEmail',
				message: 'Author Email:',
				default: this.user.git.email
			},
			{
				name: 'authorURI',
				message: 'Author URI:'
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
					return answer.themeName.toLowerCase().replace( /[\s-]/g, '_' ).replace( /[^0-9a-z_]/g, '' );
				}
			},
			{
				name: 'classPrefix',
				message: 'Class Prefix:',
				default: function( answer ) {
					return answer.themeName.replace( /[\s-]/g, '_' ).replace( /[^0-9a-zA-Z_]/g, '' );
				}
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
				default: 'GNU General Public License v2 or later'
			},
			{
				name: 'licenseURI',
				message: 'License URI:',
				default: 'http://www.gnu.org/licenses/gpl-2.0.html'
			}
		] ).then( props => {
			this.opts = props;
		} );
	}

	configuring() {
		var done = this.async();

		this.opts.projectSlug = this.opts.themeName.toLowerCase().replace( /[\s]/g, '-' ).replace( /[^0-9a-z-_]/g, '' );

		fs.lstat( this.destinationPath( this.opts.projectSlug ), function( err, stats ) {
			if ( !err && stats.isDirectory() ) {
				console.log( '\nTheme already exists. Exiting!' );
				process.exit();
			}
		});

		this.destinationRoot( this.opts.projectSlug );
		done();
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

		// Project Files
		this._processDirectory(
			this.templatePath( 'project' ),
			this.destinationPath( '.' ),
			{ opts: this.opts }
		);

		// Assets
		this.fs.copyTpl(
			this.templatePath( 'assets/_style.scss' ),
			this.destinationPath( 'assets/sass/' + this.opts.projectSlug + '.scss' ),
			{ opts: this.opts }
		);
		this.fs.copyTpl(
			this.templatePath( 'assets/_script.js' ),
			this.destinationPath( 'assets/js/' + this.opts.projectSlug + '.js' ),
			{ opts: this.opts }
		);
		this.fs.copy(
			this.templatePath( 'assets/layouts' ),
			this.destinationPath( 'assets/sass/layouts' )
		);
		this.fs.copyTpl(
			this.templatePath( 'assets/_metabox.css' ),
			this.destinationPath( 'css/admin/metabox.css' ),
			{ opts: this.opts }
		);
		this.fs.copyTpl(
			this.templatePath( 'assets/_metabox.js' ),
			this.destinationPath( 'js/admin/metabox.js' ),
			{ opts: this.opts }
		);
		// Bootstrap
		if ( this.opts.bootstrap ) {
			this.fs.copy(
				this.templatePath( 'assets/_bootstrap-*.scss' ),
				this.destinationPath( 'assets/sass' )
			);
		}
	}

	install() {
		this.installDependencies( {
			bower: false
		} );
	}
};
