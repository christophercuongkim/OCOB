<?php
/*
 *
 *   Template Name: Faculty Display 
 *
 */

get_header(); 
?>
    <style>
    /*Use to make a two div columns stack on mobile*/
    @media screen and (max-width:600px) {
        td {
            display: table-row !important;
            text-align: center;
            width: 100%;
        }

        th {
            display: none;
        }
        tr {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    }
    </style>
    <link rel='stylesheet' id='vc_inline_css-css'  href='https://www.cob.calpoly.edu/studentservices/wp-content/plugins/js_composer/assets/css/js_composer_frontend_editor.min.css' type='text/css' media='all' />

    <?php $json = json_decode(substr(file_get_contents("https://www.cob.calpoly.edu/directory/api/?cat=packaging"), 3)); ?>

    <div id="primary" class="<?php echo esc_attr( $myth_primary_layout_classes ); ?>">

        <main id="main" class="site-main" role="main">
            <?php while ( have_posts() ) : the_post(); ?>

                <div class="pagePadding">
                    <div class="topImage imageBorder"><?php echo get_the_post_thumbnail(null, "100%"); ?></div>
                    <?php get_template_part( 'theme-core/theme-elements/content', 'page' ); ?>
                    <table>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Phone</th> 
                    <th>Email</th>
                    <th>Office</th>
                </tr>
                <?php foreach($json as $person) { ?>
                    <?php
                        if($person->profile_page_url != null)
                           $url = $person->profile_page_url;
                        else if($person->external_page_url != null)
                            $url = $person->external_page_url;
                        else if($person->staff_page_url != null)
                            $url = $person->staff_page_url;
                        else
                            $url = "";
                        ?>
                    <tr>
                        <td><a href="<?php echo($url) ?>"><img src="<?php echo($person->img_url) ?>" style="width:75px"></a></td>
                        <td><a href="<?php echo($url) ?>"><?php echo($person->name) ?></a></td>
                        <td><?php echo($person->phone); ?></td> 
                        <td><a href="mainto:<?php echo($person->email); ?>"><?php echo($person->email); ?></a></td>
                        <td><?php echo($person->office); ?></td>
                    </tr>
                <?php } ?>
            </table>   
                </div>

                <?php
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>

            <?php endwhile; ?> 
        </main>
    </div>

<?php include ( get_template_directory() . "/sidebar.php"); ?>
<?php include ( get_template_directory() . "/footer.php"); ?>