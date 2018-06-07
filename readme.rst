###################
ABOUT THE PROJECT
###################

A sample test Algorithm to debit a TELCO network.

*******************
Release Information
*******************
A test/ Demo version

**************************
Changelog and New Features
**************************


*******************
Server Requirements
*******************

PHP 7.0 +

************
Installation
************
Find the sample database in the folder network_billing/sample_database

visit the file network_billing/application/config/config.php
 - change the line $config['base_url'] = '(path_of_file)';

visit the file network_billing/application/config/database.php
 - change the lines respectively :

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'hostname',
	'username' => 'username',
	'password' => 'password',
	'database' => 'testtelco',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);


*******
License
*******
