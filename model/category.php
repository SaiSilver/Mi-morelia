<?php
class Category extends fActiveRecord {
	protected function configure() {}
	
	public static function findAll($section, $parent=0, $region=0) {
		return fRecordSet::build(
			__CLASS__                ,         
			array('id_section=' => $section, 'id_parent=' => $parent, "id_region=" => $region)
		);
	}
	
	public static function findAllUp($section, $parent=0, $region=0) {
		return fRecordSet::build(
			__CLASS__                ,         
			array('id_section=' => $section, 'id_parent>=' => $parent, "id_region=" => $region)
		);
	}
	
		public static function findNoParent($section, $parent=0, $region=0) {
		return fRecordSet::build(
			__CLASS__                ,         
			array('id_section=' => $section, 'id_parent!=' => $parent, "id_region=" => $region)
		);
	}
	
	
	public static function getCategory($id_category){
		return fRecordSet::build(
			__CLASS__                ,         
			array('id_category=' => $id_category)
		);
	}
	
	public static function getByName($name,$section,$parent=0){
		return fRecordSet::build(
			__CLASS__,
			array('name=' => $name, 'id_section=' => $section, 'id_parent='=>$parent)
		);
	}
	
	public static function hasParent($category_id, $region=0) {
		$category = fRecordSet::build(
			__CLASS__,
			array('id_category='=> $category_id, 'id_region=' => $region)
		);
		
		$category = $category[0];
		if ($category->getIdParent() > 0) return $category->getIdParent();
		else return $category->getIdCategory();
	}
	
	
}