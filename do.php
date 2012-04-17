<?php
include_once 'init.php';
fSession::open();
$idUser = fSession::get(SESSION_ID_USER);
if(empty($idUser))
	exit("No tienes permiso de acceder a este archivo.");
if (fRequest::isPost()) {
	try {
	//fRequest::validateCSRFToken(fRequest::get('request_token'));
					
		$do = fRequest::get('whatToDo','string');
	
		switch($do){
		/*
			* Plaza
			*/
			case 'plaza_add':
				require_once LOAD.'plaza_add.php';
				break;
			case 'plaza_edit':
				require_once LOAD.'plaza_edit.php';
				break;
			case 'plaza_list':
				require_once LOAD.'plaza_list.php';
				break;
			case 'plaza_search':
				require_once LOAD . 'plaza_search.php';
			break;
			case 'plaza_delete':
				require_once LOAD.'plaza_delete.php';
				break;
			case 'giro_add':
				require_once LOAD.'giro_add.php';
			break;
			
			case 'giro_edit':
				require_once LOAD.'giro_edit.php';
			break;
			case 'giro_list':
				require_once LOAD.'giro_list.php';
			break;
			case 'giro_search':
				require_once LOAD.'giro_search.php';
			break;
			case 'giro_delete':
				require_once LOAD.'giro_delete.php';
			break;
			
			
			case 'girot_add':
				require_once LOAD.'girot_add.php';
			break;
			case 'girot_edit':
				require_once LOAD.'girot_edit.php';
			break;
			case 'girot_list':
				require_once LOAD.'girot_list.php';
			break;
			case 'girot_search':
				require_once LOAD.'girot_search.php';
			break;
			case 'girot_delete':
				require_once LOAD.'girot_delete.php';
			break;
			
				
			case 'subgiro_list':
				require_once LOAD.'subgiro_list.php';
			break;
			case 'subgiro_search':
				require_once LOAD.'subgiro_search.php';
			break;
			case 'subgiro_delete':
				require_once LOAD.'subgiro_delete.php';
			break;
			
			case 'subgirot_list':
				require_once LOAD.'subgirot_list.php';
			break;
			case 'subgirot_search':
				require_once LOAD.'subgirot_search.php';
			break;
			case 'subgirot_delete':
				require_once LOAD.'subgirot_delete.php';
			break;
			/*
			* Real
			*/
			case 'real_add':
				require_once LOAD.'real_add.php';
				break;
			case 'real_edit':
				require_once LOAD.'real_edit.php';
				break;
			case 'real_list':
				require_once LOAD.'real_list.php';
				break;
			case 'real_search':
				require_once LOAD.'real_search.php';
			break;
			case 'real_delete':
				require_once LOAD.'real_delete.php';
				break;
				
			/*
			* Real
			*/
			case 'articleagency_add':
				require_once LOAD.'articleagency_add.php';
				break;
			case 'articleagency_edit':
				require_once LOAD.'articleagency_edit.php';
				break;
			case 'articleagency_list':
				require_once LOAD.'articleagency_list.php';
				break;
			case 'articleagency_search':
				require_once LOAD.'articleagency_search.php';
			break;
			case 'articleagency_delete':
				require_once LOAD.'articleagency_delete.php';
				break;
			/*
			* User
			*/
			case 'user_add':
				require_once LOAD.'user_add.php';
				break;
			case 'user_edit':
				require_once LOAD.'user_edit.php';
				break;
			case 'user_list':
				require_once LOAD.'user_list.php';
				break;
			case 'user_search':
				require_once LOAD.'user_search.php';
			break;
			case 'user_delete':
				require_once LOAD.'user_delete.php';
				break;
			
			/*
			*	Alerta vial
			*/
			
			case 'alertavial_add': 
				require_once LOAD.'alertavial_add.php'; 
				break;
			case 'alertavial_edit':
				require_once LOAD.'alertavial_edit.php';
				break;
			case 'alertavial_list':
				require_once LOAD.'alertavial_list.php';
				break;
			case 'alertavial_search':
				require_once LOAD.'alertavial_search.php';
			break;
			case 'alertavial_delete':
				require_once LOAD.'alertavial_delete.php';
			break;
			
			/*
			* Observatorio
			*/
			case 'observatorio_add': 
				require_once LOAD.'observatorio_add.php'; 
				break;
			case 'observatorio_edit':
				require_once LOAD.'observatorio_edit.php';
				break;
			case 'observatorio_list':
				require_once LOAD.'observatorio_list.php';
				break;
			case 'observatorio_search':
				require_once LOAD.'observatorio_search.php';
			break;
			case 'observatorio_delete':
				require_once LOAD.'alertavial_delete.php';
			break;
			/* 
			* Franchise
			*/
			case 'franchise_add':
				require_once LOAD.'franchise_add.php';
				break;
			case 'franchise_edit':
				require_once LOAD.'franchise_edit.php';
				break;
			case 'franchise_list':
				require_once LOAD.'franchise_list.php';
				break;
			case 'franchise_search':
				require_once LOAD . 'franchise_search.php';
			break;
			case 'franchise_delete':
				require_once LOAD.'franchise_delete.php';
				break;
			/*
			* News
			*/
			
			case "news_add":
				require_once LOAD . "news_add.php";
			//var_dump(fRequest::get('imageDescrip'));
			break;
		
			case "news_edit":
				require_once LOAD . "news_edit.php";
			break;
			
			case "news_delete":
				require_once LOAD . "news_delete.php";
			break;
			
			case 'news_list':
				require_once LOAD.'news_list.php';
			break;
			
			case 'news_search':
				require_once LOAD.'news_search.php';
			break;
			
			
			/*
			* Events
			*/
			case "event_add":
				require_once LOAD . "event_add.php";
			break;
			
			case "event_edit":
				require_once LOAD . "event_edit.php";
			break;
			case "event_delete":
				require_once LOAD . "event_delete.php";
			break;
			case "event_list":
				require_once LOAD . "event_list.php";
			break;
			case "event_search":
				require_once LOAD . "event_search.php";
			break;
			
			/*
			* Poll
			*/
			
			case "poll_add":
				require_once LOAD . "poll_add.php";
			break;
			
			case "poll_edit":
				require_once LOAD . "poll_edit.php";
			break;
			case "poll_delete":
				require_once LOAD . "poll_delete.php";
			break;
			case 'poll_list':
				require_once LOAD.'poll_list.php';
			break;
			
			case 'poll_search':
				require_once LOAD . 'poll_search.php';
			break;
			
			/*
			* University
			*/
			
			case "university_add":
				require_once LOAD . "university_add.php";
			break;
			
			case "university_edit":
				require_once LOAD . "university_edit.php";
			break;
			case "university_delete":
				require_once LOAD . "university_delete.php";
			break;
			case 'university_list':
				require_once LOAD.'university_list.php';
			break;
			
			case 'university_search':
				require_once LOAD . 'university_search.php';
			break;
			
			case "course_add":
				require_once LOAD . "course_add.php";
			break;
			
			case "course_edit":
				require_once LOAD . "course_edit.php";
			break;
			case "course_delete":
				require_once LOAD . "course_delete.php";
			break;
			case 'course_list':
				require_once LOAD.'course_list.php';
			break;
			
			case 'course_search':
				require_once LOAD . 'course_search.php';
			break;
			
			/* 
			* Categories
			*/
			
			case 'categories_add':
				require_once LOAD . 'categories_add.php';
			break;
			
			case 'categories_edit':
				require_once LOAD . 'categories_edit.php';
			break;
			case 'categories_delete':
				require_once LOAD . 'categories_delete.php';
			break;
			
			case 'categories_list':
				require_once LOAD . 'categories_list.php';
			break;
			
			case 'categories_search':
				require_once LOAD . 'categories_search.php';
			break;
			
			/* 
			* Giros
			*/
			
			case 'giro_add':
				require_once LOAD . 'giro_add.php';
			break;
			
			case 'giro_edit':
				require_once LOAD . 'giro_edit.php';
			break;
			
			case 'giro_list':
				require_once LOAD . 'giro_list.php';
			break;
			
			case 'giro_search':
				require_once LOAD . 'giro_search.php';
			break;
			case 'giro_delete':
				require_once LOAD . 'giro_delete.php';
			break;
			
			/* Turism */
			
				case 'turism_add':
				require_once LOAD . 'turism_add.php';
			break;
			
			case 'turism_edit':
				require_once LOAD . 'turism_edit.php';
			break;
			
			case 'turism_list':
				require_once LOAD . 'turism_list.php';
			break;
			
			case 'turism_search':
				require_once LOAD . 'turism_search.php';
			break;
			case 'turism_delete':
				require_once LOAD . 'turism_delete.php';
			break;
			
			
			case 'turismb_add':
				require_once LOAD . 'turismb_add.php';
			break;
			
			case 'turismb_edit':
				require_once LOAD . 'turismb_edit.php';
			break;
			
			case 'turismb_list':
				require_once LOAD . 'turismb_list.php';
			break;
			
			case 'turismb_search':
				require_once LOAD . 'turismb_search.php';
			break;
			case 'turismb_delete':
				require_once LOAD . 'turismb_delete.php';
			break;
			
			
			
			/*
			* Classified
			* Incomplete!
			*/
			
			
			
			case "classified_add":
				require_once LOAD . "classified_add.php";
			break;
			
			case "classified_edit":
				require_once LOAD . "classified_edit.php";
			break;
			case "classified_delete":
				require_once LOAD . "classified_delete.php";
			break;
			
			case "classified_list":
				require_once LOAD . "classified_list.php";
			break;
			
			case "classified_search":
				require_once LOAD . "classified_list.php";
			break;
			
			case "classifiedalert_list":
				require_once LOAD . "classifiedalert_list.php";
			break;
			
			case "classifiedalert_search":
				require_once LOAD . "classifiedalert_search.php";
			break;
			
			case "classifiedalert_delete":
				require_once LOAD . "classifiedalert_delete.php";
			break;
			
			/*
			* Banner
			*/
			
			case "banner_add":
				require_once LOAD . "banner_add.php";
			break;
			
			case "banner_edit":
				require_once LOAD . "banner_edit.php";
			break;
			case "banner_delete":
				require_once LOAD . "banner_delete.php";
			break;
			
			case 'banner_list':
				require_once LOAD.'banner_list.php';
			break;
			
			case 'banner_search':
				require_once LOAD.'banner_search.php';
			break;
			
			case 'load_zones':
				require_once LOAD.'load_zones.php';
			break;
			
			case 'bannersection_add':
				require_once LOAD.'bannersection_add.php';
			break;
			
			case 'bannersection_edit':
				require_once LOAD.'bannersection_edit.php';
			break;
			
			case 'bannersection_list':
				require_once LOAD.'bannersection_list.php';
			break;
			
			case 'bannersection_delete':
				require_once LOAD.'bannersection_delete.php';
			break;
			
			case 'bannersection_search':
				require_once LOAD.'bannersection_search.php';
			break;
			
			case 'load_bannersections':
				require_once LOAD.'load_bannersections.php';
			break;
			
			/*
			* Authors
			*/
			
			case "author_add":
				require_once LOAD . 'author_add.php';
			break;
			
			case "author_edit":
				require_once LOAD . 'author_edit.php';
			break;
			
			case "author_list":
				require_once LOAD . 'author_list.php';
			break;
			
			case "author_search":
				require_once LOAD . 'author_search.php';
			break;
			
			case "author_delete":
				require_once LOAD . "author_delete.php";
			break;
			/*
			* Buen Comer
			*/
			
			case "buencomer_add":
				require_once LOAD . 'buencomer_add.php';
			break;
			
			case "buencomer_edit":
				require_once LOAD . 'buencomer_edit.php';
			break;
			
			case "buencomer_list":
				require_once LOAD . 'buencomer_list.php';
			break;
			case "buencomer_search":
				require_once LOAD . 'buencomer_search.php';
			break;
			
			case "buencomer_delete":
				require_once LOAD . 'buencomer_delete.php';
			break;
			
			/*
			* Profile
			*/
			
			case "profile_add":
				require_once LOAD . 'profile_add.php';
			break;
			
			case "profile_edit":
				require_once LOAD . 'profile_edit.php';
			break;
			
			case "profile_list":
				require_once LOAD . 'profile_list.php';
			break;
			case "profile_search":
				require_once LOAD . 'profile_search.php';
			break;
			
			case "profile_delete":
				require_once LOAD . 'profile_delete.php';
			break;
			
			/*
			* Geolocation
			*/
			
			case "geolocation_add":
				require_once LOAD . 'geolocation_add.php';
			break;
			
			case "geolocation_edit":
				require_once LOAD . 'geolocation_edit.php';
			break;
			
			case "geolocation_list":
				require_once LOAD . 'geolocation_list.php';
			break;
			case "geolocation_search":
				require_once LOAD . 'geolocation_search.php';
			break;
			
			case "geolocation_delete":
				require_once LOAD . 'geolocation_delete.php';
			break;
			
			case "geolocation_category_list":
				require_once LOAD . 'geolocation_category_list.php';
			break;
			
			case "geolocation_category_search":
				require_once LOAD . 'geolocation_category_search.php';
			break;
			
			case "geolocation_category_delete":
				require_once LOAD . 'geolocation_category_delete.php';
			break;
			
			/*
			* Ticket
			*/
			
			case "ticket_list":
				require_once LOAD . 'ticket_list.php';
			break;
			
			case "ticket_search":
				require_once LOAD . 'ticket_search.php';
			break;
			
			case "ticket_add":
				require_once LOAD . 'ticket_add.php';
			break;
			
			case "ticket_delete":
				require_once LOAD . 'ticket_delete.php';
			break;
			
			case "ticketcomment_add":
				require_once LOAD . 'ticketcomment_add.php';
			break;
			
			/*
			* Common
			*/
			
			case "delete_resource":
				$id = fRequest::get('id');
				$id = explode("-",$id);
				$section =""; 
				$resource = new Resource(array('id_resource' => $id[0], 'id_entity'=> $id[1], 'id_section' => $id[2]));
				if ($resource->prepareResource_type() != 'e'){
					switch($id[2]){
						case 1: $section = "banners"; break;
						case 2: $section = "news"; break;
						case 3: $section = "classified"; break;
						case 4: $section = "events"; break;
						case 5: $section = "polls"; break;
						case 6: $section = "turism"; break;
						case 7: $section = "plaza"; break;
						//case 8: $section = "banners"; break;
						case 9: $section = "real"; break;
						case 12: $section = "authors"; break;
						case 13: $section = "buencomer"; break;
						case 14: $section = "autoplus"; break;
						case 16: $section = "articleagency"; break;
						case 17: $section = "turismb"; break;
						case 18: $section = "profile"; break;
						case 20: $section = "university"; break;
					}
				
					$file1 = new fFile("../uploads/$section/" .  $resource->prepareUrl());
					$file1->delete();
					
					$file1 = new fFile("../uploads/$section/thumbs/" .  $resource->prepareUrl());
					$file1->delete();
				}
				
				$resource->delete();
				exit("1");
			break;
			
			case "load_categories":
				require_once LOAD . 'load_categories.php';
			break;
			case "load_giro":
				require_once LOAD . 'load_giro.php';
			break;
			case "updateStatus":
				require_once LOAD . 'updateStatus.php';
			break;
			
			case "load_girot":
				require_once LOAD . 'load_girot.php';
			break;
			case "load_vehicle":
				require_once LOAD . 'load_vehicle.php';
			break;
			case 'user_add':
				require_once LOAD.'user_add.php';
				break;
			case 'user_edit':
				require_once LOAD.'user_edit.php';
				break;
			case 'user_list':
				require_once LOAD.'user_list.php';
				break;
			case 'user_delete':
				require_once LOAD.'user_delete.php';
				break;
			case 'region':
				require_once LOAD.'region_get.php';
			break;
			case 'region_get':
				require_once LOAD.'region_get.php';
				break;
			case 'user_search_by_email':
				require_once LOAD.'user_search_by_email.php';
			break;
			default: die("No existe esa opci&oacute;n: " . $do);
		}
 
	} catch (fExpectedException $e) {   
		$e->printMessage(); 
	}
}

?>