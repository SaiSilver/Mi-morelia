<?php
class BannerSection extends fActiveRecord {
	// Return an iterable set of User objects
	public static function findAll() {
		return fRecordSet::build(
			__CLASS__//,                            // Make User objects
//			array('id_role=' => 1)//,      // That are active
			//array('date_registered' => 'desc') // Ordered by registration date
		);
	}
	
	public static function findName($id){
		$record = fRecordSet::build(
			__CLASS__,
			array("id_bannersection=" => $id)
		);
		
		return $record[0]->getName();
	}
}