<?php
fSession::open();
$idUser = fSession::get(SESSION_ID_USER);
if(empty($idUser)) {
	header('Location: '.SITE);
	exit("No se ha podido acceder a esta secci&oacite;n");
}
$id = fRequest::encode('id','string');
if(strstr($id, ",")) {
	fORMDatabase::retrieve()->query("DELETE FROM bannersection WHERE id_bannersection IN ($id)");
} else {
		
	$bannersection = new BannerSection($id);
	$bannersection->delete();
}
?>