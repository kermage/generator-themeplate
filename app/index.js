var yeoman = require( 'yeoman-generator' );
var async = require( 'async' );

var Generator = yeoman.generators.Base.extend({
	promptUser: function() {
		var done = this.async();
		var prompts = [
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
			},			{
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
				default: 'A Wordpress Starter Theme'
			},
			{
				name: 'functionPrefix',
				message: 'Function Prefix:',
				default: 'themeplate'
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
		];
		this.prompt( prompts, function ( props ) {
			this.opts = props;
			this.opts.projectSlug = this.opts.themeName.toLowerCase().replace( /[\s]/g, '-' );
			done();
		}.bind( this ));
	},
	theme: function() {
		this.template( '_style.css', 'style.css' );
		this.template( '_functions.php', 'functions.php' );
		this.template( '_index.php', 'index.php' );
		this.template( '_header.php', 'header.php' );
		this.template( '_footer.php', 'footer.php' );
	},
	project: function() {
		this.template( '_package.json', 'package.json' );
		this.template( '_gulpfile.js', 'gulpfile.js' );
		this.template( '_bower.json', 'bower.json' );
	},
	style: function() {
		this.template( '_style.scss', 'assets/sass/' + this.opts.projectSlug + '.scss' );
	}
});

module.exports = Generator;
