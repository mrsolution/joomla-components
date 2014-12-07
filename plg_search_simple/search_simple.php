<?php
/**
 * @package    Plg_Grouparticle
 * @copyright  Copyright (C) 2014 Mumba Pty Ltd. All rights reserved.
 * @license    Proprietary, see LICENSE.php
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

/**
 * JomSocial PfProjectCron Plugin
 *
 * @package     System
 * @subpackage  addarticletogroup
 * @since       1.1
 */
class PlgSimple extends JPlugin
{
	/**
	 * Jomacl me method to run onAfterInitialise
	 * Only purpose is to initialise the login authentication process if a cookie is present
	 *
	 * @return  boolean
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 */
	public function onAfterInitialise()
	{
		jimport('jomacl.api');

		return true;
	}

	/**
	 * OnAfterRoute
	 *
	 * @return void
	 */
	public function onAfterRoute()
	{
		// Force reload from database
		$user = JFactory::getUser();
		$session = JFactory::getSession();
		$session->set('user', new JUser($user->id));
		$user = JFactory::getUser();

		// Load language.
		$this->loadLanguage();
		$this->projectCron();
	}

	/**
	 * projectCron
	 *
	 * @return void
	 */
	public function projectCron()
	{
		$app         = JFactory::getApplication();
		$input       = $app->input;
		$urlToken    = $input->getString('token');
		$pfcronToken = $this->params->get('pfcronToken');

		if ($pfcronToken != $urlToken or $pfcronToken == '')
		{
			return;
		}

		// Get User id
		$userId = JFactory::getUser()->id;

		// Initialiase variables.
		$db       = JFactory::getDbo();
		$subQuery = $db->getQuery(true);
		$query    = $db->getQuery(true);

		// Create the base subQuery select statement.
		$subQuery->select('c.title')
		->from($db->qn('#__categories', 'c'))
		->where($db->qn('extension') . '=' . $db->q('com_pfprojects'));

		// Create the base select statement.
		$query->select('cg.name')
		->from($db->qn('#__community_groups', 'cg'))
		->where($db->qn('name') . 'NOT IN (' . $subQuery->__toString() . ')');

		// Set the query and load the groups.
		$db->setQuery($query);

		try
		{
			$groups = $db->loadObjectList();

			if (!$groups)
			{
				return;
			}
			else
			{
				$groupcategoryPlugin = JPluginHelper::getPlugin('community', 'pfcategory');
				$groupcategoryParams = new JRegistry($groupcategoryPlugin->params);
				$pfParentCategory    = $groupcategoryParams->get('pfParentCategory');

				$object = new JomaclObject;
				$i      = 0;

				foreach ($groups as $group)
				{
					$castegoryName[$i] = $group;

					$pfProjectParams   = array(
									'groupName' => $castegoryName[$i],
									'category'  => $pfParentCategory,
									'extension' => 'com_pfprojects'
					);

					$jObject[$i] = new JRegistry($pfProjectParams);
					$object->addCategoryToJoomla($jObject[$i]);

					$i++;
				}
			}
		}
		catch (RuntimeException $e)
		{
			throw new  RuntimeException($e->getMessage(), $e->getCode());
		}

		$app->close();
	}
}
