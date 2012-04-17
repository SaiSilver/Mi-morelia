<?php
require_once '../init.php';
$id_section = 10;
$section = 'user';
$sub = 'list';
fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			//if(empty($idUser) || (!fAuthorization::checkACL($section, "delete") && !fAuthorization::checkACL($section, "edit"))) {
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
require_once INCLUDES.'header.php';
?>
			<!-- MAIN CONTAINER -->
			<script type="text/javascript" src="<?php echo SCRIPT.$section.DS.$sub ?>.js"></script>
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix">
					<input type="text" value="B&uacute;squeda.." class="text" title="B&uacute;squeda.." name="query" id="query" style="width:200px;margin-left:930px" />
				
				<br/><br/>
					<div id="users">
						
					</div>
					<span class="right">
						<label for="limit">Resultados por página</label>
						<input type="text" name="limit" id="limit" size="1" value="10" />
					</span>
				</div>
			</div><!-- //MAIN CONTAINER
<?php require_once INCLUDES.'footer.php' ?>