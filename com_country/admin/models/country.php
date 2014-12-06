<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_Category
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;
jimport('joomla.filesystem.file');
jimport('joomla.log.log');

/**
 * Category Model
 *
 * @since  0.0.1
 */
class CountryModelCountry extends JModelAdmin
{
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
	public function getTable($type = 'Country', $prefix = 'CountryTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}



	/**
	 * save data from form
	 *
	 * @param   array  $data  form of data
	 *
	 * @return  boolean
	 */

	public function save($data)
	{
		try
		{
			JTable::addIncludePath(JPATH_COMPONENT . '/tables/');
			$table     = JTable::getInstance('Country', 'CountryTable');

			$pk        = (!empty($data['id'])) ? $data['id'] : (int) $this->getState($this->getName() . '.id');
			$input     = JFactory::getApplication()->input;
			$file      = $input->files->get('jform', '', 'array');

			// Make safe file name and remove all the special charecter.
			$filename  = JFile::makeSafe($file['country_flag']['name']);
			$extension = JFile::getExt($filename);
			$filename  = JFile::stripExt($filename);
			$filename  = JFilterOutput::stringURLsafe($filename);
			$filename  = $filename . "." . $extension;
			$filename  = time() . $filename;
			$src       = $file['country_flag']['tmp_name'];
			$dest      = JPATH_ROOT . '/media/com_country/images/' . $filename;
			$isNew     = true;

			if ($pk > 0)
			{
				$table->load($pk);
				$isNew = false;
			}


			if ($file['country_flag']['error'] == 0)
			{
				if (JFile::getExt($filename) == 'jpg'
					|| JFile::getExt($filename) == 'png'
					|| JFile::getExt($filename) == 'gif'
					|| JFile::getExt($filename) == 'jpeg')
				{
					if (!JFile::upload($src, $dest))
					{
						return false;
					}

					$data['country_flag'] = $filename;
				}
				else
				{
					JLog::add(JText::_('JTEXT_ERROR_MESSAGE_EXTENCTION'), JLog::ERROR, 'jerror');

					return false;
				}
			}

			// Check if image not upload, set the default image .
			if (!$table->country_flag && array_key_exists('country_flag', $data) == false)
			{
				$data['country_flag'] = 'default.gif';
			}

			// Check the duplicate entry in table with alias.

			$this->setState($this->getName() . '.id', $table->id);

			return parent::save($data);

		}
		catch (RuntimeException $e)
		{
			throw new RuntimeException($e->getMessage(), 1);
		}
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed   A JForm object on success, false on failure
	 *
	 * @since       2.5
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_country.country', 'country',
								array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}


	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return      mixed   The data for the form.
	 *
	 * @since       2.5
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_Category.edit.Category.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	/**
	 * rebuild the tree structure
	 *
	 * @return  void
	 */
	public function rebuild()
	{
		// Get an instance of the table object.
		$table = $this->getTable();

		if (!$table->rebuild())
		{
			$this->setError($table->getError());

			return false;
		}

		// Clear the cache
		$this->cleanCache();

		return true;
	}

	/**
	 * search the list of category
	 *
	 * @param   array  $filters  array of filter
	 *
	 * @return  array    array of result
	 */
	public static function searchParent($filters = array())
	{
		$jinput = JFactory::getApplication()->input;
		$id = $jinput->getInt('id', 0);
		$filters['like'] = str_replace("-", " ", $filters['like']);
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('a.id AS value,a.title AS text,a.level AS level,a.published')
			->where('a.published <> -2 AND a.published <> 2')
			->from('#__Category AS a')
			->join('LEFT', $db->quoteName('#__Category', 'b') . ' ON a.lft > b.lft AND a.rgt < b.rgt');

		// Do not return root
		$query->where($db->quoteName('a.level') . ' <> ' . $db->quote('root'));

		if ($id != 0)
		{
			$query->join('LEFT', $db->quoteName('#__Category') . ' AS p ON p.id = ' . (int) $id)
			->where('NOT(a.lft >= p.lft AND a.rgt <= p.rgt)');
		}

		// Search in title or path
		if (!empty($filters['like']))
		{
			$query->where(
			'(' . $db->quoteName('a.title') . ' LIKE ' . $db->quote('%' . $filters['like'] . '%') . ')'
			);
		}

		// Filter by parent_id
		if (!empty($filters['parent_id']))
		{
			JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_category/tables');
			$table = JTable::getInstance('Category', 'CategoryTable');

			if ($children = $tagTable->getTree($filters['parent_id']))
			{
				foreach ($children as $child)
				{
					$childrenIds[] = $child->id;
				}

				$query->where('a.id IN (' . implode(',', $childrenIds) . ')');
			}
		}

		$query->group('a.id, a.title, a.level, a.lft, a.rgt, a.parent_id, a.published, a.path')
		->order('a.lft ASC');

		// Get the options.
		$db->setQuery($query);

		try
		{
			$results = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			return false;
		}

		for ($i = 0; $i < count($results); $i++)
		{
			if ($results[$i]->published != 1)
			{
				$results[$i]->text = str_repeat('- ', $results[$i]->level) . '[ ' . $results[$i]->text . ' ]';
			}
			else
			{
				$results[$i]->text = str_repeat('- ', $results[$i]->level) . $results[$i]->text;
			}
		}

		return $results;
	}
}
