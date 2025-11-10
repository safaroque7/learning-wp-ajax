<form action="<?php echo home_url();?>" class="searchform" id="searchform" method="get" role="search">
    <div>
        <label for="s" class="screen-reader-text">Search for:</label>
        <input type="text" id="s" name="s" value="" placeholder="<?php echo get_search_query();?>">
        <input type="submit" value="" id="searchsubmit">
    </div>
</form>