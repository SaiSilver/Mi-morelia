<?php
require_once '../init.php';
$section = 'categories';
$section_id = 0;
$sub = 'list';
/*if(!fAuthorization::checkAuthLevel('employee')): 
	exit("No se ha podido acceder");
endif; 
*/

require_once  INCLUDES.'header.php';
?>
<script type="text/javascript" src="<?php echo SCRIPT . $section . "/" .  $sub; ?>.js"></script>

				
		
			
			
			<!-- MAIN CONTAINER -->
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix">
					<input type="text" value="B&uacute;squeda.." class="text" title="B&uacute;squeda.." name="query" id="query" style="width:200px;margin-left:930px" />
				
				
				<br/>
				
				<br/>
				
				<div id="category">
				</div>
				<br style="clear:both;"/> &nbsp; &nbsp; <a href="javascript:deleteIt(0)">Eliminar los seleccionados</a>
				<span style="float:right">Cantidad de categor&iacute;as por p&aacute;gina: <input  type="text" name="limit" id="limit" size="3" value="5" /></span>
				</div>
				
			</div>
<?php require_once INCLUDES.'footer.php' ?>