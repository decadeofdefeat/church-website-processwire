#AIOM+ (All In One Minify)#

####Simple minify and parsing for CSS, LESS, JS and HTML####
-----------------------------

AIOM+ (All In One Minify) is a ProcessWire module to easily improve the performance of your website. By a simple function call Stylesheets, LESS  and Javascript files can be parsed, minimized and combined into one single file. This reduces the server requests, loading time and minimizes the traffic. In addition, the generated HTML source code can be minimized and all generated files can be loaded over a cookieless domain (domain sharding).

- - - 

####Information####

* All paths are relative to the template folder. URLs in css files will be automatically corrected. Nothing needs to be changed.
* If you make changes to the source stylesheet, LESS or javascript files, a new parsed and combined version is created automatically.
* All parameters can be adjusted via the backend.
* During development, you can enable developer mode. Files are parsed and combined, but not minimized and browser caching is prevented.
* You can use the short syntax ```AIOM``` or use the full class name ```AllInOneMinify``` in your templates.
* The generated files can be delivered via a subdomain (Domain sharding / Cookieless domain)
* LESS files can directly server side generated on the fly, without plugins. AIOM+ has a complete, high-performance PHP ported LESS library of the official LESS processor included! 
* **NOTE**: There are a few unsupported LESS features: 
    * Evaluation of JavaScript expressions within back-ticks (for obvious reasons)
    * Definition of custom functions
* Conditional loading of files based on a API selector

##Table of content##

* [Installation](#installation)
* [Minimize Stylesheets and parse LESS files](#minimize-stylesheets-and-parse-less-files)
* [LESS variables access in multiple files](#less-variables-access-in-multiple-files)
* [Minimize Javascripts](#minimize-javascripts)
* [Conditional loading](#conditional-loading)
* [Directory Traversal Filter](#directory-traversal-filter)
* [Exclude minimized files](#already-minimized-files-no-longer-minimized)
* [Exemplary template structure](#exemplary-template-structure)
* [Minimize HTML](#minimize-html)
* [Development mode](#development-mode)
* [Changelog](#changelog)
* [Others](#questions-or-comments)

##Installation##

1. Copy the files for this module to /site/modules/AllInOneMinify/
2. In admin: Modules > Check for new modules. 
3. Install Module "AIOM+ (All In One Minify) for CSS, LESS, JS and HTML".

**Alternative in ProcessWire 2.4**  

1. Login to PW backend and go to Modules
2. Click tab "new" and enter Module Class Name: "AllInOneMinify"
3. Click "Download and Install"

##Minimize Stylesheets and parse LESS files##

Minimization of a single file.

```html+php
<!-- CSS Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo AllInOneMinify::CSS('css/stylesheet.css'); ?>">

<!-- LESS file -->
<link rel="stylesheet" type="text/css" href="<?php echo AllInOneMinify::CSS('css/stylesheet.less'); ?>">
```

Minimize multiple files into one file. You can even mix stylesheet and LESS files in parsing and combining process!

```html+php
<link rel="stylesheet" href="<?php echo AllInOneMinify::CSS(array('css/file-1.css', 'css/file-2.less', 'css/file-3.css', 'css/file-4.less')); ?>">
```

**Tip:** You can also use the short syntax **"AIOM"**. For example, ```AIOM::CSS()```.

##LESS variables access in multiple files##

You have a LESS file in which you are defining, for example, all colors and another LESS file that defines the actual layout? Now you need in the layout LESS file access to the variables of the color LESS file? It's easier than you think. Through a simple referencing of source LESS file. For example: 

```html+php
<link rel="stylesheet" type="text/css" href="<?php echo AllInOneMinify::CSS('css/color.less'); ?>">
...
<link rel="stylesheet" type="text/css" href="<?php echo AllInOneMinify::CSS('css/layout.less'); ?>">
```

Example content of ```color.less```

```css
@my-color: #ff0000;
```

Example content of ```layout.less```

```css
@import (reference) "css/color.less";

body {
    background-color: @my-color;
}
```

That's all. Pretty, hu? The full documentation of LESS you can find at: www.lesscss.org


##Minimize Javascripts##

Minimization of a single file.

```html+php
<script src="<?php echo AllInOneMinify::JS('js/javascript.js'); ?>"></script>
```

Minimize multiple files into one file.

```html+php
<script src="<?php echo AllInOneMinify::JS(array('js/file-1.js', 'js/file-2.js', 'js/file-3.js', 'js/file-4.js')); ?>"></script>
```

**Tip:** You can also use the short syntax **"AIOM"**. For example, ```AIOM::JS()```.

##Conditional loading##

Since AIOM+ version 3.1.1 javascripts, stylesheets and LESS files can be loaded based on a API selector. Here is an example of conditional loading: 

```html+php
<?php $stylesheets  = array('css/reset.css',
                            'css/main.less',
					        array('loadOn'  => 'id|template=1002|1004|sitemap', 
						          'files'   => array('css/special.css', 'css/special-theme.less'))); ?>
						          
<link rel="stylesheet" type="text/css" href="<?php echo AllInOneMinify::CSS($stylesheets); ?>" />
```

The same you can do with ```AIOM::JS()```. ```loadOn``` must be an [ProcessWire API selector](http://processwire.com/api/selectors/).

##Directory Traversal Filter##

By default, only files can be included, which are in ProcessWire template folder. If you wish to add files outside that folder, you have to activate the backend "Allow Directory Traversal" option. Then you can jump back in the path. For example: 
```html+php 
AIOM::CSS('../third-party-packages/package/css/example.css');
```
**All paths are still automatically corrected!**

##Already minimized files no longer minimized##

To further enhance the performance and to give you maximum flexibility in the combining process, you now have the option to exclude certain files from the minimization (since version 2.2). All files that have the abbreviation ".min" or "-min" at the end of the file name and before the file extension, are no longer minimized. For example: ```file-1.js``` is minimized. ```file-1-min.js``` or ```file-1.min.js``` is not minimized. The same for CSS. ```file-1.css``` is minimized. ```file-1-min.css``` or ```file-1.min.css``` is not minimized.

##Exemplary template structure##

```/
site/
    templates/
        css/
        js/
```

##Minimize HTML##

The generated HTML source code is automatically minimized when rendering. This requires no change to the templates. Conditional Comments, textareas, code tags, etc. are excluded from the minimization.

**NOTE**: AIOM+ removes all whitespaces between two tags. If you explicitly need a whitespace, change the whitespace into an HTML entity: ```&nbsp;```. See ([#6](https://github.com/conclurer/ProcessWire-AIOM-All-In-One-Minify/issues/6))

##Development mode##

If you are currently in development of the site, caching can be a problem. For this, you can enable the development mode since version 1.1.0 in the Backend (Module > AIOM > Config). The files will be combined, but not minimized and re-generated at each call. In addition, a no-cache GET parameter is appended with a timestamp to prevent the browser caching. For example: ```css_031ea978b0e6486c828ba444c6297ca5_dev.css?no-cache=1335939007```

##Changelog##

3.1.4

* Bugfix: CacheFiles for Pages are now deleted when a new minimized file is created
* Bugfix: An error is thrown if the document root is different to ProcessWire's base path
* Note: AIOM is now also developed by [Conclurer](https://www.conclurer.com).

3.1.3

* New LESS version: Update parser to version 1.7.1
  * improved parser exceptions with invalid less
  * prevent fround() from changing integer into double
  * prevent fatal error with preg_match()
  * fix undefined variable
* New CSSMin version: Update script to version 1.1.2
  * Some improvements
  * Bugfix: Broken rule for firefox 27.0.1 (Animation second "s" lost)
* Push to stable

3.1.2 

* New feature: Enable or disable directory traversal filter in backend ([#12](https://github.com/conclurer/ProcessWire-AIOM-All-In-One-Minify/issues/12))
* New LESS version: Update parser to Version 1.7

3.1.1

* New feature: Conditional loading
* Update readme / documentation

3.0.1

* BugFix ([#11](https://github.com/conclurer/ProcessWire-AIOM-All-In-One-Minify/issues/11)): Wrong class order in Less.php parser (Thanks to Ryan Pierce)

3.0.0 

* AIOM+ tested with ProcessWire 2.4
* Module now multilingual
* New feature: LESS support (direct parsing and minimization server side on the fly)
* Update readme / documentation

2.2.2 

* BugFix ([#8](https://github.com/conclurer/ProcessWire-AIOM-All-In-One-Minify/issues/8)): Many errors if debug mode is activated (Thanks to JoZ3)
* Better error handling
* Additional information about spaces in the HTML minimization. See ([#6](https://github.com/conclurer/ProcessWire-AIOM-All-In-One-Minify/issues/6)) (Thanks to philippreiner)

2.2.1

* Code Corrections / class name

2.2.0

* New feature: File is not minimized when ".min" or "-min" is at the end of the filename. For example: ```file-1.min.js```.
* Update CSSMin library to Version 1.1 (inspired by Yahoo! YUI compressor)
* Update JSMin library to Version 2.7.1 (Security fix, recommended update)
* Performance improvements on first minification

2.1.1

* Old code removed
* Cleanup

2.1.0

* New CSS minimization library
* Performance improvements

2.0.0

* Configurable backend (Prefix, lifetime, dev-mode and tips)
* Empty cache on the backend
* Domain sharding / cookieless domain
* Domain sharding for SSL
* Performance improvements
* Quick introduction in the backend
* Performance tips in the backend
* .htaccess instructions for domain sharding in the backend

1.1.1  

* CSS filter update

1.1.0  

* BugFix ([#1](https://github.com/conclurer/ProcessWire-AIOM-All-In-One-Minify/issues/1)): Error: Exception: RecursiveDirectoryIterator ... Permission denied (Thanks to JoZ3 and Ryan)
* New Short-Syntax AIOM::CSS(); and AIOM::JS();
* New default settings for css minify (speed up minimizing)
* New option: enable/disable HTML minify
* New option: enable/disable development mode (combine but no minimizing)
* Some optimizations
 
1.0.0  
* Initial release

##Questions or comments?##

For any questions, suggestions or bugs please create a ticket on [GitHub](https://github.com/conclurer/ProcessWire-AIOM-All-In-One-Minify/issues). 


##Old stable Version needed?##

Under the following link you can find the old stable version of AIOM without LESS support: https://github.com/conclurer/ProcessWire-AIOM-All-In-One-Minify/tree/AIOM-(old-Stable-2.2.2)

[![Analytics](https://ga-beacon.appspot.com/UA-7951064-10/ProcessWire-AIOM-All-In-One-Minify/blob/master/README.md?pixel)](https://github.com/igrigorik/ga-beacon)
