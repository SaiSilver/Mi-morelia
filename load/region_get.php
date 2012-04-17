<?php
$r = new Region();
$tmp = $r->findAll(fRequest::encode('region'));
$regions = array();
if(!empty($tmp))
	foreach($tmp as $item)
		$regions[] = array('id_region' => $item->prepareIdRegion(),'name' => $item->prepareName());
die(json_encode($regions));