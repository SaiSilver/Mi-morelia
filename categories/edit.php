<?php
require_once '../init.php';
$section = 'categories';
$sub = 'edit';

/*
if(!fAuthorization::checkAuthLevel('employee')): 
	exit("No se ha podido acceder");
endif; 
*/
$id = fRequest::encode('id', 'integer');
$s = fRequest::encode('s', 'integer');

if(!fAuthorization::checkAuthLevel('super')) {
				$isOwner = fRecordSet::build('Category', array('id_category=' => $id, 'id_region='=>fSession::get('regs')));
				$count = $isOwner->count() > 0;
			
				if(!$count) 
					header("Location: " . SITE);
	}
	
	try {
	$category = new Category(array("id_section"=> $s, "id_category"=>$id));
	} catch(Exception $e){
		header("Location: " . SITE);
	}

require_once  INCLUDES.'header.php';

?>
			<link rel="stylesheet" href="<?php echo CSS ?>ui-lightness/jquery-ui-1.8.16.custom.css" type="text/css" />
			<script type="text/javascript" src="<?php echo JS ?>jquery.form.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>upload/jquery.MultiFile.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>jquery-ui-1.8.16.custom.min.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>ui.multiselect.js"></script>
			<script src="<?php echo JS ?>jquery.validate.min.js"></script>
			<script type="text/javascript" src="<?php echo SCRIPT . $section . "/" .  $sub; ?>.js"></script>
			

			<!-- MAIN CONTAINER -->
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix"><div class="notification success" style="display:none;" >
								Se ha editado exitosamente. 
							</div>
							<div class="notification errorBox" style="display:none;" >
								Ha ocurrido un error, revise la informaci&oacute;n. 
							</div>
							<br/>
					<form action="../do.php" method="post" id="add">
					
					<input type="hidden" name="id_user" value="<?php echo $idUser; ?>" />
					<input type="hidden" name="request_token" value="<?php echo fRequest::generateCSRFToken(SITE . "do.php") ?>" />
					<input type="hidden" name="whatToDo" value="categories_edit" />
					<input type="hidden" name="id" value="<?php echo $id ?>" />
					<input type="hidden" name="s" value="<?php echo $s ?>" />
					<table  class="contenttoc" style="float:left">
					<?php
					
						$category = new Category(array("id_section"=> $s, "id_category"=>$id));
					?>
					<!--<tr>
							<td> <label for="isSub"> Es subcategor&iacute;a (Cambiar Categor&iacute;a Padre) </label></td>
							<td><input type="checkbox" value="1" name="isSub" id="isSub" size="130"/>  <small>Marcar esta casilla solo si se desea agregar una subcategor&iacute;a</small></td>
						</tr>	
						
						<tr class="hide">
							<td><label for="id_category"> Categor&iacute;a </label> </td>
							<td >
								 <select id="categories" style="width:680px; " name="id_category">
									</select>
							</td>
						</tr>-->
						
						<tr>
							<td> <label for="name"> Nombre(Sub/Categor&iacute;a) </label></td>
							<td><input type="text" id="name" value="<?php echo $category->prepareName(); ?>" name="name" size="130"/></td>
						</tr>	
						
						
						
						

						<tr>
						 <td colspan="2"> <input style="float:right" size="10" type="submit" value="Editar Categor&iacute;a" class="button" /> </td>
						</tr>
					</table>
					<br/>
					</form>
				</div>
			</div>
<?php require_once INCLUDES.'footer.php' ?>