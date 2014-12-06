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
 * category_products Modules helper file
 *
 * @since  0.0.1
 */
class ModCategoryProductsdHelper
{
	/**
	 * Retrieves the the default images of products
	 *
	 * @param   array    $categories  get the array of selected categories
	 * @param   int      $limit       get the limit of products images
	 * @param   boolean  $catid       if yes than get the id from url and display the products
	 * @param   sort     $ordering    set the order by id or name of products
	 *
	 * @return array of images
	 */
	public static function getProducts($categories, $limit, $catid, $ordering)
	{

		if ($categories[0] == 0)
		{
			$categories == NULL;
		}

		$input = JFactory::getapplication()->input;
		$id    = $input->getInt('id');

		// Initialiase variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('a.*')
			->from($db->quoteName('#__Product') . ' AS a')
			->where($db->quoteName('a.published') . ' = ' . $db->quote('1'));
		if ($categories != NULL  && $catid == 0)
		{

			$categories = implode(",", $categories);
			$query->where('a.categories IN('.$categories.')');
		}
		if ($catid == 1)
		{
		 	if ($id)
		 	{
		 		$query->join('LEFT', '#__Category AS c ON c.id =' . $id)
		 			->where('a.categories like "%'.$id.'%"');
		 	}
		}

		if ($limit)
		{

			$query->order('id ASC LIMIT ' . $limit);
		}
		// Set the query and load the result.
		$db->setQuery($query);

		try
		{
			$result = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			throw new RuntimeException($e->getMessage(), $e->getCode());
		}

		if ($catid == 1 && $id)
		{
			// Call the checkcategory method
			return ModCategoryProductsdHelper::checkCategories($result, $id);
		}
		else
		{

			return $result;
		}
	}
	/**
	 * checkCategories method for remove the categories which not releted to category.
	 *
	 * @param   mixed    $result  result in object
	 * @param   integer  $id      id of category
	 *
	 * @return  mixed
	 */
	public static function checkCategories($result, $id)
	{
		for ($i = 0; $i < count($result); $i++)
		{
			$catArray =  explode(",", $result[$i]->categories);

			for ($j = 0; $j < count($catArray); $j++)
			{
				if (!in_array($id, $catArray))
				{
					unset($result[$i]);

				}
			}
		}
		$result = array_values($result);

		return $result;
	}
	/**
	 * exlode the images name in array
	 *
	 * @param   array  $products  array of images
	 *
	 * @return array image array
	 */
	public static function explodeImages($products)
	{

		for ($i = 0; $i < (count($products)); $i++)
		{
			$imagearray[] = explode(',', $products[$i]->default);
		}

		if ($products)
		{
			foreach ($imagearray as $key => $value)
			{
				for ($j = 0; $j < count($value); $j++)
				{
					$image[] = $value[$j];
				}
			}

			return $image;
		}
	}
}
