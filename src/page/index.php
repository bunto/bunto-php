<div class="contents">
  <h1>Bunto</h1>
  <?php
  $status = \H::i("status");
  if($status === "site-deleted"){
    sss("Site Deleted", "The site you requested was removed from Bunto, but the folder is not removed.");
  }
  echo \Lobby::l($this->u("/new"), "New Site", "class='btn'");
  ?>
  <p>
    <?php
    $sites = getData("sites");
    if($sites !== false){
      $sites = json_decode($sites, true);
      foreach($sites as $name => $site){
        echo $this->l("/site/". urlencode($name), $name, "class='btn green'") . "<cl/>";
      }
    }
    ?>
  </p>
</div>
