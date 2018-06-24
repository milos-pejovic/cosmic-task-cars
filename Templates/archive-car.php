<?php
/**
 * Template Name: Cars List
 */

$args = array(
	'post_type' => 'car',
	'numberposts' => -1
);
$cars = get_posts($args);

$locations = get_terms('location');
$prices = get_terms('price');
$colors = get_terms('color');

get_header(); 

?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if (count($cars)) : ?>
			<table>
				<tr>
					<th>Car</th>
					<th>Price</th>
					<th>Location</th>
					<th>Color</th>
					<th>Post date</th>
				</tr>
			<?php foreach ($cars as $car): ?>
			
			<?php
				if (isset($_POST['locations']) && !in_array(wp_get_post_terms($car->ID, 'location')[0]->slug, array_keys($_POST['locations']))){
					continue;
				} 
				
				if (isset($_POST['prices']) && !in_array(wp_get_post_terms($car->ID, 'price')[0]->slug, array_keys($_POST['prices']))){
					continue;
				} 
				
				if (isset($_POST['colors']) && !in_array(wp_get_post_terms($car->ID, 'color')[0]->slug, array_keys($_POST['colors']))){
					continue;
				} 
			?>
				<tr>
					<td><a href="<?php echo $car->guid ?>"><?php echo $car->post_title ?></a></td>
					<td><?php echo wp_get_post_terms($car->ID, 'price')[0]->name; ?></td>
					<td><?php echo wp_get_post_terms($car->ID, 'location')[0]->name; ?></td>
					<td><?php echo wp_get_post_terms($car->ID, 'color')[0]->name; ?></td>
					<td><?php echo $car->post_date ?></td>
				</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>
		
		<hr />
		
		<!-- Filters -->
		
		<form method="POST">
			<div class="locations">
				<h2>Locations</h2>
				<?php foreach ($locations as $location): ?>
					<label><input type="checkbox" name="locations[<?php echo $location->slug; ?>]" <?php echo ((isset($_POST['locations']) && in_array($location->slug, array_keys($_POST['locations']))) ? 'checked' : '') ?> /><?php echo $location->name; ?></label>
				<?php endforeach ?>
			</div>
			
			<div class="prices">
				<h2>Prices</h2>
				<?php foreach ($prices as $price): ?>
					<label><input type="checkbox" name="prices[<?php echo $price->slug; ?>]" <?php echo ((isset($_POST['prices']) && in_array($price->slug, array_keys($_POST['prices']))) ? 'checked' : '') ?> /><?php echo $price->name; ?></label>
				<?php endforeach ?>
			</div>
			
			<div class="colors">
				<h2>Colors</h2>
				<?php foreach ($colors as $color): ?>
					<label><input type="checkbox" name="colors[<?php echo $color->slug; ?>]" <?php echo ((isset($_POST['colors']) && in_array($color->slug, array_keys($_POST['colors']))) ? 'checked' : '') ?> /><?php echo $color->name; ?></label>
				<?php endforeach ?>
			</div>
		
			<input type="submit" value="Search" />
		</form>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();