<?php
/**
 * @version    1.0.0
 * @package    Mod_JoomGitHub
 * @author     Manuel Häusler <tech.spuur@quickline.com>
 * @copyright  2013 Ben Tasker . All rights reserved.
 * @copyright  2021 Manuel Häusler . All rights reserved.
 * @license    GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @source     https://github.com/bentasker/mod_bgithub_feed
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');

$dispcount     = $params->get('DispRecords');
$dispCommitter = $params->get('DispCommitter');

$issues = $github->getIssues($params->get('IssueStatus'), $params->get('IssueSort'), $params->get('IssueOrder'), $params->get('IssueLabels'));

$X = 0;

echo '<ul class="list-striped">';

if ($issues == null)
{
  echo JText::_('MOD_GITHUB_NOISSUE');
}
else
{
  foreach ($issues as $issue)
  {
    if ($X == $dispcount){ break; }
    $title      = str_replace("'","&apos;",htmlspecialchars($issue->title));
    $issueno    = $issue->number;
    $url        = $issue->html_url;
    $created    = date($dateformat,strtotime($issue->created_at));
    $status     = $issue->state;
    $labels     = array();
    if($issue->labels)
    {
      foreach ($issue->labels as $label)
      {
        array_push($labels, $label->name);
      }
    }
    $body       = str_replace("'","&apos;",htmlspecialchars($issue->body));
    $creator    = $issue->user->login;
    $creatorurl = "http://github.com/$creator";

    $gravatar = "<img class='bGitHubGravatar' src='{$issue->user->avatar_url}'>";

    ?>
    <li class="commit" id="commit<?php echo $X;?>">
      <div class="indCommitwrap">
        <?php if ($displayimg):?>
            <div class='commitGrav'><?php echo $gravatar; ?></div>
        <?php endif; ?>

        <div class="commitcontent">
          <div class="committext" id="CommitText<?php echo $X;?>">
            <span class='issueNo'>#<?php echo $issueno;?></span>
            <a class='IssueURL' id='BGitHubIssueUrl<?php echo $X; ?>' href='<?php echo $url; ?>' target='_blank'><?php echo $title; ?></a>
            <br />
            <div class='issueDets'>
              <?php if ($dispCommitter):?>
                by
                <a class='commitAuthor' target='_blank' href="<?php echo $creatorurl;?>"><?php echo $creator; ?></a>
              <?php endif; ?>
              <span class='CommitDate'><?php echo $created; ?></span>
            </div>
          </div>
        </div>

        <div class='issuePos'>
          <?php foreach ($labels as $label) : ?>
            <div class='issueType <?php echo str_replace(" ","",$label); ?>'>
              <?php echo $label;?>
            </div>
          <?php endforeach; ?>
        </div>

        <div class='issueStatus IssStatus<?php echo $status; ?>'><?php echo $status; ?></div>
      </div>
    </li>

    <?php
    $X++;
  }
}

echo '</ul>';
