<form class="form-inline" action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
  <div id="searchContainer" class="input-group input-group-sm ml-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm"><span class="oi oi-magnifying-glass"></span>
      </span>
    </div>
    <input class="form-control mr-sm2 form-control-sm" type="search" id="s" name="s" value="<?php if (isset($_GET['s'])) echo $_GET['s'];  ?>" placeholder="SEARCH" />
  </div>
</form>