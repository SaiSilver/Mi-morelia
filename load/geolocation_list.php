<?php
/* if (fAuthorization::checkAuthLevel('super') && fAuthorization::checkAuthLevel('admin')) 
	header("Location: " . SITE);
	*/
/*
$typeOfUser = (fAuthorization::checkAuthLevel('admin') || fAuthorization::checkAuthLevel('super'));
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

$where = "";
if (!$typeOfUser) $where = " WHERE " . fSession::get('where_at');

?>
<?php
	$section = 'observatorio';
	$section_id = 22;
	$sub = 'list';
?>	
<?php
$limit = fRequest::encode('limit','integer');
$page = fRequest::encode('p','integer');
if($page < 1) exit();
$start = ($page - 1) * $limit;

$av = fRecordSet::buildFromSQL(
	'Observatorio',
	"SELECT * FROM observatorio $where LIMIT $start,$limit",
	"SELECT count(*) FROM observatorio $where",
	$limit, // $limit
	$page  // $page
);

if($av->count() == 0) { 
echo '<div class="notification information" >
								Por el momento no hay registros en <b> Observatorio </b>.
							</div>';
} else {

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
<?php } ?>