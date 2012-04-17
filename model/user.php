<?php
class User extends fActiveRecord {
	// Return an iterable set of User objects
	public static function findActive($idRole = 1) {
		return fRecordSet::build(
			__CLASS__,                            // Make User objects
			array('id_role=' => $idRole)//,      // That are active
			//array('date_registered' => 'desc') // Ordered by registration date
		);
	}
	
	public static function getAll() {
		return fRecordSet::build(
			__CLASS__
		);
	}
	
	public static function getByEmail($email,$region) {
		$region = implode(",",$region);
		
		return fRecordSet::buildFromSQL(
			__CLASS__,
			"SELECT * FROM user WHERE id_user IN (SELECT id_user FROM userregion WHERE id_region IN ($region))"
		);
	}
	
	public static function getByRoleAndEmail($id_role,$email, $region) {
	$region = implode(",",$region);
	
		return fRecordSet::buildFromSQL(
			__CLASS__,
			"SELECT * FROM user WHERE  id_role = $id_role AND id_user IN (SELECT id_user FROM userregion WHERE id_region IN ($region))"
		); 
	}
	
	public static function getByEmailSup($email) {
		return fRecordSet::build(
			__CLASS__,
			array('email~' => $email)
		);
	}
	
	public static function getByRoleAndEmailSup($id_role,$email) {
		return fRecordSet::build(
			__CLASS__,
			array(
				'id_role=' => $id_role,
				'email~' => $email
			)
		);
	}
}