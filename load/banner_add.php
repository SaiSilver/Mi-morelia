<?php
		fSession::open();
			$idUser = fSession::get(SESSION_ID_USER);
			if(empty($idUser) || !fAuthorization::checkACL('banner', 'add')) {
			if(empty($idUser)) {
				header('Location: '.SITE);
				exit("No se ha podido acceder a esta secci&oacite;n");
			}
	}
	

	//echo  fRequest::encode('id_zone','integer');
	//echo  fRequest::encode('id_section','integer');
				/*
				 * Add Article
				 */
				 
				$banner = new Banner();
				
				$banner->setId_zone(fRequest::encode('id_zone','integer'));
				$banner->setLink(fRequest::encode('link','string'));
				$banner->setOrder(fRequest::encode('order','integer'));
				$banner->setId_section(fRequest::encode('id_section','integer'));

				/* Limited By User Permissions */
				$banner->setStatus(fRequest::get('id_state','integer'));
				try {
					$banner->store();
				} catch (Exception $e){
					exit ("Ha ocurrido un error.");
				}
				
				$lastId = $banner->prepareIdBanner();
				
				/*
				 * Add Region 
				 * Limited By User Permissions
				 */
			
			
				/*
				 * Add Files to Server
				 */
				if (!empty($_FILES)) {
				$uploader = new fUpload();
				$uploader->setOptional();
				$uploader->setMIMETypes(
					$acceptedFiles,
					'El tipo de archivo es incorrecto'
				);
				
				
				
				
				$dir = 'uploads/banners/';
				$dir2 = 'uploads/banners/thumbs/';
				
				$imageDescrip = fRequest::encode('imageDescrip');
				
				
				
				$uploaded = fUpload::count('files');
				for ($i=0; $i < $uploaded; $i++) {
						$ext = strtolower(pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION));
						$_FILES['files']['name'][$i] = fURL::makeFriendly(str_replace(' ','-',$_FILES['files']['name'][$i])).".$ext";
						$uploader->move($dir, 'files', $i);
						$fileName[] = $_FILES['files']['name'][$i];
						$fileType[] = $_FILES['files']['type'][$i];
						
						copy($dir . $fileName[$i],$dir2 . $fileName[$i]);
						$image3 = new fImage($dir2 . $fileName[$i]);
						$image3->cropToRatio(1, 1, 'left', 'bottom');
						$image3->resize(200,0);
						$image3->saveChanges();
						/*
				    $ftp = new ftp($user,$pass);
					$ftp->upload($dir . "/" . $fileName[$i], 'DIR EN REMOTE');
					# resize 
					$ftp->upload($dir2 . "/" . $fileName[$i], 'DIR EN REMOTE');
					$image->delete
					*/
					
					}
								
					/*
					 * Add Files to DataBase (Resource)
					*/
				 
					try {
						$statement = fORMDatabase::retrieve()->prepare("INSERT INTO resource (id_entity,id_section,token,url,resource_type,description) VALUES (%i, 1, '', %s, %s, %s)");
						for ($i=0; $i < $uploaded; $i++) { 
						  if($imageDescrip[$i] == "Si es necesario escribe la descripci&oacute;n del archivo") $imageDescrip[$i] = "";
						fORMDatabase::retrieve()->query($statement, $lastId, $fileName[$i], $banner->getResourceType($fileType[$i]), $imageDescrip[$i]); 
						}
					} catch (fSQLException $e){
						die("No se ha podido ejecutar la consulta");
					}
				}
				
				exit("1");
				
				?>