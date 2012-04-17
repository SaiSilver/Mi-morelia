<?php
class UserPermission extends fActiveRecord {
	// Return an iterable set of User objects
	public static function getByIdUser($id_user) {
		return fRecordSet::build(
			__CLASS__,                            // Make User objects
			array('id_user=' => $id_user)//,      // That are active
			//array('date_registered' => 'desc') // Ordered by registration date
		);
	}
}