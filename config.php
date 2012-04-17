<?php
/**
 * Automatically includes classes
 * 
 * @throws Exception
 * 
 * @param  string $class_name  Name of the class to load
 * @return void
 */
 
define('TBL_USER', 'user');
define('TBL_ROLE','role');

define('TBL_BANNER', 'banner');
define('TBL_BANNER_REGION', 'bannerregion');

define('TBL_SECTION', 'section');

define('TBL_REGION', 'region');
define('TBL_RESOURCE','resource');
define('TBL_PERMISSION','permission');
define('TBL_CATEGORY','category');
define('TBL_USER_PERMISSION','userpermission');



fORM::mapClassToTable('Banner', 'banner');

fORM::mapClassToTable('BannerSection', 'bannersection');
fORM::mapClassToTable('Section', 'section');

fORM::mapClassToTable('Region', 'region');
fORM::mapClassToTable('Resource','resource');
fORM::mapClassToTable('EconomicUnitCategory','economic_unit_categories');
fORM::mapClassToTable('EconomicUnit','economic_units');
fORM::mapClassToTable('EconomicUnitHasCategory','economic_units_has_economic_unit_categories');
fORM::mapClassToTable('User',TBL_USER);
fORM::mapClassToTable('Role',TBL_ROLE);

fORM::mapClassToTable('Permission',TBL_PERMISSION);
fORM::mapClassToTable('Category',TBL_CATEGORY);
fORM::mapClassToTable('UserPermission',TBL_USER_PERMISSION);
fORM::mapClassToTable('Log','log');



/* Public Directories & Files */
define('SITE', 'http:'.DS.DS.$_SERVER['HTTP_HOST'].DS.'adminv3'.DS);
define('CSS',SITE.'css'.DS);
define('JS',SITE.'js'.DS);
define('SCRIPT',JS.'script'.DS);
define('HOME',SITE.'home'.DS);
define('BANNER',SITE.'banner'.DS);
define('GEOLOCATION', SITE.'geolocation'.DS);
define('USER',SITE.'user'.DS);
define('CATEGORIES',SITE.'categories'.DS);
define('LOGOUT',SITE.'logout'.DS);
define('LOGIN',SITE.'login'.DS);
define('IMAGES',SITE.'images'.DS);
define('ICON',IMAGES.'icon'.DS);

/* Private Directories & Files */
define('INCLUDES',ROOT.'includes'.DS);
define('LOAD',ROOT.'load'.DS);

/* Session */
define('SESSION_ID_USER','idUser');
define('SESSION_REGIONS','regions');

define('SALT','#^&(!)()');

$db = new fDatabase('mysql', 'adminv2n', 'root', 'Radamanthys');
fORMDatabase::attach($db);
fAuthorization::setLoginPage(SITE.'login.php');
fAuthorization::setAuthLevels(
	array(
		'super' => 100,
		'admin' => 80,
		'cliente' => 20,
		'adminUsers' => 80,
		'employee'  => 50,
		'guest' => 25
	)
);

$acceptedFiles = array(
	'image/gif',
	'image/bmp',
	'image/jpeg',
	'image/pjpeg',
	'image/png',
	'application/msword',
	'application/pdf',
	'application/vnd.ms-excel',
	'application/vnd.ms-powerpoint',
	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	'application/vnd.openxmlformats-officedocument.presentationml.presentation',
	'text/plain',
	'text/richtext',
	'text/html',
	'video/mpeg',
	'video/x-mpeg2',
	'video/msvideo',
	'video/quicktime',
	'video/vivo',
	'video/wavelet',
	'video/x-sgi-movie',
	'video/x-flv',
	'video/mp4',
	'audio/x-wav',
	'audio/x-mp3',
	'audio/midi'
);