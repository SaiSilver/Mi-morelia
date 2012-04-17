<?php
require_once '../init.php';
$id_section = 10;
$section = 'user';
$sub = 'edit';
$idUser = fRequest::encode('id','integer');

if(empty($idUser) || !is_numeric($idUser)) exit();
$u = new User($idUser);
if(empty($u)) header('Location: '.USER.'list');

fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			//if(empty($idUser) || !fAuthorization::checkACL($section, $sub)) {
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}

//if($u->prepareIdRole() == 1 && !fAuthorization::checkAuthLevel('super')) header('Location: '.SITE);
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
			<script type="text/javascript" src="<?php echo SCRIPT ?>user/edit.js"></script>
			<style>
			.error {color:red}
			</style>
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
						<input type="hidden" name="id" value="<?php echo $u->prepareIdUser() ?>">
						<table class="contenttoc" style="float:none">
							<tr>
								<td><label for="firstName">Nombre</label></td>
								<td><input type="text" name="firstName" id="firstName" class="inputbox" value="<?php echo $u->prepareFirstName() ?>" /></td>
								<td><label for="lastName">Apellidos</label></td>
								<td><input type="text" name="lastName" id="lastName" class="inputbox" value="<?php echo $u->prepareLastName() ?>" /></td>
								<td><label for="birthday">Fecha de Nacimiento</label></td>
								<td><input type="text" name="birthday" id="birthday" class="inputbox" value="<?php if($u->getBirthday()) echo $u->getBirthday()->format('n/j/y') ?>" /></td>
								<td><label for="phone">Teléfono</label></td>
								<td><input type="text" name="phone" id="phone" class="inputbox" value="<?php echo $u->preparePhone() ?>" /></td>
							</tr>
							<tr>
								<td><label for="cellphone">Celular</label></td>
								<td><input type="text" name="cellphone" id="cellphone" class="inputbox" value="<?php echo $u->prepareCellphone() ?>" /></td>
								<td><label for="nextel">Nextel</label></td>
								<td><input type="text" name="nextel" id="nextel" class="inputbox" value="<?php echo $u->prepareNextel() ?>" /></td>
								<td><label for="email">Correo electrónico</label></td>
								<td><input type="text" name="email" id="email" class="inputbox required email" value="<?php echo $u->prepareEmail() ?>" /></td>
								<td><label for="fax">Fax</label></td>
								<td><input type="text" name="fax" id="fax" class="inputbox required fax" value="<?php echo $u->prepareFax() ?>" /></td>
								
							</tr>
							<tr>
								<td><label for="address">Dirección</label></td>
								<td><input type="text" name="address" id="address" class="inputbox required address" value="<?php echo $u->prepareAddress() ?>" /></td>
								<td><label for="password">Contraseña</label></td>
								<td><input type="password" name="password" id="password" class="inputbox" /></td>
							</tr>
							<?php
							if(fAuthorization::checkAuthLevel('super')):
								$r = new Region();
								$ur = new UserRegion();
								$userRegions = $ur->getByIdUser($u->getIdUser());
								$regions = $r->findAll(1);
								try {
								foreach($userRegions as $item):?>
								<tr class="regionRow">
									<td><label>Estado</label></td>
									<td>
										<select class="state" name="state">
											<option value="0">Estado</option>
											<?php
											print_r($item);
											$city = new Region($item->getIdRegion());
											foreach($regions as $region):
												if($region->getIdRegion() != $city->getIdParent()): ?>
													<option value="<?php echo $region->getIdRegion() ?>"><?php echo $region->prepareName() ?></option>
												<?php else: ?>
													<option value="<?php echo $region->getIdRegion() ?>" selected="selected"><?php echo $region->prepareName() ?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</td>
									<td><label>Municipio<label></td>
									<td class="regionCell">
										<select class="region" name="region[]">
											<option value="0">Municipio</option>
											<?php $tmpRegions = $r->findAll($city->getIdParent());
											foreach($tmpRegions as $region):
												if($region->getIdRegion() != $city->getIdRegion()): ?>
													<option value="<?php echo $region->getIdRegion() ?>"><?php echo $region->prepareName() ?></option>
												<?php else: ?>
													<option value="<?php echo $region->getIdRegion() ?>" selected="selected"><?php echo $region->prepareName() ?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</td>
									<td colspan="4">
										<a class="deleteRegion" href="">Quitar municipio</a>
									</td>
								</tr>
								<?php endforeach ?>
							<?php } catch(Exception $e) {}?>
							<tr class="regionRow">
								<td><label>Estado</label></td>
								<td>
									<select class="state" name="state">
										<option value="0">Estado</option>
										<?php
										foreach($regions as $item): ?>
										<option value="<?php echo $item->getIdRegion() ?>"><?php echo $item->prepareName() ?></option>
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
									<a id="anotherRegion" href="">Agregar otro municipio</a>
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
								//	$region = new Region($item);
//									if($region->getIdRegion() == 
									echo '<td colspan="2"><input type="checkbox" id="'.str_replace(' ','-',$region->prepareName()).'" class="region" name="region[]" value="'.$region->getIdRegion().'" /><label for="'.str_replace(' ','-',$region->prepareName()).'">'.$region->prepareName().'</label></td>';
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
										if($item->getIdRole() == 1 && !fAuthorization::checkAuthLevel('super')) continue;
										if($item->getIdRole() != $u->getIdRole()): ?>
										<option value="<?php echo $item->getIdRole() ?>"><?php echo $item->prepareName() ?></option>
										<?php else: ?>
										<option value="<?php echo $item->getIdRole() ?>" selected="selected"><?php echo $item->prepareName() ?></option>
										<?php endif ?>
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
							$up = new UserPermission();
							$userPermissions = $up->getByIdUser($u->getIdUser());
							$sections = Section::findAll();
							foreach($sections as $item):
							if($item->getIdSection() == 11 && !fAuthorization::checkAuthLevel('super')) continue;
							?>
							<tr>
								<td class="privilege" colspan="8"><?php echo $item->prepareName() ?></td>
							</tr>
								<?php
								$i = 0;
								$permissions = $p->getByIdSection($item->getIdSection());
								foreach($permissions as $p):
								$i++;
								$checked = false;
								if($i == 1) echo '<tr id="'.str_replace(' ','-',$item->prepareName()).'">'; ?>
									<?php foreach($userPermissions as $up): ?>
										<?php if($up->getIdPermission() == $p->getIdPermission()): ?>
										<td colspan="2"><input type="checkbox" name="permission[]" id="<?php echo str_replace(' ','-',$p->prepareName()) ?>" class="permission" value="<?php echo $p->getIdPermission() ?>" checked="checked" /><label for="<?php echo str_replace(' ','-',$p->prepareName()) ?>"><?php echo $p->prepareName() ?></label></td>
										<?php $checked = true;endif ?>
									<?php endforeach ?>
								<?php if(!$checked): ?>
								<td colspan="2"><input type="checkbox" name="permission[]" id="<?php echo str_replace(' ','-',$p->prepareName()) ?>" class="permission" value="<?php echo $p->getIdPermission() ?>" /><label for="<?php echo str_replace(' ','-',$p->prepareName()) ?>"><?php echo $p->prepareName() ?></label></td>
								<?php endif ?>
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
									<input type="hidden" name="whatToDo" value="user_edit" />
									<input type="submit" value="Guardar Cambios" class="button right" />
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