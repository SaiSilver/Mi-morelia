<?php
$limit = fRequest::encode('limit','integer');
$page = fRequest::encode('p','integer');
if($page < 1) exit();
$start = ($page - 1)*$limit;

$typeOfUser = (fAuthorization::checkAuthLevel('super'));
$where = "";

$users = fRecordSet::buildFromSQL(
	'User',
	"SELECT * FROM ".TBL_USER." $where LIMIT $start,$limit",
	"SELECT count(*) FROM ".TBL_USER . " $where",
	$limit, // $limit
	$page  // $page
);
if($users->count() == 0) { 
echo '<div class="notification information" >
								Por el momento no hay registros en <b> Usuarios </b>
							</div>';
} else {
$p = new Pagination($users->getPages(),$users->getPage(),3);
$pagination = $p->getPaginationLinks();
?>
<center>
<table class="contenttoc" style="width:100%;float:none">
	<tr>
		<th><input type="checkbox" id="check" /></th>
		<th>Email</th>
		<th>Rol</th>
		<th>Nombre</th>
		<th>Apellidos</th>
		<th>Fecha Nacimiento</th>
		<th>Teléfono</th>
		<th>Celular</th>
		<th>Nextel</th>
		<th>Último Acceso</th>
		<th>Fecha Registro</th>
		<?php //if(fAuthorization::checkACL('user', 'edit')): ?><th>Editar</th><?php //endif ?>
		<?php //if(fAuthorization::checkACL('user', 'delete')): ?><th>Eliminar</th><?php //endif ?>
	</tr>
	<?php
	foreach($users as $item): ?>
	<tr>
		<td><input type="checkbox" class="check" /></td>
		<td><?php echo $item->prepareEmail() ?></td>
		<td><?php echo "Rol" ?></td>
		<td><?php echo $item->prepareFirstName() ?></td>
		<td><?php echo $item->prepareLastName() ?></td>
		<td><?php if($item->getBirthday()) echo $item->getBirthday()->format('n/j/y') ?></td>
		<td><?php echo $item->preparePhone() ?></td>
		<td><?php echo $item->prepareCellphone() ?></td>
		<td><?php echo $item->prepareNextel() ?></td>
		<td><?php if($item->getUpdatedAt()) echo $item->getUpdatedAt()->format('n/j/y') ?></td>
		<td><?php if($item->getCreatedAt()) echo $item->getCreatedAt()->format('n/j/y') ?></td>
		<?php //if(fAuthorization::checkACL('user', 'edit')): ?><td><a href="<?php echo USER.'edit.php?id='.$item->getIdUser() ?>" title="edit" class="edit"><img src="<?php echo ICON?>edit.png" /></a></td><?php //endif ?>
		<?php //if(fAuthorization::checkACL('user', 'delete')): ?><td><a href="" title="<?php echo $item->getIdUser(); ?>" class="delete"><img src="<?php echo ICON?>delete.png" /></a></td><?php //endif ?>
	</tr>
	<?php endforeach ?>
</table>
<div class="pagination">
	<?php echo $pagination ?>
</div>
</center>
<?php } ?>