<?php

// No direct access
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');

$options['disable_search_threshold'] = 0;
JHtml::_('formbehavior.chosen', 'select', null, $options);

?>
<form action="<?php echo JRoute::_('index.php?option=com_country&layout=edit&id=' . (int) $this->item->id); ?>"

	method="post" enctype="multipart/form-data" name="adminForm" id="adminForm" class="form-validate">

	<div class="form-horizontal">
		<fieldset class="adminform">
		<div class="row-fluid">
			<div class="span9">
			<div class="control-group">
				<div class="controls">
				<?php echo $this->form->getInput('id'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
				<?php echo $this->form->getLabel('country_name'); ?>
				</div>
				<div class="controls">
				<?php echo $this->form->getInput('country_name'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
				<?php echo $this->form->getLabel('country_flag'); ?>
				</div>
				<div class="controls">
				<?php echo $this->form->getInput('country_flag'); ?>
				</div>
			</div>

			<?php
			$input = JFactory::getApplication()->input;
			$id    = $input->getInt('id', 0);

			if ($id > 0)
			{
				$ImageSrc = JURI::root() . 'media/com_country/images/' . $this->item->country_flag;
				?>
				<div class="controls">
				<img src="<?php echo $ImageSrc; ?>" width='150px' height='150px'>
				</div>
				<?php
			}
			?>
			<div class="control-group">
				<div class="control-label">
				<?php echo $this->form->getLabel('country_area'); ?>
				</div>
				<div class="controls">
				<?php echo $this->form->getInput('country_area'); ?>
				</div>
			</div>
			<div class="control-group">
				<div class="control-label">
				<?php echo $this->form->getLabel('land_area'); ?>
				</div>
				<div class="controls">
				<?php echo $this->form->getInput('land_area'); ?>
				</div>
			</div>
			<div class="control-group">
				<div class="control-label">
				<?php echo $this->form->getLabel('forest_area'); ?>
				</div>
				<div class="controls">
				<?php echo $this->form->getInput('forest_area'); ?>
				</div>
			</div>


			<div class="control-group">
				<div class="control-label">
				<?php echo $this->form->getLabel('summary_description'); ?>
				</div>
				<div class="controls">
				<?php echo $this->form->getInput('summary_description'); ?>
				</div>
			</div>
			<div class="control-group">
				<div class="control-label">
				<?php echo $this->form->getLabel('usefull_links'); ?>
				</div>
				<div class="controls">
				<?php echo $this->form->getInput('usefull_links'); ?>
				</div>
			</div>
			<div class="control-group">
				<div class="control-label">
				<?php echo $this->form->getLabel('social_media_link'); ?>
				</div>
				<div class="controls">
				<?php echo $this->form->getInput('social_media_link'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
				<?php echo $this->form->getLabel('fcpf_participating');?>
				</div>
				<div class="controls">
				<?php echo $this->form->getInput('fcpf_participating');?>
				</div>
			</div>

			</div>
			<div class="span3">
			<?php echo JLayoutHelper::render('joomla.edit.global', $this);?>
			</div>
			</div>
		</fieldset>
	</div>
	<input type="hidden" name="task" value="category.edit" />
	<?php echo JHtml::_('form.token'); ?>
</form>
