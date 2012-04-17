<?php
		fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			//if(empty($idUser) || !fAuthorization::checkACL('banner', 'delete')) {
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}

			$id = fRequest::encode('id','string');
			
				if(strstr($id, ",")) {
					fORMDatabase::retrieve()->query("DELETE FROM banner WHERE id_banner IN ($id)");
				
				} else {
				
					$banner = new Banner($id);
					$banner->delete();
				}
				fORMDatabase::retrieve()->query("DELETE FROM bannerregion WHERE id_banner IN ($id)");
				fORMDatabase::retrieve()->query("DELETE FROM resource WHERE id_entity IN ($id) AND id_section = 1");
?>