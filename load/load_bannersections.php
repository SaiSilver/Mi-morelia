<?php
fSession::open();
$idUser = fSession::get(SESSION_ID_USER);
if (empty($idUser)) {
	header('Location: '.SITE);
	exit("No se ha podido acceder a esta secci&oacute;n");
}

$where = " WHERE id_parent = 0 ";
$sections = fRecordSet::buildFromSQL(
	'BannerSection',
	"SELECT * FROM bannersection $where"
);

if ($sections->count() > 0) {
	foreach ($sections as $section) 
		echo '<option value="'.$section->prepareIdBannersection().'">'.$section->prepareName().'</option>';
} else		
	echo '<option value="0">No hay Secciones</option>';
?>