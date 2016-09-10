var yeoman = require( 'yeoman-generator' );
var async = require( 'async' );
var fs = require( 'fs' );

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
            this.opts.projectSlug = this.opts.themeName.toLowerCase().replace( /[\s]/g, '-' ).replace( /[^0-9a-z-_]/g, '' );
            
            fs.lstat( this.destinationPath( this.opts.projectSlug ), function( err, stats ) {
                if ( !err && stats.isDirectory() ) {
                    console.log( '\nTheme already exists. Exiting!' );
                    process.exit();
                }
            });
            
            this.destinationRoot( this.opts.projectSlug );
            done();
        }.bind( this ));
    },
    theme: function() {
        this.copy( 'theme/_screenshot.png', 'screenshot.png' );
        this.template( 'theme/_style.css', 'style.css' );
        this.template( 'theme/_functions.php', 'functions.php' );
        this.template( 'theme/_index.php', 'index.php' );
        this.template( 'theme/_header.php', 'header.php' );
        this.template( 'theme/_footer.php', 'footer.php' );
        this.template( 'theme/_sidebar.php', 'sidebar.php' );
        this.template( 'theme/_sidebar-footer.php', 'sidebar-footer.php' );
        this.template( 'theme/_page.php', 'page.php' );
        this.template( 'theme/_single.php', 'single.php' );
        
        this.template( 'theme/templates/_fullwidth-page.php', 'templates/fullwidth-page.php' );
        
        this.template( 'theme/inc/theme/_features.php', 'inc/theme/features.php' );
        this.template( 'theme/inc/theme/_navigations.php', 'inc/theme/navigations.php' );
        this.template( 'theme/inc/theme/_widgets.php', 'inc/theme/widgets.php' );
        
        this.template( 'theme/inc/widgets/_about_widget.php', 'inc/widgets/' + this.opts.classPrefix + '_about_widget.php' );
        this.template( 'theme/inc/widgets/_contact_widget.php', 'inc/widgets/' + this.opts.classPrefix + '_contact_widget.php' );
        
        this.template( 'theme/inc/settings/_setup.php', 'inc/settings/setup.php' );
        this.template( 'theme/inc/settings/_entries.php', 'inc/settings/entries.php' );
        
        this.template( 'theme/inc/post-type/_posts.php', 'inc/post-type/posts.php' );
        this.template( 'theme/inc/post-type/_taxonomies.php', 'inc/post-type/taxonomies.php' );
        
        this.template( 'theme/inc/meta-box/_setup.php', 'inc/meta-box/setup.php' );
        this.template( 'theme/inc/meta-box/_entries.php', 'inc/meta-box/entries.php' );
        
        this.template( 'theme/inc/_cleanup.php', 'inc/cleanup.php' );
        this.template( 'theme/inc/_scripts-styles.php', 'inc/scripts-styles.php' );
    },
    project: function() {
        this.template( 'project/_package.json', 'package.json' );
        this.template( 'project/_gulpfile.js', 'gulpfile.js' );
        this.template( 'project/_bower.json', 'bower.json' );
    },
    style: function() {
        this.template( 'assets/_style.scss', 'assets/sass/' + this.opts.projectSlug + '.scss' );
        this.directory( 'assets/layouts', 'assets/sass/layouts' );
        this.template( 'assets/_metabox.css', 'css/admin/metabox.css' );
    },
    script: function() {
        this.template( 'assets/_script.js', 'assets/js/' + this.opts.projectSlug + '.js' );
        this.template( 'assets/_metabox.js', 'js/admin/metabox.js' );
    },
    install: function() {
        this.installDependencies();
    }
});

module.exports = Generator;
