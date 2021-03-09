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

$user = $github->getUser($owner);

if (!$user) { return ; }

$url      = $user->html_url;
$joined   = date($params->get('JoinedDate'),strtotime($user->created_at));
$company  = $user->company;
$locat    = $user->location;
$gravatar = "<img class='bGitHubGravatar' src='{$user->avatar_url}'>";
$blog     = $user->blog;

?>

<table class='GHubUserInfo'>
  <tbody>
    <tr>
      <td colspan="3" class='GHubUser GHubCell'>
        <div class='GHubLogo'></div>
        <h3><a href='<?php echo $url;?>' target='_blank'><?php echo $owner;?></a> on GitHub</h3>
      </td>
    </tr>
    <tr>
      <td class='GHubJoined GHubCell'>
        Joined
        <div class='GHubJoinedDate GHubContent'>
		      <?php echo $joined;?>
        </div>
      </td>
      <?php if (!empty($locat)):?>
        <td class='GHubLocation GHubCell'>
          &nbsp;
          Location
          <div class='GHubLocationl GHubContent'>
            <?php echo $locat; ?>
          </div>
        </td>
      <?php endif; ?>
    </tr>

    <?php if (!empty($company) || !empty($blog)):?>
      <tr>
        <?php if (!empty($company)):?>
          <td class='GHubCo GHubCell'>
            &nbsp;
    	      Company
    		    <div class='GHubCoNme GHubContent'>
    		      <?php echo $company; ?>
    		    </div>
          </td>
        <?php endif;?>
        <?php if (!empty($blog)):?>
          <td class='GHubBlog GHubCell'>
            &nbsp;
            Blog<br />
            <span class='GHubBlogNme GHubContent'>
              <a href='<?php echo $blog; ?>' target='_blank'><?php echo $blog; ?></a>
            </span>
          </td>
        <?php endif; ?>
      </tr>
    <?php endif; ?>

    <?php if ($params->get('UserListRepos')): ?>
      <tr class='UserRepos'>
        <td colspan="3"><h3>User's Repositories</h3></td>
      </tr>

      <?php
      $userrepos = $github->getUsersRepos($owner);
      $userrepofilter = $params->get('UserRepoFilter');
      $filt = explode(",",$userrepofilter);

      $X = 0;

      foreach ($userrepos as $repo)
      {
        if ((!empty($userrepofilter)) && ((in_array($repo->name,$filt))))
        {
          continue;
        }

        if ($X == $dispcount){ break; }

        $reponame = $repo->name;
        $url = $repo->html_url;
        $desc = $repo->description;
        $lang = $repo->language;
        $lastupdate = date( $params->get('RepoDate'), strtotime($repo->updated_at));
      ?>
      <tr class='UserRepo'>
        <td colspan="3">
          <div class='UserRepoNme'>
            <span class='UserRepoName'><a href='<?php echo $url; ?>' target='_blank'><?php echo $reponame; ?></a></span>
            <br />
            <span class='UserRepoDesc'><?php echo $desc; ?></span><br />
            <span class='repoupdDate'>Last updated <?php echo $lastupdate;?></span>
          </div>
          <div class='repoLang'>
            <?php echo $lang; ?>
          </div>
        </td>
      </tr>
      <?php
      }


    endif;?>

  </tbody>
</table>
