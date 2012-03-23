<form method="get" id="searchform" action="<?php echo bloginfo( 'wpurl' ); ?>">
	<input class="inputbox" type="text" name="s" onfocus="if(this.value=='<?php echo __('Search...','duotive'); ?>') this.value='';" onblur="if(this.value=='') this.value='<?php echo __('Search...','duotive'); ?>';" value="<?php echo __('Search...','duotive'); ?>" size="20" maxlength="20">
    <input class="search" type="submit" value="" />
</form>