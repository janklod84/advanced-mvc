<?php 
/*
 | -------------------------------------------------------------------
 |         SET TRUE OR FALSE MODULE DEBUG
 | -------------------------------------------------------------------
*/
 define('DEBUG', true);


/*
 | -------------------------------------------------------------------
 |         DATABASE CONFIG
 |         DB_NAME      : database name
 |         DB_USER      : database user
 |         DB_PASSWORD  : database password
 |         DB_HOST      : database host *** use IP address to avoid DSN lookup
 | -------------------------------------------------------------------
*/

define('DB_NAME', 'jk_basic_mvc');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1');


/*
 | -------------------------------------------------------------------
 |         DEFAULT CONTROLLER IF THERE ISN'T ONE DEFINED IN THE URL
 | -------------------------------------------------------------------
*/
define('DEFAULT_CONTROLLER', 'Home');


/*
 | -------------------------------------------------------------------
 |         DEFAULT LAYOUT
 |         if no layout is set in the controller use this layout.
 | -------------------------------------------------------------------
*/

 define('DEFAULT_LAYOUT', 'default');


 /*
 | -------------------------------------------------------------------
 |         PROJECT ROOT
 |         Exemple : 
 |          - if path is http://mvc.loc/ => PROOT is '/'
 |          - if path is http://localhost/mvc/ => PROOT is '/mvc/'
 | -------------------------------------------------------------------
*/

 define('PROOT', '/'); 



 /*
 | -------------------------------------------------------------------
 |         SITE TITLE
 |         This will be used if no site title is set
 | -------------------------------------------------------------------
*/

 define('SITE_TITLE', 'JanKlod MVC Framework');