<?php
class Region extends fActiveRecord {
	public static function findRegionName($id) {
		return fRecordSet::build(
			__CLASS__,
			array('id_region=' => $id)//,      // That are active
		);
	}
	
	public static function findAll($parent = 0) {
		return fRecordSet::build(
			__CLASS__,
			array('id_parent=' => $parent)//,      // That are active
		);
	}
	
	public static function getOne($id) {
		return fRecordSet::build(
			__CLASS__,
			array('id_region=' => $id)
		);
	}
}