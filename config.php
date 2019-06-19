<?php

/**
 * Set project path in constant ROOT
 */
define('ROOT', str_replace('\\','/', dirname(__FILE__)));

/**
 * could be named as class in components\connections(Redis or Sqlite)
 */
define('TYPE_CONNECTION', 'Redis');
define('DATABASE_PATH', ROOT.'/database.db');
