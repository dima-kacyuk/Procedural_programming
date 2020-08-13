<?php
/*
Template Name: admin
*/
?>
<?php get_header('admin'); ?>
	<main>
		<div class="content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<h4>Posted on <?php the_time('F jS, Y')?></h4>
				<p> <?php the_content(__('more...')); ?></p>
				<hr><?php endwhile;else: ?>
				<p><?php _e('Sorry, no posts'); ?></p> <?php endif; ?>
		</div>
		<?php get_sidebar('admin'); ?>
	</main>
	<div class="delimetr"></div>
	<?php get_footer('admin'); ?>