<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die;

// Import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * Hello World Component Controller
 *
 * @since  0.0.1
 */
class CountryController extends JControllerLegacy
{
	/**
	 * display task
	 *
	 * @param   boolean  $cachable   if true view the output.
	 * @param   boolean  $urlparams  An array of safeUrl.
	 *
	 * @return void
	 */
	function display($cachable = false, $urlparams = false)
	{
		// Set default view if not set
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'Countries'));
		parent::display($cachable);
	}
}
