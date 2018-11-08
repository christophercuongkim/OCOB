<!--
/************************************************************************************************
* Copyright © 2005, Paulo Avila. All Rights Reserved (pravila@calpoly.edu)
* Developed for the Orfalea College of Business website (http://www.cob.calpoly.edu/)
*
*
*
* PURPOSE
*
* This script provides the variables and functions necessary for the proper operation of the
* navigation menu for the Orfalea College of Business. See the descriptions below for more
* information about particular functions or variables.
*
* If editing this script (esecially for the first time) it would be wise to print this comment
* header to provide a reference of the code so that you don't accidentally mess up!
*
*
*
* GLOBAL VARIABLE DESCRIPTIONS
*
*   timeOut_ID - Holds the ID of a timeout sequence. Used when reseting a timeOut (as in a
*	             MouseOut event.
*   blinkCount - A counter to keep track of how many times to blink the text color. Be sure
*	             to reset to 0 before the start of each blink sequence.
*
*   img_ShowMore - the path to the bullet image indicating the menu CAN be expanded
*   img_ShowLess - the path to the bullet image indicating the menu IS ALREADY expanded
*
*   nav1_IDprefix - a string representing the prefix of every menu (nav1) id
*   nav2_IDprefix - a string representing the prefix of every sub menu (nav2) id
*
*	nav1_Element - used to hold a document element to be able to create the dynamic content
*	nav2_Element - used to hold a document element to be able to create the dynamic content
*
*	upColor - the default color (in HEX format) of the nav1 text
*	overColor - the text color (in HEX format) during a MouseOver event 
*	blinkColor - the ON color (in HEX format) used when "blinking" the text
*
*	allDepartments[] - a string array containing the names of all the departments
*	                   MAKE SURE THIS ARRAY IS BOTH UP TO DATE AND EXTREMELY ACCURATE
*                      IN THE SPELLING OF THE DEPARTMENT NAMES!
*
*	department - a string containing the department's name, used to automatically expand the corrent
*	             submenu when "showDepartment()" is called, and also used in the  "hideAll()"
*	             function to not hide the current page's department's submenu.
*	             This string is acquired from the pathArray[][] in the breadCrumb file. If a
*	             breadCrumb file does not exist in the directory, this value will be NULL.
*
*	menuName - a string representing the menu to perform actions on.
*	           Initialized in beginCountDown() function.
*
*
*
* FUNCTION DESCRIPTIONS
*
* void showDepartment()
*   - Uses the "department" variable (initialized with the value in the pathArray[][] from
*	  the breadCrumb file) to acquire the proper document element.
*   - Should be called every time a page is loaded to automatically expand the correct
*	  submenu.
*
* void begin_CountDown(string s1)
*	- Concatenates the nav1_IDprefix and nav2_IDprefix variables to the s1 parameter to define
*	  the proper document ID to be able to define the document element to expand.
*	- Should be called on every MouseOver event of the nav1 menu items.
*	- Calls a function to blink the text after a certain delay.
*
* void cancel_CountDown()
*	- Stops the blinking and prevents the menu from expanding by clearing the timeout
*     and restoring the color of the text.
*
* void blinkText()
*	- Recursive function that change the color of the text back and forth before calling
*	  a function that actually expands the correct menu.
*	- Manages the blinkCount global variable to keep track of how many "blinks" to perform.
*
* void displayItem()
*	- Expands a the menu of the document elements assigned to the global variables nav1_Element
*	  and nav2_Element by:
*		1) changing the style.display value to 'block'
*		2) changing the bullet image to the path specified by img_ShowLess
*
* void hideAll()
*	- Hides all the sub menus EXCEPT for the one corresponding to the page's current department
*	  acheives this by checking the department varaiable (GLOBAL VARIABLE DESCRIPTIONS).
*	- Uses the global array 'allDepartments[]' to loop through all the sub menus. MAKE SURE THIS
*	  GLOBAL ARRAY IS UP TO DATE!
*
* element elementExists(string s1)
*	- A wrapper function to return the document element with id equal to param s1.
*	- Alerts a meaningful error report if it doesn't exist.
*
************************************************************************************************/

var timeout_ID;
var blinkCount = 0;

var img_ShowMore = '../images/layout/nav_bullet.gif';
var img_ShowLess = '../images/layout/nav_bullet_over.gif';

var nav1_IDprefix = "nav1:";
var nav2_IDprefix = "nav2:";

var nav1_Element;
var nav2_Element;

var upColor = "#FFFFFF";
var overColor = "#CCCCCC";
var blinkColor = "#777777";

var allDepartments = new Array("About the College",
                                "Academic Fee",
                                "Advising Center",
                                "Prospective Students",
                                "Undergraduate Programs",
                                "Graduate Programs",
                                "Faculty & Staff",
                                "Student Resources",
                                "Alumni",
                                "Business Resources",
                                "Giving");

var department = null;
if (pathArray.length > 1)
  var department = pathArray[1][0];

var menuName;


function showDepartment()
{
  if (department != null)
  {
    nav2_Element = document.getElementById(nav2_IDprefix + department);
    nav1_Element = document.getElementById(nav1_IDprefix + department);
  
    if (nav2_Element && nav1_Element)
      displayItem();
  }
}


function begin_CountDown(menuToOpen)
{
  menuName = menuToOpen;
  
  nav2_Element = elementExists(nav2_IDprefix + menuName);
  nav1_Element = elementExists(nav1_IDprefix + menuName);
  
  if (nav2_Element && nav1_Element)
  {
    blinkCount = 0;
	nav1_Element.style.color = overColor;
    timeout_ID = setTimeout("blinkText()", 700);
  }
}



function cancel_CountDown()
{
  if (timeout_ID)
  {
    clearTimeout(timeout_ID);
    nav1_Element.style.color = upColor;
  }
}


function blinkText()
{
  if (blinkCount <= 6 && nav2_Element.style.display != 'block')
  {
    if (blinkCount % 2 == 0)
      nav1_Element.style.color = upColor;
	else
	  nav1_Element.style.color = blinkColor;
    blinkCount++;
	timeout_ID = setTimeout("blinkText()", 80);
  }
  else
  {
    displayItem();
  }
}


function displayItem()
{
    nav2_Element.style.display = 'block';
    //nav1_Element.style.backgroundImage = "url(" + img_ShowLess + ")";
    //nav1_Element.style.backgroundRepeat = "no-repeat";
}


function hideAll()
{
  var i;


  for (i = 0; i < allDepartments.length; i++)
  {
    if ( department != allDepartments[i] )
    {
      nav2_Element = elementExists(nav2_IDprefix + allDepartments[i]);
      nav1_Element = elementExists(nav1_IDprefix + allDepartments[i]);

      if (nav2_Element && nav1_Element)
	  {
	    nav2_Element.style.display = 'none';
        //nav1_Element.style.color = upColor;
        //nav1_Element.style.backgroundImage = "url(" + img_ShowMore + ")";
        //nav1_Element.style.backgroundRepeat = "no-repeat";
	  }
    }
  }
}


function elementExists(ID)
{
  var element = document.getElementById(ID);

  if ( !element )
  {
//    alert("This document does NOT contain the element with:\n\n    id=\"" + ID + "\"\n\nDon't worry, this error is a problem for the person who maintains this webpage.");
    element = 0;
  }
  
  return element;
}
-->
