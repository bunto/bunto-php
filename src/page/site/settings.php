<?php
$this->addScript("new-site.js");
$this->addStyle("site-settings.css");
$this->setTitle("$name - Settings");

echo $this->inc("/src/inc/partial/site.sidebar.php", array(
  "su" => $su // Site URL
));
?>
<div class="contents">
  <h2>Settings</h2>
  <?php
  if(isset($_POST['delete_site']) && \H::csrf()){
    \H::saveJSONData("sites", array(
      $name => false
    ));
    $this->redirect("?status=site-deleted");
  }else if(isset($_POST['submit'])){
    $output = $_POST['output'];
    $tagline = $_POST['tagline'];
    $theme = isset($_POST['theme']) ? $_POST['theme'] : "";
    if($output != "" && $theme != ""){
      if(!file_exists($output) || !is_writable($output)){
        \Lobby::ser("Output Path problem", "The path you gave as output doesn't exist or permission is not acceptable. Make sure it's an existing directory with Read & Write permission", false);
      }else if(array_search($theme, $this->themes) === false){
        \Lobby::ser("Invalid Theme", "The theme you selected doesn't exist", false);
      }else{
        // Everything's great
        $this->addSite($name, $tagline, $output, $theme, (isset($_POST['empty']) ? 1 : 0), (isset($_POST['titleTag']) ? 1 : 0));
        
        /* Generate the site */
        $gSite = new \Lobby\App\sige\Site($this->getSite($name), $this);
        $gSite->generate($this->getPages($name));
        \Lobby::sss("Site updated", "The site was updated and generated successfully");
      }
    }else{
      \Lobby::ser("Fill Up", "Please fill the form completely", false);
    }
  }
  ?>
  <form action="<?php echo \Lobby::u();?>" method="POST">
    <?php
    $site = $this->getSite($name);
    $empty = $site['empty'] == 1 ? "checked='checked'" : "";
    $titleTag = isset($site['titleTag']) && $site['titleTag'] == 1 ? "checked='checked'" : "";
    if($site !== false){
    ?>
      <label>
        <div>Tagline</div>
        <input type="text" name="tagline" title="The tagline of site" value="<?php echo $site['tagline'];?>" />
      </label><cl/>
      <label>
        <div>Output Location</div>
        <div class="row">
          <div class="col s9 input-field">
            <input type="text" name="output" id="output_loc" title="Path to which the files of generated site should be saved" value="<?php echo $site['out'];?>" />
          </div>
          <div class="col s2 input-field">
            <a id="choose_output_loc" class="btn orange">Choose Path</a>
          </div>
        </div>
      </label><cl/>
      <label>
        <input type="checkbox" name="empty" title="Should the contents of output directory be removed before making the site" <?php echo $empty;?>/>
        <span>Empty Output location</span>
      </label>
      <label title="Append the site name after page title ? Example : 'My Page - Delicious Blog'">
        <input type="checkbox" name="titleTag" <?php echo $titleTag;?> />
        <span>Append Site Name to &lt;title&gt; tag</span>
      </label>
      <div style="margin-top: 20px;">
        <div>Theme</div>
        <?php
        foreach($this->themes as $theme){
          $checked = $site['theme'] == $theme ? "checked" : "false";
        ?>
          <label class='theme'>
            <a title="Click to see example" target="_blank" href="<?php echo $this->u("/src/data/themes/{$theme}/example.html");?>">
              <img src="<?php echo APP_SRC . "/src/data/themes/{$theme}/thumbnail.png";?>" />
            </a>
            <input type="radio" name="theme" value="<?php echo $theme;?>" checked="<?php echo $checked;?>" />
            <span></span>
          </label>
        <?php
        }
        ?>
      </div>
    <?php
    }
    ?>
    <div clear>
      <button name="submit" class="btn green">Update Settings</button>
    </div>
  </form>
  <form action="<?php echo \Lobby::u();?>" method="POST" clear>
    <p><button name="delete_site" class="btn red">Delete Site From Bunto</button> - Folder won't be removed.</p>
    <?php \H::csrf(1);?>
  </form>
</div>
