<?php
/**
 * Category
 *
 * @package Cata\Breadcrumbs
 */

namespace Cata\Breadcrumbs;

use WP_Term;

/**
 * Category
 */
class Category {
	/**
	 * Disallow
	 *
	 * @var array
	 */
	const DISALLOW = array(
		'uncategorized',
	);

	/**
	 * Construct
	 */
	public function __construct() {
		add_filter( 'cata_breadcrumbs_get_crumbs', array( __CLASS__, 'add_category' ), 20, 2 );
	}

	/**
	 * Add Category
	 *
	 * @param array $crumbs - array of breadcrumb items.
	 * @param int   $post_id - post we're using to make the breadcrumb.
	 * 
	 * @return array $crumbs - updated with the primary category.
	 */
	public static function add_category( array $crumbs, int $post_id ): array {
		$blacklist = apply_filters( 'cata_breadcrumbs_disallowed_category_slugs', self::DISALLOW );

		if ( ! empty( $crumbs ) ) {
			$blacklist = array_merge( $blacklist, array_column( $crumbs, 'slug' ) );
		}

		$category = self::get_primary_category( $post_id, $blacklist );

		if ( ! $category instanceof WP_Term ) {
			return $crumbs;
		}

		$crumb = array(
			'slug'  => $category->slug,
			'url'   => get_term_link( $category, 'category' ),
			'title' => $category->name,
		);

		$crumb = apply_filters( 'cata_breadcrumbs_category_crumb', $crumb, $category );

		return array_merge( array( $crumb ), $crumbs );
	}

	/**
	 * Get Primary Category
	 * 
	 * @param int $post_id
	 * @param array $unusable_term_slugs
	 * 
	 * @return WP_Term|null Either a WP_Term null false
	 */
	public static function get_primary_category( int $post_id, array $unusable_term_slugs = array() ): ?WP_Term {
		$terms = get_the_terms( $post_id, 'category' );

		if ( ! is_array( $terms ) || empty( $terms ) ) {
			return null;
		}

		$usable_terms = array_values(
			array_filter( $terms, function( $term ) use ( $unusable_term_slugs ) {
				return ! in_array( $term->slug, $unusable_term_slugs, true );
			})
		);

		if ( empty( $usable_terms ) ) {
			return null;
		}

		return array_shift( $usable_terms );
	}
}
