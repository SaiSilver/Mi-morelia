<?php
fSession::open();
$idUser = fSession::get(SESSION_ID_USER);
if (empty($idUser)) {
	header('Location: '.SITE);
	exit("No se ha podido acceder a esta secci&oacute;n");
}

$id = fRequest::encode('id_bannersection', 'integer');

if(!fAuthorization::checkAuthLevel('super')) {
				$isOwner = fRecordSet::build('BannerSection', array('id_bannersection=' => $id_bannersection));
				$count = $isOwner->count() > 0;
			
				if(!$count) 
					exit("0");
	}
	
try {
	
	$bannersection = new BannerSection($id);
	$bannersection->setName(fRequest::encode('name', 'string'));
	$bannersection->store();
} catch (Exception $e) {
	die('Ha ocurrido un error. '.$e->getMessage());
}	
die('1');
?>