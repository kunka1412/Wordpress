<?php 
        		$sorted = array();
				$args   = array( 'hide_empty' => false );
				$taxarray = array ('insurance','personal_insurance');
				$terms  = get_terms( $taxarray, $args );
				//var_dump($terms); 
				if( $terms ) : 
				    foreach ( $terms as $term ) {
				        $sorted[]  = array(
				            'order' => get_field( 'start_date', $term ), // Get field from ACF
				            'name'  => $term->name,
				            'image' => get_field('icon_',$term),
				            'f_img' => get_field('image_hover', $term),
				            'link'  => $term->term_id
				        );		

				    }

				    function sortByOrder($a, $b) {
				        return $a['order'] - $b['order'];
				    }
				    usort($sorted, 'sortByOrder');
				    $i=0;
				    foreach( $sorted as $t ) :				    
						$i++;
                         echo '<div class="col-md-6 col-xs-6 contenthere">
                                <a class="nohover" href="">
                                  <img src="'.$t['image'].'">' . $t['name'] .'
                                </a>';
                         //echo '<div class="col-md-12 col-xs-12"><a href="' . esc_url( get_term_link( $term ) ) . '"><img class="fea_img" src="'.$f_img.'" alt=""/>' . $term->name .'</a></div>';
                          if($i%2 != 0){
                            echo '<a class="whenhover" href="' . esc_url( get_term_link( $t['link'] ) ) .'" style="background: #ffffff url(\''.$t['f_img'].'\') no-repeat scroll right top; position: absolute; top: 0px; float: right; height: 100% ! important; z-index: 1; right: -102% ! important; width: 202% ! important;"><span style="float: left; width: 50%; margin-top: 50px;">' . $t['name'] .'</span></a>
                              </div>';
                          }else{
                            echo '<a class="whenhover" href="' . esc_url( get_term_link( $t['link'] ) ) .'" style=" background: #ffffff url(\''.$t['f_img'].'\') no-repeat scroll left top; position: absolute; top: 0px; float: right; height: 100% ! important; z-index: 1; right: 0px ! important; width: 202% ! important;"><span style="width: 50%; float: right; margin-top: 50px;">' . $t['name'] .'</span></a>
                              </div>';
                          }
				      	
				    endforeach;
				endif;
         ?>