<?php
/**
 * @version       1.0.0
 * @package       com_country
 * @copyright     Copyright (C) 2010 - 2014 Tailored Solutions PVT. Ltd. All rights reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @author        anisha <anisha@tasolglobal.com> - http://
 */

// No direct access
defined('_JEXEC') or die;

$document = &JFactory::getDocument();
$document->addStylesheet(JURI::root() . 'media/com_country/css/form.css');

//$document->addScript(JURI::root().'components/com_unsubjects/assets/js/jquery.expander.js');

JHtml::_('jquery.framework', true);
JHtml::_('behavior.framework', true);
JHtml::_('behavior.tooltip');
JHtml::_('bootstrap.framework');
$document->addScript('https://maps.googleapis.com/maps/api/js?sensor=false');
$document->addScript(JURI::root(true) . '/media/com_country/js/com_country.js');

for ($i = 0; $i < count($this->item); $i++)
{
?>
	<div class="item_fields" style="width: 100%;">
		 <div class="subject_fields left_wrp">
		<table class="table">

		<tr>
			<td>
				<div class="imgbox img-polaroid">

				<?php
				$imgSrc = JURI::root() . '/media/com_country/images/thumbs/' . $this->item[$i]->thumbsImage;
				?>
				<img src="<?php echo $imgSrc;?>" >

				</div>
				<h2 id="overviewsection"><?php echo $this->item[$i]->country_name; ?></h2>
				<div class="mapbox">
					<div id="map">
					</div>
				</div>

				<h4 id="h4txt"> Country Area :- <?php echo number_format($this->item[$i]->country_area);?> </h4>
				<h4 id="h4txt"> Land Area :- <?php echo number_format($this->item[$i]->land_area);?> </h4>
				<h4 id="h4txt"> Forest Area :- <?php echo number_format($this->item[$i]->forest_area);?> </h4>
				<?php $str = ($this->item[$i]->fcpf_participating) ? $str = "Yes" : $str = "No";?>

				<h4 id="h4txt">FCPF Participating Country : <?php echo $str;?> </h4>

				<div class="sectiondesc sviewmore">
					<div><?php echo substr($this->item[$i]->summary_description,0, strpos($this->item[$i]->summary_description, "</p>")+4);?></div>
					<div class="overview_more_content"> <?php echo substr($this->item[$i]->summary_description,strpos($this->item[$i]->summary_description, "</p>"),strlen($this->item[$i]->summary_description));?></div>
					<div class="overview_more rightmore">
						<?php
						if (strip_tags(substr($this->item[$i]->summary_description,strpos($this->item[$i]->summary_description, "</p>"),strlen($this->item[$i]->summary_description))))
						echo JText::_('COM_UNSUBJECTS_OVERVIEW_SHOW_MORE')?>
					</div>
				</div>

			</td>
		</tr>
		<tr>
			<td>
				<h2><?php echo JText::_('COM_COUNTRY_FORM_LBL_COUNTRY_DOCUMENT_RECOMONDED'); ?></h2>
				<div class="sectiondesc sviewmore">
					<div class="unsubjectdocman">
					<?php $renderer   = $document->loadRenderer('modules');
						$position   = 'recomdocman_country';
						$options   = array('style' => 'raw');
						echo $renderer->render($position, $options, null);
					?>
					</div>

				</div>
			</td>
		</tr>
		<tr>
			<td>
				<h2><?php echo JText::_('COM_COUNTRY_FORM_LBL_COUNTRY_DOCUMENT'); ?></h2>
				<div class="sectiondesc sviewmore">
					<div class="unsubjectdocman">
					<?php $renderer   = $document->loadRenderer('modules');
						$position   = 'docman_country';
						$options   = array('style' => 'raw');
						echo $renderer->render($position, $options, null);
					?>
					</div>

				</div>
			</td>
		</tr>
		<tr>
				<td>
					<h2><?php echo JText::_('COM_COUNTRY_FORM_LBL_COUNTRY_SECTION_EVENTS'); ?></h2>
					<div class="cal_btn"><a href="<?php echo JRoute::_('index.php?option=com_jevents&view=month&layout=calendar&Itemid='.$Itemid);?>" title="cal" alt="cal"><?php echo JText::_('COM_COUNTRY_EVENT_FULL_CALNDAR')?></a></div>
					<div class="sectiondesc">
					<?php
					$renderer   = $document->loadRenderer('modules');
					$position   = 'countryevent';
					$options    = array('style' => 'raw');
					echo $renderer->render($position, $options, null);
				?>
					</div>
				</td>
		</tr>
		<tr>
				<td>
					<h2><?php echo JText::_('COM_COUNTRY_FORM_LBL_COUNTRY_SECTION_PHOTOALBUM'); ?></h2>
					<div class="sectiondesc">
					<?php
					$renderer   = $document->loadRenderer('modules');
					$position   = 'countryphotoes';
					$options    = array('style' => 'raw');
					echo $renderer->render($position, $options, null);
				?>
					</div>
				</td>
		</tr>

		</table>
		</div>
		<div class="subject_fields right_wrp">
			<div class="usefulsection rightblock" id="sectionpartnerorgs">
        		<h2><?php echo JText::_('COM_COUNTRY_FORM_LBL_COUNTRY_SECTION_PARTNER_ORGS'); ?></h2>
					<div class="sectiondesc sviewmore">
					<?php
					$renderer = $document->loadRenderer('modules');
					$position = 'countryorganisations';
					$options  = array('style' => 'raw');
					echo $renderer->render($position, $options, null);
					?>
					</div>
					<div class="innr_blck_shdow"></div>
    		</div>
			<div class="usefulsection rightblock" id="sectioncontacts">
        		<h2><?php echo JText::_('COM_COUNTRY_FORM_LBL_COUNTRY_SECTION_CONTACTS'); ?></h2>
					<div class="sectiondesc sviewmore">
					<?php
					$renderer = $document->loadRenderer('modules');
					$position = 'countrycontacts';
					$options  = array('style' => 'raw');
					echo $renderer->render($position, $options, null);
					?>
					</div>
					<div class="innr_blck_shdow"></div>
    		</div>
        	<div class="usefulsection rightblock" id="sectiondiscussion">
        		<h2><?php echo JText::_('COM_COUNTRY_FORM_LBL_COUNTRY_SECTION_ANNOUNCEMENTS'); ?></h2>
					<div class="sectiondesc sviewmore">
					<?php
					$renderer = $document->loadRenderer('modules');
					$position = 'countryannousement';
					$options  = array('style' => 'raw');
					echo $renderer->render($position, $options, null);
					?>
					</div>
					<div class="innr_blck_shdow"></div>
    		</div>
    		<div class="usefulsection rightblock" id="sectiondiscussion">
                <h2><?php echo JText::_('COM_COUNTRY_FORM_LBL_COUNTRY_SECTION_FORUM'); ?></h2>
                <?php
                    $renderer   = $document->loadRenderer('modules');
                    $position   = 'countryforum';
                    $options   = array('style' => 'raw');
                    echo $renderer->render($position, $options, null);
                    ?>
				<div class="innr_blck_shdow"></div>
			</div>

			<div class="usefulsection rightblock">
        		<h2><?php echo JText::_('COM_COUNRTY_FORM_LBL_COUNRTY_SECTION_USEFUL'); ?></h2>
				<div class="sectiondesc sviewmore">
					<div><?php echo $this->item[$i]->usefull_links;//substr($this->item->section_useful,0, strpos($this->item->section_useful, "</p>")+4);?></div>

				</div>
                <div class="innr_blck_shdow"></div>
        	</div>
        	<div class="usefulsection rightblock">
        		<h2><?php echo JText::_('COM_COUNTRY_FORM_LBL_COUNTRY_SECTION_SOCIALFEEDS'); ?></h2>
				<div class="sectiondesc sviewmore">
					<div><?php echo $this->item[$i]->social_media_link;//substr($this->item->section_socialfeeds,0, strpos($this->item->section_socialfeeds, "</p>")+4);?></div>

				</div>
                <div class="innr_blck_shdow"></div>
        	</div>
        	<div class="usefulsection rightblock" id="sectiondiscussion">
        		<h2><?php echo JText::_('COM_COUNTRY_FORM_LBL_COUNTRY_SECTION_BLOG'); ?></h2>
					<div class="sectiondesc sviewmore">
					<?php
					$renderer = $document->loadRenderer('modules');
					$position = 'countryblog';
					$options  = array('style' => 'raw');
					echo $renderer->render($position, $options, null);
					?>
					</div>
					<div class="innr_blck_shdow"></div>
    		</div>
		</div>
	</div>
	<?php
}