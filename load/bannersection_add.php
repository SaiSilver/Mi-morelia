<?php
fSession::open();
$idUser = fSession::get(SESSION_ID_USER);
if (empty($idUser)) {
	header('Location: '.SITE);
	exit("No se ha podido acceder a esta secci&oacute;n");
}

try {
	$bannersection = new BannerSection();
	if (fRequest::encode('zone', 'integer') == 1)
		$bannersection->setIdParent(fRequest::encode('id_section', 'integer'));
	else
		$bannersection->setIdParent(0);
	$bannersection->setName(fRequest::encode('name', 'string'));
	$bannersection->store();
} catch (Exception $e) {
	die('Ha ocurrido un error. '.$e->getMessage());
}	
die('1');
?>