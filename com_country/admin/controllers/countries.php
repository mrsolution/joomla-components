<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_Category
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

/**
 * Categories Controller
 *
 * @since  0.0.1
 */
class CountryControllerCountries extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    name of model
	 * @param   string  $prefix  name of model prefix
	 * @param   array   $config  config array
	 *
	 * @since       2.5
	 *
	 * @return  void
	 */
	public function getModel($name = 'Country', $prefix = 'CountryModel', $config=array())
	{
		return parent::getModel($name, $prefix, array('ignore_request' => true));
	}
}

