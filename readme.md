# SCSS to CSS compiler

Server-side sass compiler (minifier).

## Usage
put the ".htaccess" and "compiler" folder to scss directory like this.

- *css* 
 - style.scss
 - .htaccess
 - *compiler*
   - scss.php
   - scss.inc.php
   - cssmin.inc.php

and access sass file on your browser.

## How?
If you access sass file, simply mod_rewites URI to the scss.php .
And scss.php compiles & minifies using following library.

## Library
- Compile Sass with [scssphp](http://leafo.net/scssphp/) (GPL3/MIT License)
- Minify with [CssMin](http://code.google.com/p/cssmin/) (MIT License)

## License
MIT License