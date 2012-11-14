<?php

define('KOHANA_PROPEL_MODULE_PATH', realpath(__DIR__));
define('PROPEL_PATH', KOHANA_PROPEL_MODULE_PATH . '/vendor/propelorm/Propel/');

// load Propel
require_once PROPEL_PATH. '/runtime/lib/Propel.php';

// add include path
set_include_path(APPPATH.'classes');


/*
 * Set up Propel configuration as a non-project-specific array
 */

// this is where classmap file would be if it were generated
$classmapFilename = APPPATH.'config/propel/generated-classmap.php';

// if classmap file has been generated, include it in configuration
$classmap = file_exists($classmapFilename)
	? include($classmapFilename)
	: null;

$propelRuntimeConfiguration = array(
	'propel' => array(
		'datasources' => array(),
		'default' => 'default', // default connection name

		// following two were transferred from Propel-generated config file
		'classmap' => $classmap,
		'generator_version' => '1.6.4-dev'
	)
);


/*
 * Copy Kohana's database config into the Propel configuration array
 */

// get configuration:
// KO3.2: Kohana::$config->load('database')->as_array(), no DSN; DSN=mysql:host=HOST;dbname=DB
// KO3.0, 3.1? : Kohana::config('database')->as_array(), has DSN

/*
 * Loop through Kohana's defined database connections, transform each into Propel's configuration
 * format
 */

foreach (Kohana::$config->load( 'database' )->as_array() as $connectionName=>$connectionDetails) {

	$connectionType = $connectionDetails['type'];
	
	// throw exception if type is not mysql
	if ($connectionType != "mysql") throw new \Exception("Database types other than MySQL are not yet supported");
	
	// if DSN set, use it, if not, assemble it
	$connectionDsn = isset($connectionDetails['connection']['dsn'])
		? $connectionDetails['connection']['dsn']
		: sprintf(
			"%s:host=%s;dbname=%s",
			$connectionDetails['type'],
			$connectionDetails['connection']['hostname'],
			$connectionDetails['connection']['database']
		)
	;
	
	$connectionCharset = $connectionDetails['charset'];
	$connectionUsername = $connectionDetails['connection']['username'];
	$connectionPassword = $connectionDetails['connection']['password'];

	// Save transformed connection configuration into array
	$propelRuntimeConfiguration['propel']['datasources'][$connectionName] = array(
		'adapter' => $connectionType,
		'connection' => array(
			'dsn' => $connectionDsn,
			'user' => $connectionUsername,
			'password' => $connectionPassword,
			'settings' => array(
				'charset' => array(
					'value' => $connectionCharset
				)
			)
		)
	);
	
}


/*
 * Configure and start Propel
 */

Propel::setConfiguration($propelRuntimeConfiguration);
Propel::initialize();
