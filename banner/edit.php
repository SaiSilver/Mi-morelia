<?php
require_once '../init.php';
$section = 'banner';
$sub = 'edit';
fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			//if(empty($idUser) || !fAuthorization::checkACL($section, $sub)) {
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
$id_banner = fRequest::encode('id','integer');

	if(!fAuthorization::checkAuthLevel('super')) {
				$isOwner = fRecordSet::build('BannerRegion', array('id_banner=' => $id_banner, 'id_region='=>fSession::get('regs')));
				$count = $isOwner->count() > 0;
			
				if(!$count) 
					header("Location: " . SITE);
	}

if(empty($id_banner)) header('Location: '.SITE);
$site = str_replace('\\','/',SITE);
try {
	$banner = new Banner($id_banner);	
} catch (Exception $e) {
	header("Location: " . SITE);
}


require_once  INCLUDES.'header.php';
?>
			<link rel="stylesheet" href="<?php echo JS ?>jwysiwyg/jquery.wysiwyg.css" type="text/css" />
			<link rel="stylesheet" href="<?php echo CSS ?>ui-lightness/jquery-ui-1.8.16.custom.css" type="text/css" />
			
			
			<script type="text/javascript" src="<?php echo JS ?>jwysiwyg/jquery.wysiwyg.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>upload/jquery.MultiFile.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>jquery.form.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>jquery-ui-1.8.16.custom.min.js"></script>
			
			<link rel="stylesheet" href="<?php echo CSS ?>multiselect.css" type="text/css" />
			<script type="text/javascript" src="<?php echo JS ?>plugins/localisation/jquery.localisation-min.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>plugins/scrollTo/jquery.scrollTo-min.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>ui.multiselect.js"></script>
		<script src="<?php echo JS ?>jquery.validate.min.js"></script>
	<link rel="stylesheet" href="../js/colorbox/colorbox.css" />
		<script src="../js/colorbox/jquery.colorbox.js"></script>
			<script type="text/javascript" src="<?php echo SCRIPT . $section . "/" .  $sub; ?>.js"></script>
	
	<script>
		$(function(){
			//$("div.available").width(175);
			//$("div.selected").width(160);
			$("input.search").width(100);
		});
	</script>
			
			<!-- MAIN CONTAINER -->
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix">
<div class="notification success" style="display:none;" >
								Se ha editado exitosamente. 
							</div>
							<div class="notification errorBox" style="display:none;" >
								Ha ocurrido un error, revise la informaci&oacute;n. 
							</div>
							<br/>
					<form action="../do.php" method="post" id="add" enctype="multipart/form-data">
							<input type="hidden" name="id_user" value="<?php echo $idUser; ?>" />
						<input type="hidden" name="id_banner" value="<?php echo $id_banner; ?>" />
						<input type="hidden" name="request_token" value="<?php echo fRequest::generateCSRFToken(SITE . "do.php") ?>" />
						<input type="hidden" name="whatToDo" value="banner_edit" />
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
										'SELECT * FROM bannersection WHERE id_parent = 0 AND '.fSession::get('where_at')
									);
									try {
										$z = new BannerSection($banner->prepareIdZone());
										$sec = new BannerSection($z->prepareIdParent());
									} catch (Exception $e)	{ }
									
									if ($zones->count() > 0) :
										foreach ($zones as $zone):
											if (isset($sec) && ($zone->prepareIdBannersection() == $sec->prepareIdBannersection())) :
									?>
									<option value="<?=$zone->prepareIdBannersection()?>" selected><?=$zone->prepareName()?></option>
									<? else : ?>	
									<option value="<?=$zone->prepareIdBannersection()?>"><?=$zone->prepareName()?></option>
											<?php endif?>
										<?php endforeach?>
									<?php endif?>
									</select>
							</td>
						</tr>
						
						<tr>
							<td> <label for="title"> Zona </label></td>
							
							<td><select name="id_zone" id="id_zone" style="width:285px"> 
									<option value="0"> Selecciona una zona </option>
									<?php
									$zones = fRecordSet::buildFromSQL(
										'BannerSection',
										'SELECT * FROM bannersection WHERE id_parent = '.$sec->prepareIdBannersection().' AND '.fSession::get('where_at')
									);
									try {
										$z = new BannerSection($banner->prepareIdZone());
										$sec = new BannerSection($z->prepareIdParent());
									} catch (Exception $e)	{ }
									
									if ($zones->count() > 0) :
										foreach ($zones as $zone):
											if (isset($sec) && ($zone->prepareIdBannersection() == $banner->prepareIdZone())) :
									?>
									<option value="<?=$zone->prepareIdBannersection()?>" selected><?=$zone->prepareName()?></option>
									<? else : ?>	
									<option value="<?=$zone->prepareIdBannersection()?>"><?=$zone->prepareName()?></option>
											<?php endif?>
										<?php endforeach?>
									<?php endif?>
								</select><br/><small>Selecciona una zona para ver su ubicaci&oacute;n</small></td>
						</tr>
<?php
							$status = $banner->getStatus();
						$status = ($status == true || $status == "Yes" || $status == 1) ? "1" : "0";
						?>
						<tr>
							<td> <label for="id_state"> Estado <label> </td> 
							<td>
								<select name="id_state" style="width:200px"> 
								
									<option value="1" <?php if($status=="1") echo "selected='selected'"; ?> > Aceptado </option>
									<option value="0"<?php if($status=="0") echo "selected='selected'"; ?>  > Rechazado </option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Orden</td> <td> <input type="text" value="<?php echo $banner->getOrder()?>" name="order" /> </td>
						</tr>
						<tr>
							<td><label for="content">Enlace</label></td>
							<td><input type="text" name="link" value="<?php echo $banner->prepareLink()?>" size="50"/></td>
						</tr>
						
						<?php
							$resources = Resource::findForSection($id_banner, 1);
							
						?>
						<tr>
						   <td><label>Archivos actuales</label></td>
						   <td>
						   <?php 
							foreach($resources as $resource) {
								
								if($resource->prepareResource_type()=='i') 
									echo '<span class="resourcesSpan" id="' . $resource->prepareId_resource() . '"><a class="group1" href="../../uploads/banners/' . $resource->prepareUrl() . '"> Ver Imagen </a>';
								else if($resource->prepareResource_type()=='e') echo '<span class="resourcesSpan" id="' . $resource->prepareId_resource() . '"><a target="_blank" href="' . $resource->prepareUrl() . '"> Ver Video </a>';
								else 					
									echo '<span class="resourcesSpan" id="' . $resource->prepareId_resource() . '"><a target="_blank" href="../../uploads/banners/' . $resource->prepareUrl() . '"> Ver Archivo </a>';
							

echo'								- <a href="javascript:" class="delete" id="' . $resource->prepareId_resource() . '-' . $resource->prepareId_entity() . '-' . $resource->prepareId_section() . '"> Eliminar </a>  <br/></span>';
							}
							?>
							</td>
						</tr>
						<tr>
						 <td><label for="images">Imagen</label></td>
						 <td><input type="file" class="multid" name="files[]"/></td>
						</tr>
						<tr>
						 <td colspan="2"> <input style="float:right" size="5" type="submit" value="Editar Banner" class="button" /> </td>
						</tr>
					</table>
					
					</form>
					<div id="image" style="width:600px; display:none; float:right; margin-right:100px; height:540px; border:1px solid red; background-color:#eee">
					</div>
				</div>
			</div>
<?php require_once INCLUDES.'footer.php' ?>