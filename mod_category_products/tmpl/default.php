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
 * category_products Modules default Layout
 *
 * @since  0.0.1
 */
$doc = JFactory::getDocument();
$doc->addScript(JURI::root(true) . '/media/com_category/js/jcarousel.responsive.js');
$doc->addScript(JURI::root(true) . '/media/com_category/js/jquery.jcarousel.min.js');
$doc->addStyleSheet(JURI::root(true) . '/media/com_category/style/jcarousel.responsive.css');
$doc->addStyleSheet(JURI::root(true) . '/media/mod_category_products/style/mod_category_products.css');
$input  = JFactory::getApplication()->input;
$Itemid = $input->getInt('Itemid');
$id     = $input->getInt('id');
$pid    = $input->getInt('pid');

?>

<h3> Products </h3>
<div class="nav products<?php echo $class_sfx;?>" >
<?php

?>
<?php if ($images): ?>
	<div class="wrapper">
	    <div class="jcarousel-wrapper">
	        <div class="jcarousel">
	            <ul>

					<?php for ($j = 0; $j < count($images); $j++):
						$fullImagePath = JPATH_ROOT . '/media/com_category/images/' . $images[$j];
						$image         = new JImage(JPath::clean($fullImagePath));
						$thumbs        = $image->createThumbs('140x140');
						$thumbnail = basename($thumbs[0]->getPath());
						$image = JUri::root() . 'media/com_category/images/thumbs/' . $thumbnail;?>
            		<li>
						<img src="<?php echo $image ?>" class="img"></a>
					</li>
					<?php endfor; ?>
	            </ul>
	        </div>
		<?php if ($j > 5): ?>
	        <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
	        <a href="#" class="jcarousel-control-next">&rsaquo;</a>
	    <?php endif; ?>
	    	</div>
	</div>
<?php endif;
?>
</div>
