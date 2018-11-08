<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" value=" Type and hit enter ...<?php /* echo wp_specialchars($s, 1); */ ?>" name="s" id="s" onfocus="if (this.value == ' Type and hit enter ...') {this.value = '';}" onblur="if (this.value == '') {this.value = ' Type and hit enter ...';}" />
<input type="hidden" id="searchsubmit" value="Search" />
</form>
