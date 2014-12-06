<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_category
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

/**
 * Category Model
 *
 * @since  0.0.1
 */
class CountryModelCountries extends JModelList
{
	/**
	 * @var array messages
	 */
	protected $messages;

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   type    $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A database object
	 *
	 * @since       2.5
	 */
	public function getTable($type = 'Product', $prefix = 'ProductTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Get list of Category
	 *
	 * @return   Object  collection of categories
	 */
	public function getListQuery()
	{

		// Initialiase variables.
		$input = JFactory::getApplication()->input;
		$id = $input->get('id');

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('a.*')
			->from($db->quoteName('#__com_countries') . ' AS a')
			->where('a.published=1 and '. $db->qn('id') . '=' . $id);

		// Set the query and load the result.
		$db->setQuery($query);


		return $query;
	}
}
