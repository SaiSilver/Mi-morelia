<?php
/* if (ffranchiseization::checkAuthLevel('super') && ffranchiseization::checkAuthLevel('admin')) 
	header("Location: " . SITE);
	*/
/*
$typeOfUser = (ffranchiseization::checkAuthLevel('admin') || ffranchiseization::checkAuthLevel('super'));
$where = "";
if (!$typeOfUser) $where = " WHERE id_user = $idUser";
*/
/*
$canEdit = fAuthorization::checkACL('franchise', 'edit');
$canDelete = fAuthorization::checkACL('franchise', 'delete');
*/
$canEdit = true;
$canDelete = true;

$typeOfUser = (fAuthorization::checkAuthLevel('super'));

$where = " WHERE ";
if (!$typeOfUser) $where = " WHERE " . fSession::get('where_at') . " AND ";

?>
<?php
	$section = 'alertavial';
	$section_id = 21;
	$sub = 'list';
?>	
<?php
$query = fRequest::encode('query', 'string');
$limit = fRequest::encode('limit','integer');
$page = fRequest::encode('p','integer');
if($page < 1) exit();
$start = ($page - 1) * $limit;

$av = fRecordSet::buildFromSQL(
	'Observatorio',
	"SELECT * FROM observatorio $where (  id_region IN (SELECT id_region FROM region WHERE name LIKE '%$query%') OR description LIKE '%$query%' OR title LIKE '%$query%' ) LIMIT $start,$limit",
	"SELECT count(*) FROM observatorio $where (  id_region IN (SELECT id_region FROM region WHERE name LIKE '%$query%') OR description LIKE '%$query%' OR title LIKE '%$query%' )",
	$limit, // $limit
	$page  // $page
);


$p = new Pagination($av->getPages(), $av->getPage(),3);
$pagination = $p->getPaginationLinks();
?>


<center>
<table class="contenttoc" style="width:auto; float:none">
	<tr>
		<th> <input type="checkbox" name="check" id="check" /> </th>
		<th> T&iacute;tulo </th>
		<th> Texto </th>
		<th> Regi&oacute;n </th>
		<th> Estado </th>
	<?php if($canEdit): ?> <th> Editar </th> <?php endif; ?>
	<?php if($canDelete): ?> <th> Eliminar </th> <?php endif; ?>
	</tr>
	<?php
	// $user = new User();
	// $users = $user->getAll();
	foreach($av as $a): 
	
		$id = $a->prepareIdObservatorio();
		
		
		echo '<tr><td> <input type="checkbox" class="check" value="' . $id . '" name="args[]" /> </td>';
						
		echo '<td> ' . $a->prepareTitle() . ' </td>';
		echo '
			<td> ' . substr($a->prepareDescription(),0,30) . ' </td>
		';
						
		echo '<td>';	
			$idRegion = $a->prepareIdRegion();
			if (!empty($idRegion)):
			try {
				$region = new Region($idRegion);
				echo $region->prepareName();
			} catch(Exception $e){
				echo "Sin regi&oacute;n";
			}
			endif;
						
		echo '</td>';
		
				$status = $a->getStatus();
		$status = ($status == true || $status == "Yes" || $status == 1) ? "Activo" : "Inactivo";
		
		echo '<td> '. $status . "</td>";
		if($canEdit)
		echo '<td><center><a href="edit.php?id='.$id.'"><img src="' . ICON . 'edit.png" /></a> </center></td>';
		if($canDelete)
		echo '<td><center><a id="'.$id.'" class="eliminar" href="javascript:deleteIt(' . $id . ')"><img src="' . ICON . 'delete.png" /> </a> </center> </td>';
		echo '</tr>';
			
	endforeach;
	?>
	
</table>

<div class="pagination">
	<?php echo $pagination ?>
</div>

</center>