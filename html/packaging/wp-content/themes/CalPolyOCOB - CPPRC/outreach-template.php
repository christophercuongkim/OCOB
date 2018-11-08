<?php //File: outreach.php ?>
<?php get_header(); ?>

<?php
/**
  *  Template Name: OutReach Template
*/

 get_sidebar('area'); 
 ?>
 <!-- Robin does not like using these fonts -->
 <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'> 
<div id="content">
  <div id="contentLine"></div>
  <style>
#bottomPost {
	margin-top: -10px;
}
.top{
	text-align: center;
}
.column-2 {
	width: 48%;
	display: inline-block;
	float: left;
}

.row-wrapper{
	width: 100%;
	margin-left: 15px;
}

.descriptionHolder strong{
	color: #A09546;
	display: block;
	margin-top: 10px;
	margin-bottom: 10px;
	/*font-size: larger;*/
	/*font-weight: normal;*/
}

.descriptionHolder .column-2 span{
	color: black;
	margin-top: 0;
	margin-bottom: 0;
}

.descriptionHolder .column-2 img{
	max-width: 150px;
}

.descriptionHolder .column-2{
	margin-bottom: 15px;
	margin-right: 15px;
}

.description, .classOf, .name{
	/*font-family: 'Lato', sans-serif;
	font-weight: lighter;*/
}

.description{
	/*font-size: 14px;
	line-height: 125%;*/
}

.name{
	font-weight: bold;
}

.title{
	/*font-family: 'Lato', sans-serif;*/
	font-weight: normal;
}

.descriptionHolder .column-2 ul {
	list-style: none;
}

.descriptionHolder .column-2 ul li{
	margin-bottom: 5px;
}

.splitLeft ul, .splitRight ul {
	margin: 0px 0px 10px 10px;
    padding-left: 2px;
    list-style: outside none disc;  
}

.splitLeft ul li, .splitRight ul li {
    padding: 3px 0px;
    padding-right: 4px;
    list-style: outside none disc;  
}

.splitRight {
	padding-right: 5px;
}

@media only screen and (max-width: 760px) {
	.descriptionHolder .column-2{
		width: 98%;
		text-align: center;
	}	
	
	.descriptionHolder{
		width: 98%;
		margin-bottom: 25px;
	}
	p {
		float: left;
		margin-right: 15px;
	}
	.widget img {
		margin-left: 22%;
	}
}


</style>
<!-- content -->

	<div class="row-wrapper">
		<h1 style="margin-bottom: 5px;">OutREACH</h1>
		<img src="http://www.cob.calpoly.edu/media/images/outReach/outReachLogo.jpeg">
		<div class="splitLeft" style="margin-right: 15px;"> <!-- column-2 descriptionHolder -->
			<div class="column-2">
				<h3 style="padding-right: 5px;"><?php echo("Test"); ?></h3>
				
			</div>
			<p><?php echo(get_the_content()); ?></p>
		</div>
		<div class="splitRight">
			<div class="column-2">
			</div>
			<p><?php print("hello"); ?></p>
		</div>
	</div>
	
<!-- end of content -->
</div>
<div class="clear"></div>
<?php get_footer(); ?>
