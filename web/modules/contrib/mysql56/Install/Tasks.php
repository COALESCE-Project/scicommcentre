<?php

namespace Drupal\Driver\Database\mysql\Install;

use Drupal\mysql56\Driver\Database\mysql\Install\Tasks as Mysql56Tasks;

// For sites using the legacy namespace and not using Composer, this isn't in
// the autoloader.
require_once __DIR__ . '/../src/Driver/Database/mysql/Install/Tasks.php';

class Tasks extends Mysql56Tasks {}
