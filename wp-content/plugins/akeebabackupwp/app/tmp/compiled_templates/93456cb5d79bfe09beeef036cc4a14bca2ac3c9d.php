<?php /* /Users/hubertoszywa/Local Sites/landing-test/app/public/wp-content/plugins/akeebabackupwp/app/Solo/ViewTemplates/Sysconfig/default.blade.php */ ?>
<?php
/**
 * @package   solo
 * @copyright Copyright (c)2014-2023 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

use Awf\Text\Text;
use Solo\Helper\Escape;

defined('_AKEEBA') or die();

/** @var \Solo\View\Sysconfig\Html $this */

$router = $this->getContainer()->router;
$inCMS = $this->getContainer()->segment->get('insideCMS', false);
?>

<?php echo $this->loadAnyTemplate('CommonTemplates/FTPBrowser'); ?>
<?php echo $this->loadAnyTemplate('CommonTemplates/SFTPBrowser'); ?>
<?php echo $this->loadAnyTemplate('CommonTemplates/FTPConnectionTest'); ?>

<form action="<?php echo $this->container->router->route('index.php?view=sysconfig'); ?>" method="POST" id="adminForm"
      class="akeeba-form--horizontal" role="form">
    <div class="akeeba-tabs">
        <label for="sysconfigAppSetup" class="active">
            <span class="akion-ios-cog"></span>
	        <?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_APPSETUP'); ?>
        </label>
        <section id="sysconfigAppSetup">
	        <?php echo $this->loadAnyTemplate('Sysconfig/appsetup'); ?>
        </section>

    <?php if($inCMS && AKEEBABACKUP_PRO): ?>
        <label for="sysconfigBackupOnUpdate">
            <span class="akion-refresh"></span>
			<?php echo \Awf\Text\Text::_('SOLO_SETUP_LBL_BACKUPONUPDATE'); ?>
        </label>
        <section id="sysconfigBackupOnUpdate">
			<?php echo $this->loadAnyTemplate('Sysconfig/backuponupdate'); ?>
        </section>
    <?php endif; ?>

        <label for="sysconfigBackupChecks">
            <span class="akion-android-list"></span>
	        <?php echo \Awf\Text\Text::_('SOLO_SYSCONFIG_BACKUP_CHECKS'); ?>
        </label>
        <section id="sysconfigBackupChecks">
	        <?php echo $this->loadAnyTemplate('Sysconfig/backupchecks'); ?>
        </section>

        <label for="sysconfigPublicAPI">
            <span class="akion-android-globe"></span>
	        <?php echo \Awf\Text\Text::_('SOLO_SYSCONFIG_FRONTEND'); ?>
        </label>
        <section id="sysconfigPublicAPI">
	        <?php echo $this->loadAnyTemplate('Sysconfig/publicapi'); ?>
        </section>

        <label for="sysconfigPushNotifications">
            <span class="akion-chatbubble"></span>
	        <?php echo \Awf\Text\Text::_('SOLO_SYSCONFIG_PUSH'); ?>
        </label>
        <section id="sysconfigPushNotifications">
	        <?php echo $this->loadAnyTemplate('Sysconfig/push'); ?>
        </section>

        <label for="sysconfigUpdate">
            <span class="akion-refresh"></span>
	        <?php echo \Awf\Text\Text::_('SOLO_SYSCONFIG_UPDATE'); ?>
        </label>
        <section id="sysconfigUpdate">
	        <?php echo $this->loadAnyTemplate('Sysconfig/update'); ?>
        </section>

        <label for="sysconfigEmail">
            <span class="akion-email"></span>
	        <?php echo \Awf\Text\Text::_('SOLO_SYSCONFIG_EMAIL'); ?>
        </label>
        <section id="sysconfigEmail">
	        <?php echo $this->loadAnyTemplate('Sysconfig/email'); ?>
        </section>

	    <?php if(!$inCMS): ?>
        <label for="sysconfigDatabase">
            <span class="akion-ios-box"></span>
	        <?php echo \Awf\Text\Text::_('SOLO_SETUP_SUBTITLE_DATABASE'); ?>
        </label>
        <section id="sysconfigDatabase">
	        <?php echo $this->loadAnyTemplate('Sysconfig/database'); ?>
        </section>
	    <?php endif; ?>
    </div>

    <div class="akeeba-hidden-fields-container">
        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="token" value="<?php echo $this->container->session->getCsrfToken()->getValue(); ?>">
    </div>
</form>

<script type="text/javascript">
// Callback routine to close the browser dialog
var akeeba_browser_callback = null;

akeeba.System.documentReady(function ()
{
	// Push some custom URLs
	akeeba.Setup.URLs['ftpBrowser'] = '<?php echo Escape::escapeJS($router->route('index.php?view=ftpbrowser')) ?>';
	akeeba.Setup.URLs['sftpBrowser'] = '<?php echo Escape::escapeJS($router->route('index.php?view=sftpbrowser')) ?>';
	akeeba.Setup.URLs['testFtp'] = '<?php echo Escape::escapeJS($router->route('index.php?view=configuration&task=testftp')) ?>';
	akeeba.Setup.URLs['testSftp'] = '<?php echo Escape::escapeJS($router->route('index.php?view=configuration&task=testsftp')) ?>';
});

</script>
