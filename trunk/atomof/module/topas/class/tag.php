<?php

class Topas_Tag {
   var $text="";
   var $end ="";

   function get(){
      return $this->text.$this->end;
   }

   function pp(){
      $args=func_get_args();
      foreach($args as $v){
         if    ( is_array($v) )  $this->text.=implode("",$v);
         elseif( is_object($v) ) $this->text.=$v->get();
         else                   $this->text.=$v;
      }
   }

   function attributes ( $attr, $val ){
      $attr=array_merge(Array('id','class','style','name','title'),$attr);
      foreach ($attr as $name){
         if( isset($val[$name]) ){
            $str.="{$name}=\"{$val[$name]}\" ";
         }
      }
      return $str;
   }

   function start( $t, $attr, $val){
      $this->tag =$t;
      $this->text="<{$t} ".$this->attributes($attr,$val).">"
   ;}

   function end(){
      $this->end="</{$this->tag}>";
   ;}

   function single( $t, $attr, $val){
      $this->tag =$t;
      $this->text="<{$t} ".$this->attributes($attr,$val)." />"
   ;}

   function img( $val ){
      $i=new Topas_Tag();
      $i->single('img',array('src','border','alt','height','width'),$val);
      return $i;
   ;}
   
   function form( $arg ){
      $i=new Topas_Tag();
      if( ! isset($arg['action']) )
         $arg['action']=$_SERVER['PHP_SELF'];
      if( ! isset($arg['method']) )
         $arg['method']='POST';
      $i->start('form',array('method','encoding','target','action'),$arg);
      $i->end();
      return $i;
   }

   function input( $typ, $attr, $arg ){
      $i=new Topas_tag();
      $attr=array_merge($attr,array('type','value'));
      $arg['type']=$typ;
      $i->single('input',$attr,$arg);
      return $i;
   }

   function iText($arg){
      return $this->input('text',array('maxlength'),$arg);
   }

   function iSubmit($arg){
      return $this->input('submit',array(),$arg);
   }

   function ul($list,$arg=array()){
      $i=new Topas_Tag();
      $i->start('ul',array(),$arg);
      $i->end();
      foreach($list as $li){
         $i->text.="<li>{$li}</li>";
      }
      return $i;
   }

   function double( $t, $attr, $arg ){
      $i=new Topas_Tag();
      $i->start($t,$attr,$arg);
      if( isset($arg['text']) )
         $i->pp($arg['text']);
      $i->end();
      return $i;
   }

   function a( $arg ){
      return $this->double('a',array('href','alt'),$arg)
   ;}
   
   function div( $val ){
      return $this->double('div',array(),$val)
   ;}

   function box_fullsize( $include ){
      return '<table height="100%" width="100%"><tr>'
            .'<td align="center" valign="middle">'.$include
            .'</td></tr></table>'
   ;}

   function box_minimal( $include ){
      return '<table height="*" width="*"><tr>'
            .'<td align="center" valign="middle">'.$include
            .'</td></tr></table>'
   ;}

}

?>
