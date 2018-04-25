<?php /* Template Name: CustomPage home */ ?>
<div class="heading"><h1>Get started with similar Web Products</h1>
<?php

$args = array( 'post_type' => 'Products', 'posts_per_page' => 6 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();?>
<div class="productimage"><?php echo the_post_thumbnail();?></div>
<?php

endwhile;
do_action('show_beautiful_filters');
 ?>

 

