<?php
/**
 * @package Techotronic
 * @subpackage jQuery TinyTips
 *
 * @since 1.0
 * @author Arne Franken
 *
 * Sets variables and loads the main function of the TinyTips Javascript
 */
?>
<script type="text/javascript">
    // <![CDATA[
<?php
    /**
    * declare variables that are used in more than one function
    */
    ?>
        var tinytipsTheme = "<?php echo $this->tinytipsSettings['tinytipsTheme']; ?>";
    <?php
     /**
      * call colorbox selector function.
      */
     ?>
    jQuery(document).ready(function($) {
        $("a.tinytips").each( function(index,obj){
            if($(obj).attr('title')){
                $(obj).tinyTips(tinytipsTheme, 'title');
            }
        });
    });
    // ]]>
</script>
