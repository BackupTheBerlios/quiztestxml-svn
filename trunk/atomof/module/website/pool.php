<?php

function pool_website(){
   return new website_pool();
}

class website_pool {

   function document_title($controller,$service,$modul){
      $title=$controller->needs_val("document/title");
      return "<title>{$title}</title>\n";
   ;}

   function document_shortcut_icon($controller,$service,$modul){
      list($mod,$src)=$icon=$controller->needs("document/shortcut_icon");
      $src=$controller->media($src,$mod);
      return
      "<link rel=\"shortcut icon\" href=\"{$src}\" type=\"image/x-icon\" />\n"
   ;}

   function document_stylesheet($controller,$service,$modul){
      list($mod,$src)=$icon=$controller->needs("document/stylesheet");
      $src=$controller->media($src,$mod);
      return
      "<link rel=\"stylesheet\" href=\"{$src}\" type=\"text/css\" />\n"
   ;}

   function application_banner($controller,$service,$modul){
      $tag = new Topas_tag;
      list($modul,$data)=$controller->needs("application/banner");
      if(isset($data['modul']))
         $modul=$data['modul'];
      $data["src"]=$controller->media($data["src"],$modul);
      $img = $tag->img($data);
      return $img->get();
   }
}

?>
