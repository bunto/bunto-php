<?php
namespace Lobby\App;

class bunto extends \Lobby\App {
  
  public $themes = array(
    "architect"
  );
  
  public function page($p){
    require APP_DIR . "/src/inc/class.site.php";
    
    $pages = array(
      "index", "/new"
    );
    $p = $p == "/" ? "index" : $p;
    if(array_search($p, $pages) !== false){
      return "auto";
    }else if(substr($p, 0, 6) === "/site/"){
      $parts = explode("/", $p);
      $name = urldecode($parts[2]);
      $site_id = urlencode($name);
      $site = $this->getSite();
      
      if(count($site) == 0){
        return false;
      }else{
        $p2 = isset($parts[3]) ? $parts[3] : "index";
        
        if($p2 == "index" || $p2 == "settings" || $p2 == "pages" || $p2 == "edit"){
          $this->addStyle("site.css");
          $site = $this->getSite($name);
          
          return $this->inc("/src/page/site/$p2.php", array(
            "name" => $name,
            "site" => $site,
            "su" => $this->u("/site/".urlencode($name)), // Short for site URL
            "page" => $p2
          ));
        }else{
          return false;
        }
      }
    }else{
      return false;
    }
  }
  
  public function addSite($name, $out, $theme, $tagline = "", $empty = 0, $titleTag = 1){
    $sites = $this->getSite();
    $sites[$name] = array(
      "out" => $out,
      "theme" => $theme,
      "empty" => $empty,
      "tagline" => $tagline,
      "titleTag" => $titleTag
    );
    $sites = json_encode($sites);
    saveData("sites", $sites);
  }
  
  public function getSite($site = false){
    $sites = getData("sites");
    $sites = json_decode($sites, true);
    $sites = !is_array($sites) ? array() : $sites;
    if($site){
      $sites[$site]['name'] = $site;
      return isset($sites[$site]) ? $sites[$site] : array();
    }else{
      return $sites;
    }
  }
  
  /* Get pages of a site or a specific page of a site. The name of a page is alphanumeric */
  public function getPages($site, $type = "all"){
    $pages = \H::getJSONData("{$site}Pages");
    
    if($pages){
      if($type == "all"){
        // Give all pages
        return $pages;
      }else{
        // Give the single page requested
        $type = strtolower($type);
        return $pages[$type];
      }
    }else{
      return $pages;
    }
  }
  
  public function addPage($site, $name, $page){
    $data = \H::getJSONData("{$site}Pages");
    var_dump($data);
    $name = strtolower($name);
    $pages[$name] = $page;
    saveData("{$site}Pages", json_encode($pages));
    return true;
  }
  
}
