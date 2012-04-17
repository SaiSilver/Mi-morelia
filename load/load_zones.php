<?php
fSession::open();
$idUser = fSession::get(SESSION_ID_USER);
if (empty($idUser)) {
	header('Location: '.SITE);
	exit("No se ha podido acceder a esta secci&oacute;n");
}

$id_parent = fRequest::encode('id_parent', 'integer') > 0 ? fRequest::encode('id_parent', 'integer') : -1;
$zones = fRecordSet::buildFromSQL(
	'BannerSection',
	"SELECT * FROM bannersection WHERE id_parent = $id_parent ORDER BY name"
);

if ($zones->count() > 0) { 
	foreach ($zones as $zone) 
		echo '<option value="'.$zone->prepareIdBannersection().'">'.$zone->prepareName().'</option>';
} else		
	echo '<option value="0"> Selecciona una zona </option>';
die('1');
?>