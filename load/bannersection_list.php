<?php
$section = 'banner';
$sub = 'list';
	
?>
	
<?php
$typeOfUser = (fAuthorization::checkAuthLevel('super'));
//$canEdit = fAuthorization::checkACL('poll', 'edit');
//$canDelete = fAuthorization::checkACL('poll', 'delete');
$where = "";
if (!$typeOfUser) $where = " WHERE " . fSession::get('where_at');
$limit = fRequest::encode('limit','integer');
$page = fRequest::encode('p','integer');

if($page < 1) exit();
$start = ($page - 1) * $limit;
$sections = fRecordSet::buildFromSQL(
	'BannerSection',
	"SELECT * FROM bannersection $where LIMIT $start,$limit",
	"SELECT count(*) FROM bannersection $where",
	$limit, // $limit
	$page  // $page
);

if($sections->count() == 0) { 
echo '<div class="notification information" >
								Por el momento no hay registros en <b> Secciones de banners </b>.
							</div>';
} else {

$p = new Pagination($sections->getPages(),$sections->getPage(),3);
$pagination = $p->getPaginationLinks();
?>
<center>
<table class="contenttoc" style="width:auto; float:left">
				<tr>
					<th> <input type="checkbox" name="check" id="check" /> </th>
					<th> Nombre </th>
					<th> Editar </th>
					<th> Eliminar </th>
				</tr>
				
				<?php
				date_default_timezone_set('America/Mexico_City');
				foreach ($sections as $section) {
					
					
					$id = $section->prepareIdBannersection();

						
						
						echo '<tr>
								<td> <input type="checkbox" class="check" value="' . $id . '" name="args[]" /> </td>
						';
						
						echo '
								<td> ' . $section->prepareName() . ' </td>
						';

						echo	'<td><center><a href="editSection.php?id='.$id.'"><img src="' . ICON . 'edit.png" /></a> </center></td>
								<td><center><a id="'.$id.'" class="eliminar" href="javascript:deleteIt(' . $id . ')"><img src="' . ICON . 'delete.png" /> </a> </center> </td>
							</tr>
						';
					
					}
					
				?>
				
				
				
				</table>
<br style="clear:both;" />
<div class="pagination">
	<?php echo $pagination ?>
</div>
</center>
<?php } ?>