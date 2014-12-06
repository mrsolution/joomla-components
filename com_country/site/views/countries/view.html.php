<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

/**
 * HTML View class for the HelloWorld Component
 *
 * @since  0.0.1
 */
class CountryViewCountries extends JViewLegacy
{
	/**
	 * Overwritting JViwe display method
	 *
	 * @param   int  $tpl  default templete value
	 *
	 * @return  boolean        return true or false
	 */
	function display($tpl = null)
	{
		$input    = JFactory::getApplication()->input;
		$id       = $input->getInt('id');
		$this->id = $id;
		$this->item = $this->get('Items');
		$imagePath = JPATH_ROOT . '/media/com_country/images/' . $this->item[0]->country_flag;
		$image = new JImage($imagePath);
		$thumbs = $image->createThumbs('100x50');
		$this->item[0]->thumbsImage = basename($thumbs[0]->getPath());

		// Display the view
		parent::display($tpl);
	}
}
