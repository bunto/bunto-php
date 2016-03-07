<?php
$this->setTitle("Site $name");
echo $this->inc("/src/inc/partial/site.sidebar.php", array(
  "su" => $su // Site URL
));
?>
<div class="contents">
  <h3><?php echo $name;?></h3>
  <p>Manage your static site <?php echo $name;?>.</p>
  <p clear>
    <?php echo \Lobby::l("$su/settings", "Settings", "class='btn'");?>
    <?php echo \Lobby::l("$su/pages", "Pages", "class='btn'");?>
  </p>
  <form clear method="POST" action="<?php echo \Lobby::u();?>">
    <button style="font-size: 25px;" name="generate" class="btn orange">Generate Site NOW!</button>
  </form>
  <?php
  if(isset($_POST['generate'])){
    /* Generate the site */
    $gSite = new \Lobby\App\sige\Site($this->getSite($name), $this);
    $gSite->generate($this->getPages($name));
    \Lobby::sss("Generated Site", "The site was successfully generated");
  }
  ?>
</div>
