<?php
		fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			//if(empty($idUser) || !fAuthorization::checkACL('user', 'delete')) {
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
$id = fRequest::encode('id','integer');
if(empty($id)) exit();
try {
	$u = new User($id);
	$up = new UserPermission();
	
	$userPermissions = $up->getByIdUser($u->getIdUser());
	foreach($userPermissions as $item) {
		if(!empty($item) && $item != 'null') {
			$up = new UserPermission(array(
				'id_user' => $u->getIdUser(),
				'id_permission' => $item->getIdPermission()
			));
			$up->delete();
		}
	}
	$u->delete();
} catch(Exception $e) {
	die($e->getMessage());
}
die('1');