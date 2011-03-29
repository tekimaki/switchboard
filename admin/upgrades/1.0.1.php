<?php
/**
 * @version $Header$
 */
global $gBitInstaller;

$infoHash = array(
	'package'      => SWITCHBOARD_PKG_NAME,
	'version'      => str_replace( '.php', '', basename( __FILE__ )),
	'description'  => "Add alternative message field to queue record to support plain and html formatted emails.",
	'post_upgrade' => NULL,
);

$gBitInstaller->registerPackageUpgrade( $infoHash, array(

array( 'DATADICT' => array(
	array( 'ALTER' => array(
		// insert new column
		'switchboard_queue' => array(
			'alt_message' => array( '`alt_message`', 'X' ),
			'subject' => array( '`subject`', 'X' ),
	))),
)),
array( 'QUERY' => array(
	'PGSQL' => array( "ALTER TABLE `".BIT_DB_PREFIX."switchboard_queue` ALTER COLUMN `message` TYPE TEXT" ),
	'SQL92' => array( "ALTER TABLE `".BIT_DB_PREFIX."switchboard_queue` ALTER COLUMN `message` TEXT" ),
)),
));
