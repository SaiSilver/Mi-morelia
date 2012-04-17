<?php
require_once '../init.php';
$section = 'observatorio';
$sub = 'edit';
fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			//if(empty($idUser) || !fAuthorization::checkACL($section, $sub)) {
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
			
		$id = fRequest::encode('id','integer');
if(empty($id)) header("Location: " . SITE);

if(!fAuthorization::checkAuthLevel('super')) {
				$isOwner = fRecordSet::build('Observatorio', array('id_observatorio=' => $id, 'id_region='=>fSession::get('regs')));
				$count = $isOwner->count() > 0;
			
				if(!$count) 
					exit("0");
			}
			
try {
			$o = new Observatorio($id);
	} catch(Exception $e) { header("Location: " . SITE); }
require_once INCLUDES.'header.php';

	

?>


			<link rel="stylesheet" href="<?php echo CSS ?>ui-lightness/jquery-ui-1.8.16.custom.css" type="text/css" />
			
			
			<script type="text/javascript" src="<?php echo JS ?>jwysiwyg/jquery.wysiwyg.js"></script>
			
			<script type="text/javascript" src="<?php echo JS ?>jquery.form.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>jquery-ui-1.8.16.custom.min.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>jquery.ui.core.min.js"></script>
	
			
			<script type="text/javascript" src="<?php echo JS ?>ui.multiselect.js"></script>
			<script src="<?php echo JS ?>jquery.validate.min.js"></script>
			
			<script type="text/javascript" src="<?php echo SCRIPT . $section . "/" .  $sub; ?>.js"></script>

	
			
			
			
			<!-- MAIN CONTAINER -->
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix"><div class="notification success" style="display:none;" >
								Se ha agregado exitosamente. 
							</div>
							<div class="notification errorBox" style="display:none;" >
								Ha ocurrido un error, revise la informaci&oacute;n. 
							</div>
							<br/>
					<form action="../do.php" method="post" id="add">
					<input type="hidden" name="request_token" value="<?php echo fRequest::generateCSRFToken(SITE . "do.php") ?>" />
						<input type="hidden" value="<?php echo $id ?>" name="id" />
						<input type="hidden" name="whatToDo" value="observatorio_edit" />
						
						<table class="contenttoc" style="float:none">
						<tr>
								<td><label> T&iacute;tulo </label></td>
								<td><input type="text" name="title" size="100" value="<?php echo $o->prepareTitle() ?>" /></td>
							</tr>
							<tr>
								<td> <label for="text"> Texto: </label> </td>
								<td> <textarea cols="100" rows="15" name="text" id="text"><?php echo $o->prepareDescription() ?></textarea> </td>
							</tr>

						<?php if(fAuthorization::checkAuthLevel('super')): ?>
								<tr class="regionRow">
								<td><label>Región</label></td>
								<td>
									<select class="state" name="state">
										<option value="0">Estado</option>
										<?php
										$regions = Region::findAll(1);
										$region = new Region($o->getIdRegion());
										foreach($regions as $item) {
											if($region->getIdParent() != $item->getIdRegion())
										 		echo '<option value="'.$item->getIdRegion().'">'.$item->prepareName().'</option>';
											else
												echo '<option value="'.$item->getIdRegion().'" selected="selected">'.$item->prepareName().'</option>';
										}
										?>
									</select>
									<select class="region" name="region">
										<option value="0">Municipio</option>
										<?php
										$regions = Region::findAll($region->getIdParent());
										foreach($regions as $item) {
											if($region->getIdRegion() != $item->getIdRegion())
										 		echo '<option value="'.$item->getIdRegion().'">'.$item->prepareName().'</option>';
											else
												echo '<option value="'.$item->getIdRegion().'" selected="selected">'.$item->prepareName().'</option>';
										}
										?>
									</select>
									<!-- <a id="anotherRegion" href="" style="margin-right:20px">Agregar otro municipio</a> -->
								</td>
							</tr>
							<?php else: ?>
							<tr>
								<td class="privilege" colspan="2"><input type="checkbox" id="selectRegions" /><label for="selectRegions">Seleccionar todos los municipios</label></td>
							</tr>
						<?php 
							$ur = new UserRegion();
							$userRegions = $ur->getByIdUser($idUser);
					    ?>		
						<tr>
						 <td><label for="regions"> Regiones </label></td><td>
								    <select id="regions" name="region">

   <?php
										foreach($userRegions as $r) {
											$region = new Region($r->prepareId_region());
											if($r->prepareId_region() == $o->prepareId_region()) $sel = "selected=\"selected\""; else $sel = "";
											echo '<option ' . $sel .  '  value="' . $region->prepareId_region() . '"> ' . $region->prepareName() . ' </option>';
										}
									?>
  </select>
  <center><span id="selectR" style="display:none;"> <b>Selecciona una regi&oacute;n</b></span></center>
</td>
						</tr>
							<?php endif ?>
							
							
									<?php
							$status = $o->getStatus();
						$status = ($status == true || $status == "Yes" || $status == 1) ? "1" : "0";
						?>
						
						<tr>
							<td> <label for="status"> Estado <label> </td> 
							<td>
								<select name="status" style="width:200px"> 
								
									<option value="1" <?php if($status=="1") echo "selected='selected'"; ?> > Aceptado </option>
									<option value="0"<?php if($status=="0") echo "selected='selected'"; ?>  > Rechazado </option>
								</select>
							</td>
						</tr>
						
						
							
							<tr>
								<td colspan="2"><input type="submit" value="Editar" class="button right" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
<?php require_once INCLUDES.'footer.php' ?>