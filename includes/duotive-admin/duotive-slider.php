<?php
//CREATE DATABASE
		//CREATE FUNCTION
		function create_db () {
			global $wpdb;
			$create_query = 'CREATE TABLE `duotive_slider` (
								`ID` INT NOT NULL AUTO_INCREMENT ,
								`TITLE` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
								`TITLE_SHORT` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,								
								`TEXT` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
								`LINK` TEXT NOT NULL ,
								`IMG` TEXT NOT NULL ,
								`PUBLISH` TEXT NOT NULL,
								`TARGET` TEXT NOT NULL,
								`VIDEO` TEXT NOT NULL,
								PRIMARY KEY ( `ID` )
							) ENGINE = MYISAM ;
							';
			$create = $wpdb->get_results($create_query);
		}
		//CHECK FUNCTION
		function check_db_existance($table) {
			global $wpdb;
			$tables = mysql_list_tables(DB_NAME);
			while (list ($temp) = mysql_fetch_array ($tables)) {
				if ($temp == $table) {
					return TRUE;
				}
			}
			return FALSE;
		
		}		
		if ( check_db_existance('duotive_slider') == '') create_db();
//INSERT FUNCTIONS
	
	function insert_slide_in_db($id = 'NULL', $title='no-title',$title_short='no-title',$text='no-text',$link='no-link',$img='no-img',$publish=1,$target='url',$video='no-video') {
		global $wpdb; 
		$title = mysql_real_escape_string(htmlspecialchars ($title, ENT_QUOTES, 'UTF-8'));
		$title_short = mysql_real_escape_string(htmlspecialchars ($title_short, ENT_QUOTES, 'UTF-8'));
		$text = mysql_real_escape_string(htmlspecialchars ($text, ENT_QUOTES, 'UTF-8'));
		$insert_query = "INSERT INTO `duotive_slider` (`ID`, `TITLE`,`TITLE_SHORT`, `TEXT`, `LINK`, `IMG`, `PUBLISH`, `TARGET`, `VIDEO`) VALUES ('".$id."', '".$title."','".$title_short."', '".$text."', '".$link."', '".$img."', '".$publish."', '".$target."', '".$video."');";
 		$insert = $wpdb->get_results($insert_query);
	}
//REQUIRE SLIDES 
	function slide_require ($limit = 0, $start = 0) {
		global $wpdb;
		$limiter = '';
		if ( $limit != 0 ) $limiter = ' LIMIT '.$start.','.$limit;
		$slide_require_query = 'SELECT * FROM duotive_slider WHERE PUBLISH=1 ORDER BY ID ASC'.$limiter;
		$slide_require = $wpdb->get_results($slide_require_query);
		return $slide_require;
	}
//DELETE ENTRY 
	function delete_slide($id) {
		global $wpdb;			
		$delete_query = 'DELETE FROM duotive_slider WHERE ID="'.$id.'" LIMIT 1';	
		$wpdb->get_results($delete_query);	
	}
//PUBLISH SLIDE
	function publish_slide($id) {
		global $wpdb;			
		$delete_query = 'UPDATE duotive_slider SET `PUBLISH` = 1 WHERE ID="'.$id.'"';	
		$wpdb->get_results($delete_query);	
	}	
//UNPUBLISH SLIDE
	function unpublish_slide($id) {
		global $wpdb;			
		$delete_query = 'UPDATE duotive_slider SET `PUBLISH` = 0 WHERE ID="'.$id.'"';	
		$wpdb->get_results($delete_query);	
	}		
//MOVE ENTRY UP
	function move_entry_up ( $id ) {
		global $wpdb;
		
		$slides = slide_require();
		$destination = 1;
		
		foreach ( $slides as $slide ):
			if ( $slide->ID < $id )
			{ 
				if ( $slide->ID > $destination ) $destination = $slide->ID;
			}
		endforeach;
		
		$row_query = 'SELECT * FROM duotive_slider WHERE ID="'.$destination.'"';	
		$row_destination = $wpdb->get_results($row_query);
		
		$row_query = 'SELECT * FROM duotive_slider WHERE ID="'.$id.'"';	
		$row_move = $wpdb->get_results($row_query);
		
		delete_slide($destination);
		insert_slide_in_db($destination, $row_move[0]->TITLE,$row_move[0]->TITLE_SHORT,$row_move[0]->TEXT,$row_move[0]->LINK,$row_move[0]->IMG,$row_move[0]->PUBLISH, $row_move[0]->TARGET, $row_move[0]->VIDEO);
		
		delete_slide($id);
		insert_slide_in_db($id, $row_destination[0]->TITLE,$row_destination[0]->TITLE_SHORT,$row_destination[0]->TEXT,$row_destination[0]->LINK,$row_destination[0]->IMG,$row_destination[0]->PUBLISH,$row_destination[0]->TARGET,$row_destination[0]->VIDEO);
		
		$refer = $_SERVER['HTTP_REFERER'];
		echo "<script language=\"JavaScript\">
				 <!--
				 document.location.href  = \"admin.php?page=duotive-slider#slides\";
				 -->
				</script>";		
	}
//MOVE ENTRY DOWN
	function move_entry_down ( $id ) {
		global $wpdb;
		
		$slides = slide_require();
		$destination = $id;
		
		foreach ( $slides as $slide ):

			if ( $slide->ID > $id )
			{ 
				$destination = $slide->ID;

				$row_query = 'SELECT * FROM duotive_slider WHERE ID="'.$destination.'"';	
				$row_destination = $wpdb->get_results($row_query);
		
				$row_query = 'SELECT * FROM duotive_slider WHERE ID="'.$id.'"';	
				$row_move = $wpdb->get_results($row_query);
				
				delete_slide($destination);
				insert_slide_in_db($destination, $row_move[0]->TITLE, $row_move[0]->TITLE_SHORT,$row_move[0]->TEXT,$row_move[0]->LINK,$row_move[0]->IMG,$row_move[0]->PUBLISH,$row_move[0]->TARGET,$row_move[0]->VIDEO);
				
				delete_slide($id);
				insert_slide_in_db($id, $row_destination[0]->TITLE,$row_destination[0]->TITLE_SHORT,$row_destination[0]->TEXT,$row_destination[0]->LINK,$row_destination[0]->IMG,$row_destination[0]->PUBLISH,$row_destination[0]->TARGET,$row_destination[0]->VIDEO); 				

			}
		endforeach;
		
		$refer = $_SERVER['HTTP_REFERER'];
		echo "<script language=\"JavaScript\">
				 <!--
				 document.location.href  = \"admin.php?page=duotive-slider#slides\";
				 -->
				</script>";	
	}

//CREATE THE HTML VERSION OF THE SLIDER
function get_slider_code ($type){
	$slider = '';	
	switch($type)
	{
		case 'fullwidth-slider':
			$slides = slide_require();
			$timthumb = get_bloginfo('template_url').'/includes/timthumb.php';
			
			$sliderfullwidtharrowcontrols =  get_option('sliderfullwidtharrowcontrols');
			if ( $sliderfullwidtharrowcontrols == '' ) $sliderfullwidtharrowcontrols = 1; else $sliderfullwidtharrowcontrols =  get_option('sliderfullwidtharrowcontrols');

			$sliderfullwidthgallery =  get_option('sliderfullwidthgallery');
			if ( $sliderfullwidthgallery == '' ) $sliderfullwidthgallery = 1; else $sliderfullwidthgallery =  get_option('sliderfullwidthgallery');

			$sliderfullwidthtitles =  get_option('sliderfullwidthtitles');
			if ( $sliderfullwidthtitles == '' ) $sliderfullwidthtitles = 1; else $sliderfullwidthtitles =  get_option('sliderfullwidthtitles');

			$sliderfullwidthcontentbox =  get_option('sliderfullwidthcontentbox');
			if ( $sliderfullwidthcontentbox == '' ) $sliderfullwidthcontentbox = 1; else $sliderfullwidthcontentbox =  get_option('sliderfullwidthcontentbox');

			$slider = '<div id="fullwidth-slider-wrapper">';
				$slider .= '<div id="fullwidth-slider">';
					if ( $sliderfullwidthcontentbox ):
						$slider .= '<div id="slider-overlay"></div>';
						$slider .= '<div id="contentbox">';
							$slider .= '<a id="contentbox-close" href="javascript: void(0)">Close</a>';
							$slider .= '<a href="javascript: void(0)" id="contentbox-next">Left</a>';
							$slider .= '<a href="javascript: void(0)" id="contentbox-prev">Right</a>';
							$slider .= '<ul>';
								foreach ( $slides as $slide ):
									$slider .= '<li>';
										$slider .= '<h5>'.stripslashes($slide->TITLE).'</h5>';
											$slider .= '<p>'.stripslashes($slide->TEXT).'</p>';
											$slider .= '<a class="more" href="'.$slide->LINK.'">Read more</a>';
									$slider .= '</li>';
								endforeach;
							$slider .= '</ul>';
						$slider .= '</div>';	
					endif;	
					if ( $sliderfullwidtharrowcontrols ) :
						$slider .= '<div id="slider-controls">';
							$slider .= '<a id="slider-control-left" href="javascript: void(0)">left</a>';
							$slider .= '<a id="slider-control-right" href="javascript: void(0)">right</a>';
						$slider .= '</div>';
					endif; 
					$slider .= '<div id="slider-images-wrapper">';
						foreach ( $slides as $slide ):
							$slider .= '<img src="'.$slide->IMG.'" alt="'.stripslashes($slide->TITLE).'"/>';						
						endforeach;
						foreach ( $slides as $slide ):
							$slider .= '<a href="'.$slide->LINK.'" title="'.stripslashes($slide->TITLE).'"></a>';						
						endforeach;					
					$slider .= '</div>';
				if ( $sliderfullwidthtitles ):
					$no_gallery_class = '';
					if ( !$sliderfullwidthgallery ) $no_gallery_class = ' class="no-gallery"';
					$slider .= '<div id="slider-text"'.$no_gallery_class.'>';
						$slider .= '<div id="content-controls">';
							$slider .= '<a id="slider-control-up" href="javascript: void(0)">up</a>';
							$slider .= '<a id="slider-control-play" href="javascript: void(0)">play</a>';
							$slider .= '<a id="slider-control-down" href="javascript: void(0)">down</a>';
						$slider .= '</div>';
						$slider .= '<ul>';
							foreach ( $slides as $slide ):
								$slider .= '<li><a href="javascript: void(0)">'.stripslashes($slide->TITLE).'</a></li>';
							endforeach;
						$slider .= '</ul>';
					$slider .= '</div>';
				endif;
				if ( $sliderfullwidthgallery ) :
					$slider .= '<div id="gallery-wrapper">';
						$slider .= '<div id="slider-gallery">';
							$slider .= '<ul>';
							foreach ( $slides as $slide ):
								$slider .= '<li>';
									$slider .= '<a href="javascript: void(0)" title="'.stripslashes($slide->TITLE).'">';
										$slider .= '<span class="border"></span>';
										$slider .=	'<img src="'.$timthumb.'?src='.$slide->IMG.'&amp;h=50&amp;w=100&amp;zc=1&amp;q=100" alt="'.stripslashes($slide->TITLE).'" />';
									$slider .= '</a>';						
								$slider .= '</li>';
							endforeach;	
							$slider .= '</ul>';
						$slider .= '</div>';
					$slider .= '</div>';			
				endif;	
				$slider .= '</div>';
			$slider .= '</div>';

			echo $slider;
		break;		
		case 'gallery-slider':
			$slides = slide_require();
			$slidergalleryrandom = get_option('slidergalleryrandom'); if ( $slidergalleryrandom == '' ) $slidergalleryrandom = 0; else $slidergalleryrandom = get_option('slidergalleryrandom');		
			if ( $slidergalleryrandom == 1 ) shuffle($slides);
			$timthumb = get_bloginfo('template_url').'/includes/timthumb.php';
			$slidergalleryarrowcontrols =  get_option('slidergalleryarrowcontrols');
			if ( $slidergalleryarrowcontrols == '' ) $slidergalleryarrowcontrols = 1; else $slidergalleryarrowcontrols =  get_option('slidergalleryarrowcontrols');			
			
			$slider = '<div id="gallery-slider-wrapper">';
				$slider .= '<div id="gallery-slider">';
					if ( $slidergalleryarrowcontrols ) :
						$slider .= '<div id="slider-controls">';
							$slider .= '<a href="javascript: void(0)" id="slider-control-left">left</a>';
							$slider .= '<a href="javascript: void(0)" id="slider-control-right">right</a>';
						$slider .= '</div>';
					endif;
					$slider .= '<div id="slider-images-wrapper">';
						$slider .= '<ul id="slider-main-ul">';
						$slider_count = count($slides);
						for ( $current_slide = 0; $current_slide < $slider_count; $current_slide = $current_slide + 9):
							if ( isset($slides[$current_slide]->IMG) || isset($slides[$current_slide + 1]->IMG) || isset($slides[$current_slide + 2]->IMG) ) :
								$slider .= '<li>';
									$slider .= '<ul>';
										if ( $slides[$current_slide]->IMG ) :
											$slider .= '<li class="type-3">';
												$target = $slides[$current_slide]->TARGET;
												if ( $target == '' || $target == 'url' ) $slider .= '<a class="article-icon" title="'.$slides[$current_slide]->TITLE.'" href="'.$slides[$current_slide]->LINK.'">';
												if ( $target == 'image' ) $slider .= '<a class="image-icon" rel="gallery[modal]" title="'.$slides[$current_slide]->TITLE.'" href="'.$slides[$current_slide]->IMG.'">';												
												if ( $target == 'video' ) $slider .= '<a class="video-icon" rel="gallery[modal]" title="'.$slides[$current_slide]->TITLE.'" href="'.$slides[$current_slide]->VIDEO.'">';																								
													$slider .= '<span>';
														$slider .= '<div class="icon"></div>';
														$slider .= '<strong>'.stripslashes($slides[$current_slide]->TITLE).'</strong>';
														$slider .= stripslashes($slides[$current_slide]->TEXT);
														if ( $target == '' || $target == 'url' ) $slider .= '<em class="more">Read more &#187;</em>';
														if ( $target == 'image' ) $slider .= '<em class="more">View image &#187;</em>';
														if ( $target == 'video' ) $slider .= '<em class="more">Watch video &#187;</em>';
													$slider .= '</span>';
													$slider .= '<img height="298" width="318" src="'.$timthumb.'?src='.$slides[$current_slide]->IMG.'&amp;h=298&amp;w=318&amp;zc=1&amp;q=100" alt="Please add picture">';
												$slider .= '</a>';
											$slider .= '</li>';
										endif;
										if ( $slides[$current_slide + 1]->IMG ) :
											$slider .= '<li class="type-1">';
												$target = $slides[$current_slide + 1]->TARGET;
												if ( $target == '' || $target == 'url' ) $slider .= '<a class="article-icon" title="'.$slides[$current_slide + 1]->TITLE.'" href="'.$slides[$current_slide + 1]->LINK.'">';
												if ( $target == 'image' ) $slider .= '<a class="image-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 1]->TITLE.'" href="'.$slides[$current_slide + 1]->IMG.'">';												
												if ( $target == 'video' ) $slider .= '<a class="video-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 1]->TITLE.'" href="'.$slides[$current_slide + 1]->VIDEO.'">';												
													$slider .= '<span>';
														$slider .= '<div class="icon"></div>';
														$slider .= '<strong>'.stripslashes($slides[$current_slide + 1]->TITLE).'</strong>';											
														if ( $target == '' || $target == 'url' ) $slider .= '<em class="more">Read more &#187;</em>';
														if ( $target == 'image' ) $slider .= '<em class="more">View image &#187;</em>';														
														if ( $target == 'video' ) $slider .= '<em class="more">Watch video &#187;</em>';														
													$slider .= '</span>';
													$slider .= '<img height="148" width="158" src="'.$timthumb.'?src='.$slides[$current_slide + 1]->IMG.'&amp;h=148&amp;w=158&amp;zc=1&amp;q=100" alt="Please add picture">';
												$slider .= '</a>';								
											$slider .= '</li>';
										endif;
										if ( $slides[$current_slide + 2]->IMG ) :
											$slider .= '<li class="type-1">';
												$target = $slides[$current_slide + 2]->TARGET;
												if ( $target == '' || $target == 'url' ) $slider .= '<a class="article-icon" title="'.$slides[$current_slide + 2]->TITLE.'" href="'.$slides[$current_slide + 2]->LINK.'">';
												if ( $target == 'image' ) $slider .= '<a class="image-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 2]->TITLE.'" href="'.$slides[$current_slide + 2]->IMG.'">';												
												if ( $target == 'video' ) $slider .= '<a class="video-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 2]->TITLE.'" href="'.$slides[$current_slide + 2]->VIDEO.'">';												
													$slider .= '<span>';
														$slider .= '<div class="icon"></div>';
														$slider .= '<strong>'.stripslashes($slides[$current_slide + 2]->TITLE).'</strong>';
														if ( $target == '' || $target == 'url' ) $slider .= '<em class="more">Read more &#187;</em>';
														if ( $target == 'image' ) $slider .= '<em class="more">View image &#187;</em>';														
														if ( $target == 'video' ) $slider .= '<em class="more">Watch video &#187;</em>';														
													$slider .= '</span>';
													$slider .= '<img height="148" width="158" src="'.$timthumb.'?src='.$slides[$current_slide + 2]->IMG.'&amp;h=148&amp;w=158&amp;zc=1&amp;q=100" alt="Please add picture">';
												$slider .= '</a>';
											$slider .= '</li>';	
										endif;
									$slider .= '</ul>';								
								$slider .= '</li>';	
							endif;								
							if ( isset($slides[$current_slide + 3]->IMG) || isset($slides[$current_slide + 4]->IMG) || isset($slides[$current_slide + 5]->IMG) || isset($slides[$current_slide + 6]->IMG) ):						
								$slider .= '<li>';
									$slider .= '<ul>';
										if ( $slides[$current_slide + 3]->IMG ) :
											$slider .= '<li class="type-1">';
												$target = $slides[$current_slide + 3]->TARGET;
												if ( $target == '' || $target == 'url' ) $slider .= '<a class="article-icon" title="'.$slides[$current_slide + 3]->TITLE.'" href="'.$slides[$current_slide + 3]->LINK.'">';
												if ( $target == 'image' ) $slider .= '<a class="image-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 3]->TITLE.'" href="'.$slides[$current_slide + 3]->IMG.'">';
												if ( $target == 'video' ) $slider .= '<a class="video-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 3]->TITLE.'" href="'.$slides[$current_slide + 3]->VIDEO.'">';
													$slider .= '<span>';
														$slider .= '<div class="icon"></div>';
														$slider .= '<strong>'.stripslashes($slides[$current_slide + 3]->TITLE).'</strong>';
														if ( $target == '' || $target == 'url' ) $slider .= '<em class="more">Read more &#187;</em>';
														if ( $target == 'image' ) $slider .= '<em class="more">View image &#187;</em>';														
														if ( $target == 'video' ) $slider .= '<em class="more">Watch video &#187;</em>';														
													$slider .= '</span>';
													$slider .= '<img height="148" width="158" src="'.$timthumb.'?src='.$slides[$current_slide + 3]->IMG.'&amp;h=148&amp;w=158&amp;zc=1&amp;q=100" alt="Please add picture">';
												$slider .= '</a>';										
											$slider .= '</li>';
										endif;
										if ( $slides[$current_slide + 4]->IMG ) :
											$slider .= '<li class="type-1">';
												$target = $slides[$current_slide + 4]->TARGET;
												if ( $target == '' || $target == 'url' ) $slider .= '<a class="article-icon" title="'.$slides[$current_slide + 4]->TITLE.'" href="'.$slides[$current_slide + 4]->LINK.'">';
												if ( $target == 'image' ) $slider .= '<a class="image-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 4]->TITLE.'" href="'.$slides[$current_slide + 4]->IMG.'">';												
												if ( $target == 'video' ) $slider .= '<a class="video-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 4]->TITLE.'" href="'.$slides[$current_slide + 4]->VIDEO.'">';												
													$slider .= '<span>';
														$slider .= '<div class="icon"></div>';
														$slider .= '<strong>'.stripslashes($slides[$current_slide + 4]->TITLE).'</strong>';
														if ( $target == '' || $target == 'url' ) $slider .= '<em class="more">Read more &#187;</em>';
														if ( $target == 'image' ) $slider .= '<em class="more">View image &#187;</em>';
														if ( $target == 'video' ) $slider .= '<em class="more">Watch video &#187;</em>';
													$slider .= '</span>';
													$slider .= '<img height="148" width="158" src="'.$timthumb.'?src='.$slides[$current_slide + 4]->IMG.'&amp;h=148&amp;w=158&amp;zc=1&amp;q=100" alt="Please add picture">';
												$slider .= '</a>';	
											$slider .= '</li>';
										endif;
										if ( $slides[$current_slide + 5]->IMG ) :
											$slider .= '<li class="type-2">';
												$target = $slides[$current_slide + 5]->TARGET;
												if ( $target == '' || $target == 'url' ) $slider .= '<a class="article-icon" title="'.$slides[$current_slide + 5]->TITLE.'" href="'.$slides[$current_slide + 5]->LINK.'">';
												if ( $target == 'image' ) $slider .= '<a class="image-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 5]->TITLE.'" href="'.$slides[$current_slide + 5]->IMG.'">';
												if ( $target == 'video' ) $slider .= '<a class="video-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 5]->TITLE.'" href="'.$slides[$current_slide + 5]->VIDEO.'">';
													$slider .= '<span>';
														$slider .= '<div class="icon"></div>';
														$slider .= '<strong>'.stripslashes($slides[$current_slide + 5]->TITLE).'</strong>';
														$slider .= stripslashes($slides[$current_slide + 5]->TEXT);
														if ( $target == '' || $target == 'url' ) $slider .= '<em class="more">Read more &#187;</em>';
														if ( $target == 'image' ) $slider .= '<em class="more">View image &#187;</em>';
														if ( $target == 'video' ) $slider .= '<em class="more">Watch video &#187;</em>';
													$slider .= '</span>';
													$slider .= '<img height="148" width="318" src="'.$timthumb.'?src='.$slides[$current_slide + 5]->IMG.'&amp;h=148&amp;w=318&amp;zc=1&amp;q=100" alt="Please add picture">';
												$slider .= '</a>';	
											$slider .= '</li>';
										endif;
										if ( $slides[$current_slide + 6]->IMG ) :
											$slider .= '<li class="type-2">';
												$target = $slides[$current_slide + 6]->TARGET;
												if ( $target == '' || $target == 'url' ) $slider .= '<a class="article-icon" title="'.$slides[$current_slide + 6]->TITLE.'" href="'.$slides[$current_slide + 6]->LINK.'">';
												if ( $target == 'image' ) $slider .= '<a class="image-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 6]->TITLE.'" href="'.$slides[$current_slide + 6]->IMG.'">';
												if ( $target == 'video' ) $slider .= '<a class="video-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 6]->TITLE.'" href="'.$slides[$current_slide + 6]->VIDEO.'">';
													$slider .= '<span>';
														$slider .= '<div class="icon"></div>';
														$slider .= '<strong>'.stripslashes($slides[$current_slide + 6]->TITLE).'</strong>';
														$slider .= stripslashes($slides[$current_slide + 6]->TEXT);
														if ( $target == '' || $target == 'url' ) $slider .= '<em class="more">Read more &#187;</em>';
														if ( $target == 'image' ) $slider .= '<em class="more">View image &#187;</em>';
														if ( $target == 'video' ) $slider .= '<em class="more">Watch video &#187;</em>';
													$slider .= '</span>';
													$slider .= '<img height="148" width="318" src="'.$timthumb.'?src='.$slides[$current_slide + 6]->IMG.'&amp;h=148&amp;w=318&amp;zc=1&amp;q=100" alt="Please add picture">';
												$slider .= '</a>';	
											$slider .= '</li>';						
										endif;
									$slider .= '</ul>';								
								$slider .= '</li>';	
							endif;
							if ( isset($slides[$current_slide + 7]->IMG) || isset($slides[$current_slide + 8]->IMG) ):
								$slider .= '<li>';
									$slider .= '<ul>';
										if ( $slides[$current_slide + 7]->IMG != '' ):
											$slider .= '<li class="type-2">';
												$target = $slides[$current_slide + 7]->TARGET;
												if ( $target == '' || $target == 'url' ) $slider .= '<a class="article-icon" title="'.$slides[$current_slide + 7]->TITLE.'" href="'.$slides[$current_slide + 7]->LINK.'">';
												if ( $target == 'image' ) $slider .= '<a class="image-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 7]->TITLE.'" href="'.$slides[$current_slide + 7]->IMG.'">';
												if ( $target == 'video' ) $slider .= '<a class="video-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 7]->TITLE.'" href="'.$slides[$current_slide + 7]->VIDEO.'">';
													$slider .= '<span>';
														$slider .= '<div class="icon"></div>';
														$slider .= '<strong>'.stripslashes($slides[$current_slide + 7]->TITLE).'</strong>';
														$slider .= stripslashes($slides[$current_slide + 7]->TEXT);
														if ( $target == '' || $target == 'url' ) $slider .= '<em class="more">Read more &#187;</em>';
														if ( $target == 'image' ) $slider .= '<em class="more">View image &#187;</em>';
														if ( $target == 'video' ) $slider .= '<em class="more">Watch video &#187;</em>';
													$slider .= '</span>';
													$slider .= '<img height="148" width="318" src="'.$timthumb.'?src='.$slides[$current_slide + 7]->IMG.'&amp;h=148&amp;w=318&amp;zc=1&amp;q=100" alt="Please add picture">';
												$slider .= '</a>';	
											$slider .= '</li>';
										endif;
										if ( $slides[$current_slide + 8]->IMG != '' ):
											$slider .= '<li class="type-3">';
												$target = $slides[$current_slide + 8]->TARGET;
												if ( $target == '' || $target == 'url' ) $slider .= '<a class="article-icon" title="'.$slides[$current_slide + 8]->TITLE.'" href="'.$slides[$current_slide + 8]->LINK.'">';
												if ( $target == 'image' ) $slider .= '<a class="image-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 8]->TITLE.'" href="'.$slides[$current_slide + 8]->IMG.'">';
												if ( $target == 'video' ) $slider .= '<a class="video-icon" rel="gallery[modal]" title="'.$slides[$current_slide + 8]->TITLE.'" href="'.$slides[$current_slide + 8]->VIDEO.'">';
													$slider .= '<span>';
														$slider .= '<div class="icon"></div>';
														$slider .= '<strong>'.stripslashes($slides[$current_slide + 8]->TITLE).'</strong>';
														$slider .= stripslashes($slides[$current_slide + 8]->TEXT);
														if ( $target == '' || $target == 'url' ) $slider .= '<em class="more">Read more &#187;</em>';														
														if ( $target == 'image' ) $slider .= '<em class="more">View image &#187;</em>';
														if ( $target == 'video' ) $slider .= '<em class="more">Watch video &#187;</em>';
													$slider .= '</span>';
													$slider .= '<img height="298" width="318" src="'.$timthumb.'?src='.$slides[$current_slide + 8]->IMG.'&amp;h=298&amp;w=318&amp;zc=1&amp;q=100" alt="Please add picture">';
												$slider .= '</a>';	
											$slider .= '</li>';	
										endif;
									$slider .= '</ul>';								
								$slider .= '</li>';
							endif;
						endfor;
						$slider .= '</ul>';
					$slider .= '</div>';
					$slider .= '<div id="slider-bottom-controls">';
					$slider .= '<a id="slider-scroll-left" href="javascript: void(0);" title="Scroll left">left</a>';
					$slider .= '<div id="slider-scroll"><div class="knob"></div></div>';
					$slider .= '<a id="slider-scroll-right" href="javascript: void(0);" title="Scroll right">right</a>';
					$slider .= '</div>';				
				$slider .= '</div>';			
			$slider .= '</div>';
			echo $slider;
		break;
		case 'presentation-slider':
			$slides = slide_require();
			$timthumb = get_bloginfo('template_url').'/includes/timthumb.php';
			
			$sliderpresentationarrowcontrols =  get_option('sliderpresentationarrowcontrols');
			if ( $sliderpresentationarrowcontrols == '' ) $sliderpresentationarrowcontrols = 1; else $sliderpresentationarrowcontrols =  get_option('sliderpresentationarrowcontrols');
			
			$sliderpresentationdescription =  get_option('sliderpresentationdescription');
			if ( $sliderpresentationdescription == '' ) $sliderpresentationdescription = 1; else $sliderpresentationdescription =  get_option('sliderpresentationdescription');
			
			$slider = '<div id="presentation-slider-wrapper">';
				$slider .= '<div id="presentation-slider">';
					if ( $sliderpresentationarrowcontrols ):
						$slider .= '<div id="slider-controls">';
							$slider .= '<a href="javascript: void(0)" id="slider-control-left">left</a>';
							$slider .= '<a href="javascript: void(0)" id="slider-control-right">right</a>';
						$slider .= '</div>';
					endif;						
					$slider .= '<div id="slider-images-wrapper">';
						foreach ( $slides as $slide ):
							$slider .= '<a href="'.$slide->LINK.'" title="'.stripslashes($slide->TITLE).'">';	
								if ( $sliderpresentationdescription ) :
									$slider .= '<span class="content">';
										$slider .= '<span class="title">'.stripslashes($slide->TITLE).'</span>';
										$slider .= '<span class="text">'.stripslashes($slide->TEXT).'</span>';										
									$slider .= '</span>';				
								endif;
								$slider .= '<img src="'.$timthumb.'?src='.$slide->IMG.'&amp;h=388&amp;w=960&amp;zc=1&amp;q=100" alt="'.stripslashes($slide->TITLE).'" />';
							$slider .= '</a>';
						endforeach;				
					$slider .= '</div>';
					$slider .= '<div id="slider-contentbox">';
						$slider .= '<div id="slider-timer"><div id="slider-progress-bar"></div></div>';
						$slider .= '<div id="slider-gallery">';
							$slider .= '<ul>';
							$slide_counter = 1;
							foreach ( $slides as $slide ):
								if ( $slide_counter < 10 ) $slide_counter = '0'.$slide_counter;
								$slider .= '<li>';
									$slider .= '<a title="'.stripslashes($slide->TITLE).'" href="javascript: void(0);">';
										$slider .= '<span class="number">'.$slide_counter.'</span>';
										$slider .= '<span class="title">'.stripslashes(strip_tags($slide->TITLE_SHORT)).'</span>';
									$slider .= '</a>';
								$slider .= '</li>';
								$slide_counter++;
							endforeach;									
							$slider .= '</ul>';
						$slider .= '</div>';
					$slider .= '</div>';
					$slider .= '<div id="slider-bottom-controls">';
						$slider .= '<a id="slider-scroll-left" href="javascript: void(0);" title="Scroll left">left</a>';
						$slider .= '<div id="slider-scroll"><div class="knob"></div></div>';
						$slider .= '<a id="slider-scroll-right" href="javascript: void(0);" title="Scroll right">right</a>';
					$slider .= '</div>';
				$slider .= '</div>';
			$slider .= '</div>';		
			echo $slider;
		break;
		case 'complex-slider':
			$slides = slide_require();
			$timthumb = get_bloginfo('template_url').'/includes/timthumb.php';
			
			$slidercomplexgallery =  get_option('slidercomplexgallery');
			if ( $slidercomplexgallery == '' ) $slidercomplexgallery = 1; else $slidercomplexgallery =  get_option('slidercomplexgallery');
			$slidercomplexdescription =  get_option('slidercomplexdescription');
			if ( $slidercomplexdescription == '' ) $slidercomplexdescription = 1; else $slidercomplexdescription =  get_option('slidercomplexdescription');
			$slidercomplexarrowcontrols =  get_option('slidercomplexarrowcontrols');
			if ( $slidercomplexarrowcontrols == '' ) $slidercomplexarrowcontrols = 1; else $slidercomplexarrowcontrols =  get_option('slidercomplexarrowcontrols');

			$slider = '<div id="complex-slider-wrapper">';
				$slider .= '<div id="complex-slider">';
					if ( $slidercomplexarrowcontrols == 1 ):
						$slider .='<div id="slider-controls">';
							$slider .='<a href="javascript: void(0)" id="slider-control-left">left</a>';
							$slider .='<a href="javascript: void(0)" id="slider-control-right">right</a>';
						$slider .='</div>';
					endif;
					$slider .='<div id="slider-images-wrapper">';
						$i = 0;
							foreach ( $slides as $slide ):
								$slider .= '<a href="'.$slide->LINK.'" title="'.stripslashes($slide->TITLE).'">';					
										$slider .= '<img src="'.$timthumb.'?src='.$slide->IMG.'&amp;h=378&amp;w=960&amp;zc=1&amp;q=100" alt="'.stripslashes($slide->TITLE).'" />';															
								$slider .= '</a>';
								$i++;
							endforeach;
					$slider .= '</div>';
					$slider .= '<div id="slider-timer">';
						$slider .= '<div id="slider-progress-bar"></div>';
					$slider .= '</div>';
					if ( $slidercomplexdescription || $slidercomplexgallery ):
						$slider .= '<div id="slider-contentbox">';
							if ($slidercomplexdescription)
							{
								$slider .= '<div id="slider-description">';
									$slider .= '<ul>';					
										$i = 0;
										foreach ( $slides as $slide ):
											$slider .= '<li>';								
												$slider .= '<strong>'.stripslashes($slide->TITLE).'</strong>';
												$slider .= '<p>'.stripslashes(strip_tags(substr($slide->TEXT,0,120))).'...</p>';									
											$slider .= '</li>';
										endforeach;
									$slider .= '</ul>';
								$slider .= '</div>';
							}
							if ($slidercomplexgallery)
							{
								$class = '';
								if ( !$slidercomplexdescription ) $class = ' class="full"';  
								$slider .= '<div id="slider-gallery"'.$class.'>';
									$slider .= '<ul>';
									$i = 0;
									foreach ( $slides as $slide ):
										$slider .= '<li>';
											$slider .= '<a href="javascript: void(0)" title="'.stripslashes($slide->TITLE).'">';	
												$slider .= '<span class="border"></span>';				
												$slider .= '<img src="'.$timthumb.'?src='.$slide->IMG.'&amp;h=50&amp;w=100&amp;zc=1&amp;q=100" alt="'.stripslashes($slide->TITLE).'" />';															
											$slider .= '</a>';
										$slider .= '</li>';
										$i++;
									endforeach;
									$slider .= '</ul>';
								$slider .= '</div>';
							}
						$slider .= '</div>';	
					endif;						
				$slider .= '</div>';
			$slider .= '</div>';				
			echo $slider;
		break;		
		case 'content':
			$slides = slide_require();
			$timthumb = get_bloginfo('template_url').'/includes/timthumb.php';
			$slidercontentposition = get_option('slidercontentposition');
			if ( $slidercontentposition == '' ) $slidercontentposition = 'side-description-right'; else $slidercontentposition = get_option('slidercontentposition');
			$slider = '<div id="content-slider-wrapper">';
				$slider .= '<div id="content-slider" class="'.$slidercontentposition.' side-description">';
						$i = 0;
						$slider .= '<ul>';
							foreach ( $slides as $slide ):
								$slider .= '<li>';
										$slider .= '<div class="image-wrapper">';
											$slider .= '<img src="'.$timthumb.'?src='.$slide->IMG.'&amp;h=462&amp;w=600&amp;zc=1&amp;q=100" alt="'.stripslashes($slide->TITLE).'" style="display:none;" />';						
										$slider .= '</div>';
										$slider .= '<div class="content">';
											$slider .= '<h3>'.stripslashes($slide->TITLE).'</h3>';
											$slider .= '<p>'.stripslashes($slide->TEXT).'<br /><a class="read-more" href="'.$slide->LINK.'">Read More &#187;</a></p>';
										$slider .= '</div>';										
								$slider .= '</li>';
								$i++;
							endforeach;
						$slider .= '</ul>';											
				$slider .= '</div>';
			$slider .= '</div>';				
			echo $slider;
		break;
		case 'accordion':
			$slides = slide_require();
			$timthumb = get_bloginfo('template_url').'/includes/timthumb.php';
			$slideraccordionnumber = get_option('slideraccordionnumber');
			if ( $slideraccordionnumber == '' ) $slideraccordionnumber = 6; else $slideraccordionnumber = get_option('slideraccordionnumber');
			
			$slide_number = (int)$slideraccordionnumber;
			$class = '';
			if ( $slide_number == 8 ) $class = 'accordion-eight-elements';
			if ( $slide_number == 7 ) $class = 'accordion-seven-elements';
			if ( $slide_number == 6 ) $class = 'accordion-six-elements';
			if ( $slide_number == 5 ) $class = 'accordion-five-elements';
			if ( $slide_number == 4 ) $class = 'accordion-four-elements';
			if ( $slide_number == 3 ) $class = 'accordion-three-elements';			
								
			$slider = '<div id="accordion-slider-wrapper">';
				$slider .= '<div id="accordion-slider">';
					$i = 0;
					$slider .= '<ul>';
						foreach ( $slides as $slide ):
							if ( $i <= $slide_number - 1 ):
								$slider .= '<li class="'.$class.'">';
									$slider .= '<img src="'.$timthumb.'?src='.$slide->IMG.'&amp;h=458&amp;w=600&amp;zc=1&amp;q=100" alt="'.stripslashes($slide->TITLE).'" />';						
									$slider .= '<div class="content">';
											$slider .= '<h3>'.stripslashes($slide->TITLE).'</h3>';
											$slider .= '<p>'.stripslashes($slide->TEXT).'</p>';
											$slider .= '<a class="read-more" href="'.$slide->LINK.'">Read More &#187;</a>';
									$slider .= '</div>';									
								$slider .= '</li>';
							endif;
							$i++;
						endforeach;					
					$slider .= '</ul>';					
				$slider .= '</div>';			
			$slider .= '</div>';
			echo $slider;
		break;
		case 'nivo':
			$slides = slide_require();
			$timthumb = get_bloginfo('template_url').'/includes/timthumb.php';
			$slider = '<div id="nivo-slider-wrapper">';
				$slider .= '<div id="nivo-slider-loader">';
					$slider .= '<div id="nivo-slider">';
						$i = 1;
						foreach ( $slides as $slide ):
							$slider .= '<img src="'.$timthumb.'?src='.$slide->IMG.'&amp;h=462&amp;w=962&amp;zc=1&amp;q=100" alt="'.stripslashes($slide->TITLE).'" title="#html-description-'.$i.'" />';						
							$i++;
						endforeach;
					$slider .= '</div>';
				$slider .= '</div>';
				$i = 1;
				foreach ( $slides as $slide ):
					$slider .='<div id="html-description-'.$i.'" class="nivo-html-caption">';
						$slider .= '<span class="title">'.stripslashes($slide->TITLE).'</span>';
						$slider .= '<p class="content">'.stripslashes($slide->TEXT).'</p>';
						$slider .= '<a class="read-more" href="'.$slide->LINK.'">Read More &#187;</a>';
					$slider .='</div>';
					$i++;
				endforeach;					
			$slider .= '</div>';
			echo $slider;
		break;
		case 'video':
			$blog_url = get_bloginfo( 'template_url' );
   			$themecolor =  get_option('themecolor');
			$slidevideosource = get_option('slidevideosource');
			$slidevideourl = get_option('slidevideourl');
			switch ( $slidevideosource )
			{
				case 'youtube':
					$slidevideourl = str_replace('http://www.youtube.com/watch?v=','',$slidevideourl);
					$slidevideourl = str_replace('http://youtube.com/watch?v=','',$slidevideourl);					
					$strip_top = strrpos($slidevideourl,'&');
					if ( $strip_top > 0 ) $slidevideourl = substr($slidevideourl,0,$strip_top);		
				break;
				
				case 'vimeo':
					$slidevideourl = str_replace('http://www.vimeo.com/','',$slidevideourl);				
					$slidevideourl = str_replace('http://vimeo.com/','',$slidevideourl);
				break;
			}
			if ( $slidevideosource == 'video' || $slidevideosource == 'youtube' ) $sliderheight = '482';
			else $sliderheight = '452';
    		if ( $themecolor == '' ) $themecolor = 'db6e0d';		
			$slider = '<div id="video-slideshow-wrapper">';
				$slider .= '<script type="text/javascript" language="javascript" src="'.$blog_url.'/includes/video-player/swfobject.js"></script>';
				$slider .= '<script type="text/javascript">';
					$slider .= 'var flashvars = {};';
						$slider .= 'flashvars.type = "'.$slidevideosource.'";';
						$slider .= 'flashvars.url = "'.$slidevideourl.'";';
						if ( $slidevideosource == 'video' || $slidevideosource == 'youtube' ) :
						$slider .= 'flashvars.color = "0x'.$themecolor.'";';
						$slider .= 'flashvars.hover = "0x000000";';
						$slider .= 'flashvars.bgColor = "0xFFFFFF";';
						$slider .= 'flashvars.borderColor = "0xCCCCCC";';
						$slider .= 'flashvars.bufferColor = "0xe6e4df";';
						$slider .= 'flashvars.progressBgColor = "0xEEEEEE";';
						$slider .= 'flashvars.volumeBgColor = "0xCCCCCC";';
						else:
						$slider .= 'flashvars.color = "'.$themecolor.'";';
						endif;
						$slider .= 'flashvars.width = "960";';
						$slider .= 'flashvars.height = "452";';
					$slider .= 'var params = {};';
						$slider .= 'params.bgcolor = "0x000000";';
						$slider .= 'params.scale = "noscale";';
						$slider .= 'params.salign = "tl";';						
						$slider .= 'params.allowfullscreen = "true";';
						$slider .= 'params.wmode = "opaque";';						
					$slider .= 'var attributes = {};';
					$slider .= 'swfobject.embedSWF("'.$blog_url.'/includes/video-player/main.swf", "video-slideshow", "960", "'.$sliderheight.'", "9.0.0", false, flashvars, params, attributes);';
				$slider .= '</script>';
				$slider .= '<div id="video-slideshow">';
					$slider .= '<a href="http://www.adobe.com/go/getflashplayer">';
						$slider .= '<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />';
					$slider .= '</a>';
				$slider .= '</div>';
			$slider .= '</div>';				
			echo $slider;
        break;
		case 'static-image':
			$slider_image = get_option('slidestaticimage');
			$slider_url = get_option('slidestaticurl');
			$slider_width = get_option('slidestaticwidth');
			$slider_width = str_replace('px','',$slider_width);
			if ( $slider_width == '' ) $slider_width = '962';
			$timthumb = get_bloginfo('template_url').'/includes/timthumb.php';
			if ( $slider_image != '' ) :
				$slider = '<div id="slider-static-image-wrapper">';
					$slider .= '<div id="slider-static-image" style="width: '.$slider_width.'px;">';
						$slider .= '<a href="'.$slider_url.'">';
							$slider .= '<img src="'.$timthumb.'?src='.$slider_image.'&amp;h=462&amp;w='.$slider_width.'&amp;zc=1&amp;q=100" alt="" title="" />';
						$slider .= '</a>';
					$slider .= '</div>';
				$slider .= '</div>';
			endif;
			echo $slider;
		break;
		
	}	
}
function themeoptions_admin_menu() 
{
	// ADD THE SLIDER OPTIONS PAGE TO ADMIN SIEBAR
	add_submenu_page( 'duotive-panel', 'Duotive Slider Options', 'Slideshow', 'manage_options', 'duotive-slider', 'themeoptions_page');
}

function themeoptions_page() 
{
	// IF UPDATE TO SLIDESHOW OPTIONS, CALL THE UPDATE FUNCTION
	if ( isset($_POST['update_themeoptions']) && $_POST['update_themeoptions'] == 'true' ) { themeoptions_update(); }
	
	//MOVE UP/DOWN OR DELETE A SLIDER
	if(isset($_GET['delete']) && $_GET['delete'] != '') delete_slide($_GET['delete']);
	if(isset($_GET['publish']) && $_GET['publish'] != '') publish_slide($_GET['publish']);	
	if(isset($_GET['unpublish']) && $_GET['unpublish'] != '') unpublish_slide($_GET['unpublish']);		
	if(isset($_GET['move_up']) && $_GET['move_up'] != '') move_entry_up($_GET['move_up']);
	if(isset($_GET['move_down']) && $_GET['move_down'] != '') move_entry_down($_GET['move_down']);
	
	//ADD A NEW SLIDE
	if (isset($_POST['title']) && isset($_POST['img']) )
	{
		if ($_POST['title'] != '' && $_POST['img'] != '' )
		{
			insert_slide_in_db(NULL,$_POST['title'],$_POST['title_short'],$_POST['text'],$_POST['link'],trim($_POST['img']),trim($_POST['publish']),trim($_POST['target']),trim($_POST['video']));
		}
	}
	
	//EDIT A SLIDE
	if (isset($_POST['edit_id']) && isset($_POST['edit_title']) && isset($_POST['edit_img']) )
	{
		if ($_POST['edit_id'] != '' && $_POST['edit_title'] !='' && $_POST['edit_img'] != '' )
		{
			delete_slide($_POST['edit_id']);
			insert_slide_in_db($_POST['edit_id'],$_POST['edit_title'],$_POST['edit_title_short'],$_POST['edit_text'],$_POST['edit_link'],trim($_POST['edit_img']),trim($_POST['edit_publish']),trim($_POST['edit_target']),trim($_POST['edit_video']));
			
		}
	}

?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/duotive-admin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/colorpicker.css" /> 
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/css/jqtransform.css" /> 
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/colorpicker.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.jqtransform.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery.tools.min.js" /></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/js/jquery-ui.min.js" /></script>    
    <script type="text/javascript">
		$(document).ready(function() {
			jQuery('#duotive-admin-panel img.hint-icon[title]').tooltip({ 'effect':'slide', 'offset':[-9, 0],'layout': '<div><span class="arrow"></span></div>'});								   
			$('#slideshow_background_color').ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).val(hex);
					$(el).ColorPickerHide();
				},
					onBeforeShow: function () {
						$(this).ColorPickerSetColor(this.value);
					}
				})
				.bind('keyup', function(){
				$(this).ColorPickerSetColor(this.value);
			});							 
			$(".transform").jqTransform();
			$( "#duotive-admin-panel" ).tabs();
			$("#duotive-admin-panel div.table-row:even").addClass('table-row-alternative');
	    	$('#settings .table-row-last').prev('div').addClass('table-row-beforelast');			
	    	$('#slides .table-row-last').prev('div').addClass('table-row-beforelast');			
			$('#addslide .table-row-last').prev('div').addClass('table-row-beforelast');						
			//UPLOAD BUTTONS
			jQuery('#slideshow_background_image_button').click(function() {
				 formfield = jQuery('#slideshow_background_image').attr('name');
				 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				 destination = 'slideshow-bg';
				 return false;
			});
		
			jQuery('#slide_image_button').click(function() {
				 formfield = jQuery('#slide_image').attr('name');
				 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				 destination = 'add-slide';			 
				 return false;
			});
			
			jQuery('#slidestaticimage_button').click(function() {
				 formfield = jQuery('#slidestaticimage').attr('name');
				 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				 destination = 'add-slidestaticimage';			 
				 return false;
			});			
			window.send_to_editor = function(html) {
				switch(destination)
				{
					case 'slideshow-bg':
						 imgurl = jQuery('img',html).attr('src');
						 jQuery('#slideshow_background_image').val(imgurl);
					break; 
					case 'add-slide':
						imgurl2 = jQuery('img',html).attr('src');
						jQuery('#slide_image').val(imgurl2);
					break;
					case 'add-slidestaticimage':
						imgurl3 = jQuery('img',html).attr('src');
						jQuery('#slidestaticimage').val(imgurl3);
					break;					
				}
				tb_remove();
			}
			
			$( "#sliderpatternopacityslider" ).slider({
				range: 'min',
				value:$( "#sliderpatternopacity" ).val(),
				min: 0,
				max: 1,
				step: 0.1,
				slide: function( event, ui ) {
					$( "#sliderpatternopacity" ).val( ui.value );
				}
			});
			$( "#sliderpatternopacity" ).val($( "#sliderpatternopacityslider" ).slider( "value" ) );
			
			$( "#slidernivoanimspeedslider" ).slider({
				range: 'min',
				value:$( "#slidernivoanimspeed" ).val(),
				min: 400,
				max: 1200,
				step: 100,
				slide: function( event, ui ) {
					$( "#slidernivoanimspeed" ).val( ui.value );
				}
			});
			$( "#slidernivoanimspeed" ).val($( "#slidernivoanimspeedslider" ).slider( "value" ) );
			
			$( "#slidernivopausetimeslider" ).slider({
				range: 'min',
				value:$( "#slidernivopausetime" ).val(),
				min: 2000,
				max: 12000,
				step: 500,
				slide: function( event, ui ) {
					$( "#slidernivopausetime" ).val( ui.value );
				}
			});
			$( "#slidernivopausetime" ).val($( "#slidernivopausetimeslider" ).slider( "value" ) );	
			
			$( "#slidergallerydurationslider" ).slider({
				range: 'min',
				value:$( "#slidergalleryduration" ).val(),
				min: 400,
				max: 1200,
				step: 100,
				slide: function( event, ui ) {
					$( "#slidergalleryduration" ).val( ui.value );
				}
			});
			$( "#slidergalleryduration" ).val($( "#slidergallerydurationslider" ).slider( "value" ) );				

			$( "#slidergalleryintervalslider" ).slider({
				range: 'min',
				value:$( "#slidergalleryinterval" ).val(),
				min: 2000,
				max: 12000,
				step: 500,
				slide: function( event, ui ) {
					$( "#slidergalleryinterval" ).val( ui.value );
				}
			});
			$( "#slidergalleryinterval" ).val($( "#slidergalleryintervalslider" ).slider( "value" ) );	
			
			$( "#slidercontentspeedslider" ).slider({
				range: 'min',
				value:$( "#slidercontentspeed" ).val(),
				min: 400,
				max: 2000,
				step: 100,
				slide: function( event, ui ) {
					$( "#slidercontentspeed" ).val( ui.value );
				}
			});
			$( "#slidercontentspeed" ).val($( "#slidercontentspeedslider" ).slider( "value" ) );
			
			$( "#slidercontentpauseslider" ).slider({
				range: 'min',
				value:$( "#slidercontentpause" ).val(),
				min: 1000,
				max: 12000,
				step: 500,
				slide: function( event, ui ) {
					$( "#slidercontentpause" ).val( ui.value );
				}
			});
			$( "#slidercontentpause" ).val($( "#slidercontentpauseslider" ).slider( "value" ) );
			
			$( "#slidercomplexdurationslider" ).slider({
				range: 'min',
				value:$( "#slidercomplexduration" ).val(),
				min: 400,
				max: 2000,
				step: 100,
				slide: function( event, ui ) {
					$( "#slidercomplexduration" ).val( ui.value );
				}
			});
			$( "#slidercomplexduration" ).val($( "#slidercomplexdurationslider" ).slider( "value" ) );

			$( "#slidercomplexintervalslider" ).slider({
				range: 'min',
				value:$( "#slidercomplexinterval" ).val(),
				min: 1000,
				max: 12000,
				step: 500,
				slide: function( event, ui ) {
					$( "#slidercomplexinterval" ).val( ui.value );
				}
			});
			$( "#slidercomplexinterval" ).val($( "#slidercomplexintervalslider" ).slider( "value" ) );
			
			$( "#sliderpresentationdurationslider" ).slider({
				range: 'min',
				value:$( "#sliderpresentationduration" ).val(),
				min: 400,
				max: 2000,
				step: 100,
				slide: function( event, ui ) {
					$( "#sliderpresentationduration" ).val( ui.value );
				}
			});
			$( "#sliderpresentationduration" ).val($( "#sliderpresentationdurationslider" ).slider( "value" ) );

			$( "#sliderpresentationintervalslider" ).slider({
				range: 'min',
				value:$( "#sliderpresentationinterval" ).val(),
				min: 1000,
				max: 12000,
				step: 500,
				slide: function( event, ui ) {
					$( "#sliderpresentationinterval" ).val( ui.value );
				}
			});
			$( "#sliderpresentationinterval" ).val($( "#sliderpresentationintervalslider" ).slider( "value" ) );			

			$( "#sliderfullwidthdurationslider" ).slider({
				range: 'min',
				value:$( "#sliderfullwidthduration" ).val(),
				min: 400,
				max: 2000,
				step: 100,
				slide: function( event, ui ) {
					$( "#sliderfullwidthduration" ).val( ui.value );
				}
			});
			$( "#sliderfullwidthduration" ).val($( "#sliderfullwidthdurationslider" ).slider( "value" ) );

			$( "#sliderfullwidthintervalslider" ).slider({
				range: 'min',
				value:$( "#sliderfullwidthinterval" ).val(),
				min: 1000,
				max: 12000,
				step: 500,
				slide: function( event, ui ) {
					$( "#sliderfullwidthinterval" ).val( ui.value );
				}
			});
			$( "#sliderfullwidthinterval" ).val($( "#sliderfullwidthintervalslider" ).slider( "value" ) );
			
		});
		function confirmAction() { return confirm("Are you sure you want to delete this slide?")}
		function toggleLayer( whichLayer )
		{
			var elem, vis;
			if( document.getElementById ) elem = document.getElementById( whichLayer );
				else if( document.all )  elem = document.all[whichLayer];
				else if( document.layers ) elem = document.layers[whichLayer];
			vis = elem.style;
			if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)
				vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';
				vis.display = (vis.display==''||vis.display=='block')?'none':'block';
		}
		
	</script>    
<div class="wrap">
    <div id="duotive-logo">Duotive Admin Panel</div>
    <div id="duotive-main-menu">
        <ul>
            <li><a href="admin.php?page=duotive-panel">General settings</a></li>
            <li><a href="admin.php?page=duotive-front-page-manager">Frontpage</a></li>
            <li class="active"><a href="admin.php?page=duotive-slider">Slideshow</a></li>
            <li><a href="admin.php?page=duotive-sidebars">Sidebars</a></li>
			<li><a href="admin.php?page=duotive-portfolios">Portfolios</a></li>
			<li><a href="admin.php?page=duotive-blogs">Blogs</a></li>
			<li><a href="admin.php?page=duotive-pricing-table">Pricing tables</a></li>
            <li><a href="admin.php?page=duotive-contact">Contact page</a></li>                                                                                   
        </ul>
    </div>
    <div id="duotive-admin-panel">
    	<h3>Slideshow</h3>
        <ul>
            <li><a href="#settings">Slideshow settings</a></li>
            <li><a href="#slides">Current slides</a></li>
            <li class="plus"><a class="plus" href="#addslide"><span class="deco"></span>Add a new slide</a></li>            
        </ul>
        <div id="settings">
            <form method="POST" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=duotive-slider#settings" class="transform">
                <input type="hidden" name="update_themeoptions" value="true" />
                <div class="table-row clearfix">     
                    <label for="slider">Turn slider on/off:</label>
                    <select name="slider">
                      <?php $slider = get_option('slider'); ?>
                      <option value="on" <?php if ($slider=='on') { echo 'selected'; } ?> >On</option>
                      <option value="off" <?php if ($slider=='off') { echo 'selected'; } ?>>Off</option>
                    </select>
                </div> 
                <div class="table-row clearfix">     
                    <label for="slider_display">Display only on front page:</label>
                    <select name="slider_display">
                      <?php $slider_display = get_option('slider_display'); ?>
                      <option value="1" <?php if ($slider_display=='1') { echo 'selected'; } ?> >Yes</option>
                      <option value="0" <?php if ($slider_display=='0') { echo 'selected'; } ?>>No</option>
                    </select>
					<img class="hint-icon" title="If you want the slideshow to be displayed only on your frontpage choose No, otherwise choose Yes and all your pages will have the slideshow active." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                         
                </div> 
                <div class="table-row clearfix">       
                    <label for="slideshow_background_color">Slideshow background color:</label>
                    <input id="slideshow_background_color" type="text" size="6" name="slideshow_background_color" value="<?php echo get_option('slideshow_background_color'); ?>" />
					<img class="hint-icon" title="Select a color for the area in which the slideshow is placed." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                </div>
                <div class="table-row clearfix">    
                    <label for="slideshow_background_image">Slideshow background image:</label>
                    <input id="slideshow_background_image" type="text" size="50" name="slideshow_background_image" value="<?php echo get_option('slideshow_background_image'); ?>" />                     
                    <span class="upload_or">OR</span>
					<input id="slideshow_background_image_button" type="button" value="Upload image" />
                    <img class="hint-icon" title="Type in the URL of an existing image on your server or Insert a new one. The image will be placed on top of the slideshow color you chose." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                         
                </div>     
                <div class="table-row clearfix">     
                    <label for="sliderpattern">Slideshow pattern:</label>
                    <select name="sliderpattern">
						<?php $sliderpattern = get_option('sliderpattern');?>
                        <option value="" <?php if ($sliderpattern=='') { echo 'selected'; } ?> >No pattern</option>                        
                        <option value="subheader-pattern-dot" <?php if ($sliderpattern=='subheader-pattern-dot') { echo 'selected'; } ?> >Dots</option>
                        <option value="subheader-pattern-spaced-dot" <?php if ($sliderpattern=='subheader-pattern-spaced-dot') { echo 'selected'; } ?> >Dots [ spaced ]</option> 
                        <option value="subheader-pattern-diagonal-left-dotted" <?php if ($sliderpattern=='subheader-pattern-diagonal-left-dotted') { echo 'selected'; } ?> >Dots [ left diagonal ]</option>
                        <option value="subheader-pattern-diagonal-right-dotted" <?php if ($sliderpattern=='subheader-pattern-diagonal-right-dotted') { echo 'selected'; } ?> >Dots [ right diagonal ]</option>                                
                        <option value="subheader-pattern-diagonal-left" <?php if ($sliderpattern=='subheader-pattern-diagonal-left') { echo 'selected'; } ?> >Diagonal [ left ]</option>
                        <option value="subheader-pattern-diagonal-right" <?php if ($sliderpattern=='subheader-pattern-diagonal-right') { echo 'selected'; } ?> >Diagonal [ right ]</option> 
                        <option value="subheader-pattern-x" <?php if ($sliderpattern=='subheader-pattern-x') { echo 'selected'; } ?> >[ x ]</option>                                                                                                        
                        <option value="subheader-pattern-plus" <?php if ($sliderpattern=='subheader-pattern-plus') { echo 'selected'; } ?> >[ + ]</option>
                        <option value="subheader-pattern-metal" <?php if ($sliderpattern=='subheader-pattern-metal') { echo 'selected'; } ?> >Metal</option>
                        <option value="subheader-pattern-box-1" <?php if ($sliderpattern=='subheader-pattern-box-1') { echo 'selected'; } ?> >Box [ 1 ]</option>
                        <option value="subheader-pattern-box-2" <?php if ($sliderpattern=='subheader-pattern-box-2') { echo 'selected'; } ?> >Box [ 2 ]</option>
                        <option value="subheader-pattern-grid-1" <?php if ($sliderpattern=='subheader-pattern-grid-1') { echo 'selected'; } ?> >Grid [ 1 ]</option>
                        <option value="subheader-pattern-grid-2" <?php if ($sliderpattern=='subheader-pattern-grid-2') { echo 'selected'; } ?> >Grid [ 2 ]</option> 
                        <option value="subheader-pattern-grid-1" <?php if ($sliderpattern=='subheader-pattern-grid-1') { echo 'selected'; } ?> >Grid [ 1 ]</option>
                        <option value="subheader-pattern-diagonal-grid" <?php if ($sliderpattern=='subheader-pattern-diagonal-grid') { echo 'selected'; } ?> >Grid [ diagonal ]</option> 
                        <option value="subheader-pattern-vertical-lines" <?php if ($sliderpattern=='subheader-pattern-vertical-lines') { echo 'selected'; } ?> >Lines [ vertical ]</option> 
                        <option value="subheader-pattern-horizontal-lines" <?php if ($sliderpattern=='subheader-pattern-horizontal-lines') { echo 'selected'; } ?> >Lines [ horizontal ]</option> 
                        <option value="subheader-pattern-vertical-zigzag" <?php if ($sliderpattern=='subheader-pattern-vertical-zigzag') { echo 'selected'; } ?> >Zig Zag [ vertical ]</option>
                        <option value="subheader-pattern-horizontal-zigzag" <?php if ($sliderpattern=='subheader-pattern-horizontal-zigzag') { echo 'selected'; } ?> >Zig Zag [ horizontal ]</option>                                                                                                
					</select>
					<img class="hint-icon" title="Select one of the patterns as a color/image overlay." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                            
                </div>
                <div class="table-row clearfix">       
                    <label for="sliderpatternopacity">Slideshow pattern opacity:</label>
                    <input id="sliderpatternopacity" type="text" size="2" name="sliderpatternopacity" value="<?php echo get_option('sliderpatternopacity'); ?>" />
					<div id="sliderpatternopacityslider"></div>                    
					<img class="hint-icon" title="You can adjust the pattern's opacity level using this slider, so it will look good regardless of the color or image that you chose." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                </div>                                                            
                <div class="table-row clearfix">     
                    <label for="slidertype">Slider type:</label>
                    <select name="slidertype" onchange="this.form.submit();">
                      	<?php $slidertype = get_option('slidertype'); ?>
						<option value="fullwidth-slider" <?php if ($slidertype=='fullwidth-slider') { echo 'selected'; } ?> >Duotive - Fullwidth Slider</option>                       	                        
                      	<option value="complex-slider" <?php if ($slidertype=='complex-slider') { echo 'selected'; } ?> >Duotive - Complex Slider</option>                       	
                      	<option value="presentation-slider" <?php if ($slidertype=='presentation-slider') { echo 'selected'; } ?> >Duotive - Presentation Slider</option>                       	                        
                      	<option value="gallery-slider" <?php if ($slidertype=='gallery-slider') { echo 'selected'; } ?> >Duotive - Gallery Slider</option>                       	                                                
                      	<option value="accordion" <?php if ($slidertype=='accordion') { echo 'selected'; } ?> >Accordion Slider</option>                        
                      	<option value="content" <?php if ($slidertype=='content') { echo 'selected'; } ?> >Content Slider</option>
                      	<option value="nivo" <?php if ($slidertype=='nivo') { echo 'selected'; } ?> >Nivo Slider</option>                        
						<option value="video" <?php if ($slidertype=='video') { echo 'selected'; } ?>>Video</option>                      
						<option value="static-image" <?php if ($slidertype=='static-image') { echo 'selected'; } ?>>Static image + URL</option>                                              
                    </select>
                    <img class="hint-icon" title="Choose the slideshow type that you like the most. You can tweak the settings below until you get the results you want." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                </div> 
                <?php if ( $slidertype == 'static-image' ): ?>
                    <div class="table-row clearfix">    
                        <label for="slidestaticimage">Static image:</label>
                        <input id="slidestaticimage" type="text" size="50" name="slidestaticimage" value="<?php echo get_option('slidestaticimage'); ?>" />                     
                        <input id="slidestaticimage_button" type="button" value="Upload image" />
						<img class="hint-icon" title="Upload an image or insert an image url for the big-image that will be displayed on the front page slideshow area." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                    </div>
                    <div class="table-row clearfix">    
                        <label for="slidestaticurl">Static URL:</label>
                        <input id="slidestaticurl" type="text" size="90" name="slidestaticurl" value="<?php echo get_option('slidestaticurl'); ?>" />
						<img class="hint-icon" title="Add an URL that will be followed when you click the big-image on the front page in the slideshow area." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                         
                    </div> 
                    <div class="table-row clearfix">    
                        <label for="slidestaticwidth">Static image width:</label>
                        <input id="slidestaticwidth" type="text" size="6" name="slidestaticwidth" value="<?php echo get_option('slidestaticwidth'); ?>" />
                    </div>                                                        
                <?php endif; ?>
                <?php if ( $slidertype == 'video' ): ?>
                    <div class="table-row clearfix">     
                        <label for="slidevideosource">Video source:</label>
                        <select name="slidevideosource">
                          <?php $slidevideosource = get_option('slidevideosource'); ?>
                          <option value="video" <?php if ($slidevideosource=='video') { echo 'selected'; } ?> >Self hosted</option>                          
                          <option value="youtube" <?php if ($slidevideosource=='youtube') { echo 'selected'; } ?> >Youtube</option>                          
                          <option value="vimeo" <?php if ($slidevideosource=='vimeo') { echo 'selected'; } ?> >Vimeo</option>
                        </select>
						<img class="hint-icon" title="Where will the video player get the video from." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                             
                    </div>  
                    <div class="table-row clearfix">    
                        <?php $slidevideourl = get_option('slidevideourl'); ?>
                        <label for="slidevideourl">Video url:</label>
                        <input id="slidevideourl" type="text" size="90" name="slidevideourl" value="<?php echo $slidevideourl; ?>" />
						<img class="hint-icon" title="Add an url for the Youtube video, the Vimeo video or your own uploaded video." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                             
                    </div>                                      
                <?php endif; ?>                              
                <?php if ( $slidertype == 'nivo' ): ?>
                    <div class="table-row clearfix">     
                        <label for="slidernivotransition">Transition:</label>
                        <select name="slidernivotransition">
                          <?php $slidernivotransition = get_option('slidernivotransition'); ?>
                            <option value="sliceDown" <?php if ($slidernivotransition=='sliceDown') { echo 'selected'; } ?> >sliceDown</option>
                            <option value="sliceDownLeft" <?php if ($slidernivotransition=='sliceDownLeft') { echo 'selected'; } ?> >sliceDownLeft</option>
                            <option value="sliceUp" <?php if ($slidernivotransition=='sliceUp') { echo 'selected'; } ?> >sliceUp</option>
                            <option value="sliceUpLeft" <?php if ($slidernivotransition=='sliceUpLeft') { echo 'selected'; } ?> >sliceUpLeft</option>
                            <option value="sliceUpDown" <?php if ($slidernivotransition=='sliceUpDown') { echo 'selected'; } ?> >sliceUpDown</option>
                            <option value="sliceUpDownLeft" <?php if ($slidernivotransition=='sliceUpDownLeft') { echo 'selected'; } ?> >sliceUpDownLeft</option>
                            <option value="fold" <?php if ($slidernivotransition=='fold') { echo 'selected'; } ?> >fold</option>
                            <option value="fade" <?php if ($slidernivotransition=='fade') { echo 'selected'; } ?> >fade</option>
                            <option value="random" <?php if ($slidernivotransition=='random') { echo 'selected'; } ?> >random</option>
                            <option value="slideInRight" <?php if ($slidernivotransition=='slideInRight') { echo 'selected'; } ?> >slideInRight</option>
                            <option value="slideInLeft" <?php if ($slidernivotransition=='slideInLeft') { echo 'selected'; } ?> >slideInLeft</option>
                            <option value="boxRandom" <?php if ($slidernivotransition=='boxRandom') { echo 'selected'; } ?> >boxRandom</option>                            
                            <option value="boxRain" <?php if ($slidernivotransition=='boxRain') { echo 'selected'; } ?> >boxRain</option>                            
                            <option value="boxRainReverse" <?php if ($slidernivotransition=='boxRainReverse') { echo 'selected'; } ?> >boxRainReverse</option>                            
                            <option value="boxRainGrow" <?php if ($slidernivotransition=='boxRainGrow') { echo 'selected'; } ?> >boxRainGrow</option>                            
                            <option value="boxRainGrowReverse" <?php if ($slidernivotransition=='boxRainGrowReverse') { echo 'selected'; } ?> >boxRainGrowReverse</option>                                                                                                                                            
                        </select>
						<img class="hint-icon" title="The transition effect between the images in the slideshow." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                             
                    </div> 
                    <div class="table-row clearfix"> 
                    	<?php $slidernivoslices =  get_option('slidernivoslices'); ?>                    
				        <?php if ( $slidernivoslices == '' ) $slidernivoslices = 8; else $slidernivoslices =  get_option('slidernivoslices'); ?>                      
                        <label for="slidernivoslices">Slices:</label>
                        <input type="text" size="8" name="slidernivoslices" value="<?php echo $slidernivoslices; ?>" />
						<img class="hint-icon" title="The number of slices used for slide transitions defined above." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                             
                    </div> 
                    <div class="table-row clearfix"> 
                    	<?php $slidernivoboxcols =  get_option('slidernivoboxcols'); ?>                    
						<?php $slidernivoboxrows =  get_option('slidernivoboxrows'); ?>                        
				        <?php if ( $slidernivoboxcols == '' ) $slidernivoboxcols = 8; else $slidernivoboxcols =  get_option('slidernivoboxcols'); ?>                     
				        <?php if ( $slidernivoboxrows == '' ) $slidernivoboxrows = 8; else $slidernivoboxrows =  get_option('slidernivoboxrows'); ?>                      
                        <label for="slidernivoslices">Box cols x rows:</label>
                        <input type="text" size="8" name="slidernivoboxcols" value="<?php echo $slidernivoboxcols; ?>" />
                        <span style="float:left; margin-right:10px; margin-top:5px;">x</span>
                        <input type="text" size="8" name="slidernivoboxrows" value="<?php echo $slidernivoboxrows; ?>" />
  						<img class="hint-icon" title="The number of columns x the number of rows used for box transitions defined above." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                    </div>                     
                    <div class="table-row clearfix"> 
                    	<?php $slidernivoanimspeed =  get_option('slidernivoanimspeed'); ?>
				        <?php if ( $slidernivoanimspeed == '' ) $slidernivoanimspeed = 800; else $slidernivoanimspeed =  get_option('slidernivoanimspeed'); ?>                      
                        <label for="slidernivoanimspeed">Animation speed:</label>
                        <input type="text" size="8" id="slidernivoanimspeed" name="slidernivoanimspeed" value="<?php echo $slidernivoanimspeed; ?>" />
						<div id="slidernivoanimspeedslider"></div>
						<img class="hint-icon" title="The time that the transition defined above will take to get from a slide to another." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                                                                     
                    </div> 
                    <div class="table-row clearfix"> 
                    	<?php $slidernivopausetime =  get_option('slidernivopausetime'); ?>
				        <?php if ( $slidernivopausetime == '' ) $slidernivopausetime = 3000; else $slidernivopausetime =  get_option('slidernivopausetime'); ?>                      
                        <label for="slidernivopausetime">Pause time:</label>
                        <input type="text" size="8" id="slidernivopausetime" name="slidernivopausetime" value="<?php echo $slidernivopausetime; ?>" />
                        <div id="slidernivopausetimeslider"></div>
						<img class="hint-icon" title="The time the slider pauses on a slide before advancing to the next one." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                             
                    </div>  
                    <div class="table-row clearfix">     
                        <label for="slidernivodirectionnav">Directional navigation:</label>
                        <select name="slidernivodirectionnav">
                          <?php $slidernivodirectionnav = get_option('slidernivodirectionnav'); ?>
                          <option value="true" <?php if ($slidernivodirectionnav=="true") { echo 'selected'; } ?> >On</option>
                          <option value="false" <?php if ($slidernivodirectionnav=="false") { echo 'selected'; } ?>>Off</option>
                        </select>
						<img class="hint-icon" title="Enable left-right navigation arrows." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                             
                    </div> 
                    <div class="table-row clearfix">     
                        <label for="slidernivodirectionnavhide">Autohide directional nav.:</label>
                        <select name="slidernivodirectionnavhide">
                          <?php $slidernivodirectionnavhide = get_option('slidernivodirectionnavhide'); ?>
                          <option value="true" <?php if ($slidernivodirectionnavhide=="true") { echo 'selected'; } ?> >On</option>
                          <option value="false" <?php if ($slidernivodirectionnavhide=="false") { echo 'selected'; } ?>>Off</option>
                        </select>
						<img class="hint-icon" title="Auto-hide the left-right navigation arrows." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                             
                    </div>  
                    <div class="table-row clearfix">     
                        <label for="slidernivocontrolnav">Control navigation:</label>
                        <select name="slidernivocontrolnav">
                          <?php $slidernivocontrolnav = get_option('slidernivocontrolnav'); ?>
                          <option value="true" <?php if ($slidernivocontrolnav=="true") { echo 'selected'; } ?> >On</option>
                          <option value="false" <?php if ($slidernivocontrolnav=="false") { echo 'selected'; } ?>>Off</option>
                        </select>
						<img class="hint-icon" title="Enable numbered bullets navigation." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                             
                    </div>                                                                                                                                        
                <?php endif; ?>
                <?php if ( $slidertype == 'accordion' ): ?>
                    <div class="table-row clearfix">     
                        <label for="slideraccordionnumber">Number of elements:</label>
                        <select name="slideraccordionnumber">
                          <?php $slideraccordionnumber = get_option('slideraccordionnumber'); ?>
                          <option value="3" <?php if ($slideraccordionnumber=='3') { echo 'selected'; } ?> >3 Elements</option>
                          <option value="4" <?php if ($slideraccordionnumber=='4') { echo 'selected'; } ?> >4 Elements</option>
                          <option value="5" <?php if ($slideraccordionnumber=='5') { echo 'selected'; } ?> >5 Elements</option>
                          <option value="6" <?php if ($slideraccordionnumber=='6') { echo 'selected'; } ?> >6 Elements</option>
                          <option value="7" <?php if ($slideraccordionnumber=='7') { echo 'selected'; } ?> >7 Elements</option>
                          <option value="8" <?php if ($slideraccordionnumber=='8') { echo 'selected'; } ?> >8 Elements</option>                                                                                                                                  
                        </select>
						<img class="hint-icon" title="The number of images that will be displayed in the slider." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>  
                    <div class="table-row clearfix">     
                        <label for="slideraccordionsticky">Sticky element:</label>
                        <select name="slideraccordionsticky">
                          <?php $slideraccordionsticky = get_option('slideraccordionsticky'); ?>
                          <option value="0" <?php if ($slideraccordionsticky==0) { echo 'selected'; } ?> >No</option>                          
                          <option value="1" <?php if ($slideraccordionsticky==1) { echo 'selected'; } ?> >Yes</option>
                        </select>
                        <img class="hint-icon" title="The first element in the slider will be active by default." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                                     
                <?php endif; ?> 
                <?php if ( $slidertype == 'content' ): ?>
                    <div class="table-row clearfix">     
                        <label for="slidercontenttranstion">Transition mode:</label>
                        <select name="slidercontenttranstion">
                          <?php $slidercontenttranstion = get_option('slidercontenttranstion'); ?>
                          <option value="fade" <?php if ($slidercontenttranstion=='fade') { echo 'selected'; } ?> >Fade Transition</option>
                          <option value="horizontal" <?php if ($slidercontenttranstion=='horizontal') { echo 'selected'; } ?> >Horizontal Transition</option>
                          <option value="vertical" <?php if ($slidercontenttranstion=='vertical') { echo 'selected'; } ?> >Vertical Transition</option>                                    
                        </select>
                        <img class="hint-icon" title="The animation between the slides." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>   
                    <div class="table-row clearfix">     
                        <label for="slidercontentposition">Content position:</label>
                        <select name="slidercontentposition">
                          <?php $slidercontentposition = get_option('slidercontentposition'); ?>
                          <option value="side-description-right" <?php if ($slidercontentposition=='side-description-right') { echo 'selected'; } ?> >Content on the right</option> 
                          <option value="side-description-left" <?php if ($slidercontentposition=='side-description-left') { echo 'selected'; } ?> >Content on the left</option>                                               
                        </select>
                        <img class="hint-icon" title="The layout for slides. Image on the left and content on the right or image on the right and content on the left." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>  
                    <div class="table-row clearfix">       
                        <label for="slidercontentspeed">Speed:</label>
                        <input type="text" size="8" id="slidercontentspeed" name="slidercontentspeed" value="<?php echo get_option('slidercontentspeed'); ?>" />
                        <div id="slidercontentspeedslider"></div>
						<img class="hint-icon" title="The time that the transition defined above will take to get from a slide to another." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                                                                                             
                    </div>                     
                    <div class="table-row clearfix">     
                        <label for="slidercontentautoplay">Auto-play:</label>
                        <select name="slidercontentautoplay">
                          <?php $slidercontentautoplay = get_option('slidercontentautoplay'); ?>
                          <option value="true" <?php if ($slidercontentautoplay=='true') { echo 'selected'; } ?> >Yes</option> 
                          <option value="false" <?php if ($slidercontentautoplay=='false') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                        <img class="hint-icon" title="Enable auto-advance to the next slide." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                     
                    </div> 
                    <?php if ( $slidercontentautoplay == 'true' ) : ?>
                        <div class="table-row clearfix">       
                            <label for="slidercontentpause">Pause between slides:</label>
                            <input type="text" size="8" name="slidercontentpause" id="slidercontentpause" value="<?php echo get_option('slidercontentpause'); ?>" />
                            <div id="slidercontentpauseslider"></div>
                            <img class="hint-icon" title="The time that the transition defined above will take to get from a slide to another." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                                                                     
                        </div>                                            
                    <?php endif; ?>                                    
                <?php endif; ?>
                <?php if ( $slidertype == 'presentation-slider' ): ?>
                    <div class="table-row clearfix">     
                        <label for="sliderpresentationarrowcontrols">Display arrow controls:</label>
                        <select name="sliderpresentationarrowcontrols">
                          <?php $sliderpresentationarrowcontrols = get_option('sliderpresentationarrowcontrols'); if ( $sliderpresentationarrowcontrols == '' ) $sliderpresentationarrowcontrols = 1; else $sliderpresentationarrowcontrols = get_option('sliderpresentationarrowcontrols'); ?>
                          <option value="1" <?php if ($sliderpresentationarrowcontrols=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($sliderpresentationarrowcontrols=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>  
                    <div class="table-row clearfix">     
                        <label for="sliderpresentationdescription">Display description:</label>
                        <select name="sliderpresentationdescription">
                          <?php $sliderpresentationdescription = get_option('sliderpresentationdescription'); if ( $sliderpresentationdescription == '' ) $sliderpresentationdescription = 1; else $sliderpresentationdescription = get_option('sliderpresentationdescription'); ?>
                          <option value="1" <?php if ($sliderpresentationdescription=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($sliderpresentationdescription=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>
                    <div class="table-row clearfix">     
                        <label for="sliderpresentationhide">Auto-hide description:</label>
                        <select name="sliderpresentationhide">
                          <?php $sliderpresentationhide = get_option('sliderpresentationhide'); if ( $sliderpresentationhide == '' ) $sliderpresentationhide = 1; else $sliderpresentationhide = get_option('sliderpresentationhide'); ?>
                          <option value="1" <?php if ($sliderpresentationhide=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($sliderpresentationhide=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>
                    <div class="table-row clearfix"> 
                        <?php $sliderpresentationduration = get_option('sliderpresentationduration'); if ( $sliderpresentationduration == '' ) $sliderpresentationduration = 1000; else $sliderpresentationduration = get_option('sliderpresentationduration'); ?>
                        <label for="sliderpresentationduration">Fade time:</label>
                        <input id="sliderpresentationduration" type="text" size="10" name="sliderpresentationduration" value="<?php echo $sliderpresentationduration; ?>" />
                        <div id="sliderpresentationdurationslider"></div>
                    </div>    
                    <div class="table-row clearfix">    
                        <?php $sliderpresentationinterval = get_option('sliderpresentationinterval'); if ( $sliderpresentationinterval == '' ) $sliderpresentationinterval = 8000; else $sliderpresentationinterval = get_option('sliderpresentationinterval'); ?>
                        <label for="sliderpresentationinterval">Time between slides:</label>
                        <input id="sliderpresentationinterval" type="text" size="10" name="sliderpresentationinterval" value="<?php echo $sliderpresentationinterval; ?>" />
                        <div id="sliderpresentationintervalslider"></div>
                    </div>                                                                
                <?php endif; ?>
                <?php if ( $slidertype == 'fullwidth-slider' ): ?>
                    <div class="table-row clearfix">     
                        <label for="sliderfullwidtharrowcontrols">Display arrow controls:</label>
                        <select name="sliderfullwidtharrowcontrols">
                          <?php $sliderfullwidtharrowcontrols = get_option('sliderfullwidtharrowcontrols'); if ( $sliderfullwidtharrowcontrols == '' ) $sliderfullwidtharrowcontrols = 1; else $sliderfullwidtharrowcontrols = get_option('sliderfullwidtharrowcontrols'); ?>
                          <option value="1" <?php if ($sliderfullwidtharrowcontrols=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($sliderfullwidtharrowcontrols=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>
                    <div class="table-row clearfix">     
                        <label for="sliderfullwidthgallery">Display gallery:</label>
                        <select name="sliderfullwidthgallery">
                          <?php $sliderfullwidthgallery = get_option('sliderfullwidthgallery'); if ( $sliderfullwidthgallery == '' ) $sliderfullwidthgallery = 1; else $sliderfullwidthgallery = get_option('sliderfullwidthgallery'); ?>
                          <option value="1" <?php if ($sliderfullwidthgallery=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($sliderfullwidthgallery=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>  
                    <div class="table-row clearfix">     
                        <label for="sliderfullwidthtitles">Display titles:</label>
                        <select name="sliderfullwidthtitles">
                          <?php $sliderfullwidthtitles = get_option('sliderfullwidthtitles'); if ( $sliderfullwidthtitles == '' ) $sliderfullwidthtitles = 1; else $sliderfullwidthtitles = get_option('sliderfullwidthtitles'); ?>
                          <option value="1" <?php if ($sliderfullwidthtitles=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($sliderfullwidthtitles=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>  
                    <div class="table-row clearfix">     
                        <label for="sliderfullwidthcontentbox">Display contentbox:</label>
                        <select name="sliderfullwidthcontentbox">
                          <?php $sliderfullwidthcontentbox = get_option('sliderfullwidthcontentbox'); if ( $sliderfullwidthcontentbox == '' ) $sliderfullwidthcontentbox = 1; else $sliderfullwidthcontentbox = get_option('sliderfullwidthcontentbox'); ?>
                          <option value="1" <?php if ($sliderfullwidthcontentbox=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($sliderfullwidthcontentbox=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>                                                             
                    <div class="table-row clearfix"> 
                        <?php $sliderfullwidthduration = get_option('sliderfullwidthduration'); if ( $sliderfullwidthduration == '' ) $sliderfullwidthduration = 1000; else $sliderfullwidthduration = get_option('sliderfullwidthduration'); ?>
                        <label for="sliderfullwidthduration">Fade time:</label>
                        <input id="sliderfullwidthduration" type="text" size="10" name="sliderfullwidthduration" value="<?php echo $sliderfullwidthduration; ?>" />
                        <div id="sliderfullwidthdurationslider"></div>
                    </div>    
                    <div class="table-row clearfix">    
                        <?php $sliderfullwidthinterval = get_option('sliderfullwidthinterval'); if ( $sliderfullwidthinterval == '' ) $sliderfullwidthinterval = 8000; else $sliderfullwidthinterval = get_option('sliderfullwidthinterval'); ?>
                        <label for="sliderfullwidthinterval">Time between slides:</label>
                        <input id="sliderfullwidthinterval" type="text" size="10" name="sliderfullwidthinterval" value="<?php echo $sliderfullwidthinterval; ?>" />
                        <div id="sliderfullwidthintervalslider"></div>
                    </div>                                                                
                <?php endif; ?>                
                <?php if ( $slidertype == 'gallery-slider' ): ?>
                    <div class="table-row clearfix">     
                        <label for="slidergalleryrandom">Display random slides:</label>
                        <select name="slidergalleryrandom">
                          <?php $slidergalleryrandom = get_option('slidergalleryrandom'); if ( $slidergalleryrandom == '' ) $slidergalleryrandom = 1; else $slidergalleryrandom = get_option('slidergalleryrandom'); ?>
                          <option value="1" <?php if ($slidergalleryrandom=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($slidergalleryrandom=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>                  
                    <div class="table-row clearfix">     
                        <label for="slidergalleryarrowcontrols">Display arrow controls:</label>
                        <select name="slidergalleryarrowcontrols">
                          <?php $slidergalleryarrowcontrols = get_option('slidergalleryarrowcontrols'); if ( $slidergalleryarrowcontrols == '' ) $slidergalleryarrowcontrols = 1; else $slidergalleryarrowcontrols = get_option('slidergalleryarrowcontrols'); ?>
                          <option value="1" <?php if ($slidergalleryarrowcontrols=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($slidergalleryarrowcontrols=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>  
                    <div class="table-row clearfix">     
                        <label for="slidergallerydescription">Display description:</label>
                        <select name="slidergallerydescription">
                          <?php $slidergallerydescription = get_option('slidergallerydescription'); if ( $slidergallerydescription == '' ) $slidergallerydescription = 1; else $slidergallerydescription = get_option('slidergallerydescription'); ?>
                          <option value="1" <?php if ($slidergallerydescription=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($slidergallerydescription=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>
                    <div class="table-row clearfix"> 
                        <?php $slidergalleryduration = get_option('slidergalleryduration'); if ( $slidergalleryduration == '' ) $slidergalleryduration = 1000; else $slidergalleryduration = get_option('slidergalleryduration'); ?>
                        <label for="slidergalleryduration">Animation time:</label>
                        <input id="slidergalleryduration" type="text" size="10" name="slidergalleryduration" value="<?php echo $slidergalleryduration; ?>" />
                        <div id="slidergallerydurationslider"></div>
                    </div>    
                    <div class="table-row clearfix">    
                        <?php $slidergalleryinterval = get_option('slidergalleryinterval'); if ( $slidergalleryinterval == '' ) $slidergalleryinterval = 8000; else $slidergalleryinterval = get_option('slidergalleryinterval'); ?>
                        <label for="slidergalleryinterval">Auto advance time:</label>
                        <input id="slidergalleryinterval" type="text" size="10" name="slidergalleryinterval" value="<?php echo $slidergalleryinterval; ?>" />
                        <div id="slidergalleryintervalslider"></div>
                    </div>                                                                
                <?php endif; ?>                
                <?php if ( $slidertype == 'complex-slider' ): ?>
                    <div class="table-row clearfix">     
                        <label for="slidercomplexarrowcontrols">Display arrow controls:</label>
                        <select name="slidercomplexarrowcontrols">
                          <?php $slidercomplexarrowcontrols = get_option('slidercomplexarrowcontrols'); if ( $slidercomplexarrowcontrols == '' ) $slidercomplexarrowcontrols = 1; else $slidercomplexarrowcontrols = get_option('slidercomplexarrowcontrols'); ?>
                          <option value="1" <?php if ($slidercomplexarrowcontrols=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($slidercomplexarrowcontrols=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>                  
                    <div class="table-row clearfix">     
                        <label for="slidercomplexgallery">Display gallery:</label>
                        <select name="slidercomplexgallery">
                          <?php $slidercomplexgallery = get_option('slidercomplexgallery'); if ( $slidercomplexgallery == '' ) $slidercomplexgallery = 1; else $slidercomplexgallery = get_option('slidercomplexgallery'); ?>
                          <option value="1" <?php if ($slidercomplexgallery=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($slidercomplexgallery=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div>  
                    <div class="table-row clearfix">     
                        <label for="slidercomplexdescription">Display description:</label>
                        <select name="slidercomplexdescription">
                       	  <?php $slidercomplexdescription = get_option('slidercomplexdescription'); if ( $slidercomplexdescription == '' ) $slidercomplexdescription = 1; else $slidercomplexdescription = get_option('slidercomplexdescription'); ?>
                          <option value="1" <?php if ($slidercomplexdescription=='1') { echo 'selected'; } ?> >Yes</option> 
                          <option value="0" <?php if ($slidercomplexdescription=='0') { echo 'selected'; } ?> >No</option>                                               
                        </select>
                    </div> 
                    <div class="table-row clearfix"> 
                        <?php $slidercomplexduration = get_option('slidercomplexduration'); if ( $slidercomplexduration == '' ) $slidercomplexduration = 1000; else $slidercomplexduration = get_option('slidercomplexduration'); ?>
                        <label for="slidercomplexduration">Fade time:</label>
                        <input id="slidercomplexduration" type="text" size="10" name="slidercomplexduration" value="<?php echo $slidercomplexduration; ?>" />
                        <div id="slidercomplexdurationslider"></div>
                    </div>    
                    <div class="table-row clearfix">    
                        <?php $slidercomplexinterval = get_option('slidercomplexinterval'); if ( $slidercomplexinterval == '' ) $slidercomplexinterval = 7500; else $slidercomplexinterval = get_option('slidercomplexinterval'); ?>
                        <label for="slidercomplexinterval">Time between slides:</label>
                        <input id="slidercomplexinterval" type="text" size="10" name="slidercomplexinterval" value="<?php echo $slidercomplexinterval; ?>" />
                        <div id="slidercomplexintervalslider"></div>
                    </div>                                                             	
                <?php endif; ?>
                <div class="table-row table-row-last clearfix">
                    <input type="submit" name="search" value="Save changes" class="button" />
                    <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                </div>						                        
            </form>    
        </div>      
        <div id="addslide">
            <form method="POST" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=duotive-slider#addslide" class="transform">
                <div class="table-row clearfix">
                    <label for="title">Slide title:</label>
                    <input class="fullwidth" name="title" type="text" onfocus="if(this.value=='add title') this.value='';" onblur="if(this.value=='') this.value='add title';" value="add title" size="50"/>
                </div>
                <div class="table-row clearfix">
                    <label for="title_short">Slide presentation short title:</label>
                    <input class="fullwidth" name="title_short" type="text" onfocus="if(this.value=='add title') this.value='';" onblur="if(this.value=='') this.value='add title';" value="add title" size="50"/>
                    <img class="hint-icon" title="This short title will be used in the Presentation Slider's scrolling gallery, if it has been chosen." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                </div>                
                <div class="table-row clearfix">
                    <label for="text">Slide description:</label>
                    <textarea class="fullwidth" rows="9" cols="50" name="text" onfocus="if(this.value=='add description') this.value='';" onblur="if(this.value=='') this.value='add description';" >add description</textarea>                            
                </div>
                <div class="table-row clearfix">
                    <label for="img">Slide image:</label>
                    <input id="slide_image" class="fullwidth" name="img" type="text" onfocus="if(this.value=='add image') this.value='';" onblur="if(this.value=='') this.value='add image';" value="add image" size="50"/>
                    <span class="upload_or">OR</span>
                    <input id="slide_image_button" type="button" value="Upload image" />
                </div>
                <div class="table-row clearfix">
                    <label for="target">Target type:</label>
                    <div class="radio-in-line"><input type="radio" checked name="target" value="url">URL</div>
                    <div class="radio-in-line"><input type="radio" name="target" value="video">Video</div>
                    <div class="radio-in-line"><input type="radio" name="target" value="image">Image</div>                    
                    <img style="margin-top:2px;" class="hint-icon" title="Select which type of resource will be opened when this slide is clicked." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                </div>                                     
                <div class="table-row clearfix">
                    <label for="link">Slide URL:</label>
                    <input class="fullwidth" name="link" type="text" onfocus="if(this.value=='#') this.value='';" onblur="if(this.value=='') this.value='#';" value="#" size="50"/>                            
                    <img class="hint-icon" title="Where to navigate if the slide is clicked. Fill this only if you selected the target type to URL." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                </div>             
                <div class="table-row clearfix">
                    <label for="video">Slide video URL:</label>
                    <input class="fullwidth" name="video" type="text" onfocus="if(this.value=='add video url') this.value='';" onblur="if(this.value=='') this.value='add video url';" value="#" size="50"/>                            
                    <img class="hint-icon" title="If you selected the target to be Video, here is where you should insert the video's link." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                </div>                
                <div class="table-row clearfix">
                    <label for="publish">Published:</label>
                    <div class="radio-in-line"><input type="radio" checked name="publish" value="1">Yes</div>
                    <div class="radio-in-line"><input type="radio" name="publish" value="0">No</div>
                    <img class="hint-icon" title="If this is set to Yes your newly added slide will be added immediatly to your current published slides. You can change this at any time from the Current slides tab by clicking on the status icon." src="<?php echo get_bloginfo('template_directory'); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                </div>                
                <div class="table-row table-row-last clearfix">
                    <input type="submit" name="search" value="Add slide" class="button" />
                </div>                        							                        
            </form>
        </div>          
        <div id="slides">
				<?php
					global $wpdb;
					$slides = '';
					if ( check_db_existance('duotive_slider') ) :
						$slide_require_query = 'SELECT * FROM duotive_slider ORDER BY ID ASC';	
						$slides = $wpdb->get_results($slide_require_query);
					endif;
                ?>   
                <?php if ( $slides!= '' && count($slides) ): ?>
                <table>
                    <thead>
                        <tr>
                        	<th>No.</th>
                            <th>Image</th>                            
                            <th>Title</th>
                            <th>URL</th>
                            <th>Edit</th>
                            <th>Ordering</th> 
                            <th>Status</th>
                            <th>Delete</th>                           
                        </tr>                
                    </thead>
                  <?php $class = ''; $count = count($slides); ?>
                  <?php $timthumb = get_bloginfo('template_url').'/includes/timthumb.php'; ?>
				<?php $i = 0; foreach ( $slides as $slide ): ?>
                    <tr class="<?php echo $class; ?>">
                        <td valign="center" align="center"><?php echo $i+1; ?></td>
                        <td valign="center"><img src="<?php echo $timthumb; ?>?src=<?php echo $slide->IMG; ?>&w=60&h=60&zc=1&q=100" /> </td>                  
                        <td valign="center"><?php echo stripslashes($slide->TITLE); ?> </td>
                        <td valign="center"><?php echo $slide->LINK; ?> </td>
                        <td valign="center" align="center">
                            <a class="edit" title="Edit Slide" onclick="javascript:toggleLayer('editForm<?php echo $i; ?>')"; href="javascript:void(0);">EDIT</a>                  
                        </td>
                        <td valign="center" align="center">
                            <a title="Move Slide Up" <?php if( $i == 0 ) echo 'onclick="javascript: return false;"'; ?> class="move_up<?php if ( $i == 0 ) echo ' disabled_up'; ?>" href="?page=duotive-slider&move_up=<?php echo $slide->ID; ?>">MOVE UP</a>
                            <a title="Move Slide Down" <?php if ( $i == $count - 1 ) echo 'onclick="javascript: return false;"'; ?> class="move_down<?php if ( $i == $count - 1 ) echo ' disabled_down'; ?>"class="move_down" href="?page=duotive-slider&move_down=<?php echo $slide->ID; ?>">MOVE DOWN</a>
                        </td> 
                        <td valign="center" align="center">                 
                            <?php if ( $slide->PUBLISH == 0 ) : ?> 
                            <a class="publish"  title="Publish Slide" href="?page=duotive-slider&publish=<?php echo $slide->ID; ?>#slides">PUBLISH</a> 
                            <?php else: ?>
                            <a class="unpublish"  title="Unpublish Slide" href="?page=duotive-slider&unpublish=<?php echo $slide->ID; ?>#slides">UNPUBLISH</a>                                             
                            <?php endif; ?>                  
                        </td>
                        <td valign="center" align="center">        
                            <a class="delete" title="Delete Slide" onClick="return confirmAction()" href="?page=duotive-slider&delete=<?php echo $slide->ID; ?>#slides">DELETE</a>
                        </td>
                    </tr>
                    <tr class="edit">
                        <td colspan="8">
                            <div id="editForm<?php echo $i; ?>" class="edit-slide">
                                <form method="POST" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=duotive-slider#slides" class="transform">
                                    <input type="hidden" name="edit_id" value="<?php echo $slide->ID;?>" />
                                    <div class="table-row clearfix">                  
                                        <label for="edit_title">Slide title:</label>
                                        <input class="inputbox" name="edit_title" type="text" value="<?php echo stripslashes($slide->TITLE);?>" size="50"/>
                                    </div>
                                    <div class="table-row clearfix">                  
                                        <label for="edit_title_short">Slide presentation short title:</label>
                                        <input class="inputbox" name="edit_title_short" type="text" value="<?php echo stripslashes($slide->TITLE_SHORT);?>" size="50"/>
                                    </div>                                
                                    <div class="table-row clearfix">
                                        <label for="edit_text">Slide description:</label>
                                        <textarea rows="9" cols="50"  name="edit_text" ><?php echo stripslashes($slide->TEXT);?></textarea>
                                    </div>
                                    <div class="table-row clearfix">
                                        <label for="edit_img">Slide image:</label>
                                        <input class="inputbox" name="edit_img" type="text" value="<?php echo $slide->IMG;?>" size="50"/>
                                    </div> 
                                    <div class="table-row clearfix">
                                        <label for="edit_target">Target type:</label>
                                        <div class="radio-in-line"><input type="radio" <?php if ( $slide->TARGET == 'url' ) echo 'checked="checked"';?>  name="edit_target" value="url">URL</div>
                                        <div class="radio-in-line"><input type="radio" <?php if ( $slide->TARGET == 'video' ) echo 'checked="checked"';?>  name="edit_target" value="video">Video</div>
                                        <div class="radio-in-line"><input type="radio" <?php if ( $slide->TARGET == 'image' ) echo 'checked="checked"';?>  name="edit_target" value="image">Image</div>                                        
                                    </div>                                                                       
                                    <div class="table-row clearfix">
                                        <label for="edit_link">Slide URL:</label>
                                        <input class="inputbox" name="edit_link" type="text" value="<?php echo $slide->LINK;?>" size="50"/>
                                    </div>
                                    <div class="table-row clearfix">
                                        <label for="edit_video">Slide video URL:</label>
                                        <input class="inputbox" name="edit_video" type="text" value="<?php echo $slide->VIDEO;?>" size="50"/>
                                    </div>                                     
                                    <div class="table-row clearfix">
                                        <label for="edit_publish">Published:</label>
                                        <div class="radio-in-line"><input type="radio" <?php if ( $slide->PUBLISH == 1 ) echo 'checked="checked"';?>  name="edit_publish" value="1">Yes</div>
                                        <div class="radio-in-line"><input type="radio" <?php if ( $slide->PUBLISH == 0 ) echo 'checked="checked"';?>  name="edit_publish" value="0">No</div>
                                    </div>                                                                    
                                    <div class="table-row clearfix">
                                        <input type="submit" class="button" value="Update slide"/>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php $i++; ?>
                <?php if ( $class == '' ) $class = 'alternate'; else $class = ''; ?>
                <?php endforeach; ?>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Image</th>                            
                        <th>Title</th>
                        <th>URL</th>
                        <th>Edit</th>
                        <th>Ordering</th> 
                        <th>Status</th>
                        <th>Delete</th>   
                    </tr>                
                </tfoot>     
              </table>
			<?php else: ?>
            	<div class="page-error">There aren't any slides added yet.</div>              
			<?php endif; ?>
        </div>
    </div>
</div>
<?php
}

function themeoptions_update()
{
	if ( isset($_POST['slider']) ) update_option('slider',$_POST['slider']);
	if ( isset($_POST['slider_display']) ) update_option('slider_display',$_POST['slider_display']);	
	if ( isset($_POST['slidertype']) ) update_option('slidertype',$_POST['slidertype']);
	if ( isset($_POST['slideshow_background_image']) ) update_option('slideshow_background_image',$_POST['slideshow_background_image']);
	if ( isset($_POST['slideshow_background_color']) ) update_option('slideshow_background_color',$_POST['slideshow_background_color']);	
	if ( isset($_POST['sliderpattern']) ) update_option('sliderpattern',$_POST['sliderpattern']);
	if ( isset($_POST['sliderpatternopacity']) ) update_option('sliderpatternopacity',$_POST['sliderpatternopacity']);
	if ( isset($_POST['slidevideosource']) ) update_option('slidevideosource',$_POST['slidevideosource']);
	if ( isset($_POST['slidevideourl']) ) update_option('slidevideourl',$_POST['slidevideourl']);
	if ( isset($_POST['slidestaticimage']) ) update_option('slidestaticimage',$_POST['slidestaticimage']);
	if ( isset($_POST['slidestaticurl']) ) update_option('slidestaticurl',$_POST['slidestaticurl']);	
	if ( isset($_POST['slidestaticwidth']) ) update_option('slidestaticwidth',$_POST['slidestaticwidth']);		
	if ( isset($_POST['slideraccordionnumber']) ) update_option('slideraccordionnumber',$_POST['slideraccordionnumber']);	
	if ( isset($_POST['slideraccordionsticky']) ) update_option('slideraccordionsticky',$_POST['slideraccordionsticky']);		
	if ( isset($_POST['slidercontenttranstion']) ) update_option('slidercontenttranstion',$_POST['slidercontenttranstion']);
	if ( isset($_POST['slidercontentposition']) ) update_option('slidercontentposition',$_POST['slidercontentposition']);
	if ( isset($_POST['slidercontentautoplay'] ) ) update_option('slidercontentautoplay',$_POST['slidercontentautoplay']);	
	if ( isset($_POST['slidercontentspeed']) ) update_option('slidercontentspeed',$_POST['slidercontentspeed']);
	if ( isset($_POST['slidercontentpause']) ) update_option('slidercontentpause',$_POST['slidercontentpause']);
	if ( isset($_POST['slidercomplexarrowcontrols']) ) update_option('slidercomplexarrowcontrols',$_POST['slidercomplexarrowcontrols']);	
	if ( isset($_POST['slidercomplexgallery']) ) update_option('slidercomplexgallery',$_POST['slidercomplexgallery']);
	if ( isset($_POST['slidercomplexdescription']) ) update_option('slidercomplexdescription',$_POST['slidercomplexdescription']);
	if ( isset($_POST['slidercomplexduration']) ) update_option('slidercomplexduration',$_POST['slidercomplexduration']);
	if ( isset($_POST['slidercomplexinterval']) ) update_option('slidercomplexinterval',$_POST['slidercomplexinterval']);	
	if ( isset($_POST['sliderpresentationarrowcontrols']) ) update_option('sliderpresentationarrowcontrols',$_POST['sliderpresentationarrowcontrols']);
	if ( isset($_POST['sliderpresentationdescription']) ) update_option('sliderpresentationdescription',$_POST['sliderpresentationdescription']);
	if ( isset($_POST['sliderpresentationhide']) ) update_option('sliderpresentationhide',$_POST['sliderpresentationhide']);
	if ( isset($_POST['sliderpresentationduration']) ) update_option('sliderpresentationduration',$_POST['sliderpresentationduration']);
	if ( isset($_POST['sliderpresentationinterval']) ) update_option('sliderpresentationinterval',$_POST['sliderpresentationinterval']);
	if ( isset($_POST['sliderfullwidtharrowcontrols']) ) update_option('sliderfullwidtharrowcontrols',$_POST['sliderfullwidtharrowcontrols']);
	if ( isset($_POST['sliderfullwidthgallery']) ) update_option('sliderfullwidthgallery',$_POST['sliderfullwidthgallery']);	
	if ( isset($_POST['sliderfullwidthtitles']) ) update_option('sliderfullwidthtitles',$_POST['sliderfullwidthtitles']);
	if ( isset($_POST['sliderfullwidthcontentbox']) ) update_option('sliderfullwidthcontentbox',$_POST['sliderfullwidthcontentbox']);	
	if ( isset($_POST['sliderfullwidthduration']) ) update_option('sliderfullwidthduration',$_POST['sliderfullwidthduration']);
	if ( isset($_POST['sliderfullwidthinterval']) ) update_option('sliderfullwidthinterval',$_POST['sliderfullwidthinterval']);
	if ( isset($_POST['slidergalleryrandom']) ) update_option('slidergalleryrandom',$_POST['slidergalleryrandom']);	
	if ( isset($_POST['slidergalleryarrowcontrols']) ) update_option('slidergalleryarrowcontrols',$_POST['slidergalleryarrowcontrols']);
	if ( isset($_POST['slidergallerydescription']) ) update_option('slidergallerydescription',$_POST['slidergallerydescription']);
	if ( isset($_POST['slidergalleryduration']) ) update_option('slidergalleryduration',$_POST['slidergalleryduration']);
	if ( isset($_POST['slidergalleryinterval']) ) update_option('slidergalleryinterval',$_POST['slidergalleryinterval']);	
	if ( isset($_POST['slidernivotransition']) ) update_option('slidernivotransition',$_POST['slidernivotransition']);
	if ( isset($_POST['slidernivoslices']) ) update_option('slidernivoslices',$_POST['slidernivoslices']);
	if ( isset($_POST['slidernivoboxcols']) ) update_option('slidernivoboxcols',$_POST['slidernivoboxcols']);
	if ( isset($_POST['slidernivoboxrows']) ) update_option('slidernivoboxrows',$_POST['slidernivoboxrows']);	
	if ( isset($_POST['slidernivoanimspeed']) ) update_option('slidernivoanimspeed',$_POST['slidernivoanimspeed']);
	if ( isset($_POST['slidernivopausetime']) ) update_option('slidernivopausetime',$_POST['slidernivopausetime']);
	if ( isset($_POST['slidernivodirectionnav']) ) update_option('slidernivodirectionnav',$_POST['slidernivodirectionnav']);
	if ( isset($_POST['slidernivocontrolnav']) ) update_option('slidernivocontrolnav',$_POST['slidernivocontrolnav']);	
	if ( isset($_POST['slidernivodirectionnavhide']) ) update_option('slidernivodirectionnavhide',$_POST['slidernivodirectionnavhide']);	
}

add_action('admin_menu', 'themeoptions_admin_menu');

?>