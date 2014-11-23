Dbtable
---------------------------
Use it  to retrieve information of datatables 
in a Database. 
PHP classes for database handling upon PDO.

License 
------------------
This software is free software and carries a MIT license.

History
-----------------------------------
v 1 First edition
*Based upon mos/database and mos/cform package.
*The intention is to explore all datafiles in a database.

How to use Cdbtable  
===================
Copy the map Dbtables in vendor/roka/Dbtable/src to your app/src map  
and also the map Dbtables in vendor/roka/Dbtable/view to your app/view map    

Insert to your Index-file in webroot  
  
> $di->set('DbtablesController', function() use ($di) {
    $controll = new \Roka\Dbtables\DbtablesController();
    $controll->setDI($di);
    return $controll;
});

You must have a database connection open ie like this   
  
> $di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
  // $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
	 $db->setOptions(require ANAX_APP_PATH . 'config/config_sqlite.php');
    $db->connect();
    return $db;
});

You can use it from the browsner like the link

/webroot/Dbtables/select

```
 .  
..:  Copyright (c) 2014 Göran Karlsson rgoran.karlsson@teila.com
```


