<?php

namespace Drupal\list_registered_users\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;

class ListRegisteredUsersController extends ControllerBase {

  /**
   * The database connection service.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Constructs a ListRegisteredUsersController object.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * Lists all registered users with their email, username, and role.
   *
   * @return array
   *   A renderable array.
   */
  public function listUsers() {
    // Get all users from the database.
    $query = $this->database->select('users_field_data', 'u');
    $query->join('user__roles', 'r', 'u.uid = r.entity_id');
    $query->fields('u', ['uid', 'name', 'mail']);
    $query->addField('r', 'roles_target_id', 'role');
    $query->condition('u.status', 1); // Ensure we only get active users.
    $result = $query->execute();

    $users = [];
    foreach ($result as $record) {
      $users[] = [
        'name' => $record->name,
        'email' => $record->mail,
        'full_name' => $record->name, // Replace with username as there is no field_full_name
        'role' => $record->role,
      ];
    }

    // Prepare the render array for output.
    $header = [
      $this->t('Username'),
      $this->t('Email'),
      $this->t('Full Name'),
      $this->t('Role'),
    ];

    $rows = [];
    foreach ($users as $user) {
      $rows[] = [
        $user['name'],
        $user['email'],
        $user['full_name'],
        $user['role'],
      ];
    }

    $build = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => $this->t('No users found.'),
    ];

    return $build;
  }
}
