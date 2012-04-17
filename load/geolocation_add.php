<?php
		fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
		/*	if(empty($idUser) || !fAuthorization::checkACL('franchise', 'add')) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}*/
	$av = new Observatorio();
	$av->setDescription(fRequest::encode('text','string'));
	$av->setId_region(fRequest::encode('region','integer'));
	$av->setCreatedAt(date('Y-m-d H:m:s'));
	$av->setTitle(fRequest::encode('title','string'));
	$av->setStatus(fRequest::encode('status','integer'));
	
	try { $av->store(); } catch (Exception $e){
					exit ("Ha ocurrido un error." .$e->getMessage());
				}
	exit("1");
?>