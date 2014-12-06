<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_country
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

/**
 * countries View
 *
 * @since  0.0.1
 */
class CountryViewCountries extends JViewLegacy
{
	/**
	 * countries view display method
	 *
	 * @param   string  $tpl  default templete
	 *
	 * @return void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		$document = JFactory::getDocument();
		$document->addScript(JURI::root(true) . '/media/jui/js/jquery.min.js');
		$document->addScript(JURI::root(true) . "/media/com_country/js/com_country.js");
		$document->addStylesheet(JURI::root(true) . "/media/com_country/style/style.css");

		$app                 = JFactory::getApplication();
		$pagination          = $this->get('Pagination');
		$items               = $this->get('Items');


		$this->state         = $this->get('State');
		$this->assoc         = $this->get('Assoc');
		$this->activeFilters = $this->get('ActiveFilters');
		$this->filterForm    = $this->get('FilterForm');
		$user                = JFactory::getUser();
		$userId              = $user->get('id');


		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Assign data to the view
		$this->items      = $items;
		$this->pagination = $pagination;

		// Set the toolbar and number of found items
		$this->addToolBar($this->pagination->total);

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * add toolbar function
	 *
	 * @param   total  $total  string
	 *
	 * @return void
	 */
	protected function addToolBar($total=null)
	{
		$canDo = JHelperContent::getActions('com_country', 'country', $this->state->get('filter.country_id'));

		JToolBarHelper::title(JText::_('COM_COUNTRY_MANAGER_COUNTRIES').
				//Reflect number of items in title!
				($total?' <span style="font-size: 0.5em; vertical-align: middle;">('.$total.')</span>':'')
				, 'country');
		JToolBarHelper::addNew('country.add');

		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
		{
			JToolbarHelper::editList('country.edit');
		}

		if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'countries.delete', 'JTOOLBAR_EMPTY_TRASH');
		}

		JToolbarHelper::publish('countries.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('countries.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::archiveList('countries.archive');

		if (JFactory::getUser()->authorise('core.admin'))
		{
			JToolbarHelper::checkin('countries.checkin');
		}

		JToolbarHelper::trash('countries.trash');

	}

	/**
	 * set document title
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('countries'));
	}
}
