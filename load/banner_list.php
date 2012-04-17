<?php
$typeOfUser = (fAuthorization::checkAuthLevel('super'));
$where = "";
if (!$typeOfUser) $where = " WHERE id_banner IN (SELECT id_banner FROM bannerregion WHERE " . fSession::get('where_at') . ")";

$canEdit = fAuthorization::checkACL('banner', 'edit');
$canDelete = fAuthorization::checkACL('banner', 'delete');


?>
<?php
	
	$section = 'banners';
	$section_id = 1;
	$sub = 'list';
	
?>
	
<?php
$limit = fRequest::encode('limit','integer');

$page = fRequest::encode('p','integer');
if($page < 1) exit();
$start = ($page - 1) * $limit;

//echo $start; echo $page;
$banners = fRecordSet::buildFromSQL(
	'Banner',
	"SELECT * FROM banner $where LIMIT $start,$limit",
	"SELECT count(*) FROM banner $where",
	$limit, // $limit
	$page  // $page
);
if($banners->count() == 0) { 
echo '<div class="notification information" >
								Por el momento no hay registros en <b> Publicidad </b>.
							</div>';
} else {

$p = new Pagination($banners->getPages(),$banners->getPage(),3);
$pagination = $p->getPaginationLinks();
?>
<center>
<table class="contenttoc" style="width:auto; float:left">
				<tr>
					<th> <input type="checkbox" name="check" id="check" /> </th>
					<th> Imagen </th>
					<th> Link </th>
					<th> Secci&oacute;n  </th>
					<th> Region </th>
					<th> Orden </th>
					<th> Estado </th>
					<th> Fecha de publicaci&oacute;n </th>
					<?php if($canEdit): ?> <th> Editar </th> <?php endif; ?>
					<?php if($canDelete): ?> <th> Eliminar </th> <?php endif; ?>
				</tr>
				
				<?php
				date_default_timezone_set('America/Mexico_City');
				foreach ($banners as $banner) {
					
					$date1 = new fDate($banner->getCreated_at());
					$id = $banner->prepareId_banner();
				
						//$category = new Category(array('id_category' => $article->prepareId_category(), 'id_section' => $section_id));
						try {
						$bannerRegions = BannerRegion::findRegions($id);
						} catch(Exception $e) { }
						//$user = new User($article->prepareId_user());
						$status = $banner->getStatus();
						$status = ($status == true || $status == "Yes" || $status == 1) ? "Publicado" : "No publicado";
						
						echo '<tr>
								<td> <input type="checkbox" class="check" value="' . $id . '" name="args[]" /> </td>
						';
						$image = Banner::getImage($id, 1);
						if(!empty($image)) echo '
							<td> <img width="200" height="80" src="../../uploads/banners/thumbs/' .  $image . '"/> </td>';
						else echo '<td> - </td>';
						
						echo '
								<td> ' . $banner->prepareLink() . ' </td>
								<td> ' . BannerSection::findName($banner->prepareId_section()) . ' </td>
						';
						
						
						
						echo '<td>';
						foreach($bannerRegions as $bannerRegion){
							$regionId = $bannerRegion->prepareId_region();
							try { $region = new Region($regionId); echo $region->prepareName() . "<br/>"; } catch(Exception $e) { echo "Sin regi&oacute;n <br/>";  }
							
						}
						
						echo '</td>';
						
						
						echo	' <td> <center> ' . $banner->getOrder() . ' </center> </td>
						<td> ' . $status . ' </td>
								<td> <center>'  . $date1->format('d-m-Y') . '</center> </td>';
								
						if($canEdit)
						echo '<td><center><a href="edit.php?id='.$id.'"><img src="' . ICON . 'edit.png" /></a> </center></td>';
						if($canDelete)
						echo '<td><center><a id="'.$id.'" class="eliminar" href="javascript:deleteIt(' . $id . ')"><img src="' . ICON . 'delete.png" /> </a> </center> </td>';
						
						echo '</tr>';
					
					}
					
				?>
				
				
				
				</table>
				
<br style="clear:both;" />
<div class="pagination">
	<?php echo $pagination ?>
</div>
</center>
<?php } ?>