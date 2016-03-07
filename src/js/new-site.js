lobby.load(function(){
  /**
   * Site path Picker
   */
  $(".workspace #choose_output_loc").live("click", function(){
    lobby.mod.FilePicker("/", function(result){
      $(".workspace #output_loc").val(result.dir);
    });
  });
});
