<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Modules
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

/**
 * category_products Modules main file
 *
 * @since  0.0.1
 */

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';


$categories = $params->get('category');
$limit      = $params->get('limit');
$catid      = $params->get('categoryid');
$ordering   = $params->get('sort');
$class_sfx  = htmlspecialchars($params->get('moduleclass_sfx'));

$products = ModCategoryProductsdHelper::getProducts($categories,$limit, $catid, $ordering);


$images   = ModCategoryProductsdHelper::explodeImages($products);


require JModuleHelper::getLayoutPath('mod_category_products');
