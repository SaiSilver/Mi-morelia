<?php
		fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			if(empty($idUser) || !fAuthorization::checkACL('user', 'edit')) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
$id = fRequest::encode('id','integer');
if(empty($id)) exit();
$u = new User($id);

$p = fRequest::encode('password','string');
if(!empty($p)) {
	$p = md5($p.SALT);
	$p = base64_encode($p);
	$p = hash('sha256',$p);
	$u->setPassword($p);
}

$u->setIdRole(fRequest::encode('role','integer'));
$u->setEmail(fRequest::encode('email','string'));
$u->setFirstName(fRequest::encode('firstName','string'));
$u->setLastName(fRequest::encode('lastName','string'));
$u->setBirthday(fRequest::encode('birthday','date'));
$u->setPhone(fRequest::encode('phone','string'));
$u->setCellphone(fRequest::encode('cellphone','string'));
$u->setNextel(fRequest::encode('nextel','string'));
$u->setFax(fRequest::encode('fax','string'));
$u->setAddress(fRequest::encode('address','string'));

try {
	$u->store();
} catch(Exception $e) {
	die('El correo electrónico ya está asociado con una cuenta');
}

try {
	$regions = array_unique(fRequest::encode('region','array'));
	$permissions = array_unique(fRequest::encode('permission','array'));

	$ur = new UserRegion();
	$userRegions = $ur->getByIdUser($u->getIdUser());
	foreach($userRegions as $item) {
		$ur = new UserRegion(array(
			'id_user' => $u->getIdUser(),
			'id_region' => $item->getIdRegion()
		));
		$ur->delete();
	}

	$up = new UserPermission();
	$userPermissions = $up->getByIdUser($u->getIdUser());
	foreach($userPermissions as $item) {
		$up = new UserPermission(array(
			'id_user' => $u->getIdUser(),
			'id_permission' => $item->getIdPermission()
		));
		$up->delete();
	}

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