<?php 
/*
 | -------------------------------------------------------------------
 |         SET TRUE OR FALSE MODULE DEBUG
 | -------------------------------------------------------------------
*/
 define('DEBUG', true);


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