<?php
$section = 'categories';
$section_id = 0;
$sub = 'list';

$typeOfUser = (fAuthorization::checkAuthLevel('super'));
$where = "";
if (!$typeOfUser) $where = " WHERE " . fSession::get('where_at');
?>
	
<?php
$limit = fRequest::encode('limit','integer');
$page = fRequest::encode('p','integer');

if($page < 1) exit();
$start = ($page - 1) * $limit;
$categories = fRecordSet::buildFromSQL(
	'Category',
	"SELECT * FROM category $where LIMIT $start,$limit",
	"SELECT count(*) FROM category $where",
	$limit, // $limit
	$page  // $page
);

if($categories->count() == 0) { 
echo '<div class="notification information" >
								Por el momento no hay registros en <b> Categor&iacute;as </b>.
							</div>';
} else {

$p = new Pagination($categories->getPages(),$categories->getPage(),3);
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
				foreach ($categories as $category) {
					
					
					$id = $category->prepareId_category();

						
						
						echo '<tr>
								<td> <input type="checkbox" class="check" value="' . $id . '" name="args[]" /> </td>
						';
						
						echo '
								<td> ' . $category->prepareName() . ' </td>
						';
						
						
						
						echo	'<td><center><a href="edit.php?id='.$id.'&s='.$category->prepareId_section().'"><img src="' . ICON . 'edit.png" /></a> </center></td>
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