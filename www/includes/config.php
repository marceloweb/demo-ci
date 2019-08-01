<?php

return array(
    'database' => array(
        'driver' => getenv("DB_DRIVER"),
        'dbname' => getenv("DBNAME"),
        'host' => getenv("DB_HOST"),
        'user'  => getenv("DB_USER"),
        'passwd' => getenv("DB_PASSWD")    
    )
);