<?php// File: Stats.php ?><?php get_header(); ?><?php
/**
  *  Template Name: Stats
*/
 get_sidebar(); ?>
<link href='https://fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>

<div id="content">
    <div id="contentLine"></div>
	<script src="/wp-content/themes/CalPolyOCOB2012/js/ChartJS/Chart.min.js"></script>
	<script>
		var options = {
		    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		    scaleBeginAtZero : true,

		    //Boolean - Whether grid lines are shown across the chart
		    scaleShowGridLines : true,

		    //String - Colour of the grid lines
		    scaleGridLineColor : "rgba(0,0,0,.05)",

		    //Number - Width of the grid lines
		    scaleGridLineWidth : 1,

		    //Boolean - Whether to show horizontal lines (except X axis)
		    scaleShowHorizontalLines: true,

		    //Boolean - Whether to show vertical lines (except Y axis)
		    scaleShowVerticalLines: false,

		    //Boolean - If there is a stroke on each bar
		    barShowStroke : true,

		    //Number - Pixel width of the bar stroke
		    barStrokeWidth : 0,

		    //Number - Spacing between each of the X value sets
		    barValueSpacing : 5,

		    //Number - Spacing between data sets within X values
		    barDatasetSpacing : 1,

		    //String - A legend template
		    legendTemplate : "",

			// Boolean - If we want to override with a hard coded scale
			scaleOverride: true,

			// ** Required if scaleOverride is true **
		    // Number - The number of steps in a hard coded scale
		    scaleSteps: 9,
		    // Number - The value jump in the hard coded scale
		    scaleStepWidth: 1000,
		    // Number - The scale starting value
		    scaleStartValue: 0,

		    // String - Template string for single tooltips
			tooltipTemplate: "<%= value %> applications",

		}
	</script>
    <div id="mainLeftFull">
	    <div class="post">
            <a id="topH1"></a>
	        <?php
	        if(have_posts()) : ?><?php while(have_posts()) : the_post();
				echo get_the_post_thumbnail();
	            echo inner_doc_nav(get_the_content(), get_post_custom());
	            if( have_rows('stats_data') ):

				     // loop through the rows of data
				    while ( have_rows('stats_data') ) : the_row();

				        if( get_row_layout() == 'section_heading' ):

				        	$sectionHeadingText = get_sub_field('section_heading');
				        	$size = get_sub_field('size');?>
				        	<?php echo '<h1>'.$sectionHeadingText.'</h1>';
					        	$picture = get_sub_field('picture');
					        	if(count($picture) > 0){
						        	echo "<img class='statsHeaderImg' src='".$picture["url"]."'/>";
					        	}
				        	?>
				        	<?php
				        elseif( get_row_layout() == 'stat' ):

				        	$data = get_sub_field('data');
				        	$statText = get_sub_field('stat_text');
				        	$source = get_sub_field('source');?>
				        	<div class="onebyone">
					            <div class="stat"><?php echo($data); ?></div>
					            <div class="description"><?php echo($statText); ?></div>
					            <?php if(strlen($source) > 0):?><div class="mini"><?php echo($source); ?></div><?php endif; ?>
				            </div>
							<?php
				        elseif( get_row_layout() == 'bar_graph' ):

				        	$title = get_sub_field('title');?>
							<h2 class="center"><?php echo($title); ?></h2>
							<canvas id="data_<?php echo($title); ?>" width="400" height="400"></canvas>
							<script>
								<?php
									$xs = array();
									$ys = array();
									if( have_rows('data_points') ):
									    while ( have_rows('data_points') ) : the_row();
									        $x = get_sub_field('x_value');
									        $y = get_sub_field('y_value');
									        array_push($xs, $x);
									        array_push($ys, $y);
									    endwhile;
									endif;

								?>
								var ctx = document.getElementById("data_<?php echo($title); ?>").getContext("2d");
								var data = {
								    labels: [<?php for($i = 0; $i < sizeof($xs);$i++){echo '"'.$xs[$i].'",';} ?>],
								    datasets: [
								        {
								            label: "Enrollemnt Numbers",
								            fillColor: "rgba(4,86,66,1)",
								            strokeColor: "rgba(4,86,66,1)",
								            highlightFill: "rgba(4,86,66,.8)",
								            highlightStroke: "rgba(4,86,66,1)",
								            data: [<?php for($i = 0; $i < sizeof($ys);$i++){echo $ys[$i].',';} ?>]
								        },
								    ]
								};
								var myBarChart = new Chart(ctx).Bar(data, options);
							</script>
							<?php
				        endif;

				    endwhile;

				endif;
	        ?>
        </div><!--post-->
        <?php endwhile;
              endif; ?>
    </div><!--mainLeftFull-->
</div><!-- content -->
<style>
	.onebyone{
		width: 47%;
		text-align: center;
		display: inline-block;
		vertical-align: top;
		margin: 1%;
		font-family:'Asap', Arial, Helvetica, sans-serif;
		margin-bottom: 25px;
	}
	.onebyone:hover{

	}
	.onebyone .stat{
		color:#045642;
		font-size: 60px;
		font-weight: 600;
	}
	.onebyone .description{
		font-size: 20px;
		color:#4D4F53;
		line-height: 110%;
	}
	.onebyone .mini{
		font-size: 12px;
		color:#4D4F53;
		line-height: 110%;
		margin-top: 6px;
	}
	.center{
		margin: 0px auto;
		display: block;
		text-align: center;
	}
	canvas{
		margin: 0 auto;
		display: block;
		-webkit-tap-highlight-color: rgba(0,0,0,0);
	}

	@media (max-width: 600px) {
	  	.onebyone{
	  		width: 98%;
		}
	}
	h1{
		text-decoration: underline;
	}
	.statsHeaderImg{
		width: 100%;
		margin-top: 10px;
	}
</style>
</div>
<div class="clear"></div><?php get_footer(); ?>

