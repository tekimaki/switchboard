<?php
global $gShellScript;
$gShellScript = TRUE;

/**
 * required setup
 */
if( !empty( $argc ) ) {
	$_SERVER["SERVER_NAME"] = '';
	// reduce feedback for command line to keep log noise way down
	define( 'BIT_PHP_ERROR_REPORTING', E_ALL ^ E_NOTICE ^ E_WARNING );
}

// running from cron can cause us not to be in the right dir.
chdir( dirname( __FILE__ ) );
require_once( '../../kernel/setup_inc.php' );

if( empty( $argc ) && !$gBitUser->isAdmin() ) {
	$gBitSystem->fatalError( tra( 'You do not have permission to access this page.' ));
} 

if( $gBitSystem->isPackageActive( 'switchboard' ) ) {
	global $gSwitchboardSystem;
	if( $gSwitchboardSystem->tendQueue() )
	{
		print tra( "Switchboard queue successfully processed" ).PHP_EOL;
	}else{
		print tra( "Switchboard queue processing failed. See server error log." ).PHP_EOL;
	}
}
