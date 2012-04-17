<?php
require_once '../init.php';
$section = 'categories';
$sub = 'add';

/*
if(!fAuthorization::checkAuthLevel('employee')): 
	exit("No se ha podido acceder");
endif; 
*/
require_once  INCLUDES.'header.php';
?>
						
			<link rel="stylesheet" href="<?php echo CSS ?>ui-lightness/jquery-ui-1.8.16.custom.css" type="text/css" />
			<link rel="stylesheet" href="<?php echo CSS ?>multiselect.css" type="text/css" />
			
			<script type="text/javascript" src="<?php echo JS ?>jquery.form.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>upload/jquery.MultiFile.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>jquery-ui-1.8.16.custom.min.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>plugins/localisation/jquery.localisation-min.js"></script>
	<script type="text/javascript" src="<?php echo JS ?>plugins/scrollTo/jquery.scrollTo-min.js"></script>
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
					<input type="hidden" name="whatToDo" value="categories_add" />
					
					<table  class="contenttoc cate" style="float:left">
					
						<?php
							$sections = Section::findAll();
							$list = array(2);
						?>
						
						<tr>
							<td><label for="id_section"> Secci&oacute;n </label> </td>
							<td>
								 <select id="sections" style="width:680px;" name="id_section">

						<?php
							foreach ($sections as $section) {
								if (in_array($section->prepareId_section(), $list))
									echo '<option value="' . $section->prepareId_section() . '"> ' . $section->prepareName() . ' </option>';
							}
						?>
								</select>
							</td>
						</tr>
						<tr id="category_select">
							<td> <label for="isSub"> Es subcategor&iacute;a  </label></td>
							<td><input type="checkbox" value="1" name="isSub" id="isSub" size="130"/>  <small>Marcar esta casilla solo si se desea agregar una subcategor&iacute;a</small></td>
						</tr>	
						
						<!--
						<tr class="hide">
							<td><label for="id_category"> Categor&iacute;a </label> </td>
							<td >
								 <select id="categories" style="width:680px; " name="id_category">
									</select>
							</td>
						</tr>
						-->
						
						<tr id="category_name">
							<td> <label for="name"> Nombre(Sub/Categor&iacute;a) </label></td>
							<td><input type="text" id="name"  name="name" size="130"/></td>
						</tr>	
						
						
						
						

						<tr>
						 <td colspan="2"> <input style="float:right" size="10" type="submit" value="Agregar Categor&iacute;a" class="button" /> </td>
						</tr>
					</table>
					<br/>
					<input type="hidden" id="parent_id" name="parent_id" value="0">
					</form>
				</div>
			</div>
<?php require_once INCLUDES.'footer.php' ?>