var yeoman = require('yeoman-generator');
var async = require( 'async' );

var Generator = yeoman.generators.Base.extend({
	promptUser: function() {
		var done = this.async();
		var prompts = [
			{
				name: 'themeName',
				message: 'Theme Name:',
			},
			{
				name: 'themeURI',
				message: 'Theme URI:',
			},
			{
				name: 'author',
				message: 'Author:',
			},
			{
				name: 'authorURI',
				message: 'Author URI:',
			},
			{
				name: 'description',
				message: 'Description:',
			},
			{
				name: 'functionPrefix',
				message: 'Function Prefix:',
			}
		];
		this.prompt(prompts, function (props) {
			this.opts = props;
			done();
		}.bind(this));
	},
	theme: function() {
		this.template( '_style.css', 'style.css' );
		this.template( '_functions.php', 'functions.php' );
		this.template( '_index.php', 'index.php' );
		this.template( '_header.php', 'header.php' );
		this.template( '_footer.php', 'footer.php' );
	}
});

module.exports = Generator;
