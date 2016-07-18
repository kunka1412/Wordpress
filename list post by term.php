<?php 
               $terms= get_terms( 'personal_insurance', 'orderby=count&hide_empty=0' );
                    $count=0;
                       foreach ( $terms as $term ) {
                        $image = get_field('feature_image', $term);
                         $args = array(
                            'post_type' => 'corporate insurance',
                            'personal_insurance' => $term->slug,
                            'parent' => $term->term_id,
                            'post_parent' => 0,
                            'child_of'     => 0,                       
                        );?>                       
                      <div class="col col-md_4 no-padding">
                      <?php
                       echo'<img src="'.$image.'">
                       <div class="icon"><a class="bg-blue" href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name .'</a><span></span>';
                        $query = new WP_Query( $args );
                        echo '<ul class="menu-acc">';
                        while ( $query->have_posts() ) : $query->the_post(); ?> 
                          <li class="animal-listing" id="post-<?php the_ID(); ?>">
                              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                          
                              <?php
                              $args = array(
                                  'post_type'      => 'corporate insurance',
                                  'posts_per_page' => -1,
                                  'post_parent'    => $post->ID,
                                  'order'          => 'ASC',
                                  //'orderby'        => 'menu_order'
                               );
                          
                              $parent = new WP_Query( $args );

                              if ( $parent->have_posts() ) : ?>
                                  <ul class="sub">
                                  <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
                                          <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                                  <?php endwhile; ?>
                                  </ul>
                              <?php endif; wp_reset_query(); ?>                        
                        <?php endwhile;
                        echo'</li></ul>';
                        echo '</div></div>';
                        $counts= $count++;
                        if ($counts == 2) {
                          echo '</div>';
                          echo '<div class="row2">';
                        }

                       }
              ?> 