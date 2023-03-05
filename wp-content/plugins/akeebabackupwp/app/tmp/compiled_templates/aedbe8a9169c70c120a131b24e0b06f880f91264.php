<?php /* /Users/hubertoszywa/Local Sites/landing-test/app/public/wp-content/plugins/akeebabackupwp/app/Solo/ViewTemplates/Sysconfig/appsetup.blade.php */ ?>
<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2023 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

use Awf\Text\Text;
use Solo\Helper\Escape;
use Solo\Helper\FEFSelect;

defined('_AKEEBA') or die();

/** @var \Solo\View\Sysconfig\Html $this */

$config = $this->container->appConfig;
$inCMS  = $this->container->segment->get('insideCMS', false);

$timezone = $config->get('timezone', 'GMT');
$timezone = ($timezone == 'UTC') ? 'GMT' : $timezone;

/**
 * Remember to update wpcli/Command/Sysconfig.php in the WordPress application whenever this file changes.
 */
?>
<div class="akeeba-form-group">
	<label for="darkmode">
		<?php echo \Awf\Text\Text::_('SOLO_CONFIG_DISPLAY_DARKMODE_LABEL'); ?>
	</label>
	<div class="akeeba-toggle">
		<?php echo FEFSelect::radiolist([
			FEFSelect::option('0', Text::_('AWF_NO'), ['attr' => ['class' => 'red']]),
			FEFSelect::option('-1', Text::_('SOLO_CONFIG_DISPLAY_DARKMODE_OPT_AUTO'), ['attr' => ['class' => 'orange']]),
			FEFSelect::option('1', Text::_('AWF_YES'), ['attr' => ['class' => 'green']]),
		], 'darkmode', ['forToggle' => 1], 'value', 'text', (int) $config->get('darkmode', -1), 'darkmode'); ?>

	</div>
	<p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('SOLO_CONFIG_DISPLAY_DARKMODE_DESCRIPTION'); ?>
	</p>
</div>

<?php if(defined('WPINC')): ?>
<div class="akeeba-form-group">
    <label for="under_tools">
        <?php echo \Awf\Text\Text::_('SOLO_CONFIG_UNDER_TOOLS_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
        <?php echo FEFSelect::booleanList('under_tools', array('forToggle' => 1, 'colorBoolean' => 1), $config->get('under_tools', 0)); ?>

    </div>
    <p class="akeeba-help-text">
        <?php echo \Awf\Text\Text::_('SOLO_CONFIG_UNDER_TOOLS_DESCRIPTION'); ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="quickbackup_profile">
        <?php echo \Awf\Text\Text::_('SOLO_CONFIG_QUICKBACKUP_PROFILE_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
        <?php echo \Awf\Html\Html::_('select.genericlist', $this->profileList, 'quickbackup_profile', ['list.select' => $config->get('quickbackup_profile', 1)]); ?>
    </div>
    <p class="akeeba-help-text">
        <?php echo \Awf\Text\Text::_('SOLO_CONFIG_QUICKBACKUP_PROFILE_DESCRIPTION'); ?>
    </p>
</div>
<?php endif; ?>

<div class="akeeba-form-group">
    <label for="useencryption">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_SECURITY_USEENCRYPTION_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
	    <?php echo FEFSelect::booleanList('useencryption', array('forToggle' => 1, 'colorBoolean' => 1), $config->get('useencryption', 1)); ?>

    </div>
    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_SECURITY_USEENCRYPTION_DESCRIPTION'); ?>
    </p>
</div>

<?php // WordPress sets its own timezone. We use that value forcibly in our WP-specific Solo\Application\AppConfig (helpers/Solo/Application/AppConfig.php). Therefore we display it locked in WP. ?>
<div class="akeeba-form-group">
    <label for="timezone">
		<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_TIMEZONE'); ?>
    </label>
	<?php echo \Solo\Helper\Setup::timezoneSelect($timezone, 'timezone', true, $inCMS); ?>

    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_($inCMS ? 'SOLO_SETUP_LBL_TIMEZONE_WORDPRESS' : 'SOLO_SETUP_LBL_TIMEZONE_HELP'); ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="localtime">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_BACKEND_LOCALTIME_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
	    <?php echo FEFSelect::booleanList('localtime', array('forToggle' => 1, 'colorBoolean' => 1), $config->get('localtime', 1)); ?>

    </div>
    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_BACKEND_LOCALTIME_DESC'); ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="timezonetext">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_BACKEND_TIMEZONETEXT_LABEL'); ?>
    </label>
	<?php echo \Solo\Helper\Setup::timezoneFormatSelect($config->get('timezonetext', 'T')); ?>

    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_BACKEND_TIMEZONETEXT_DESC'); ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="forced_backup_timezone">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_FORCEDBACKUPTZ_LABEL'); ?>
    </label>
	<?php echo \Solo\Helper\Setup::timezoneSelect($config->get('forced_backup_timezone', 'AKEEBA/DEFAULT'), 'forced_backup_timezone', true); ?>

    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_FORCEDBACKUPTZ_DESC'); ?>
    </p>
</div>

<?php if($inCMS): ?>
    <div class="akeeba-form-group">
        <label for="wp_cron_override_time">
            <?php echo \Awf\Text\Text::_('SOLO_CONFIG_WP_CRON_OVERRIDE_TIME_LABEL'); ?>
        </label>
        <?php echo FEFSelect::genericlist([
            FEFSelect::option('0', Text::_('AWF_NO')),
            FEFSelect::option('1', Text::_('SOLO_CONFIG_WP_CRON_OVERRIDE_TIME_OPTIMISTIC')),
            FEFSelect::option('2', Text::_('SOLO_CONFIG_WP_CRON_OVERRIDE_TIME_CONSERVATIVE')),
        ], 'wp_cron_override_time', [], 'value', 'text', (int) $config->get('wp_cron_override_time', 1),'wp_cron_override_time'); ?>

        <p class="akeeba-help-text">
            <?php echo \Awf\Text\Text::_('SOLO_CONFIG_WP_CRON_OVERRIDE_TIME_DESCRIPTION'); ?>
        </p>
    </div>
<?php endif; ?>

<div class="akeeba-form-group">
    <label for="showDeleteOnRestore">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_BACKEND_SHOWDELETEONRESTORE_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
		<?php echo FEFSelect::booleanList('showDeleteOnRestore', array('forToggle' => 1, 'colorBoolean' => 1), $config->get('showDeleteOnRestore', 0)); ?>

    </div>
    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_BACKEND_SHOWDELETEONRESTORE_DESC'); ?>
    </p>
</div>

<?php if($inCMS): ?>
<div class="akeeba-form-group">
    <label for="showBrowserDownload">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_BACKEND_SHOWBROWSERDOWNLOAD_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
		<?php echo FEFSelect::booleanList('showBrowserDownload', array('forToggle' => 1, 'colorBoolean' => 1), $config->get('showBrowserDownload', 0)); ?>

    </div>
    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_BACKEND_SHOWBROWSERDOWNLOAD_DESC'); ?>
    </p>
</div>
<?php endif; ?>

<?php if(!$inCMS): ?>

    <div class="akeeba-form-group">
        <label for="live_site">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_LIVESITE'); ?>
        </label>
        <input type="text" name="live_site" id="live_site"
               value="<?php echo $config->get('live_site'); ?>">
        <p class="akeeba-help-text">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_LIVESITE_HELP'); ?>
        </p>
    </div>

    <div class="akeeba-form-group">
        <label for="session_timeout">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_SESSIONTIMEOUT'); ?>
        </label>
        <input type="text" name="session_timeout" id="session_timeout"
               value="<?php echo $config->get('session_timeout'); ?>">
        <p class="akeeba-help-text">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_SESSIONTIMEOUT_HELP'); ?>
        </p>
    </div>
<?php endif; ?>

<div class="akeeba-form-group">
    <label for="dateformat">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_DATEFORMAT_LABEL'); ?>
    </label>
    <input type="text" name="dateformat" id="dateformat"
           value="<?php echo $config->get('dateformat'); ?>">
    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_DATEFORMAT_DESC'); ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="stats_enabled">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_USAGESTATS_SOLO_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
	    <?php echo FEFSelect::booleanList('stats_enabled', array('forToggle' => 1, 'colorBoolean' => 1), $config->get('stats_enabled', 1)); ?>

    </div>
    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_USAGESTATS_SOLO_DESC'); ?>
    </p>
</div>

<?php if(!$inCMS): ?>

    <div class="akeeba-form-group">
        <label for="proxy_host">
            <?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PROXY_HOST_LABEL'); ?>
        </label>
        <input type="text" name="proxy_host" id="proxy_host"
               value="<?php echo $config->get('proxy_host'); ?>">
        <p class="akeeba-help-text">
            <?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PROXY_HOST_DESC'); ?>
        </p>
    </div>

    <div class="akeeba-form-group">
        <label for="proxy_port">
            <?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PROXY_PORT_LABEL'); ?>
        </label>
        <input type="number" min="1" max="65535" name="proxy_port" id="proxy_port"
               value="<?php echo $config->get('proxy_port', '8080'); ?>">
        <p class="akeeba-help-text">
            <?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PROXY_PORT_DESC'); ?>
        </p>
    </div>

    <div class="akeeba-form-group">
        <label for="proxy_user">
            <?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PROXY_USER_LABEL'); ?>
        </label>
        <input type="text" name="proxy_user" id="proxy_user"
               value="<?php echo $config->get('proxy_user', ''); ?>">
        <p class="akeeba-help-text">
            <?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PROXY_USER_DESC'); ?>
        </p>
    </div>

    <div class="akeeba-form-group">
        <label for="proxy_pass">
            <?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PROXY_PASS_LABEL'); ?>
        </label>
        <input type="password" name="proxy_pass" id="proxy_pass"
               value="<?php echo $config->get('proxy_pass', ''); ?>">
        <p class="akeeba-help-text">
            <?php echo \Awf\Text\Text::_('COM_AKEEBA_CONFIG_PROXY_PASS_DESC'); ?>
        </p>
    </div>
<?php endif; ?>

<hr/>

<div class="akeeba-form-group">
    <label for="fs_driver">
		<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_DRIVER'); ?>
    </label>
	<?php echo \Solo\Helper\Setup::fsDriverSelect($config->get('fs.driver')); ?>

    <p class="akeeba-help-text">
		<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_DRIVER_HELP'); ?>
    </p>
</div>

<div id="ftp_options">
    <div class="akeeba-form-group">
        <label for="fs_host">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_FTP_HOST'); ?>
        </label>
        <input type="text" name="fs_host" id="fs_host"
               value="<?php echo $config->get('fs.host'); ?>">
        <p class="akeeba-help-text">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_FTP_HOST_HELP'); ?>
        </p>
    </div>

    <div class="akeeba-form-group">
        <label for="fs_port">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_FTP_PORT'); ?>
        </label>
        <input type="text" name="fs_port" id="fs_port"
               value="<?php echo $config->get('fs.port'); ?>">
        <p class="akeeba-help-text">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_FTP_PORT_HELP'); ?>
        </p>
    </div>

    <div class="akeeba-form-group">
        <label for="fs_username">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_FTP_USERNAME'); ?>
        </label>
        <input type="text" name="fs_username" id="fs_username"
               value="<?php echo $config->get('fs.username'); ?>">
        <p class="akeeba-help-text">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_FTP_USERNAME_HELP'); ?>
        </p>
    </div>

    <div class="akeeba-form-group">
        <label for="fs_password">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_FTP_PASSWORD'); ?>
        </label>
        <input type="password" name="fs_password" id="fs_password"
               value="<?php echo $config->get('fs.password'); ?>">
        <p class="akeeba-help-text">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_FTP_PASSWORD_HELP'); ?>
        </p>
    </div>

    <div class="akeeba-form-group">
        <label for="fs_directory">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_FTP_DIRECTORY'); ?>
        </label>

        <input type="text" name="fs_directory" id="fs_directory" value="<?php echo $config->get('fs.directory'); ?>" />

        <p class="akeeba-help-text">
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_FS_FTP_DIRECTORY_HELP'); ?>
        </p>
    </div>
</div>
