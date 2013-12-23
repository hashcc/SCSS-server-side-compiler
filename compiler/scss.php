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
  
  public function __construct(){
    
    // SCSS dir
    $this->dir = "../";

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
  
  public function checkURI(){
  
    if (preg_match("/^[a-zA-Z0-9\-_\.]+$/D", $_GET["filename"]) !== 1){
      exit("SCSS file must be specified with alphabets and numeric characters only.");
    }
  
  }
  
  public function get(){
    
    $this->file = file_get_contents($this->dir.$_GET["filename"]);

  }
  
  public function compile(){

    if (!$this->doCompile) return;
    if (!$this->uriMatch("compile")) return;

    // Use scssphp library
    $compiler = new scssc();
    // default @import directory
    $compiler->setImportPaths($this->dir);
    // Let the stylesheet minimum
    $compiler->setFormatter($this->formatter);
    
    try {
      $this->file = $compiler->compile($this->file);
    } catch (Exception $e){
      exit("<dl><dt>An Error occured while compiling</dt><dd>".$e->getMessage()."</dd></dl>");
    }
  }

  public function minify(){
  
    if (!$this->doMinify) return;
    if (!$this->uriMatch("min")) return;

    $this->file = CssMin::minify($this->file);
  
  }
  
  public function gzip(){
    
    // check if browser support gzip encoding
    $headers = getallheaders();
    if (strpos($headers["Accept-Encoding"], "gzip") === false) return false;

    // gzip compression
    $this->file = gzencode($this->file);
    header("content-length: ". strlen($this->file));
    header("content-encoding: gzip");

  }

  public function output(){
    
    // gzip if available
    $this->gzip();
    
    header("content-type: text/css; charset=utf-8");
    print_r($this->file);

  }

  public function uriMatch($str){
    
    if (!$_GET["options"]) return false;
    
    return (preg_match("/".$str."/", $_GET["options"])) ? true : false;

  }

}

?>