<?php
\Lobby::hook("panel.end", function(){
?>
  <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
<?php
});
?>
<ul id="slide-out" class="side-nav fixed">
  <form method="POST" action="<?php echo $su;?>" id="generate">
    <button name="generate" class="btn orange">Generate Site</button>
  </form>
  <li><a href="<?php echo $su;?>">Home</a></li>
  <li><a href="<?php echo $su . "/settings";?>">Settings</a></li>
  <li><a class="waves-effect waves-teal" href="<?php echo $su . "/pages";?>">Pages</a></li>
</ul>
