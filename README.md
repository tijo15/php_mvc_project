Allt om monsters planer på att ta över världen
=========

This project is the final assignment in the phpmvc course held by Blekinge Tekniska Högskola (BTH). It is a discussion forum built with the Anax-MVC using the module CDatabase for database connection and CForm for form generation. Follow the guide below on how to install.



Installation
------------------

You will need to install composer from https://getcomposer.org/

1) Clone the project by following this link: https://github.com/tijo15/php_mvc_project.git

2) Enter the project folder and delete the vendor folder.

3) Run composer and use the composer update command to install the dependencies CForm and CDatabase

4) Go to app-->config folder, open the database_mysql.php file and enter your database connection details.

5) Import SQL tables from folder sql/sqlimport.sql to your SQL host using the import feature. This will import all the used tables

Use of external libraries
-----------------------------------

The following external modules are included and subject to its own license.

### Modernizr
* Website: http://modernizr.com/
* Version: 2.6.2
* License: MIT license
* Path: included in `webroot/js/modernizr.js`

### PHP Markdown
* Website: http://michelf.ca/projects/php-markdown/
* Version: 1.4.0, November 29, 2013
* License: PHP Markdown Lib Copyright © 2004-2013 Michel Fortin http://michelf.ca/
* Path: included in `3pp/php-markdown`

### Lessphp

* Website: http://leafo.net/lessphp
* Version: 0.4.0
* License: Copyright (c) 2013 Leaf Corcoran, http://leafo.net/lessphp
* Path: included in webroot/css/anax-grid/lessphp/lessc.inc.php

### Semantic grid

* Website: http://tylertate.github.io/semantic.gs/
* Version: 1.2, January 11, 2012
* License: Licensed under Apache 2.0. See LICENSE
* Path: included in webroot/css/anax-grid/semantic.gs


