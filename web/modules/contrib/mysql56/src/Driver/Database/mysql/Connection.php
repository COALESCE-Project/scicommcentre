<?php

namespace Drupal\mysql56\Driver\Database\mysql;

use Drupal\Core\Database\Driver\mysql\Connection as CoreMysqlConnection;

require_once __DIR__ . '/load_base_classes.inc';

/**
 * MySQL 5.6 implementation of \Drupal\Core\Database\Driver\mysql\Connection.
 */
class Connection extends CoreMysqlConnection {

  /**
   * {@inheritdoc}
   */
  public function __construct(\PDO $connection, array $connection_options) {
    // @see https://www.drupal.org/project/drupal/issues/3218978
    // @todo Remove this when the above issue is committed.
    if ($this->identifierQuotes === ['"', '"'] && strpos($connection_options['init_commands']['sql_mode'], 'ANSI') === FALSE) {
      $this->identifierQuotes = ['`', '`'];
    }
    parent::__construct($connection, $connection_options);
  }

  /**
   * {@inheritdoc}
   */
  public function getDriverClass($class) {
    if (empty($this->driverClasses[$class])) {
      $namespaces = [
        $this->connectionOptions['namespace'],
        'Drupal\\mysql\\Driver\\Database\\mysql',
      ];
      foreach ($namespaces as $namespace) {
        $driver_class = $namespace . '\\' . $class;
        if (class_exists($driver_class)) {
          $this->driverClasses[$class] = $driver_class;
          break;
        }
      }
      if (empty($this->driverClasses[$class])) {
        $this->driverClasses[$class] = parent::getDriverClass($class);
      }
    }
    return $this->driverClasses[$class];
  }

  /**
   * {@inheritdoc}
   */
  public function hasJson(): bool {
    // MySQL 5.6 does not have JSON support, so this is a lie, but Drupal 10
    // requires this function to return true. Drupal 10.0 does not execute JSON
    // queries, so this lie is acceptable for now, but Drupal 10.1 might
    // execute JSON queries that will throw exceptions on MySQL 5.6.
    return TRUE;
  }

}
