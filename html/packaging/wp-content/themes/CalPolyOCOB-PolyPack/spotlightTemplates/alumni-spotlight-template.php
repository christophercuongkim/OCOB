<?php get_header(); ?>
<!-- Spotlight Template -->
<?php
/**
  *  Template Name: Spotlight Template
*/


 get_sidebar('area'); 
 ?>
<div id="content">
  <div id="contentLine"></div>
  <style>
/* half of the screen and floated left */
.column-2 {
	width: 48%;
	display: inline-block;
	float: left;
}
/* makes sure each row fills up the width and moves it over 15px */
.row-wrapper{
	width: 100%;
	margin-left: 15px;
}
/* changes all of the bold text to quoted text */
.descriptionHolder strong{
	color: #A09546;
	display: block;
	margin-top: 10px;
	margin-bottom: 10px;
	/*font-size: larger;*/
	/*font-weight: normal;*/
}
/* Fixes the "Class Of" span to display the correct way */
.descriptionHolder .column-2 span{
	color: black;
	margin-top: 0;
	margin-bottom: 0;
}
/* sets the size of the spotlight picture */
.descriptionHolder .column-2 img{
	max-width: 150px;
}
/* makes sure each column doesnt touch each other innopropriately */
.descriptionHolder .column-2{
	margin-bottom: 15px;
	margin-right: 15px;
}
/* bolds the name */
.name{
	font-weight: bold;
}
/* fixes title formatting */
.title{
	font-weight: normal;
}
/* gets rid of the bullets for the list, looked gross */
.descriptionHolder .column-2 ul {
	list-style: none;
}
/* seperates out each list item from getting too close */
.descriptionHolder .column-2 ul li{
	margin-bottom: 5px;
}
/* fixes ul displayed with each side */
.splitLeft ul, .splitRight ul {
	margin: 0px 0px 10px 10px;
    padding-left: 2px;
    list-style: outside none disc;  
}
/* fixes li displayed with each side */
.splitLeft ul li, .splitRight ul li {
    padding: 3px 0px;
    padding-right: 4px;
    list-style: outside none disc;  
}
/* makes sure the right side has 5px of padding on the right */
.splitRight {
	padding-right: 5px;
}
/* the paragraphs margins were making things look way too far aprart */
p{
	margin-top: 0px;
}
/* splits the articles from each other */
.splitter{
	border-top: 2px solid #29551A;
	width: 100%;
	padding-bottom: 10px;
	float: left;
}
/* Happens when you get to ipad size */
@media only screen and (max-width: 760px) {
/* 	make each colum the whole screen with and center them */
	.descriptionHolder .column-2{
		width: 98%;
		text-align: center;
	}	
/* 	make each description fill the whole width as well */
	.descriptionHolder{
		width: 98%;
		margin-bottom: 25px;
	}
/* 	Fixed the wonky paragraph styles on mobile */
	p {
		float: left;
		margin-right: 15px;
	}
/* 	the image looked wierd, this fixed it */
	.widget img {
		margin-left: 22%;
	}
/* 	gets rid of splitter because the centered picture was enough to distringuish it from the next */
	.splitter{
		display: none;
	}
}


</style>
<!-- content -->

<?php
	$rows = get_field('spotlights');
	if($rows){
		$num = count($rows);
		$seen = 0;
		$isLeft = true;
		?>
		<div class="row-wrapper descriptionHolder">
			<h1 style="margin-bottom: 5px;">Spotlights</h1>
			<?php
			foreach($rows as $row)
			{
				$seen++;
				//get rid of dots and then split by new lines and then make a list out of them
				$listOfCredentials =  preg_split("\n", str_replace("•","",$row['list_of_credentials']));
				$credentials = "<ul>";
				foreach($credentials as $cred){
					$credentials .= "<li>" . $cred . "</li>";
				}
				$credentials.= "</ul>";
				//replace all new line with html breaks
				$description = $row["description"];
				//alternate each profile, one left, one right
				if($isLeft){
					echo '<div class="splitLeft" style="margin-right: 15px;">';
				}else{
					echo '<div class="splitRight">';
				}
				$isLeft = !$isLeft;
				?>
					<div class="column-2">
						<img src="<?php echo($row['picture']); ?>">
						
						<h2><?php echo($row['name']); ?></h2>
						<?php if($row['title'] != '' && strlen($row['title']) > 0) { ?>
							<h3 style="padding-right: 8px;"><?php echo($row['title']); ?></h3>
						<?php } ?>
						<?php if($row['graduation_year'] != '' && strlen($row['graduation_year']) > 0) { ?> 
							<span style="font-size: large;" class="classOf"><i>Class of <?php echo($row['graduation_year']); ?></i></span>
						<?php } ?>
					    
						<?php if($credentials != '<ul><li></li></ul>') { ?> 
							<i><?php echo($credentials); ?></i>
						<?php } ?>	
					</div>
					<?php print($description); ?>
				</div>
				<?php
				//this is after the right is processed and there are more spotlights to display
				if($isLeft && $seen < $num){
					echo "<div class='splitter'></div>";
				}
			}
	}?>
<!-- end of content -->
</div></div>

<div class="clear"></div>
<?php get_footer(); ?>
