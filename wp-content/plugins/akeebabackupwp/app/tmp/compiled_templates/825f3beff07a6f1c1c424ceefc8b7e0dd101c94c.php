<?php /* /Users/hubertoszywa/Local Sites/landing-test/app/public/wp-content/plugins/akeebabackupwp/app/Solo/ViewTemplates/Fsfilters/tabular.blade.php */ ?>
<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2023 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

use Awf\Text\Text;

defined('_AKEEBA') or die();

/** @var \Solo\View\Fsfilters\Html $this */
?>
<?php echo $this->loadAnyTemplate('CommonTemplates/ErrorModal'); ?>
<?php echo $this->loadAnyTemplate('CommonTemplates/ProfileName'); ?>

<form class="akeeba-form--inline akeeba-panel--info">
    <div class="akeeba-form-group">
        <label><?php echo \Awf\Text\Text::_('COM_AKEEBA_FILEFILTERS_LABEL_ROOTDIR'); ?></label>
		<?php echo $this->root_select; ?>
    </div>
    <div id="addnewfilter" class="akeeba-form-group--actions">
        <label>
			<?php echo \Awf\Text\Text::_('COM_AKEEBA_FILEFILTERS_LABEL_ADDNEWFILTER'); ?>
        </label>
        <button class="akeeba-btn--grey" id="comAkeebaFileFiltersAddDirectories"><?php echo \Awf\Text\Text::_('COM_AKEEBA_FILEFILTERS_TYPE_DIRECTORIES'); ?></button>
        <button class="akeeba-btn--grey" id="comAkeebaFileFiltersAddSkipfiles"><?php echo \Awf\Text\Text::_('COM_AKEEBA_FILEFILTERS_TYPE_SKIPFILES'); ?></button>
        <button class="akeeba-btn--grey" id="comAkeebaFileFiltersAddSkipdirs"><?php echo \Awf\Text\Text::_('COM_AKEEBA_FILEFILTERS_TYPE_SKIPDIRS'); ?></button>
        <button class="akeeba-btn--grey" id="comAkeebaFileFiltersAddFiles"><?php echo \Awf\Text\Text::_('COM_AKEEBA_FILEFILTERS_TYPE_FILES'); ?></button>
    </div>
</form>

<div id="ak_roots_container_tab" class="akeeba-panel--primary">
    <div id="ak_list_container">
        <table id="ak_list_table" class="akeeba-table--striped">
            <thead>
            <tr>
                <td width="250px"><?php echo \Awf\Text\Text::_('COM_AKEEBA_FILEFILTERS_LABEL_TYPE'); ?></td>
                <td><?php echo \Awf\Text\Text::_('COM_AKEEBA_FILEFILTERS_LABEL_FILTERITEM'); ?></td>
            </tr>
            </thead>
            <tbody id="ak_list_contents">
            </tbody>
        </table>
    </div>
</div>
