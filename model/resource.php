<?php
class Resource extends fActiveRecord {
	public static function findForSection($entity, $section) {
		return fRecordSet::build(
			__CLASS__,                            // Make User objects
			array('id_entity=' => $entity, 'id_section=' => $section)      // That are active
			//array('date_registered' => 'desc') // Ordered by registration date
		);
	}
	
	public static function countResource($entity,$section,$type){
		$counter = fRecordSet::build(
			__CLASS__,                            // Make User objects
			array('id_entity=' => $entity, 'id_section=' => $section, 'resource_type=' => $type)      // That are active
			
		);
		
		return $counter->count();
	}
}