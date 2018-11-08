<?php// File: sidebar-polypack.php ?>

<div id="rightCol">


<?php
if(!function_exists('get_post_top_ancestor_id')){
/**
 * Gets the id of the topmost ancestor of the current page. Returns the current
 * page's id if there is no parent.
 *
 * @uses object $post
 * @return int
 */
function get_post_top_ancestor_id(){
    global $post;

    if($post->post_parent){
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }

    return $post->ID;
}}
?>

<?php
	$id = get_the_ID();
	if($id == 119){

	} elseif($id == 7){
	?>
	<h2>GOLD LEVEL SPONSORS</h2>
<ul>
<li><a target="_blank" href="http://www.pregis.com/"> <img src="http://www.cob.calpoly.edu/polypack/files/2016/02/pregislogo.jpg" alt="Pregis logo" height="63" width="179"/></a> </li>
  <li><a target="_blank" href="http://www.ista.org/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/ISTA.jpg" alt="ISTA logo" height="74" width="179"/></a></li>
  <li><a target="_blank" href="http://www.westpak.com/"> <img src="http://www.cob.calpoly.edu/polypack/files/2016/01/westpack.jpg" alt="West Pack logo" height="34" width="179"/></a></li>
  <li><a target="_blank" href="http://www.dow.com/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/dow.jpg" alt="Dowlogo" height="63" width="179"/></a></li>
  <li><a target="_blank" href="http://www.rightpaq.com/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/rightpaqlogo.jpg" alt="RightPaq logo" height="44" width="179"/></a></li>
  <li><a target="_blank" href="http://www.bay-cities.com/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/01/baycities.jpg" alt="Bay Cities logo" height="24" width="179"/></a></li>
  <li><a target="_blank" href="http://www.bigheartpet.com/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/bigheartlogo.jpg" alt="Big Heart logo" height="110" width="179"/></a></li>
  <li><a target="_blank" href="http://www.morningstarco.com/index.cgi/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/morningstar.jpg" alt="Morning Star logo" height="93" width="179"/></a></li>
  <li><a target="_blank" href="http://www.lansmont.com/index.cgi/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/lansmontlogo.jpg" alt="Lansmont logo" height="49" width="179"/></a></li>
</ul>
<h2>SILVER LEVEL SPONSORS</h2>
<ul>
<li><a target="_blank" href="http://www.walmart.com/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/walmartlogo.jpg" alt="WalMart logo" height="50" width="179"/></a></li>
</ul>

<h2>SILENT AUCTION SPONSORS</h2>
<ul>
<li><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/dtbobalogo.jpg" alt="dt boba logo" height="179" width="179"/></a></li>
<li><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/subsealogo.jpg" alt="WalMart logo" height="152" width="179"/></a></li>
<li><a target="_blank" href="http://www.yelp.it/biz/fattoush-san-luis-obispo"><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/fattoushlogo.jpg" alt="WalMart logo" height="179" width="179"/></a></li>
<li><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/shellbeachliquor.jpg" alt="Shell Beach Liquor logo" height="172" width="179"/></a></li>
<li><a target="_blank" href="http://www.panolivo.com"><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/panolivologo.jpg" alt="Panolivo logo" height="272" width="179"/></a></li>
</ul>
	<?php /*
	}elseif ($id != 29 && $id != 32) { // Kayjing assked to have the sidebar removed on these pages temporaryly*/ ?>

<h2>GOLD LEVEL SPONSORS</h2>
	<ul>
		<li>
		 	<a target="_blank" href="http://www.canontradeshows.com/expo/wpack14/" class="">
			<img src="http://www.cob.calpoly.edu/polypack/files/2016/01/westpack.jpg" alt="West Pack logo" height="34" width="179" title="" style="">
			</a>
		</li>
		<li>
		 	<a target="_blank" href="http://www.cbrands.com/" class="">
			<img src="http://www.cob.calpoly.edu/polypack/files/2016/01/constellationb.jpg" alt="Constellation Brands logo" height="95" width="159" title="" style="">
			</a>
		</li>
		<li>
		 	<a target="_blank" href="http://www.teampsc.com/" class="">
			<img src="http://www.cob.calpoly.edu/polypack/files/2016/01/PSC.png" alt="Pacific Southwest logo" height="95" width="159" title="" style="">
			</a>
		</li>
		<li><a target="_blank" href="http://www.lansmont.com/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/01/Lansmont.jpg" alt="Lansmont logo" height="120" width="179"/></li></a>
		<li><a target="_blank" href="http://www.edwards.com/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/01/Edwards.jpg" alt="Edwards logo" height="50" width="25"/></li></a>
		<li><a target="_blank" href="http://www.bay-cities.com/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/01/baycities.jpg" alt="Bay Cities logo" height="24" width="179"/></li>
	</ul>

<h2>SILVER LEVEL SPONSORS</h2>
<ul>
<li><a href="http://www.canontradeshows.com/expo/wpack14/"> <img src="http://www.cob.calpoly.edu/polypack/files/2016/02/ISTA.jpg" alt="ISTA logo" height="34" width="179"/></li>
<li><a href="http://www.specright.com/"> <img src="http://www.cob.calpoly.edu/polypack/files/2016/02/spec_right.jpg" alt="SpecRight logo" height="105" width="159"style="border-style: none"/></li></a>
 <li><a href="http://www.eastman.com/Pages/Home.aspx/"> <img src="http://www.cob.calpoly.edu/polypack/files/2016/02/Eastman.jpg" alt="Eastman logo" height="105" width="159"style="border-style: none"/></li></a>
 <li><a href="http://www.dow.com/"><img src="http://www.cob.calpoly.edu/polypack/files/2016/02/dow.jpg" alt="Dowlogo" height="63" width="179"/></li></a>
</ul>
<?php }?>



</div>