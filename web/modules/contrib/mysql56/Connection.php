<?php

namespace Drupal\Driver\Database\mysql;

use Drupal\mysql56\Driver\Database\mysql\Connection as Mysql56Connection;

// For sites using the legacy namespace and not using Composer, this isn't in
// the autoloader.
require_once __DIR__ . '/src/Driver/Database/mysql/Connection.php';

class Connection extends Mysql56Connection {}
