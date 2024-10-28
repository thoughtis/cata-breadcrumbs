<?php
/**
 * Cata Breadcrumbs
 *
 * @package   Cata\Breadcrumbs
 * @author    Thought & Expression Co. <devjobs@thought.is>
 * @copyright 2019 Thought & Expression Co.
 * @license   GNU GENERAL PUBLIC LICENSE
 *
 * @wordpress-plugin
 * Plugin Name: Cata Breadcrumbs
 * Description: Add a function with a filter to get breadcrumbs.
 * Author:      Thought & Expression Co. <devjobs@thought.is>
 * Author URI:  https://thought.is
 * Version:     0.1.0-beta1
 * License:     GPL v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Cata\Breadcrumbs;

/**
 * Global Functions
 */
require_once __DIR__ . '/includes/global-functions.php';

/**
 * Category Breadcrumbs
 */
require_once __DIR__ . '/includes/category/class-category.php';

new Category();
