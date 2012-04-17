<?php

class EconomicUnitHasCategory extends fActiveRecord
{
    protected function configure()
    {
    }
	
	
	public static function findForUnit($id) {
		return fRecordSet::build(
			__CLASS__,
			array("economic_units_economic_unit_id="=>$id)
		);
	}
	
}

?>