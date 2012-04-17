<?php
class Role extends fActiveRecord {
	public static function getAll() {
		return fRecordSet::build(
			__CLASS__,
			null,
			array('name' => 'asc')
		);
	}
	
	public static function getRole($id_role) {
		return fRecordSet::build(
			__CLASS__,
			array('id_role=' => $id_role)
		);
	}
}