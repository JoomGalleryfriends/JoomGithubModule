<?php
/**
 * @version    1.0.0
 * @package    Mod_GitHub
 * @author     Manuel Häusler <tech.spuur@quickline.com>
 * @copyright  2021 Manuel Häusler
 * @license    GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @source     https://github.com/bentasker/mod_bgithub_feed
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>

<div class="modBGitHubWrap<?php echo $suffix; ?>" <?php if ($params->get('DivSize') > 0): ?> style="width: <?php echo $params->get('DivSize');?>;"<?php endif;?>>
  <div class="CommitWrapper">
	<?php
		$layout = $params->get('layout', 'default');

		if ($layout != '_:default')
		{
			// Load the desired layout
			require JModuleHelper::getLayoutPath('mod_github', $layout );
		}
		else
		{
			// Default layout is essentially just the other layouts, all in one as tabs
			$document->addScript("modules/mod_github/assets/mod_github.js");
	?>
	<div class='BGHubTabSwitcher'>
	  <ul class='BGHubTabswitch nav nav-tabs'>
	    <li class='BGHubTabSwitch BGHubActitab' id='BGHubCommitsBut' onclick='switchtabs("BGHubCommits","BGHubTabContent","BGHubTabSwitch")'>Commits</li>
	    <li class='BGHubTabSwitch' id='BGHubIssuesBut' onclick='switchtabs("BGHubIssues","BGHubTabContent","BGHubTabSwitch")'>Issues</li>
	    <li class='BGHubTabSwitch' id='BGHubUserBut' onclick='switchtabs("BGHubUser","BGHubTabContent","BGHubTabSwitch")'><?php echo $owner;?></li>
	  </ul>
	</div>
	<div class="clearfix"></div>

	<div class='BGHubTabContent' id='BGHubCommitsTab'>
		<?php require JModuleHelper::getLayoutPath('mod_github', 'Commits' ); ?>
	</div>

	<div class='BGHubTabContent' id='BGHubIssuesTab' style='display: none;'>
		<?php require JModuleHelper::getLayoutPath('mod_github', 'Issues' ); ?>
	</div>

	<div class='BGHubTabContent' id='BGHubUserTab' style='display: none;'>
		<?php require JModuleHelper::getLayoutPath('mod_github', 'User' ); ?>
	</div>

	<?php
		} // Layout switch ends
	?>
  </div>
</div>
