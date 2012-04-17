<?php
		fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			if(empty($idUser) || !fAuthorization::checkACL('observatorio', 'delete')) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}

			$id = fRequest::encode('id','string');
			
				if(strstr($id, ",")) {
					fORMDatabase::retrieve()->query("DELETE FROM observatorio WHERE id_observatorio IN ($id)");
				} else {
				
					$f = new Observatorio($id);
					$f->delete();
				}
				
				//fORMDatabase::retrieve()->query("DELETE FROM resource WHERE id_entity = $id AND id_section = 10");
?>