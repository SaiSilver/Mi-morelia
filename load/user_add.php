<?php
		fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			if(empty($idUser) || !fAuthorization::checkACL('user', 'add')) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
$u = new User();

$p = fRequest::encode('password','string').SALT;
$p = md5($p);
$p = base64_encode($p);
$p = hash('sha256',$p);

try {
	$u->setIdRole(fRequest::encode('role','integer'));
	$u->setEmail(fRequest::encode('email','string'));
	$u->setPassword($p);
	$u->setFirstName(fRequest::encode('firstName','string'));
	$u->setLastName(fRequest::encode('lastName','string'));
	$u->setBirthday(fRequest::encode('birthday','date'));
	$u->setPhone(fRequest::encode('phone','string'));
	$u->setCellphone(fRequest::encode('cellphone','string'));
	$u->setNextel(fRequest::encode('nextel','string'));
	$u->setNextel(fRequest::encode('fax','string'));
	$u->setNextel(fRequest::encode('address','string'));
	$u->store();
} catch(Exception $e) {
	die('El correo electrónico ya está asociado con una cuenta'.$e->getMessage());
}

$regions = array_unique(fRequest::encode('region','array'));
$permissions = array_unique(fRequest::encode('permission','array'));
try {
	foreach($regions as $item) {
		if(!empty($item) && $item != 'null') {
			$ur = new UserRegion();
			$ur->setIdUser($u->getIdUser());
			$ur->setIdRegion($item);
			$ur->store();
		}
	}
	foreach($permissions as $item) {
		if(!empty($item) && $item != 'null') {
			$up = new UserPermission();
			$up->setIdUser($u->getIdUser());
			$up->setIdPermission($item);
			$up->store();
		}
	}
} catch(Exception $e) {die($e->getMessage());}

die('1');