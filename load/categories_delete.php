<?php
fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			if(empty($idUser) || !fAuthorization::checkAuthLevel("employee")) {
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
$id = fRequest::encode('id','string');
if(strstr($id, ",")) {
	fORMDatabase::retrieve()->query("DELETE FROM category WHERE id_category IN ($id)");
} else {
		
	fORMDatabase::retrieve()->query("DELETE FROM category WHERE id_category IN ($id)");
}
			
?>