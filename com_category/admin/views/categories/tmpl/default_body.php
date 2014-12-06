<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;
echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
$user		= JFactory::getUser();
$userId		= $user->get('id');

foreach ($this->items as $i => $item):
$canEdit    = $user->authorise('core.edit',       'com_helloworld.helloworld.' . $item->id);
$canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
$canEditOwn = $user->authorise('core.edit.own',   'com_helloworld.helloworld.' . $item->id) && $item->created_by == $userId;
$canChange  = $user->authorise('core.edit.state', 'com_helloworld.helloworld.' . $item->id) && $canCheckin;

?>

		<tr class="row<?php echo $i % 2; ?>">
				<td>
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>
				<td>
					<?php echo JHtml::_('jgrid.published', $item->published, $i, 'categories.'); ?>
				</td>
				<td>
				<?php if ($item->checked_out): ?>
				<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'categories.', $canCheckin); ?>
				<?php endif; ?>

				<?php echo str_repeat('<span class="gi">&mdash;</span>', $item->level - 1) ?>
				<a href="<?php echo JRoute::_('index.php?option=com_category&view=category&task=category.edit&layout=edit&id=' . $item->id . ''); ?>">
				<?php echo $item->title; ?></a>
				<?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->alias));?>

				</td>
				<td>
					<?php echo $item->id; ?>
				</td>
		</tr>
<?php endforeach; ?>
