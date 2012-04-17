<?php
		fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			if(empty($idUser) || !fAuthorization::checkACL('observatorio', 'edit')) {
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
	$id = fRequest::encode('id','integer');
	if(empty($id)) exit("Ha ocurrido un error");
	if(!fAuthorization::checkAuthLevel('super')) {
				$isOwner = fRecordSet::build('Observatorio', array('id_observatorio=' => $id, 'id_region='=>fSession::get('regs')));
				$count = $isOwner->count() > 0;
			
				if(!$count) 
					exit("0");
	}
	
	$av = new Observatorio($id);
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