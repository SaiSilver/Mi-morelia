<?php

class EconomicUnitCategory extends fActiveRecord
{
    public static function findAll() {
		return fRecordSet::build(
			__CLASS__ 
		);
	}
	
	public static function findForRegion($region) {
		return fRecordSet::build(
			__CLASS__,
			array("economic_unit_category_region="=>$region)
		);
	}
}

?>