<?php
$this->addScript("new-site.js");
$this->addStyle("site-settings.css");
?>
<div class="contents">
  <h2>New Site</h2>
  <?php
  if(isset($_POST['submit'])){
    $name = $_POST['site'];
    $output = $_POST['output'];
    $theme = isset($_POST['theme']) ? $_POST['theme'] : "";
    /* Any change to the below must be reflected in settings.php */
    if($name != "" && $output != "" && $theme != ""){
      if(!file_exists($output) || !is_writable($output)){
        \Lobby::ser("Output Path problem", "The path you gave as output doesn't exist or permission is not acceptable. Make sure it's an existing directory with Read & Write permission", false);
      }else if(!ctype_alnum(str_replace(" ", "", $name))){
        \Lobby::ser("Invalid Name", "Only alphanumeric characters are allowed for Site Name", false);
      }else if(array_search($theme, $this->themes) === false){
        \Lobby::ser("Invalid Theme", "The theme you selected doesn't exist", false);
      }else{
        // Everything's great
        $this->addSite($name, $output, $theme);
        \Lobby::sss("Site added", "The site was added successfully");
      }
    }else{
      \Lobby::ser("Fill Up", "Please fill the form completely", false);
    }
  }
  ?>
  <form action="" method="POST">
    <label>
      <div>Site Name</div>
      <input type="text" name="site" />
    </label>
    <label>
      <div>Output Location</div>
      <div class="row">
        <div class="col s9 input-field">
          <input type="text" name="output" id="output_loc" title="Path to which the files of generated site should be saved" />
        </div>
        <div class="col s2 input-field">
          <a id="choose_output_loc" class="btn orange">Choose Path</a>
        </div>
      </div>
    </label>
    <label>
      <input type="checkbox" name="empty" title="Should the contents of output directory be removed before generating the site everytime" />
      <span>Empty Output location</span>
    </label>
    <div style="margin-top: 20px;">
      <div>Theme</div>
      <?php
      foreach($this->themes as $theme){
      ?>
        <label class='theme'>
          <a target="_blank" href="<?php echo APP_SRC . "/src/data/themes/{$theme}/example.html";?>">
            <img src="<?php echo APP_SRC . "/src/data/themes/{$theme}/thumbnail.png";?>" />
          </a>
          <input type="radio" name="theme" value="<?php echo $theme;?>" />
          <span></span>
        </label>
      <?php
      }
      ?>
    </div>
    <label>
      <button name="submit" class="btn green">Create Site</button>
    </label>
  </form>
</div>
