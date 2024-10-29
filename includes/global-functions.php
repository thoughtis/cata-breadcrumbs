<?php
/**
 * Global Functions
 * 
 * @package Cata\Breadcrumbs
 * @since 0.1.0
 */

/**
 * Get Cata Breadcrumbs
 * 
 * @return array
 */
function cata_breadcrumbs_get_crumbs(): array {
	return apply_filters( 'cata_breadcrumbs_get_crumbs', array(), get_the_ID() );
}
