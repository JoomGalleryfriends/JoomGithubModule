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

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$github = new modBGitHubHelper;
$github->setparams($params);

$document = JFactory::getDocument();
$document->addStyleSheet("modules/mod_github/assets/mod_github.css");


$dateformat    = $params->get('DateFormat');
$displayimg    = $params->get('CommitImg');
$owner         = $params->get('Owner');
$repo          = $params->get('repo');
$dispcount     = $params->get('DispRecords');
$dispCommitter = $params->get('DispCommitter');
$suffix        = $params->get('ClssSuffix');


require JModuleHelper::getLayoutPath('mod_github', 'default');
