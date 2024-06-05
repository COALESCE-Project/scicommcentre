<?php

namespace Drupal\mysql56\Driver\Database\mysql\Install;

use Drupal\Core\Database\Driver\mysql\Install\Tasks as CoreMysqlTasks;

require_once __DIR__ . '/../load_base_classes.inc';

/**
 * Specifies installation tasks for MySQL 5.6 and equivalent databases.
 */
class Tasks extends CoreMysqlTasks {

  const MYSQL_MINIMUM_VERSION = '5.6';
  const MARIADB_MINIMUM_VERSION = '10.0';

}
