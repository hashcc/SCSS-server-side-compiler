<?php
  
  require "scss.inc.php";
  require "cssmin.inc.php";
  
  $scss = new SCSS;
  
  // Check URI if fiie-name only contains ABC.. + 123.. + .
  $scss->checkURI();
  // Get SCSS
  $scss->get();
  // Compile SCSS to CSS
  $scss->compile();
  // Minify CSS
  $scss->minify();
  // Output CSS
  $scss->output();
  

class SCSS{
  
  function __construct(){
    
    // SCSS path
    $this->path = "../";
    // SCSS format style
    // - scss_formatter
    // - scss_formatter_nested
    // - scss_formatter_compressed)
    $this->formatter = "scss_formatter";
    // Do SCSS compile
    $this->doCompile = true;
    // Do CSS Minify
    $this->doMinify  = true;
  
  }
  
  function checkURI(){
  
    if (preg_match("/^[a-zA-Z0-9\.]+$/D", $_GET["filename"]) !== 1){
      exit("SCSS file must be specified with alphabets and numeric characters only.");
    }
  
  }
  
  function get(){
  
    $this->file = file_get_contents($this->path.$_GET["filename"]);
  
  }
  
  function compile(){

    if (!$this->doCompile) return;

    // Use scssphp library
    $compiler = new scssc();
    // default @import directory
    $compiler->setImportPaths($this->path);
    // Let the stylesheet minimum
    $compiler->setFormatter($this->formatter);
    
    $this->file = $compiler->compile($this->file);
  
  }

  function minify(){
  
    if (!$this->doMinify) return;

    $this->file = CssMin::minify($this->file);
  
  }
  
  function output(){

    header("Content-type: text/css; charset=UTF-8");
    print_r($this->file);

  }

}

?>