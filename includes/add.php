<?php
require_once '../init.php';
$section = 'observatorio';
$sub = 'addObs';

fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			if(empty($idUser) || !fAuthorization::checkACL($section, "add")) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
require_once INCLUDES.'header.php';
?>


			<link rel="stylesheet" href="<?php echo CSS ?>ui-lightness/jquery-ui-1.8.16.custom.css" type="text/css" />
			<link rel="stylesheet" href="<?php echo JS ?>jwysiwyg/jquery.wysiwyg.css" type="text/css" />
			
			<script type="text/javascript" src="<?php echo JS ?>jwysiwyg/jquery.wysiwyg.js"></script>
			
			<script type="text/javascript" src="<?php echo JS ?>jquery.form.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>jquery-ui-1.8.16.custom.min.js"></script>
			<script type="text/javascript" src="<?php echo JS ?>jquery.ui.core.min.js"></script>
	
			
			<script type="text/javascript" src="<?php echo JS ?>ui.multiselect.js"></script>
			<script src="<?php echo JS ?>jquery.validate.min.js"></script>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<script type="text/javascript" src="<?php echo SCRIPT . $section . "/" . "add"; ?>.js"></script>

			<script type="text/javascript">
				$(document).ready(function() {
					$(".wysiwyg").wysiwyg();
					initialize();
					//codeAddress();
					$(".multiselect").multiselect();
				});
				var infowindow = new google.maps.InfoWindow({ 
					disableAutoPan:false,
					size: new google.maps.Size(100,50)
				});

				function successCallback(position) {
					lat = position.coords.latitude;
					lon = position.coords.longitude;
				}

				function errorCallback(error) {
					dump(error);
				}

				function dump(obj) {
					var out = '';
					for (var i in obj)
						out += i + ": " + obj[i] + "\n";
					alert(out);
				}

				// A function to create the marker and set up the event window function 
				function createMarker(latlng, name, html) {
					var contentString = html;
					var marker = new google.maps.Marker({
						position: latlng,
						map: map,
						zIndex: Math.round(latlng.lat()*-100000)<<5
					});

					google.maps.event.addListener(marker, 'click', function() {
						infowindow.setContent(contentString); 
						infowindow.open(map,marker);
					});
					google.maps.event.trigger(marker, 'click');    
					$("#lat").val(lat);
					$("#lon").val(lon);
					return marker;
				}
				function codeAddress() { 
					var address = $("#address").val() + ", " + document.getElementById("city_i").value + ", " + $("#state option:selected").html() + ", " + $("#country option:selected").html();
					if (geocoder) {
						geocoder.geocode( { 'address': address}, function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								map.setCenter(results[0].geometry.location);
							} else {
								alert("Geocode was not successful for the following reason: " + status);
							}
						});
					}
				}

				function initialize() {
					geocoder = new google.maps.Geocoder();
					var latlng = new google.maps.LatLng(19.6929761,-101.1802989999);
					var myOptions = {
						zoom: 16,
						center: latlng,
						mapTypeControl: true,
						mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
						navigationControl: true,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}
					x = latlng.toString();
					x = x.split(",");
					lat = x[0].substring(1,x[0].length); 
					lon = x[1].substring(1,x[1].length-1);
					map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
					google.maps.event.addListener(map, 'click', function() {
						infowindow.close();
					});
					
					google.maps.event.addListener(map, 'click', function(event) {
						//call function to create marker
						if(marker) {
							marker.setMap(null);
							marker = null;
						}
						marker = createMarker(event.latLng, "name",'Mi negocio');
						lat = event.latLng.lat();
						lon = event.latLng.lng();
					});

					var latlng = new google.maps.LatLng(lat,lon);
					marker =  new google.maps.Marker({
						position: latlng,
						map: map,
						zIndex: Math.round(latlng.lat()*-100000)<<5
					});
					infowindow.setContent('Mi negocio'); 
					infowindow.open(map,marker);
				}
			</script>
			<style>
			.ui-autocomplete {width:300px; }
			.ui-corner-all {
				padding:3px;
			}
			</style>
			
			
			
			<!-- MAIN CONTAINER -->
			<div id="ja-container" class="wrap ja-r2">
				<div class="main clearfix"><div class="notification success" style="display:none;" >
								Se ha agregado exitosamente. 
							</div>
							<div class="notification errorBox" style="display:none;" >
								Ha ocurrido un error, revise la informaci&oacute;n. 
							</div>
							<br/>
					<form action="../do.php" method="post" id="add">
						<input type="hidden" name="request_token" value="<?php echo fRequest::generateCSRFToken(SITE . "do.php") ?>" />
						
						<input type="hidden" name="whatToDo" value="observatorio_add" />
						
						<table  class="contenttoc" style="float:left">
						
						
						<tr>
								<td><label> Nombre </label></td>
								<td><input type="text" name="title" size="80" /></td>
								
						
							</tr>
							<tr>
								<td> <label for="type"> Tipo de Vialidad: </label> </td>
								<td> <input type="text" size="80" name="type" id="type" /> </td>
							</tr>
							
							<tr>
								<td> <label for="text"> Descripci&oacute;n: </label> </td>
								<td> <textarea cols="80" rows="10" name="description" id="description" class="wysiwyg"></textarea> </td>
							</tr>
							
							<tr>
								<td> <label for="street"> Calle: </label> </td>
								<td> <input type="text" size="80" name="street" id="street" /> </td>
							</tr>
							
							<tr>
								<td> <label for="number"> N&uacute;mero: </label> </td>
								<td> <input type="text" size="10" name="number" id="number" /> </td>
							</tr>
							
							<tr>
								<td> <label for="type"> Asentamiento: </label> </td>
								<td> <input type="text" size="80" name="reserve" id="reserve" /> </td>
							</tr>
							
							<tr>
								<td> <label for="type"> Tel&eacute;fono: </label> </td>
								<td> <input type="text" size="80" name="phone" id="phone" /> </td>
							</tr>
							
								
									
							
					<?php if(fAuthorization::checkAuthLevel('super')): ?>
							<tr class="regionRow">
								<td><label>Región</label></td>
								<td>
									<select class="state" name="state">
										<option value="0">Estado</option>
										<?php
										$r = Region::findAll(1);
										foreach($r as $item): ?>
										<option value="<?php echo $item->prepareIdRegion() ?>"><?php echo $item->prepareName() ?></option>
										<?php endforeach ?>
									</select>
									<select class="region" name="region">
										<option value="0">Municipio</option>
									</select>
									<!-- <a id="anotherRegion" href="" style="margin-right:20px">Agregar otro municipio</a> -->
								</td>
							</tr>
							<?php else: ?>
							
							<?php 
							$ur = new UserRegion();
							$userRegions = $ur->getByIdUser($idUser);
					    ?>		
						<tr>
						 <td><label for="regions"> Regiones </label></td><td>
								    <select id="regions" name="region">

   <?php
										foreach($userRegions as $r) {
											$region = new Region($r->prepareId_region());
											
											echo '<option value="' . $region->prepareId_region() . '"> ' . $region->prepareName() . ' </option>';
										}
									?>
  </select>
  <center><span id="selectR" style="display:none;"> <b>Selecciona una regi&oacute;n</b></span></center>
</td>
						</tr>
							<?php endif ?>
							
							
							
						<tr>
							<td> <label for="status"> Estado <label> </td> 
							<td>
								<select name="status" style="width:200px"> 
									<option value="1"> Aceptado </option>
									<option value="0"> Rechazado </option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td> <label for="verified"> Verificado <label> </td> 
							<td>
								<select name="verified" style="width:200px"> 
									<option value="1"> Verificado </option>
									<option value="0"> No verificado </option>
								</select>
							</td>
						</tr>
						
							
							<tr>
						
								<td colspan="2"><input type="submit" value="Agregar" class="button right" /></td>
							</tr>
						</table>
						<table style="margin-left:20px; float:left">
								<tr><td><div id="map_canvas" style="width:500px;height:300px"></div></td></tr>
								
						</table>
					</form>
				</div>
			</div>
<?php require_once INCLUDES.'footer.php' ?>