<!--
/************************************************************************************************
* Copyright © 2005, Paulo Avila. All Rights Reserved
*
* This script provides the neccesary variables and functions for displaying the current date,
* time, and last modified date on a web page.
*
* Here is a description of the variables used to display the date/time:
*
* 	- modifiedDay		day of the week of last save (integer representing the week day)
* 	- modifiedMonth		month of last save
* 	- modifiedDate		day of the month of last save
* 	- modifiedYear		year of last save (yyyy)
*
*	- day				current day of the week (integer representing the week day)
*	- month				current month
*	- date				current day of the month
*	- year				current year (yyyy)
*	- hours				hour that the page was loaded
*	- minutes			minute that the page was loaded
*	- seconds			seconds that the page was loaded
*
*
* Link to this script by placing the following code in the head of your document
* (with the appropriate src path):
*
*	<script type="text/javascript" src="date.js"></script>
*
* and display the date/time by properly using the variables above in your document (example):
*
* 	<script type="text/JavaScript">
*	  document.write( modifiedMonth + '/' + modifiedDate + '/' + modifiedYearSH );
*	</script>
************************************************************************************************/

var dayArray = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
var monthArray = new Array("January","February","March","April","May","June","July","August","September","October","November","December");


/***********************************************************
******** Variables for displaying last modified date *******
***********************************************************/
var lastUpdated = new Date(document.lastModified);

//var modifiedDay = dayArray[ lastUpdated.getDay() ];
var modifiedMonth = lastUpdated.getMonth() + 1;
var modifiedDate = lastUpdated.getDate();
var modifiedYear = lastUpdated.getYear();

// prevents problem in Netscape when displaying year
modifiedYear = (modifiedYear < 1000) ? modifiedYear + 1900 : modifiedYear;

// changes the year from long format (yyyy) to short hand format (yy)
var modifiedYearSH = modifiedYear - 2000;
if (modifiedYearSH < 10) {
  modifiedYearSH = '0' + modifiedYearSH;
}


/***********************************************************
******* Variables for displaying current date & time *******
***********************************************************/
var today = new Date();
var day = dayArray[ today.getDay() ];
var month = monthArray[ today.getMonth() ];
var date = today.getDate();
var year = today.getYear();
var hours = today.getHours();
var minutes = today.getMinutes();
var seconds = today.getSeconds();


//for a 12-hour clock instead of a 24-hour clock
var dn = "am";
if (hours >= 12) {
  dn = "pm";
  if (hours > 12)
  hours = hours - 12;
}

//prevents a single digit to be displayed in the minutes
if (minutes < 10)
	minutes = "0" + minutes;
-->
