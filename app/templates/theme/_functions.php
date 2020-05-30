<?php

/**
 * <%= opts.projectName %> functions and definitions
 *
 * @package <%= opts.projectName %>
 * @since 0.1.0
 */

/* generator-themeplate v<%= opts.generatorVersion %> */

/*
 * ==================================================
 * Global constants
 * ==================================================
 */
// phpcs:disable Generic.Functions.FunctionCallArgumentSpacing.TooMuchSpaceAfterComma
define( '<%= opts.constantPrefix %>_THEME_BASE',  basename( __DIR__ ) );
define( '<%= opts.constantPrefix %>_THEME_URL',   get_theme_root_uri( basename( __DIR__ ) ) . '/' . basename( __DIR__ ) . '/' );
define( '<%= opts.constantPrefix %>_THEME_PATH',  get_theme_root( basename( __DIR__ ) ) . '/' . basename( __DIR__ ) . '/' );
define( '<%= opts.constantPrefix %>_THEME_DEBUG', true );
// phpcs:enable

// Better move this folder (<%= opts.projectSlug %>) to the plugins directory, then remove these lines after
require_once '<%= opts.projectSlug %>/<%= opts.projectSlug %>.php';


/*
 * ==================================================
 * Setup Theme
 * ==================================================
 */

require_once 'setup/features.php';
require_once 'setup/navigations.php';
require_once 'setup/widgets.php';
require_once 'setup/scripts-styles.php';
require_once 'setup/actions-filters.php';


/*
 * ==================================================
 * Extra custom functions
 * ==================================================
 */

