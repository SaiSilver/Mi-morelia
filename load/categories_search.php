<?php
$section = 'categories';
$section_id = 0;
$sub = 'list';
$typeOfUser = (fAuthorization::checkAuthLevel('super'));
$where = " WHERE ";
if (!$typeOfUser) $where = " WHERE " . fSession::get('where_at') . " AND ";
?>
	
<?php
$limit = fRequest::encode('limit','integer');
$page = fRequest::encode('p','integer');
$query = fRequest::encode('query','string');
if($page < 1) exit();
$start = ($page - 1) * $limit;
$categories = fRecordSet::buildFromSQL(
	'category',
	"SELECT * FROM category $where (name LIKE '%$query%') LIMIT $start,$limit",
	"SELECT count(*) FROM category $where (name LIKE '%$query%')",
	$limit, // $limit
	$page  // $page
);


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