<?php
class Section extends fActiveRecord {
	public static function findAll() {
		return fRecordSet::build(__CLASS__);
	}
	
	public static function findName($id){
		$record = fRecordSet::build(
			__CLASS__,
			array("id_section=" => $id)
		);
		
		return $record[0]->getName();
	}
}