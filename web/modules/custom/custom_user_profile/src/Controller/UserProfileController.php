<?php

namespace Drupal\custom_user_profile\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserProfileController extends ControllerBase {

  protected $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  public function userProfile($user_id) {
    // Fetch user profile information from the database.
    $query = $this->database->select('user_custom_profile', 'ucp')
      ->fields('ucp')
      ->condition('user_id', $user_id)
      ->execute();
    $user_data = $query->fetchAssoc();

    // If no user data is found, return an error message.
    if (empty($user_data)) {
      return [
        '#markup' => $this->t('User profile not found.'),
      ];
    }

    // Build the render array for displaying user profile information.
    $build = [
      '#theme' => 'user_profile_page',
      '#user_data' => $user_data,
    ];

    return $build;
  }
}
