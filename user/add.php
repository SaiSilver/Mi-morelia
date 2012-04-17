<?php
require_once '../init.php';
$id_section = 10;
$section = 'user';
$sub = 'add';
fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			//if(empty($idUser) || !fAuthorization::checkACL($section, $sub)) {
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
require_once INCLUDES.'header.php';
?>
			<!-- MAIN CONTAINER -->
			<link rel="stylesheet" href="<?php echo CSS ?>ui-lightness/jquery-ui-1.8.16.custom.css">
			<script type="text/javascript" src="<?php echo SCRIPT ?>common.js"></script>
			<script src="<?php echo JS ?>jquery.form.js"></script>
			<script src="<?php echo JS ?>jquery.ui.core.min.js"></script>
			<script src="<?php echo JS ?>jquery.ui.widget.min.js"></script>
			<script src="<?php echo JS ?>jquery.ui.datepicker.min.js"></script>
			<script src="<?php echo JS ?>jquery.validate.min.js"></script>
			<script type="text/javascript" src="<?php echo SCRIPT ?>user/add.js"></script>
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix">
					<div class="notification success" style="display:none;" >
								Se ha editado exitosamente. 
							</div>
							<div class="notification errorBox" style="display:none;" >
								Ha ocurrido un error, revise la informaci&oacute;n. 
							</div>
							<br/>
					<form id="addUser" action="<?php echo SITE ?>do.php" method="post">
						<table class="contenttoc" style="float:none">
							<tr>
								<td><label for="firstName">Nombre</label></td>
								<td><input type="text" name="firstName" id="firstName" class="inputbox" /></td>
								<td><label for="lastName">Apellidos</label></td>
								<td><input type="text" name="lastName" id="lastName" class="inputbox" /></td>
								<td><label for="birthday">Fecha de Nacimiento</label></td>
								<td><input type="text" name="birthday" id="birthday" class="inputbox" /></td>
								<td><label for="phone">Teléfono</label></td>
								<td><input type="text" name="phone" id="phone" class="inputbox" /></td>
							</tr>
							<tr>
								<td><label for="cellphone">Celular</label></td>
								<td><input type="text" name="cellphone" id="cellphone" class="inputbox" /></td>
								<td><label for="nextel">Nextel</label></td>
								<td><input type="text" name="nextel" id="nextel" class="inputbox" /></td>
								<td><label for="fax">Fax</label></td>
								<td><input type="text" name="fax" id="fax" class="inputbox" /></td>
								<td><label for="address">Dirección</label></td>
								<td><input type="text" name="address" id="address" class="inputbox" /></td>
							</tr>	
							<tr>
								<td><label for="email">Correo electrónico</label></td>
								<td><input type="text" name="email" id="email" class="inputbox required email" /></td>
								<td><label for="password">Contraseña</label></td>
								<td><input type="password" name="password" id="password" class="inputbox" /></td>
							</tr>
							<?php if(fAuthorization::checkAuthLevel('super')): ?>
							<tr class="regionRow">
								<td><label for="state">Estado</label></td>
								<td>
									<select class="state" name="state[]">
										<option value="0">Estado</option>
										<?php
										$regions = Region::findAll(1);
										foreach($regions as $item): ?>
										<option value="<?php echo $item->prepareIdRegion() ?>"><?php echo $item->prepareName() ?></option>
										<?php endforeach ?>
									</select>
								</td>
								<td><label>Municipio<label></td>
								<td class="regionCell">
									<select class="region" name="region[]">
										<option value="0">Municipio</option>
									</select>
								</td>
								<td colspan="4">
									<a id="anotherRegion" href="" style="margin-right:20px">Agregar otro municipio</a>
								</td>
							</tr>
							<?php else: ?>
							<tr>
								<td class="privilege" colspan="8"><input type="checkbox" id="selectRegions" /><label for="selectRegions">Seleccionar todos los municipios</label></td>
							</tr>
							<?php
								$regions = fSession::get('regs');
								$i = 0;
								foreach($regions as $item) {
									$i++;
									if($i == 1) echo '<tr>';
									$region = new Region($item);
									echo '<td colspan="2"><input type="checkbox" id="'.str_replace(' ','-',$region->prepareName()).'" class="region" name="region[]" value="'.$region->prepareIdRegion().'" /><label for="'.str_replace(' ','-',$region->prepareName()).'">'.$region->prepareName().'</label></td>';
									if($i == 4) {
										echo '</tr>';
										$i = 0;
									}
								}
								if($i < 4) {
									for($i;$i<4;$i++)
										echo '<td colspan="2"></td>';
									echo '</tr>';
								}
							?>
							<?php endif ?>
							<tr>
								<td><label for="role">Rol</label></td>
								<td>
									<select id="role" name="role">
										<option value="0">Rol</option>
										<?php
										$roles = Role::getAll();
										foreach($roles as $item):
										if($item->prepareIdRole() == 1 && !fAuthorization::checkAuthLevel('super')) continue;
										?>
										<option value="<?php echo $item->prepareIdRole() ?>"><?php echo $item->prepareName() ?></option>
										<?php endforeach ?>
									</select>
								</td>
								<td colspan="6"></td>
							</tr>
							<tr>
								<td class="privilege" colspan="8"><input type="checkbox" id="selectPermissions" /><label for="selectPermissions">Seleccionar todos los permisos</label></td>
							</tr>
							<?php
							$p = new Permission();
							$sections = Section::findAll();
							foreach($sections as $item):
							if($item->prepareIdSection() == 11 && !fAuthorization::checkAuthLevel('super')) continue;
							?>
							<tr>
								<td class="privilege" colspan="8"><?php echo $item->prepareName() ?></td>
							</tr>
								<?php
								$i = 0;
								$permissions = $p->getByIdSection($item->prepareIdSection());
								foreach($permissions as $p):
								$i++;
								if($i == 1) echo '<tr id="'.str_replace(' ','-',$item->prepareName()).'">'; ?>
									<td colspan="2"><input type="checkbox" name="permission[]" id="<?php echo str_replace(' ','-',$p->prepareName()) ?>" class="permission" value="<?php echo $p->prepareIdPermission() ?>" /><label for="<?php echo str_replace(' ','-',$p->prepareName()) ?>"><?php echo $p->prepareName() ?></label></td>
								<?php
								if($i == 4) {
									$i = 0;
									echo '</tr>';
								}
								endforeach;
								if($i < 4) {
									for($i;$i<4;$i++)
										echo '<td colspan="2"></td>';
									echo '</tr>';
								}
							endforeach ?>
							<tr>
								<td colspan="8">
									<input type="hidden" name="whatToDo" value="user_add" />
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