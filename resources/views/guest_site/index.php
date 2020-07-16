<?php
global $post;
if ($post->post_name == "chicken-julfrezy-recipe") {
    header("Location:https://www.sooperchef.pk/chicken-jalfrezi-recipe/");
}/*
if ($post->ID == "1590" || $_REQUEST['p'] == '1590') {
header("Location:https://www.sooperchef.pk/chicken-jalfrezi-recipe/");
}*/
?>
<?php
get_header();
?>

<style>
.detail-social.detail-social-top {
  display:none;
}
.showRecipeToggle {
  display:none;
}
@media (max-width: 600px) {
    .blog2-inner {
        max-height: 100%;
        margin-bottom: 10px;
    }
    .blog2 .latest {
        margin-bottom: 0;
    }
.video {
  padding-bottom: 0;
  padding-top: 0;
}
.col.m2.s1.single-Lnav {
  display: none;
}
.p-0 {
  padding: 0px !important;
}
.detail-page {
  height: 400px;
  overflow: hidden;
  padding-bottom: 0px;
}
.detail-post-desc {
    display: none;
}
.detail-social.detail-social-top {
  background-color: #1a1a1a;
  display:block;
}
.detail-social.detail-social-top ul {
  text-align:center;
  padding:0px;
}
.detail-social.detail-social-top li {
  flex-grow: 1;
  float: left;
  margin: 0;
  padding: 0;
  width: 33.3%;
}
.detail-social.detail-social-top a {
  font-size: 16px;
  width:100%;
  border-radius:0px;
  display:block;
}
.detail-social.detail-social-top ul li i {
  padding-right: 0;
}
.video iframe {
  margin-bottom: 0;
}
.custom-pagination {
  margin-top: 20px;
  padding-bottom: 30px;
}
.showRecipeToggle, .hideRecipeToggle {
  border-bottom: 1px solid #ccc;
  color: #000;
  display: block;
  font-size: 17px;
  font-weight: bold;
  margin-bottom: 20px;
  margin-top: 15px;
  padding-bottom: 10px;
  text-align: center;
  cursor:pointer;
}
.inner-post-slider {
  display: none;
}
.latest h1 {
  font-size: 24px;
}
.latest {
  margin-bottom: 20px;
}
.content {
  padding-top: 0px;
}
}

</style>
<?php
    if(get_post_type() == 'blog'){
        get_template_part( 'template-parts/content', 'blog' );
    }else{
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div id="primary" class="">
        <main id="main" class="site-main" role="main">
            <div class="video">
                <div class="container">
                    <div class="row m-0">
                        <div class="col m8 l8 s12 p-0">
                            <div class="inner-video">
                                <?php
                                    $postIDToExclude = $post->ID;
                                    $video_url = get_post_meta($post->ID,'tm_video_url',true);
                                    $elements = explode("v=", $video_url);
                                ?>
                                <?php echo do_shortcode('[embedyt]'.$video_url.'[/embedyt]'); ?>
                            </div>
                        </div> <!-- ./column -8 -->
                        <!-- ./main body end -->
                    



                        <div class="col l4 m4 s12">
                            <div class="top-rated home-page-featured">
							     <div class="main-top">
    								<div class="latest blog-siebar">
    									<div class="<?php echo ALIGNMENT_NAVIGATION_CLASS; ?>">
    										<h3><?php echo FEATURED_RECIPIES_HOME_PAGE_HEADING; ?></h3>
    									</div>
    								</div>
    								<div class="featured-recipes">
    									<?php
        									$args = array(
            									'posts_per_page'   => 50,
            									'orderby'          => 'ID',
            									'order'            => 'DESC',
            									'post_type'        => 'post',
            									'post_status'      => 'publish',
            									'suppress_filters' => true,
            									'meta_query' => array( array('key' => 'post_specific_banner'))
        									);
        									$wp_query = new WP_Query($args);
        									while ( have_posts() ) : the_post();
        									$english_title = get_post_meta($post->ID, '_recipe_english_title', true);
    									?>
    									
    									<div class="row">
    										<div class="col l5 m5 s12 p-0">
    											<div class="top-image">
    												<!--                    <img src="--><?php //the_post_thumbnail_url(array(336, 312)); ?><!--" />-->
    												<?php if(ORIGINAL == "1") {?>
    												<img src="<?php the_post_thumbnail_url(array(336, 312)); ?>" alt="<?php echo the_title(); ?>" />
    												<?php } else { ?>
    												<img src="<?php the_post_thumbnail_url(array(336, 312)); ?>" alt="<?php echo $english_title = get_post_meta($post->ID, SINGLE_PAGE_MAIN_HEADING ,true); ?>" />
    												<?php } ?>
    											</div>
    										</div>
    										<div class="col l7 m7 s12 p-0">
    											<div class="top-image">
    												<div class="top-desc <?php echo ALIGNMENT_NAVIGATION_CLASS; ?>">
    													<?php if(ORIGINAL == "0") {?>
    													<span><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo $english_title; ?>">
    														<?php echo $english_title = get_post_meta($post->ID, '_recipe_english_title', true); ?>
    													</a></span>
    													<?php } else {?>
    													<span><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
    														<?php echo the_title(); ?>
    													</a></span>
    													<?php } ?>
    												</div>
    											</div>
    										</div>
    									</div>
    									
    									<?php
    									
    									endwhile;
    									wp_reset_query();
    									?>
    								</div> <!-- ./featured recipes block -->
    							</div> <!-- ./main top -->
    						</div> <!-- ./Top related -->
						
    						<!-- ./Addsens block signal post -->
    						<div class="row mt-1">
                                <div class="col m12 s12">
                                    <?php if (stristr(get_bloginfo('url'),'sooperchef.pk'))	{ ?>
                                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                        <!-- SC - 3 Res Horizental -->
                                        <ins class="adsbygoogle home-page-adsense"
                                             style="display:block"
                                             data-ad-client="ca-pub-6818780433151013"
                                             data-ad-slot="2294034581"
                                             data-ad-format="auto"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script>
                                    <?php }	?>
                                </div>
                            </div> <!-- ./Addsens block signal post -->		
    					</div> <!-- ./column 4 featured -->

                    </div> <!-- ./row -->
                </div> <!-- ./container -->
            </div> <!-- ./video block -->

            <div class="inner-post-slider" style="display:none;">

                <div class="categories-slider-loader">
                    <div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-green-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div><div class="gap-patch">
                                <div class="circle"></div>
                            </div><div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div id="owl-demo3" class="owl-carousel owl-theme" style="display: none;">
                    <?php
                        $args = array(
                                'posts_per_page'   => '10',
                            
                                'orderby'          => 'post_date',
                            
                                'order'            => 'post_date',
                            
                                'post_type'        => 'post',
                            
                                'post_status'      => 'publish',
                            
                                'suppress_filters' => true,
                        );
                        $wp_query = new WP_Query($args);

                        while ( have_posts() ) : the_post();
                            $english_title = get_post_meta($post->ID, ENGLISH_POST_TITLE, true);
                    ?>
                        <div class="item"> 
                            <a href="<?php the_permalink() ?>">
                                  <?php if(ORIGINAL == "1") {?>
                                        <img src="<?php the_post_thumbnail_url(array(250, 252)); ?>" alt="<?php echo the_title(); ?>" />
                                  <?php } else { ?>
                                      <img src="<?php the_post_thumbnail_url(array(250, 252)); ?>" alt="<?php echo $english_title; ?>" />
                                  <?php } ?>
                                <div class="slider-title">
                                  <?php if(ORIGINAL == "1") {?>
                                  <h2 class="<?php echo ALIGNMENT_NAVIGATION_CLASS; ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"> <?php echo the_title(); ?> </a></h2>
                                  <?php } else {
                    
                                  ?>
                                  <h2 class="<?php echo ALIGNMENT_NAVIGATION_CLASS; ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo $english_title; ?>"> <?php echo $english_title; ?> </a></h2>
                                  <?php } ?>
                                </div>
                            </a> 
                        </div>
                    <?php endwhile; ?>
                </div>
            </div> <!-- ./Post slider -->

            <?php
                wp_reset_query();
                global $post;
                // Fetch Research Content
                $Research_content_full = get_post_meta($post->ID,'_recipe_research_contents', true);
                //$Research_content_full = $Research_content=$researchContent[0];
            ?>
            <div class="content">
                <div class="container">
                    <div class="row">                
                        <div class="col l8 m8 s12">
                            <div class="right-content">
                                <div class="latest">
                                    <?php if(ORIGINAL == "1") {?>
                                    <div class="latest-urdu"> 
                                        <strong>
                                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"> 
                                                <?php echo the_title(); ?> 
                                            </a>
                                        </strong>
                                    </div>
                                    <?php } else { ?>
                                    <div class="latest-eng">
                                        <h1 itemprop="headline" class="entry-title">
                                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                <?php echo $english_title = get_post_meta($post->ID, SINGLE_PAGE_MAIN_HEADING ,true); ?>
                                            </a>
                                        </h1>
                                    </div>
                                    <?php } ?>
                                </div> <!-- ./latest post Title -->
                                <?php if(CURRENT_LANGUAGE == "en") { ?>
                                    <div class="resarch-content" style=" clear:both;"></div>
                                <?php } else { ?>
                                    <div style=" display:none; clear:both;" class="resarch-content"></div>
                                <?php } if($Research_content_full != "") { ?>
                                <div class="research-content-half">
                                    <?php
                                        $abc =strlen($Research_content_full);
                                        if ($abc > 150){
                                            if($pos == "" || $pos == 0) {
                                                $Research_content = substr($Research_content_full, 0, 370);
                                            } else {
                                                $Research_content = substr($Research_content_full, 0, $pos);
                                            }
                                            echo $Research_content. " ...";
                                        } else {
                                          echo $Research_content_full. " ...";
                                        }
                                    ?>
                                </div>
                            
                                <span style=" cursor: pointer; " id="research-half-content">Read More</span>
                            
                                <div id="reaseach-content-complete" class="hiddendiv">
                                    <?php echo $Research_content_full; ?>
                                    <br>
                                    <span style=" cursor: pointer;" id="research-full-content">Less Content</span>
                                </div>
                                <?php } ?>
                                <div class="detail-post-method" style=" clear:both; position:relative;">
                                    <div class="top-rated">
                                        <div class="row m-0">
                                            <div class="col s12">
                                                <ul class="tabs">
                                                    <li class="tab col m2 s6"><a href="#test1">English Recipe</a></li>
                                                    <?php
                                                        $chineese_incredients = get_post_meta($post->ID,'_recipe_chinese_contents',true);
                                                        $chineese_incredients = trim($chineese_incredients);
                                            
                                                        if ( isset($chineese_incredients) && strlen($chineese_incredients) > 0 ) {
                                                    ?>
                                                    <li class="tab col m2 s6"><a href="#chineese">中国食谱</a></li>
                                                    <?php } ?>

                                                    <?php if(CURRENT_LANGUAGE != "en") {?>
                                                    <li class="tab col m2 s6 urdu-text"><a class="active" href="#test2"><?php echo METHOD_TXT; ?></a></li>
                                      	            <?php } else { ?>
                                                    <li class="tab col m2 s6 urdu-text"><a href="#test2"><?php echo METHOD_TXT;?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                                <?php
                                                    $english_recipe_download_link = get_post_meta($post->ID,'english_recipe_download_link',true);
                                                    $urdu_recipe_download_link = get_post_meta($post->ID,'urdu_recipe_download_link',true);
                                                    while ( have_posts() ) : the_post();
                                                ?>
                                            <div id="test1" class="col s12 main-top">
                                                <div class="inner-post-detail">
                                                    <div class="row m-0">
                                                        <div class="col l8 m7 s12">
                                                            <?php $eng_incredients = get_post_meta($post->ID, '_recipe_english_contents', true);
                                                                $eng_inc_text = explode('<br />', $eng_incredients);
                                                                $eng_inc_text_break = explode('<br>', $eng_incredients);
                                                                $eng_inc_textpara = explode('<p>-', $eng_incredients);
                                                                if(count($eng_inc_text)> 1 ){
                                                                    $incHeader = '';
                                                                    $inc = '<ul>';
                                                                    foreach ($eng_inc_text as $ul_li) {

                                                                        if( strpos( $ul_li, '<h3>' ) !== false ) {
                                                                            $incHeader = $ul_li;
                                                                        } else {
                                                                            $inc .= '<li>' . $ul_li . '</li>';
                                                                        }
                                                                    };
                                                                    $inc .= '</ul>';
                                                                    echo $incHeader . $inc;
                                                                } elseif(count($eng_inc_text_break)> 1 ){
                                                                    $inc = '<ul>';
                                                                    foreach ($eng_inc_text_break as $ul_li) {
                                                                        $inc .= '<li>' . $ul_li . '</li>';
                                                                    };
                                                                    $inc .= '</ul>';
                                                                    echo   $inc;
                                                                } elseif(count($eng_inc_textpara)> 1 ){
                                                                    $inc = '<ul>';
                                                                    foreach ($eng_inc_textpara as $ul_li) {
                                                                        $inc .= '<li>' . $ul_li . '</li>';
                                                                    };
                                                                    $inc .= '</ul>';
                                                                    echo   $inc;
                                                                } else {
                                                                    echo $eng_incredients;
                                                                };
                                                            ?>
                                                        </div>
                            
                                                        <div class="col l4 m5 s12 hide-on-small-only">
                                                            <?php
                                                                $eng_nutritional  = get_post_meta($post->ID, '_recipe_english_nutrition', true);
                                                                $eng_nutritional = trim($eng_nutritional);
                                        
                                                                if ( isset($eng_nutritional) && strlen($eng_nutritional) > 0 ) {
                                                                    echo '<div class="recipe-nutrition-inner">';
                                                                    echo '<h3 class="recipe-nutrition-heading">Nutritional Info</h3>';
                                                                    echo '<span>'.$eng_nutritional.'</span>';
                                                                    echo '</div>';
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        $english_method = get_post_meta( $post->ID, '_recipe_english_method', true );
                                                        $eng_method_text = explode('<br />', $english_method);
                                                        if(count($eng_method_text)> 1 ){
                                                            $Preparation_method = '';
                                                            $method = '<ul>';
                                                            foreach ($eng_method_text as $ul_li) {
                                                                if( strpos( $ul_li, 'Time' ) !== false ) {
                                                                    $Preparation_method = $ul_li;
                                                                } else {
                                                                    $method .= '<li>' . $ul_li . '</li>';
                                                                }
                                                            }
                                                            $method .= '</ul>';
                                                            echo   $method . $Preparation_method;
                                                        } else {
                                                            echo $english_method;
                                                        };
                                                        echo $english_tips = get_post_meta( $post->ID, '_recipe_english_tips', true );
                                                    ?>
                                                    <div class="show-on-small hide-on-med-and-up">
                                                        <?php
                                                            $eng_nutritional  = get_post_meta($post->ID, '_recipe_english_nutrition', true);
                                                            $eng_nutritional = trim($eng_nutritional);

                                                            if ( isset($eng_nutritional) && strlen($eng_nutritional) > 0 ) {
                                                                echo '<div class="recipe-nutrition-inner mobile-check">';
                                                                echo '<h3 class="recipe-nutrition-heading">Nutritional Info</h3>';
                                                                echo '<span>'.$eng_nutritional.'</span>';
                                                                echo '</div>';
                                                            }
                                                        ?>
                                                    </div>
                                                    <?php
                                                        $english_Preparation_time = get_post_meta($post->ID,'english_preparation_time',true);
                                                        $english_Preparation_time = trim($english_Preparation_time);

                                                        if ( isset($english_Preparation_time) && strlen($english_Preparation_time) > 0 ) {
                                                            echo '<div class="serve-widget">';
                                                            echo '<h3 class="serve-person-detail">Preparation Time: </h3>';
                                                            echo '<span>'.$english_Preparation_time.'</span>';
                                                            echo '</div>';
                                                        }

                                                        $english_cooking_time = get_post_meta($post->ID,'english_cooking_time',true);
                                                        $english_cooking_time = trim($english_cooking_time);

                                                        if ( isset($english_cooking_time) && strlen($english_cooking_time) > 0 ) {
                                                            echo '<div class="serve-widget">';
                                                            echo '<h3 class="serve-person-detail">Cooking Time: </h3>';
                                                            echo '<span>'.$english_cooking_time.'</span>';
                                                            echo '</div>';
                                                        }

                                                        $english_serve_person = get_post_meta($post->ID,'english_serve_person',true);
                                                        $english_serve_person = trim($english_serve_person);

                                                        if ( isset($english_serve_person) && strlen($english_serve_person) > 0 ) {
                                                            echo '<div class="serve-widget">';
                                                            echo '<h3 class="serve-person-detail">Serve: </h3>';
                                                            echo '<span>'.$english_serve_person.'</span>';
                                                            echo '</div>';
                                                        }

                                                        $english_difficulty_level = get_post_meta($post->ID,'eng_difficulty_level',true);
                                                        $english_difficulty_level = trim($english_difficulty_level);

                                                        if ( isset($english_difficulty_level) && strlen($english_difficulty_level) > 0 ) {
                                                            echo '<div class="serve-widget">';
                                                            echo '<h3 class="serve-person-detail">Difficulty Level: </h3>';
                                                            echo '<span>'.$english_difficulty_level.'</span>';
                                                            echo '</div>';
                                                        }
                                                    ?>
                                                    <div class="correction-video">
                                                          <?php
                                                            $english_correction_note = get_post_meta($post->ID,'english_video_correction_note',true);
                                                            $english_correction_note = trim($english_correction_note);

                                                              if ( isset($english_correction_note) && strlen($english_correction_note) > 0 ) {
                                                                  echo '<div class="note-correction">';
                                                                  echo '<h3 class="note-heading"><i class="fa fa-info-circle" aria-hidden="true"></i></h3>';
                                                                  echo '<span>'.$english_correction_note.'</span>';
                                                                  echo '</div>';
                                                              }
                                                          ?>
                                                    </div>
                                                    <?php
                                                        $visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
                                                        if( $visitor_count == '' ){ $visitor_count = 0; }
                                                         /*if( $visitor_count >= 999 ){
                                                             $visitor_count = 999;
                                                         }*/
                                                        esc_attr($visitor_count);
                                                        //echo 'Total Views: '.esc_attr($visitor_count);
                                                    ?>
                                                </div>

                                                <div class="row m-0">
                                                    <?php if (isset($english_recipe_download_link) && strlen($english_recipe_download_link) > 0) {?>
                                                        <div class="col m6 s6">
                                                            <div class="dowload-button-english"> 
                                                                <a href="<?php echo $english_recipe_download_link ; ?>" download>Recipe Download</a> 
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <div class="col m6 s6">
                                                        <?php
                                                            if(user_agent() == 'ios'){ 
                                                        ?>
                                                                <div class="dowload-button-english mobile-ios-app-english">
                                                                    <a href="https://itunes.apple.com/us/app/sooperchef/id1175017166?mt=8" target="_blank">
                                                                        <img src="<?php bloginfo('template_directory'); ?>/images/appdownload.png">
                                                                    </a>
                                                                </div>
                                                            <?php }
                                                                elseif(user_agent() == 'android'){
                                                            ?>
                                                              <div class="dowload-button-english mobile-ios-app-english">
                                                                    <a href="https://play.google.com/store/apps/details?id=com.vb.mcpk" target="_blank">
                                                                        <img src="<?php bloginfo('template_directory'); ?>/images/andrioddownload.png">
                                                                    </a>
                                                              </div>
                                                          <?php } elseif (user_agent() == 'pc'){ ?><?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            $chineese_incredients = get_post_meta($post->ID, '_recipe_chinese_contents', true);
                                            $chineese_incredients = trim($chineese_incredients);
                                            if ( isset($chineese_incredients) && strlen($chineese_incredients) > 0 ) { ?>
                                                <div id="chineese" class="col s12 main-top">
                                                    <div class="inner-post-detail">
                                                        <?php
                                                        echo $chineese_incredients = get_post_meta($post->ID, '_recipe_chinese_contents', true);
                                                        echo $chineese_method = get_post_meta( $post->ID, '_recipe_chinese_method', true );
                                                        $chineese_Preparation_time = get_post_meta($post->ID,'chinese_preparation_time',true);
                                                        $chineese_Preparation_time = trim($chineese_Preparation_time);

                                                        if ( isset($chineese_Preparation_time) && strlen($chineese_Preparation_time) > 0 ) {
                                                            echo '<div class="serve-widget">';
                                                            echo '<h3 class="serve-person-detail">准备时间: </h3>';
                                                            echo '<span>'.$chineese_Preparation_time.'</span>';
                                                            echo '</div>';
                                                        }

                                                        $chineese_cooking_time = get_post_meta($post->ID,'chinese_cooking_time',true);
                                                        $chineese_cooking_time = trim($chineese_cooking_time);

                                                        if ( isset($chineese_cooking_time) && strlen($chineese_cooking_time) > 0 ) {
                                                            echo '<div class="serve-widget">';
                                                            echo '<h3 class="serve-person-detail">烹饪时间: </h3>';
                                                            echo '<span>'.$chineese_cooking_time.'</span>';
                                                            echo '</div>';
                                                        }

                                                        $chineese_serve_person = get_post_meta($post->ID,'chinese_serve_person',true);
                                                        $chineese_serve_person = trim($chineese_serve_person);

                                                        if ( isset($chineese_serve_person) && strlen($chineese_serve_person) > 0 ) {
                                                            echo '<div class="serve-widget">';
                                                            echo '<h3 class="serve-person-detail">服务器: </h3>';
                                                            echo '<span>'.$chineese_serve_person.'</span>';
                                                            echo '</div>';
                                                        }

                                                        $chineese_difficulty_level = get_post_meta($post->ID,'chinese_difficulty_level',true);
                                                        $chineese_difficulty_level = trim($chineese_difficulty_level);

                                                        if ( isset($chineese_difficulty_level) && strlen($chineese_difficulty_level) > 0 ) {
                                                            echo '<div class="serve-widget">';
                                                            echo '<h3 class="serve-person-detail">难度级别: </h3>';
                                                            echo '<span>'.$chineese_difficulty_level.'</span>';
                                                            echo '</div>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                        <?php } ?>

                                        <div id="test2" class="col s12 main-top">
                                            <div class="inner-post-detail align-right">
                                                <div class="row m-0">
                                                    <div class="col l4 m5 s12 hide-on-small-only">
                                                        <?php
                                                            $urdu_nutritional  = get_post_meta($post->ID, '_recipe_urdu_nutrition', true);
                                                            $urdu_nutritional = trim($urdu_nutritional);

                                                            if ( isset($urdu_nutritional) && strlen($urdu_nutritional) > 0 ) {
                                                                echo '<div class="recipe-nutrition-inner">';
                                                                echo '<h3 class="recipe-nutrition-heading">غذائیت کی معلومات</h3>';
                                                                echo '<span>'.$urdu_nutritional.'</span>';
                                                                echo '</div>';
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="col l8 m7 s12">
                                                        <?php the_content(); ?>
                                                    </div>
                                                </div>
                                                <?php
                                                    echo $Urdu_method = get_post_meta($post->ID, '_recipe_urdu_method', true);
                                                    echo $urdu_tips = get_post_meta( $post->ID, '_recipe_urdu_tips', true );
                                                ?>
                                                <div class="show-on-small hide-on-med-and-up">
                                                    <?php
                                                        $urdu_nutritional  = get_post_meta($post->ID, '_recipe_urdu_nutrition', true);
                                                        $urdu_nutritional = trim($urdu_nutritional);

                                                        if ( isset($urdu_nutritional) && strlen($urdu_nutritional) > 0 ) {
                                                            echo '<div class="recipe-nutrition-inner mobile-check">';
                                                            echo '<h3 class="recipe-nutrition-heading">غذائیت کی معلومات</h3>';
                                                            echo '<span>'.$urdu_nutritional.'</span>';
                                                            echo '</div>';
                                                        }
                                                    ?>
                                                </div>

                                                <?php
                                                    $urdu_preparation_time = get_post_meta($post->ID,'urdu_preparation_time',true);
                                                    $urdu_preparation_time = trim($urdu_preparation_time);

                                                    if ( isset($urdu_preparation_time) && strlen($urdu_preparation_time) > 0 ) {
                                                        echo '<div class="urdu-serve-widget">';
                                                        echo '<h3 class="urdu-serve-person-detail">تیاری کا وقت : </h3>';
                                                        echo '<span>'.$urdu_preparation_time.'</span>';
                                                        echo '</div>';
                                                    }

                                                    $urdu_cooking_time = get_post_meta($post->ID,'urdu_cooking_time',true);
                                                    $urdu_cooking_time = trim($urdu_cooking_time);

                                                    if ( isset($urdu_cooking_time) && strlen($urdu_cooking_time) > 0 ) {
                                                        echo '<div class="urdu-serve-widget">';
                                                        echo '<h3 class="urdu-serve-person-detail">پکانے کا وقت : </h3>';
                                                        echo '<span>'.$urdu_cooking_time.'</span>';
                                                        echo '</div>';
                                                    }

                                                    $urdu_serve_person = get_post_meta($post->ID,'urdu_serve_person',true);
                                                    $urdu_serve_person = trim($urdu_serve_person);

                                                    if ( isset($urdu_serve_person) && strlen($urdu_serve_person) > 0 ) {
                                                        echo '<div class="urdu-serve-widget">';
                                                        echo '<h3 class="urdu-serve-person-detail">افراد : </h3>';
                                                        echo '<span>'.$urdu_serve_person.'</span>';
                                                        echo '</div>';
                                                    }

                                                    $urdu_difficulty_level = get_post_meta($post->ID,'urdu_difficulty_level',true);
                                                    $urdu_difficulty_level = trim($urdu_difficulty_level);

                                                    if ( isset($urdu_difficulty_level) && strlen($urdu_difficulty_level) > 0 ) {
                                                        echo '<div class="urdu-serve-widget">';
                                                        echo '<h3 class="urdu-serve-person-detail">مشکل سطح : </h3>';
                                                        echo '<span>'.$urdu_difficulty_level.'</span>';
                                                        echo '</div>';
                                                    }
                                                ?>
                                                <div class="correction-video urdu">
                                                    <?php
                                                        $urdu_correction_note = get_post_meta($post->ID,'urdu_video_correction_note',true);
                                                        $urdu_correction_note = trim($urdu_correction_note);

                                                        if ( isset($urdu_correction_note) && strlen($urdu_correction_note) > 0 ) {
                                                            echo '<div class="note-correction">';
                                                            echo '<h3 class="note-heading urdu"><i class="fa fa-info-circle" aria-hidden="true"></i></h3>';
                                                            echo '<span>'.$urdu_correction_note.'</span>';
                                                            echo '</div>';
                                                        }
                                                    ?>
                                                </div>

                                                <div class="row m-0">
                                                    <div class="col m6 s6">
                                                        <?php
                                                            if(user_agent() == 'ios'){ ?>
                                                                <div class="dowload-button-english mobile-ios-app-urdu">
                                                                    <a href="https://itunes.apple.com/us/app/sooperchef/id1175017166?mt=8" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/appdownload.png"></a>
                                                                </div>
                                                        <?php } elseif(user_agent() == 'android'){ ?>
                                                                <div class="dowload-button-english mobile-ios-app-urdu">
                                                                    <a href="https://play.google.com/store/apps/details?id=com.vb.mcpk" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/andrioddownload.png"></a>
                                                                </div>
                                                        <?php } elseif(user_agent() == 'pc'){ ?> <?php } ?>
                                                    </div>
                                                    <?php if(isset($urdu_recipe_download_link) && strlen($urdu_recipe_download_link)){ ?>
                                                        <div class="col m6 s6">
                                                            <div class="dowload-button-urdu"> <a href="<?php echo $urdu_recipe_download_link ; ?>" download> ریسیپی ڈاون لوڈ</a> 
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </div>
                                    
                            <div class="custom_like_post <?php echo ALIGNMENT_NAVIGATION_CLASS; ?>">
                                <?php
                                    //echo CustomLikePost();
                                ?>
                            </div>
                            <?php  
                                $sponser_banner = get_post_meta($post->ID,'post_specific_banner',true);
                    	       if(!empty($sponser_banner)){
                            ?>
                                <div class="sponser-banner">
                                	<img src="<?php echo $sponser_banner; ?>" />
                                </div>
                            <?php } ?>
                            <section class="blog2">
                                <div class="latest <?php echo ALIGNMENT_NAVIGATION_CLASS; ?>">
                                    <div class="">
                                        <div class="related">
                                            <div class="otherrec_title"><?php echo TRENDING_RECIPIES_SINGLE_PAGE_HEADING; ?></div>
                                            <ul class="related_ula">
                                                <?php
                                                    $cat_id = get_the_category() ;
                                                    $data = array();
                                                    $variable=0;
                                                    foreach($cat_id as $key => $value){
                                                    $this_cat_ID = $cat_id[$variable]->cat_name;
                                                    $term_meta = get_option('taxonomy_'.get_the_category( $post->ID )[$key]->cat_ID);
                                                    $categoryName = $term_meta[custom_term_meta];
                                                    ?>
                                                  <li><?php echo $categoryName; ?></li>
                                                <?php
                                                    $variable++;
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="latest-urdu">
                                        <div class="related">
                                            <ul class="related_ula">
                                                <?php
                                                    $cat_id = get_the_category() ;
                                                    $variable=0;
                                                    foreach($cat_id as $key => $value){
                                                    	$this_cat_ID = $cat_id[$variable]->cat_name;
                                                    ?>
                                                    <li><?php echo $cat_id[$variable]->cat_name; ?></li>
                                                <?php
                                                    $variable++;
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="blog2-inner">
                                    <div class="row m-0">
                                        <?php
                                            $cat_id = get_the_category() ;
                                            $this_cat_ID = $cat_id[0]->cat_ID;
                                            $args = array(
                                                'posts_per_page'   => 8,
                                                    'meta_key'     => '_post_views_count',
                                                    'meta_value'   => '10',
                                                    'meta_compare' => '>=',
                                                'offset'           => 0,
                                                    'orderby'    => 'meta_value_num',
                                                'order'            => 'DESC',
                                                'post_type'        => 'post',
                                                'post_status'      => 'publish',
                                                'suppress_filters' => true,
                                                'cat'         => $this_cat_ID
                                            );

                                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                            $wp_query = new WP_Query($args);
                                            while ( have_posts() ) : the_post();
                                        ?>
                                            <div class="col l3 m4 s6">
                                                <div class="blog2-post">
                                                    <a href="<?php the_permalink() ?>" class="category-link-image">
                                                        <?php if(ORIGINAL == "1") {?>
                                                            <img src="<?php the_post_thumbnail_url(array(250, 252)); ?>" alt="<?php echo the_title(); ?>" />
                                                        <?php } else { ?>
                                                            <img src="<?php the_post_thumbnail_url(array(250, 252)); ?>" alt="<?php echo $english_title = get_post_meta($post->ID, SINGLE_PAGE_MAIN_HEADING ,true); ?>" />
                                                        <?php } ?>
                                                    </a>
                                                    <?php if(ORIGINAL == "1") {?>
                                                    <strong><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"> <?php echo the_title(); ?> </a></strong>
                                                    <?php } else  { ?>
                                                    <strong class="roboto"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo $english_title = get_post_meta($post->ID, SINGLE_PAGE_MAIN_HEADING ,true); ?>"> <?php echo $english_title = get_post_meta($post->ID, SINGLE_PAGE_MAIN_HEADING ,true); ?> </a></strong>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php endwhile;
                                                wp_reset_query(); ?>
                                    </div>
                                </div>
                            </section>

                            <section class="blog2">
                                <div class="latest <?php echo ALIGNMENT_NAVIGATION_CLASS; ?>">
                                    <div class="">
                                        <div class="related">
                                            <div class="otherrec_title"><?php echo get_post_type($post->ID); ?><?php echo OTHER_RECIPIES_SINGLE_PAGE_HEADING; ?></div>
                                            <ul class="related_ula">
                                                <?php
                                                $cat_id = get_the_category() ;
                                                $data = array();
                                                $variable=0;
                                                foreach($cat_id as $key => $value){
                                                    $this_cat_ID = $cat_id[$variable]->cat_name;
                                                    $term_meta = get_option('taxonomy_'.get_the_category( $post->ID )[$key]->cat_ID);
                                                    $categoryName = $term_meta[custom_term_meta];
                                                    ?>
                                                    <li><?php echo $categoryName; ?></li>
                                                    <?php
                                                    $variable++;
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="latest-urdu">
                                        <div class="related">
                                            <ul class="related_ula">
                                                <?php
                                                $cat_id = get_the_category() ;
                                                $variable=0;
                                                foreach($cat_id as $key => $value){
                                                    $this_cat_ID = $cat_id[$variable]->cat_name;
                                                    ?>
                                                    <li><?php echo $cat_id[$variable]->cat_name; ?></li>
                                                    <?php
                                                    $variable++;
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="blog2-inner">
                                    <div class="row m-0">
                                        <?php
                                        $cat_id = get_the_category() ;
                                        $this_cat_ID = $cat_id[0]->cat_ID;
                                        $args = array(
                                            'posts_per_page'   => 8,
                                            'offset'           => 0,
                                            'category'         => '',
                                            'category_name'    => '',
                                            'orderby'          => 'title',
                                            'order'            => 'DESC',
                                            'include'          => '',
                                            'exclude'          => '',
                                            'meta_key'         => '',
                                            'meta_value'       => '',
                                            'post_type'        => 'post',
                                            'post_mime_type'   => '',
                                            'post_parent'      => '',
                                            'author'    => '',
                                            'author_name'    => '',
                                            'post_status'      => 'publish',
                                            'suppress_filters' => true,
                                            'cat'         => $this_cat_ID
                                        );

                                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                        $wp_query = new WP_Query($args);
                                        while ( have_posts() ) : the_post();
                                            ?>
                                            <div class="col l3 m4 s6">
                                                <div class="blog2-post">
                                                    <a href="<?php the_permalink() ?>" class="category-link-image">
                                                        <?php if(ORIGINAL == "1") {?>
                                                            <img src="<?php the_post_thumbnail_url(array(250, 252)); ?>" alt="<?php echo the_title(); ?>" />
                                                        <?php } else { ?>
                                                            <img src="<?php the_post_thumbnail_url(array(250, 252)); ?>" alt="<?php echo $english_title = get_post_meta($post->ID, SINGLE_PAGE_MAIN_HEADING ,true); ?>" />
                                                        <?php } ?>
                                                    </a>
                                                    <?php if(ORIGINAL == "1") {?>
                                                        <strong><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"> <?php echo the_title(); ?> </a></strong>
                                                    <?php } else  { ?>
                                                        <strong class="roboto"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo $english_title = get_post_meta($post->ID, SINGLE_PAGE_MAIN_HEADING ,true); ?>"> <?php echo $english_title = get_post_meta($post->ID, SINGLE_PAGE_MAIN_HEADING ,true); ?> </a></strong>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php endwhile;
                                        wp_reset_query(); ?>
                                    </div>
                                </div>
                            </section>

                            <div class="custom-comments">
                              <?php comments_template(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- .site-main -->
</div>

  <!-- .content-area -->

</article>
    
<?php }
function ft($timeD) {
    $timeD = strtolower($timeD);
    if (strpos($timeD, '-') !== false) {
        $array = explode("-",$timeD);
        $timeD = $array[1];
    }
    $timeD = str_replace('minutes','M',$timeD);
    $timeD = str_replace('hours','H',$timeD);
    $timeD = str_replace(' ','',$timeD);
    return trim($timeD);
}
?>
<?php if(get_post_type($post->ID) == 'blog'){ ?>
    <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php echo get_page_link(); ?>"
  },
  "headline": "<?php echo the_title(); ?>",
  "image": [
    "<?php echo the_post_thumbnail_url(array(250, 252)); ?>"
   ],
  "author": {
    "@type": "Person",
    "name": "SooperChef"
  },
   "publisher": {
    "@type": "Organization",
    "name": "Sooperchef.pk",
    "logo": {
      "@type": "ImageObject",
      "url": "https://www.sooperchef.pk/wp-content/uploads/2017/11/sooperchef_logo.png"
    }
  }
}
</script>
<?php } ?>
<?php if(get_post_type($post->ID) == 'post'){ ?>
<script type="application/ld+json">
     {
      "@context": "http://schema.org/",
      "@type": "Recipe",
      "name": "<?php $strTite = get_post_meta($post->ID, ENGLISH_POST_TITLE, true); if (trim($strTite)==''){ echo the_title(); } else { echo $strTite; }  ?>",
      "image": [
        "<?php echo the_post_thumbnail_url(array(250, 252)); ?>"
      ],
      "author": {
        "@type": "Organization",
        "url": "https://www.sooperchef.pk",
        "name": "SooperChef (PVT) Limited"
      },
     "prepTime": "<?php echo 'PT'.ft(get_post_meta($post->ID,'english_preparation_time',true)); ?>",
     "CookTime": "<?php echo 'PT'.ft(get_post_meta($post->ID,'english_cooking_time',true)); ?>",
     "recipeYield": "<?php echo get_post_meta($post->ID,'english_serve_person',true); ?>",

      "recipeIngredient": [
        <?php
    $incredients_STdata = get_post_meta( $post->ID, '_recipe_english_contents', true );
    $incredients_STdata = explode('<br />', $incredients_STdata);
    echo json_encode($incredients_STdata, JSON_PRETTY_PRINT);
//   $incredients_STdata = stristr($incredients_STdata, '</p>');
//  $incredients_STdata = str_replace('</p>', '', $incredients_STdata);
//   $incredients_STdata = str_replace('<ul>', '', $incredients_STdata);
//   $incredients_STdata = str_replace('</ul>', '', $incredients_STdata);
//   $incredients_STdata = str_replace('</li>', '', $incredients_STdata);
//   $incredients_STdata = str_replace('<br />', ',', $incredients_STdata);
//    $incredients_STdata = preg_replace("/[^a-zA-Z 0-9]+/", ",", $incredients_STdata );;
//    $incredients_STdata = str_replace('li', '', $incredients_STdata);
//
//    $incredients_STdata = explode(',', $incredients_STdata);
//
//    $arr = $incredients_STdata;
//    $arr1 = array();
//     foreach($incredients_STdata as $key => $val) {
//         $val = trim($val);
//       if(strlen($val) > 1) {
//             array_push($arr1, $val );
//        }
//     }
//
//        echo json_encode($arr1, JSON_PRETTY_PRINT);
    ?>



       ],
     "recipeInstructions": "<?php echo strip_tags(get_post_meta( $post->ID, '_recipe_english_method', true )); ?>"
     }
   </script>
<?php } ?>
<script>
    function formatTime(timeD) {
        var timeD = strtolower(timeD);
        var formattedTime = timeD.replace("hours",":").replace("hour",":").replace("minutes",":").replace("minute",":");
        return formattedTime;
    }
</script>

<!-- #post-## -->

<?php get_footer(); ?>
