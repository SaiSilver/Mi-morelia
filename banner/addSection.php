<?php
require_once '../init.php';
$section = 'banner';
$sub = 'addSection';
fSession::open();
$idUser = fSession::get(SESSION_ID_USER);
if(empty($idUser)) {
	header('Location: '.SITE);
	exit("No se ha podido acceder a esta secci&oacite;n");
}
require_once INCLUDES.'header.php';
?>
			<!-- MAIN CONTAINER -->
			<link rel="stylesheet" href="<?php echo JS ?>jwysiwyg/jquery.wysiwyg.css" type="text/css" />
			<link rel="stylesheet" href="<?php echo CSS ?>ui-lightness/jquery-ui-1.8.16.custom.css">
			<script type="text/javascript" src="<?php echo SCRIPT ?>common.js"></script>
			<script src="<?php echo JS ?>jquery.form.js"></script>
			<script src="<?php echo JS ?>jquery.ui.core.min.js"></script>
			<script src="<?php echo JS ?>jquery.ui.widget.min.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>jwysiwyg/jquery.wysiwyg.js"></script>
			<script src="<?php echo JS ?>jquery.validate.min.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>upload/jquery.MultiFile.js"></script>
			<script type="text/javascript" src="<?php echo SCRIPT ?>banner/addSection.js"></script>
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix">
					<div class="notification success" style="display:none;" >
								Se ha agregado exitosamente. 
							</div>
							<div class="notification errorBox" style="display:none;" >
								Ha ocurrido un error, revise la informaci&oacute;n. 
							</div>
							<br/>
					<form id="addSection" action="<?php echo SITE ?>do.php" method="post">
						<table class="contenttoc" style="float:none">
							<tr>
								<td><label for="zone"> Es Zona </label></td>
								<td>
									<input type="checkbox" class="check" name="zone" id="zone" value="1" />
									<span> Marcar esta casilla solo si se desea agregar una zona </span>
								</td>
							</tr>
							<tr class="hide">
								<td><label for="sections"> Sección </label></td>
								<td>
									<select id="sections" style="width:285px;" name="id_section">
									
									</select>
								</td>
							</tr>	
							<tr>
								<td><label for="name"> Nombre (Sección /Zona) </label></td>
								<td><input type="text" name="name" id="name" class="inputbox" size="130" /></td>
							</tr>
							
							<tr>
								<td colspan="2">
									<input type="hidden" name="whatToDo" value="bannersection_add" />
									<input type="submit" value="Agregar" class="button right" />
								</td>
							</tr>
						</table>
						<?php
						/*$up = new UserPermission();
						$permissions = $up->getByIdUser(fSession::get(SESSION_ID_USER));*/
						?>
					</form>
				</div>
			</div>
<?php require_once INCLUDES.'footer.php' ?>