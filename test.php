function get_primary_category( $post = 0 ) {
	$category = get_the_category();
	$useCatLink = true;

	if ($category){
		$category_display = '';
		$category_link = '';
		if ( class_exists('WPSEO_Primary_Term') )
		{
			// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
			$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term = get_term( $wpseo_primary_term );
			if (is_wp_error($term)) { 
				// Default to first category (not Yoast) if an error is returned
				$category_display = $category[0]->name;
				$category_link = get_category_link( $category[0]->term_id );
			} else { 
				// Yoast Primary category
				$category_display = $term->name;
				$category_link = get_category_link( $term->term_id );
			}
		} 
		else {
			// Default, display the first category in WP's list of assigned categories
				$category_display = $category[0]->name;
				$category_link = get_category_link( $category[0]->term_id );
			}
		}
		$cate_html .='<div class="cat-links"><a href="'.$category_link.'">'.esc_html($category_display).'</a></div>';
		echo $cate_html;
}
