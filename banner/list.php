<?php
require_once '../init.php';
$section = 'banner';
$section_id = 1;
$sub = 'list';
fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			//if(empty($idUser) || (!fAuthorization::checkACL($section, "delete") && !fAuthorization::checkACL($section, "edit"))) {
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
require_once  INCLUDES.'header.php';


?>
			<script type="text/javascript" src="<?php echo SCRIPT . $section . "/" .  $sub; ?>.js"></script>
		
			
			
			<!-- MAIN CONTAINER -->
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix">
				<input type="text" value="B&uacute;squeda.." title="B&uacute;squeda.." class="text" id="query" name="query" style="width:200px;margin-left:831px" />
				
				<br/>
				<?php //Article::getImage(10, 2); ?>
				<br/>
				
				<div id="banner">
						
				</div>
				
				<br style="clear:both;"/> &nbsp; &nbsp; <a href="javascript:deleteIt(0)">Eliminar los seleccionados</a>
				<span style="float:right">Cantidad de banners por p&aacute;gina: <input  type="text" name="limit" id="limit" size="3" value="5" /></span>
				</div>
				
			</div>
<?php require_once INCLUDES.'footer.php' ?>