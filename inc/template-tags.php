<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bryhub-simple
 */

if (!function_exists('bryhub_simple_posted_on')) :
	function bryhub_simple_posted_on()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			esc_html_x('Posted on %s', 'post date', 'bryhub-simple'),
			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>';
	}
endif;

if (!function_exists('bryhub_simple_posted_by')) :

	function bryhub_simple_posted_by()
	{
		$byline = sprintf(
			esc_html_x('by %s', 'post author', 'bryhub-simple'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>';
	}
endif;

if (!function_exists('bryhub_simple_entry_footer')) :
	function bryhub_simple_entry_footer()
	{
		if ('post' === get_post_type()) {
			$categories_list = get_the_category_list(esc_html__(', ', 'bryhub-simple'));
			if ($categories_list) {
				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'bryhub-simple') . '</span>', $categories_list);
			}

			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'bryhub-simple'));
			if ($tags_list) {
				printf('<div class="tags-links">' . esc_html__('Tagged %1$s', 'bryhub-simple') . '</div>', $tags_list);
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					__('Edit <span class="screen-reader-text">%s</span>', 'bryhub-simple'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if (!function_exists('bryhub_simple_post_thumbnail')) :

	function bryhub_simple_post_thumbnail()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		if (is_singular()) :
?>

			<span class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</span>

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

<?php
		endif;
	}
endif;

if (!function_exists('wp_body_open')) :
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
endif;
