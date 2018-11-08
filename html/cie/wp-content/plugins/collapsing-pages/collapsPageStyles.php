<?php
$styleOptions = array(
'kubrick' => 'Kubrick',
'twentyten' => 'Twenty Ten',
'block' => 'Block',
'noarrows' => 'No arrows'
);

$defaultStyles= array(
'kubrick' => "{ID} span.collapsing.pages {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
} 

{ID} li.widget_collapspage h2 span.sym {float:right;padding:0 .5em}
{ID} li.collapsing.pages a.self {font-weight:bold}
{ID}:before {content:'';} 
{ID}  li.collapsing.pages:before {content:'';} 
{ID}  li.collapsing.pages {list-style-type:none}
{ID}  li.collapsing.pages{
       padding:0 0 0 1em;
       text-indent:-1em;
}
{ID} li.collapsing.pages.item:before {content: '\\00BB \\00A0' !important;} 
{ID} li.collapsing.pages .sym {
   cursor:pointer;
   font-size:1.2em;
   font-family:Arial, Helvetica;
    padding-right:5px;}",

'block' => "{ID} li a {
            display:block;
            text-decoration:none;
            margin:0;
            width:100%;
            padding:0 10em 0 1em;
            }
{ID}.collapsing.pages, {ID} li.collapsing.pages ul {
margin-left:0;
padding:0;

}
{ID} li li a {
padding-left:1em;
}
{ID} li li li a {
padding-left:2em;
}
{ID} li a:hover {
            text-decoration:none;
          }
{ID} span.collapsing.pages {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
}

{ID} li.widget_collapspage h2 span.sym {float:right;padding:0 .5em}
{ID} span.sym {
float:right;
}
{ID} li.collapsing.pages a.self {
 font-weight:bold;
}
{ID}:before {content:'';} 
{ID} li.collapsing.pages {
list-style-type:none;
}
{ID} li.collapsing.pages.item:before, 
  {ID} li.collapsing.pages:before {
       content:'';
  } 
{ID}  li.collapsing.pages .sym {
  /*
   cursor:pointer;
   font-size:1.2em;
   font-family:Arial, Helvetica;
    float:left;
    padding-right:5px;
    */
}",

'twentyten' => "
{ID} span.collapsing.pages {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
} 

{ID} h3 span.sym {float:right;padding:0 .5em}
{ID} li.collapsing.pages a.self {font-weight:bold}
{ID}:before {content:'';} 
{ID} li.collapsing.pages.expand:before {content:'';} 
{ID} li.collapsing.pages.expand,
{ID} li.collapsing.pages.collapse {
       list-style:none;
       padding:0 0 0 .9em;
       margin-left:-1em;
       text-indent:-1.1em;
}
{ID} li.collapsing.pages.item {
  padding:0;
  text-indent:0;
}

{ID} li.collapsing.pages .sym {
   cursor:pointer;
   font-size:1.2em;
   font-family:Arial, Helvetica;
    padding-right:5px;}
",


'noArrows'=>
"{ID} span.collapsing.pages {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
}
{ID} li.collapsing.pages a.self {font-weight:bold}

{ID} li.widget_collapspage h2 span.sym {float:right;padding:0 .5em}
{ID}:before {content:'';} 
{ID} li.collapsing.pages:before {content:'';} 
{ID} li.collapsing.pages {list-style-type:none}
{ID} li.collapsing.pages .sym {
   cursor:pointer;
   font-size:1.2em;
   font-family:Arial, Helvetica;
    padding-right:5px;"
    );
?>
