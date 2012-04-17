<?php
$id = fRequest::encode('id','integer');
$s = fRequest::encode('s','integer');

if(!fAuthorization::checkAuthLevel('super')) {
				$isOwner = fRecordSet::build('Category', array('id_category=' => $id, 'id_region='=>fSession::get('regs')));
				$count = $isOwner->count() > 0;
			
				if(!$count) 
					exit("0");
	}
	
	
try {
 $category = new Category(array("id_section" => $s, "id_category" => $id));
} catch (Exception $e) {}
 
 $category->setName(fRequest::encode('name','string'));

 
try { $category->store();
} catch (Exception $e){
					exit ("Ha ocurrido un error.");
				}

exit("1");
?>