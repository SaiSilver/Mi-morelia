<?php
		fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
//if (fRequest::isPost()):
	$section_id = fRequest::encode('id_section', 'integer');
	$parent_id = fRequest::encode('id_parent','integer');
	//var_dump($_POST); var_dump($_GET);
	
	//$categories = Category::findAllUp($section_id,0,$region_id);
	
	$categories = fRecordSet::buildFromSQL(
		"Category",
		"SELECT * FROM category WHERE id_section = $section_id AND id_parent = $parent_id"
	);
	?>
	
	<?php								
	if($categories->count() > 0)  {
	echo '<tr>
	<td><label for="id_category"> Categor&iacute;a </label> </td>
							<td >
								 <select class="subcategories" style="width:680px; " name="id_category">';
	foreach($categories as $category) echo '<option value="' . $category->prepareId_category() . '"> ' . $category->prepareName() . ' </option>';
	//endif;
	?>
	</select>
							</td>
	</tr>						
	<tr class="category_select">
		<td> <label for="isSub"> Es subcategor&iacute;a  </label></td>
		<td><input type="checkbox" value="1" name="isSub" class="isSub" size="130"/>  <small>Marcar esta casilla solo si se desea agregar una subcategor&iacute;a</small></td>
	</tr>	
	<?php } ?>