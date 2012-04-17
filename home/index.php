<?php
require_once '../init.php';
$section = 'general';
$sub = '';
fSession::open();
$idUser = fSession::get(SESSION_ID_USER);
$user = new User($idUser);
require_once INCLUDES.'header.php';
?>
			<!-- MAIN CONTAINER -->
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix">
				<h4> Bienvenido, <?php echo $user->prepareFirstName() . " " . $user->prepareLastName(); ?>				 </h4>
				
					<br/><br/><br/><h2> Selecciona una opci&oacute;n del menu </h2>
				</div>
			</div>
<?php require_once INCLUDES.'footer.php' ?>