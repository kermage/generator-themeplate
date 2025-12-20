import chalk from 'chalk';
import fs from 'fs';
import path from 'path';
import Generator from 'yeoman-generator';

export default class extends Generator {
	async initializing() {
		try {
			fs.lstatSync( this.destinationPath( 'themes' ) );
			fs.lstatSync( this.destinationPath( 'plugins' ) );
		} catch {
			this.log( `\nLooks like we are not in the ${ chalk.blue.bold( 'WP_CONTENT_DIR' ) }. ${ chalk.red.bold( 'Generator aborted.' ) }` );
			process.exit();
		}
	}

	async prompting() {
		this.opts = await this.prompt( [
			{
				name: 'projectName',
				message: 'Project Name:',
				default: 'ThemePlate'
			},
			{
				name: 'projectURI',
				message: 'Project URI:',
				default: 'https://github.com/kermage/generator-themeplate'
			},
			{
				name: 'authorName',
				message: 'Author:',
				default: await this.git.name()
			},
			{
				name: 'authorEmail',
				message: 'Author Email:',
				default: await this.git.email(),
				validate: function( answer ) {
					answer = answer.trim();

					if ( ! answer ) {
						return 'Author email is required.';
					}

					return answer.includes( '@' ) || 'Author email must contain @.';
				},
				filter: function( answer ) {
					return answer.trim();
				}
			},
			{
				name: 'authorURI',
				message: 'Author URI:',
				default: function( answer ) {
					return 'mailto:' + answer.authorEmail;
				},
				validate: function( answer ) {
					answer = answer.trim();

					if ( ! answer ) {
						return 'Author URI is required.';
					}

					try {
						new URL( answer );
					} catch {
						return 'Author URI must be an absolute URI, such as https://example.com or mailto:you@example.com.';
					}

					return true;
				},
				filter: function( answer ) {
					return answer.trim();
				}
			},
			{
				name: 'description',
				message: 'Description:',
				default: function( answer ) {
					return 'A ThemePlate project for ' + answer.projectName;
				}
			},
			{
				name: 'functionPrefix',
				message: 'Function Prefix:',
				default: function( answer ) {
					return answer.projectName.toLowerCase().replace( /[\s-]/g, '_' ).replace( /[^0-9a-z_]/g, '' ).replace( /_+$/, '' );
				},
				filter: function( answer ) {
					return answer.toLowerCase().replace( /[\s-]/g, '_' ).replace( /[^0-9a-z_]/g, '' ).replace( /_+$/, '' );
				}
			},
			{
				name: 'classPrefix',
				message: 'Class Prefix:',
				default: function( answer ) {
					return answer.projectName.replace( /[\s-]/g, '_' ).replace( /[^0-9a-zA-Z_]/g, '' ).replace( /_+$/, '' );
				},
				filter: function( answer ) {
					return answer.replace( /[\s-]/g, '_' ).replace( /[^0-9a-zA-Z_]/g, '' ).replace( /_+$/, '' );
				}
			},
			{
				name: 'constantPrefix',
				message: 'Constant Prefix:',
				default: function( answer ) {
					return answer.projectName.toUpperCase().replace( /[\s-]/g, '_' ).replace( /[^0-9a-zA-Z_]/g, '' ).replace( /_+$/, '' );
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
		] );
	}

	async configuring() {
		this.opts.projectSlug = this.opts.projectName.toLowerCase().replace( /[\s]/g, '-' ).replace( /[^0-9a-z-_]/g, '' ).replace( /[-_]+$/, '' );
		this.opts.classSlug = this.opts.classPrefix.toLowerCase().replace( /_/g, '-' );
		this.opts.generatorVersion = this.rootGeneratorVersion();

		try {
			if (
				fs.lstatSync( this.destinationPath( path.join( 'themes', this.opts.projectSlug ) ) ).isDirectory() ||
				fs.lstatSync( this.destinationPath( path.join( 'plugins', this.opts.projectSlug ) ) ).isDirectory()
			) {
				this.log( '\n' + chalk.blue.bold( this.opts.projectName ) + ' project already exists.\n' );
				await this.prompt( [
					{
						type: 'confirm',
						name: 'overwrite',
						message: 'Overwrite "' + this.opts.projectSlug + '"?',
						default: false
					}
				] ).then( answer => {
					this.log( '' );

					if ( ! answer.overwrite ) {
						this.log( 'Close one! ' + chalk.red.bold( 'Generator aborted.' ) );
						process.exit();
					}
				} );
			}
		} catch {}
	}

	_processDirectory( source, destination, data ) {
		fs.readdirSync( source, { recursive: true } ).forEach( file => {
			var src = path.join( source, file );
			var dest = path.join( destination, file );

			if ( fs.statSync( src ).isDirectory() ) {
				return this._processDirectory( src, dest, data );
			}

			if ( path.basename( file ).indexOf( '_' ) === 0 ) {
				dest = path.join( destination, path.dirname( file ), path.basename( file ).replace( /^_/, '' ) );
				this.fs.copyTpl( src, dest, data );
			} else {
				this.fs.copy( src, dest );
			}
		} )
	}

	writing() {
		this.destinationRoot( path.join( 'themes', this.opts.projectSlug ) );

		// Theme Files
		this._processDirectory(
			this.templatePath( 'theme' ),
			this.destinationPath( '.' ),
			{ opts: this.opts }
		);
		this.fs.move(
			this.destinationPath( 'includes/class-clean-navbar.php' ),
			this.destinationPath( 'includes/class-' + this.opts.classSlug + '-clean-navbar.php' )
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
			this.templatePath( 'assets/_script.ts' ),
			this.destinationPath( 'src/js/' + this.opts.projectSlug + '.ts' ),
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

		this.fs.copy(
			this.templatePath( 'assets/tailwind.config.js' ),
			this.destinationPath( 'tailwind.config.js' ),
		);

		this.themeRoot = this.destinationRoot();
		this.destinationRoot( path.join( 'plugins', this.opts.projectSlug ) );

		// Plugin Files
		this._processDirectory(
			this.templatePath( 'plugin' ),
			this.destinationPath( '.' ),
			{ opts: this.opts }
		);
		this.fs.move(
			this.destinationPath( 'functions.php' ),
			this.destinationPath( this.opts.projectSlug + '.php' )
		);
	}

	install() {
		const commands = [
			['composer', ['install']],
			['pnpm', ['install']]
		];

		this.log( "\n\nI'm all done. Running " +
			commands.map( ( [ command, args ] ) => chalk.yellow.bold( [ command, ...args ].join( ' ' ) ) ).join( ' and ' ) +
			' for you to install the required dependencies. If this fails, try running the commands yourself in ' +
			chalk.blue.bold( this.themeRoot ) +
			'.\n\n'
		);

		commands.forEach( ( [ command, args ] ) => this.spawnSync( command, args, { cwd: this.themeRoot } ) );
	}

	end() {
		this.log( '\n\nEverything is ready. ' + chalk.green.bold( 'ThemePlate!' ) + '\n\n' );
	}
};
