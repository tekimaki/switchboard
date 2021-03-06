<?php

global $gBitSystem;

$gBitSystem->registerPackageInfo( SWITCHBOARD_PKG_NAME, array(
	'description' => "Switchboard is a general service package for enhancing how packages can route messages in the system.",
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
) );

// Install process
// Package requirements
$gBitSystem->registerRequirements( LANGUAGES_PKG_NAME, array(
	'liberty'   => array( 'min' => '2.1.4' ),
	'users'     => array( 'min' => '2.1.0' ),
	'kernel'    => array( 'min' => '2.0.0' ),
	'themes'    => array( 'min' => '2.0.0' ),
));

global $gBitInstaller;
if( is_object( $gBitInstaller ) ){

$tables = array(
	'switchboard_prefs' => "
		package C(128) NOTNULL,
		event_type C(128) NOTNULL,
		user_id I4 NOTNULL,
		content_id I4,
		delivery_style C(64) NOTNULL
		CONSTRAINT '
			, CONSTRAINT `switchboard_prefs_content_ref` FOREIGN KEY (`content_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content` (`content_id`)
			, CONSTRAINT `switchboard_prfs_user_ref` FOREIGN KEY (`user_id`) REFERENCES `".BIT_DB_PREFIX."users_users` (`user_id`) '
	",

	"switchboard_queue" => "
		message_id I4 PRIMARY,
		package C(128) NOTNULL,
		event_type C(128) NOTNULL,
		content_id I4,
		sending_user_id I4,
		queue_date I8 NOTNULL,
  		complete_date I8,
		message X NOTNULL
		CONSTRAINT '
			, CONSTRAINT `switchboard_queue_content_ref` FOREIGN KEY (`content_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content` (`content_id`)
			, CONSTRAINT `switchboard_queue_user_ref` FOREIGN KEY (`sending_user_id`) REFERENCES `".BIT_DB_PREFIX."users_users` (`user_id`) '
	",

	"switchboard_recipients" => "
		message_id I4 PRIMARY,
		user_id I4 PRIMARY,
		delivery_style C(64) NOTNULL
		CONSTRAINT '
			, CONSTRAINT `switchboard_recipients_m_ref` FOREIGN KEY (`message_id`) REFERENCES `".BIT_DB_PREFIX."switchboard_queue` (`message_id`)
			, CONSTRAINT `switchboard_recipients_usr_ref` FOREIGN KEY (`user_id`) REFERENCES `".BIT_DB_PREFIX."users_users` (`user_id`) '
	",
);

foreach( array_keys( $tables ) AS $tableName ) {
	$gBitInstaller->registerSchemaTable( SWITCHBOARD_PKG_NAME, $tableName, $tables[$tableName] );
}

$gBitInstaller->registerPackageVersion( SWITCHBOARD_PKG_NAME, '1.0.0' );

$sequences = array (
	'switchboard_queue_id_seq' => array( 'start' => 1 )
);
$gBitInstaller->registerSchemaSequences( SWITCHBOARD_PKG_NAME, $sequences );

$indices = array(
	'switchboard_prefs_pkg_idx' => array( 'table' => 'switchboard_prefs', 'cols' => 'package', 'opts' => NULL ),
	'switchboard_prefs_type_idx' => array( 'table' => 'switchboard_prefs', 'cols' => 'event_type', 'opts' => NULL ),
	'switchboard_prefs_user_idx' => array( 'table' => 'switchboard_prefs', 'cols' => 'user_id', 'opts' => NULL ),
	'switchboard_prefs_content_idx' => array( 'table' => 'switchboard_prefs', 'cols' => 'content_id', 'opts' => NULL ),
	);
$gBitInstaller->registerSchemaIndexes( SWITCHBOARD_PKG_NAME, $indices );

$gBitInstaller->registerPreferences( SWITCHBOARD_PKG_NAME, array(
	array( SWITCHBOARD_PKG_NAME, 'switchboard_default_transport','email'),
) );

}
