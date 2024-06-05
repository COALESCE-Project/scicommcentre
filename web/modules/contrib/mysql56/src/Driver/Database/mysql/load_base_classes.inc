<?php

// Isolate scope by running within a function.
(function () {
  // When using the "Drupal\Driver" namespace, the classes in /core/modules/mysql
  // aren't in the autoloader, but we need them.
  // @see \Drupal\Core\Site\Settings::initialize()
  if (version_compare(\Drupal::VERSION, '9.4', '>=')) {
    $classes = [
      'Install\\Tasks',
      'Connection',
      'Delete',
      'ExceptionHandler',
      'Insert',
      'Merge',
      'Schema',
      'Select',
      'Truncate',
      'Update',
      'Upsert',
    ];
    foreach ($classes as $class) {
      if (!class_exists('Drupal\\mysql\\Driver\\Database\\mysql\\' . $class)) {
        require_once DRUPAL_ROOT . '/core/modules/mysql/src/Driver/Database/mysql/' . str_replace('\\', '/', $class) . '.php';
      }
    }
  }
})();
