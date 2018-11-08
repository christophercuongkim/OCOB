<!--
/************************************************************************************************
* Copyright © 2005, Paulo Avila. All Rights Reserved
*
* This script checks the content of the "href" attribute of every "a" tag inside the content
* of the document. Depending on its value, the "rel" attribute is set so that the style sheet
* places an image next to the link to label the type of document it links to.
*
* Here is a description of the variables:
*
* 	- contentLinks		an array of all the 'a' tags inside the 'content' of the document
* 	- hrefText			the text contained inside the href attribute
*
* Link to this script by placing the following code in the head of your document
* (with the appropriate src path):
*
*	<script src="link.js" type="text/javascript"></script>
************************************************************************************************/

function links()
{
  var i;
  var extension;
  var hrefText;
  var contentLinks;
 
  // if the browser supports the DOM
  if ( document.getElementById && document.getElementsByTagName )
  {
    contentLinks = document.getElementById("content").getElementsByTagName('a');

    for (i = 0; i < contentLinks.length; i++)
    {
      // if the link has a href attribute
      if ( (hrefText = contentLinks[i].getAttribute('href')) && hrefText.length > 0)
      {
        // if the link isn't for an image
        //if (contentLinks[i].innerHTML)
        //{
          extension = getExtension(hrefText).toLowerCase();

          if (extension == ".pdf")
            contentLinks[i].rel = "pdf";

          else if (extension == ".doc")
            contentLinks[i].rel = "doc";

          else if (extension == ".xls")
            contentLinks[i].rel = "xls";

          else if (extension == ".ppt")
            contentLinks[i].rel = "ppt";

          else if (contentLinks[i].target == "_blank")
            contentLinks[i].rel = "new";

          else if ( hrefText.substr(0, 7) == "http://" )
            contentLinks[i].rel = "external";

          else if ( hrefText.charAt(0)  == "#" || hrefText.indexOf(".html#") != -1)
            contentLinks[i].rel = "anchor";

          else if ( hrefText.substr(0, 7) == "mailto:" )
            contentLinks[i].rel = "email";
        //}
      }
    }
  }
}

function getExtension(string)
{
  var ext = null;
  var theLength = string.length;
  var i = theLength - 1;

  for ( i ; i > 0; i--)
    if (string.charAt(i) == '.')
      break;

  ext = string.substr(i, theLength-i);

  return ext;
}
-->
