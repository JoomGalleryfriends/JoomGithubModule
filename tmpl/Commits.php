<?php
/**
 * @version    1.0.0
 * @package    Mod_GitHub
 * @author     Manuel Häusler <tech.spuur@quickline.com>
 * @copyright  2013 Ben Tasker . All rights reserved.
 * @copyright  2021 Manuel Häusler . All rights reserved.
 * @license    GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @source     https://github.com/bentasker/mod_bgithub_feed
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');

$commits = $github->getCommits();
$X = 0;

echo '<ul class="list-striped">';

foreach ($commits as $commit)
{
  if ($X == $dispcount){ break; }

  //print_r($commit);
  //echo "<br /><br />\n\n\n\n";

  $text      = $commit->commit->message;
  $url       = "https://github.com/$owner/$repo/commit/{$commit->sha}";
  $curl      = "https://github.com/$owner/$repo/tree/{$commit->sha}";
  $author    = $commit->committer->login;
  $authorurl = "https://github.com/$author";
  $cdate     = date($dateformat,strtotime($commit->commit->committer->date));
  $gravatar  = "<img class='bGitHubGravatar' src='{$commit->committer->avatar_url}'>";
  $cno       = substr($commit->sha,0,10);
  ?>

  <li class="commit" id="commit<?php echo $X;?>">
    <div class="indCommitwrap">

      <?php if ($displayimg):?>
          <div class='commitGrav'><?php echo $gravatar; ?></div>
      <?php endif; ?>

      <div class="commitcontent">
        <div class="committext" id="CommitText<?php echo $X;?>">
          <?php echo $text; ?><br />
      	  <div class='CommitDets'>
    	      <?php if ($dispCommitter):?>
    		      <a class='commitAuthor' target=_blank href="<?php echo $authorurl;?>"><?php echo $author; ?></a>
    	      <?php endif; ?>
      	     - <span class='CommitDate'><?php echo $cdate; ?></span>
      	  </div>
        </div>
      </div>

      <div class='commitPos'>

        <div class='commitButton'>
          <a href='<?php echo $url; ?>' target=_blank class='commitLink'><?php echo $cno;?></a>
        </div>

        <a class='commitTree' href='<?php echo $curl;?>' target='_blank'>Browse Code</a>
      </div>
    </div>
  </li>

  <?php
  $X++;
}

echo '</ul>';
