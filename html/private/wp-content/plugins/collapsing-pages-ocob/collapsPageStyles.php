<?php
$style="#sidebar span.collapsing.pages {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
} 

#sidebar li.widget_collapspage h2 span.sym {float:right;padding:0 .5em}
#sidebar li.collapsing.pages a.self {font-weight:bold}
#sidebar ul.collapsing.pages.list ul.collapsing.pages.list:before {content:'';} 
#sidebar ul.collapsing.pages.list li.collapsing.pages:before {content:'';} 
#sidebar ul.collapsing.pages.list li.collapsing.pages {list-style-type:none}
#sidebar ul.collapsing.pages.list li.collapsing.pages{
       padding:0 0 0 1em;
       text-indent:-1em;
}
#sidebar ul.collapsing.pages.list li.collapsing.pages.item:before {content: '\\\\00BB \\\\00A0' !important;} 
#sidebar ul.collapsing.pages.list li.collapsing.pages .sym {
   cursor:pointer;
   font-size:1.2em;
   font-family:Monaco, 'Andale Mono', 'FreeMono', 'Courier new', 'Courier', monospace;
    padding-right:5px;}";

$default=$style;

$block="#sidebar ul.collapsing.pages.list li a {
            display:block;
            text-decoration:none;
            margin:0;
            padding:0;
            }
#sidebar ul.collapsing.pages.list li a:hover {
            background:#CCC;
            text-decoration:none;
          }
#sidebar span.collapsing.pages {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
}

#sidebar li.widget_collapspage h2 span.sym {float:right;padding:0 .5em}
#sidebar li.collapsing.pages a.self {background:#CCC;
                       font-weight:bold}
#sidebar ul.collapsing.pages.list ul.collapsing.pages.list:before {content:'';} 
#sidebar ul.collapsing.pages.list li.collapsing.pages {list-style-type:none}
#sidebar ul.collapsing.pages.list li.collapsing.pages.item:before, 
  #sidebar ul.collapsing.pages.list li.collapsing.pages:before {
       content:'';
  } 
#sidebar ul.collapsing.pages.list li.collapsing.pages .sym {
   cursor:pointer;
   font-size:1.2em;
   font-family:Monaco, 'Andale Mono', 'FreeMono', 'Courier new', 'Courier', monospace;
    float:left;
    padding-right:5px;
}
";

$noArrows="#sidebar span.collapsing.pages {
        border:0;
        padding:0; 
        margin:0; 
        cursor:pointer;
}
#sidebar li.collapsing.pages a.self {font-weight:bold}

#sidebar li.widget_collapspage h2 span.sym {float:right;padding:0 .5em}
#sidebar ul.collapsing.pages.list ul.collapsing.pages.list:before {content:'';} 
#sidebar ul.collapsing.pages.list li.collapsing.pages:before {content:'';} 
#sidebar ul.collapsing.pages.list li.collapsing.pages {list-style-type:none}
#sidebar ul.collapsing.pages.list li.collapsing.pages .sym {
   cursor:pointer;
   font-size:1.2em;
   font-family:Monaco, 'Andale Mono', 'FreeMono', 'Courier new', 'Courier', monospace;
    padding-right:5px;}";
$selected='default';
$custom=get_option('collapsPageStyle');
?>
