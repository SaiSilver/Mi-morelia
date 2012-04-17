<?php
fSession::open();
$authLevel = fAuthorization::getUserAuthLevel();

if($authLevel == 'guest') exit();
$idUser = fSession::get(SESSION_ID_USER);
if(empty($idUser)) header('Location: '.LOGIN);

//if(fAuthorization::checkACL($section,$sub)) echo "si";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- saved from url=(0064)http://demo.mariuszboloz.com/joomla/new-business/?ja_color=green -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">
	<?php require_once 'head.php' ?>
	<body id="bd" class="fs3 Moz">
		<div id="loader"><img src="<?php echo IMAGES ?>loader.gif" style="position:absolute; top:50%; left:50%;" /> <span style="position:absolute; left:46%; top:8%;"><b>Guardando los cambios, espere porfavor.</b></span> </div>
		<div id="ja-wrapper">
			<!-- MAIN NAVIGATION -->
			<div id="ja-mainnav" class="wrap">
				<div class="main clearfix">
					<ul id="ja-cssmenu" class="clearfix">
						<?php if(fAuthorization::checkAuthLevel('admin')): ?><li<?php if($section == 'general') echo ' class="active"'; ?>><a href="<?php echo HOME ?>">General</a></li><?php endif ?>
						
						<?php
						// if(fAuthorization::checkACL('banner', 'add') || fAuthorization::checkACL('banner', 'edit') || fAuthorization::checkACL('banner', 'delete')): ?>
						
						<li<?php if($section == 'banner') echo ' class="active"'; ?>>
							<a href="<?php echo BANNER ?>list.php">Publicidad</a>
						</li> 
						
						<?php // endif ?>

						
						<?php //if(fAuthorization::checkACL('user', 'add') || fAuthorization::checkACL('user', 'edit') || fAuthorization::checkACL('user', 'delete')): ?>
						<li<?php if($section == 'user') echo ' class="active"'; ?>><a href="<?php echo USER ?>list.php">Usuarios</a></li><?php //endif ?>
						
						
						<?php // if(fAuthorization::checkAuthLevel('super') || fAuthorization::checkAuthLevel('admin')): ?><li<?php if($section == 'categories') echo ' class="active"'; ?>> <a href="<?php echo CATEGORIES ?>list.php"> Categor&iacute;as </a></li> <?php // endif; ?>
						
						<?php // if(fAuthorization::checkAuthLevel('super') || fAuthorization::checkAuthLevel('admin')): ?><li<?php if($section == 'geolocation') echo ' class="active"'; ?>> <a href="<?php echo GEOLOCATION ?>list.php"> Geolocalizac&oacute;n </a></li> <?php //endif; ?>
							
						<li><a href="<?php echo LOGOUT ?>">Salir</a></li>
					</ul>
				</div>
			</div>
			<!-- //MAIN NAVIGATION -->
			<!-- TOP SPOTLIGHT -->
			<div id="ja-topsl" class="wrap">
				<div class="main clearfix">
					<div class="ja-box column ja-box-left" style="">
						<ul id="ja-css-submenu" class="clearfix">
							<div id="banner-mn" class="<?php echo ($section == 'banner')?'shown':'hidden' ?>">
							<?php if(fAuthorization::checkACL('banner', 'edit') || fAuthorization::checkACL('banner', 'delete')): ?>
							<li<?php if($sub == 'list') echo ' class="active"'; ?>><a href="<?php echo BANNER?>list.php">Listar</a></li><?php endif ?>
							<?php if(fAuthorization::checkACL('banner', 'add')): ?><li<?php if($sub == 'add') echo ' class="active"'; ?>><a href="<?php echo BANNER?>add.php">Agregar</a></li><?php endif ?>
							<li<?php if($sub == 'listSection') echo ' class="active"'; ?>><a href="<?php echo BANNER?>listSection.php">Listar Secci&oacute;n / Zona</a></li>
							<li<?php if($sub == 'addSection') echo ' class="active"'; ?>><a href="<?php echo BANNER?>addSection.php">Agregar Secci&oacute;n / Zona</a></li>
							</div>
							
							<div id="user-mn" class="<?php echo ($section == 'user')?'shown':'hidden' ?>">
								<?php if(fAuthorization::checkACL('user', 'edit') || fAuthorization::checkACL('user', 'delete')): ?>
								<li<?php if($sub == 'list') echo ' class="active"'; ?>><a href="<?php echo USER?>list.php">Listar</a></li>
								<?php endif ?>
								<?php if(fAuthorization::checkACL('user', 'add')): ?>
								<li<?php if($sub == 'add') echo ' class="active"'; ?>><a href="<?php echo USER?>add.php">Agregar</a></li>
								<?php endif ?>
							</div>
							
						
								<?php if(fAuthorization::checkAuthLevel('employee')): ?>
							<div id="user-mn" class="<?php echo ($section == 'categories')?'shown':'hidden' ?>">
								
								<li<?php if($sub == 'list') echo ' class="active"'; ?>><a href="<?php echo CATEGORIES?>list.php">Listar</a></li>
								
								
								<li<?php if($sub == 'add') echo ' class="active"'; ?>><a href="<?php echo CATEGORIES?>add.php">Agregar</a></li>
								
							</div>
							
							<?php endif; ?>
							
							<div id="geolocation-mn" class="<?php echo ($section == 'geolocation')?'shown':'hidden' ?>">
							<?php if(fAuthorization::checkACL('geolocation', 'edit') || fAuthorization::checkACL('geolocation', 'delete')): ?>
							<li<?php if($sub == 'list') echo ' class="active"'; ?>><a href="<?php echo GEOLOCATION?>list.php">Listar</a></li><?php endif ?>
							<?php if(fAuthorization::checkACL('geolocation', 'add')): ?><li<?php if($sub == 'add') echo ' class="active"'; ?>><a href="<?php echo GEOLOCATION?>add.php">Agregar</a></li><?php endif ?>
							</div>
							
						</ul>
					</div>
				</div>
			</div><!-- //TOP SPOTLIGHT -->