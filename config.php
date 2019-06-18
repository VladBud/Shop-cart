<?php

/**
 * Set project path in constant ROOT
 */
define('ROOT', str_replace('\\','/', dirname(__FILE__)));

define('TYPE_CONNECTION', 'sqlite');
define('DATABASE_PATH', ROOT.'/database.db');
