# Server-side Sass auto-compiler (minifier)

Explain in Japanese:
  http://note.openvista.jp/2013/scss-server-side-compiler/

## Usage

put the ".htaccess" and "compiler" folder to scss directory like this.

- *css* 
 - style.scss
 - .htaccess
 - *compiler*
    - scss.php
    - scss.inc.php
    - cssmin.inc.php

And access sass file with query "min", "compile" (e.g. hoge.scss?min,compile). Action of this code is controled by query, so do nothing when no query specified (raw scss file).

## How?
If you access sass file, simply mod_rewites URI to the scss.php .
And scss.php compiles & minifies using following library.

## Library
- Compile Sass with [scssphp](http://leafo.net/scssphp/) (GPL3/MIT License)
- Minify with [CssMin](http://code.google.com/p/cssmin/) (MIT License)

## License
[MIT License](http://opensource.org/licenses/MIT)