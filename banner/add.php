<?php
require_once '../init.php';
$section = 'banner';
$sub = 'add';
		fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			//if(empty($idUser) || !fAuthorization::checkACL($section, $sub)) {
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
require_once  INCLUDES.'header.php';
?>
			
			
			
			
			<script type="text/javascript" src="<?php echo JS ?>upload/jquery.MultiFile.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>jquery.form.js"></script>
			<script src="<?php echo JS ?>jquery.validate.min.js"></script>
			
			
			<script type="text/javascript" src="<?php echo SCRIPT . $section . DS .  $sub; ?>.js"></script>
			
			<!-- MAIN CONTAINER -->
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix">

				<div class="notification success" style="display:none;" >
								Se ha agregado exitosamente. 
							</div>
							<div class="notification errorBox" style="display:none;" >
								Ha ocurrido un error, revise la informaci&oacute;n. 
							</div>
							<br/>
					<form action="<?php echo SITE?>do.php" method="post" id="add" enctype="multipart/form-data">
						<input type="hidden" name="id_user" value="<?php echo $idUser; ?>" />
						<input type="hidden" name="request_token" value="<?php echo fRequest::generateCSRFToken(SITE . "do.php") ?>" />
						<input type="hidden" name="whatToDo" value="banner_add" />
					<table  class="contenttoc" style="float:left">
						<?php
							$sections = Section::findAll();
						?>
												<tr>
							<td style="border-top:2px solid gray;"><label for="id_section"> Secci&oacute;n </label> </td>
							<td style="border-top:2px solid gray;">
								 <select id="sections" style="width:285px;" name="id_section">
									<option value="0"> Selecciona una secci&oacute;n </option>
									<?php
									$zones = fRecordSet::buildFromSQL(
										'BannerSection',
										'SELECT * FROM bannersection WHERE id_parent = 0 '
									);
									if ($zones->count() > 0) :
										foreach ($zones as $zone):
									?>
									<option value="<?=$zone->prepareIdBannersection()?>"><?=$zone->prepareName()?></option>
										<?php endforeach?>
									<?php endif?>
									</select>
							</td>
						</tr>
						
						<tr>
							<td> <label for="title"> Zona </label></td>
							
							<td><select name="id_zone" id="id_zone" style="width:285px"> 
									<option value="0"> Selecciona una zona </option>
								</select><br/><small>Selecciona una zona para ver su ubicaci&oacute;n</small></td>
						</tr>	
					
					
						
						
						<tr>
							<td> <label for="id_state"> Estado <label> </td> 
							<td>
								<select name="id_state" style="width:285px"> 
									<option value="1"> Aceptado </option>
									<option value="0"> Rechazado </option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label>Orden</label></td> <td> <input type="text" name="order" /> </td>
						</tr>
						<tr>
							<td><label for="content">Enlace</label></td>
							<td><input type="text" name="link" size="50"/></td>
						</tr>
						
						<tr>
						 <td><label for="images">Imagen</label></td>
						 <td><input type="file" class="multid" name="files[]"/></td>
						</tr>
						<tr>
						 <td colspan="2"> <input style="float:right" size="5" type="submit" value="Agregar Banner" class="button" /> </td>
						</tr>
					</table>
					
					</form>
					<div id="image" style="width:600px; display:none; float:right; margin-right:100px; height:540px; border:1px solid red; background-color:white">
					</div>
				</div>
			</div>
<?php require_once INCLUDES.'footer.php' ?>