/**
 * @version    1.0.0
 * @package    Mod_GitHub
 * @author     Manuel Häusler
 * @copyright  2021 Manuel Häusler
 * @license    GNU General Public License Version 2 oder später; siehe LICENSE.txt
 */

function switchtabs(active,cls,btnClass){

   var tabs = document.getElementsByClassName(cls),
   tabbuttons = document.getElementsByClassName(btnClass);

     for (var i=0; i<tabs.length; i++)
      {

	tabs[i].style.display = "none";
      }



     for (var i=0; i<tabbuttons.length; i++)
      {
	tabbuttons[i].className = 'BGHubTabSwitch';
      }

    document.getElementById(active+'Tab').style.display = 'block';
    document.getElementById(active+'But').className = 'BGHubActitab BGHubTabSwitch';


}
