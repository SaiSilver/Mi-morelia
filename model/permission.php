<?php
class Permission extends fActiveRecord {
	// Return an iterable set of User objects
	public static function findActive() {
		return fRecordSet::build(
			__CLASS__//,                            // Make User objects
//			array('id_role=' => 1)//,      // That are active
			//array('date_registered' => 'desc') // Ordered by registration date
		);
	}
	
	public static function getByIdSection($id_section) {
		return fRecordSet::build(
			__CLASS__,
			array('id_section=' => $id_section)
		);
	}
	
	public static function getOne($id_permission) {
		return fRecordSet::build(
			__CLASS__,
			array('id_permission=' => $id_permission)
		);
	}
}