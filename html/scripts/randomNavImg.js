<!--
/************************************************************************************************
* Copyright © 2005, Paulo Avila. All Rights Reserved
*
* This script contains an array with the names of the images used as the background for
* the side navigation.
*
* Here is a description of the variables used to display the date/time:
*
* 	- path			the FULL path to the folder containing the images in the array
*	- imgArray[]	array containing the names of the images
*	- imgNum		the index number used to access the daily Banner Array
*
*
* Link to this script by placing the following code in the head of your document
* (with the appropriate src path):
*
*	<script type="text/javascript" src="randomNavImg.js"></script>
*
************************************************************************************************/

var path = "http://www.cob.calpoly.edu/images/layout/";
var errorPage = 0;

var imgArray = new Array(7);
imgArray[0] = "nav_bg_0.jpg";
imgArray[1] = "nav_bg_1.jpg";
imgArray[2] = "nav_bg_2.jpg";
imgArray[3] = "nav_bg_3.jpg";
imgArray[4] = "nav_bg_4.jpg";
imgArray[5] = "nav_bg_5.jpg";
imgArray[6] = "nav_bg_6.jpg";

var today = new Date();
var imgNum = today.getDay();


function randomizeNavImg()
{
  var element = document.getElementById("nav");

  if ( element )
  {
    if (errorPage == 0)
      element.style.backgroundImage = "url(" + path + imgArray[imgNum] + ")";
    else
      element.style.backgroundImage = "url(" + path + "nav_bg_error.jpg)";
      
    element.style.backgroundRepeat = "no-repeat";
    element.style.backgroundAttachment = "fixed";
  }
}
-->