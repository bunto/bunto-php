<?php
$this->addScript("editor.js");
echo $this->inc("/src/inc/partial/site.sidebar.php", array(
  "su" => $su // Site URL
));
/**
 * $name is for the Site Name
 * $pname is for the Page Name
 */
?>
<script src="<?php echo APP_SRC . "/src/lib/tinymce/tinymce.min.js";?>"></script>
<div class="contents">
  <h2>Create Page</h2>
  <?php
  $data = array(
    "name" => "",
    "title" => "",
    "slug" => "",
    "body" => ""
  );
  $page_edit = false;
  
  if(isset($_GET['id'])){
    $data = $this->getPages($name, $_GET['id']);
    $page_edit = $data['slug'] === "" ? false : true;
    $pid = $_GET['id'];
  }
  
  if(isset($_POST['submit'])){
    $pname = $page_edit === true  ? $_GET['id'] : $_POST['name'];
    $title = $_POST['title'];
    $body = $_POST['content'];
    $slug = $_POST['slug'];
    
    if($pname == "" || $body == "" || $title == "" || $slug == ""){
      \Lobby::ser("Fill Up", "Please fill up all the fields");
    }else if( !ctype_alnum(str_replace(" ", "", $pname)) ){
      \Lobby::ser("Invalid Name", "The page name should only contain alphanumeric characters");
    }else{
      $gSite = new \Lobby\App\sige\Site($site, $this);
      $page = $gSite->page($slug, array(
        "{{page-title}}" => $title,
        "{{page-content}}" => $body
      ));
      if($page === true){
        $this->addPage($name, $pname, array(
          "title" => $title,
          "slug" => $slug,
          "body" => $body
        ));
        \Lobby::sss( "Page "  . ($page_edit ? "Updated" : "Created"), "The page was successfully " . ($page_edit ? "updated" : "created") );
      }else{
        \Lobby::ser("Error", "Some error was occured while creating the page. Try again.");
      }
      $data = $this->getPages($name, $pname);
    }
  }
  ?>
  <form method="POST" action="<?php echo \Lobby::u();?>" style="width: 700px;">
    <?php
    if( $data['title'] == ""){
    ?>
      <p>Create a new page in <strong><?php echo $name;?></strong></p>
      <label>
        <div>Name</div>
        <input type="text" name="name" value="<?php echo $data['name'];?>" title="Should only contain alphanumeric + space characters" />
      </label>
    <?php
    }else{
      echo "<input type='text' disabled='disabled' value='{$pid}' title='Page ID. Once created, it can't be changed.'/>";
      echo "<input type='hidden' name='update' value='true' />";
    }
    ?>
    <label>
      <div>Title</div>
      <input type="text" name="title" value="<?php echo $data['title'];?>" title="The <title> of the page. Not applicable to Plain File type" />
    </label>
    <label>
      <div>Location</div>
      <input type="text" name="slug" value="<?php echo $data['slug'];?>" title="Path of page. Example : 'myFolder/myFile'. No need to add .html at end" />
    </label>
    <label>
      <div>Content</div>
      <div style="margin: 20px 0 0;"></div>
      <textarea name="content" style="height: 200px;width: 700px;"><?php echo $data['body'];?></textarea>
    </label>
    <div clear>
      <button name="submit" class="btn green"><?php echo $data['title'] == "" ? "Create Page" : "Update Page" ?></button>
      <?php
      if($page_edit){
      ?>
        <button name="deletePage" class="btn red"></button>
      <?php
      }
      ?>
    </div>
  </form>
  <style>
    .workspace#sige label{
      display: block;
      margin-bottom: 20px;
    }
  </style>
</div>
