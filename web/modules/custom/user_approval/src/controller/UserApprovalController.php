<?php

namespace Drupal\user_approval\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Database\Database;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Controller for handling user approval and rejection.
 */
class UserApprovalController extends ControllerBase {

  /**
   * Displays a list of users with approve/reject buttons in a separate column.
   */
  public function approvalPage() {
    // Get the database connection.
    $connection = Database::getConnection();

    // Query to get users from users_field_data table.
    $query = $connection->select('users_field_data', 'ufd')
      ->fields('ufd', ['uid', 'name', 'mail', 'status']);  // Select fields from users_field_data.

    // Execute the query and fetch the result.
    $result = $query->execute()->fetchAll();

    // Prepare the rows for the table.
    $rows = [];

    // Get the roles for users in a separate query.
    $role_query = $connection->select('user__roles', 'ur')
      ->fields('ur', ['entity_id', 'roles_target_id'])  // Select the user ID and roles.
      ->execute()->fetchAllKeyed(0, 1);  // Fetch as a keyed array with user ID as key.

    foreach ($result as $user) {
      // Fetch the user's roles from the roles query.
      $roles = isset($role_query[$user->uid]) ? $role_query[$user->uid] : 'No roles';

      // Create approve and reject links as actions.
      $approve_link = Link::fromTextAndUrl(
        $this->t('Approve'),
        Url::fromRoute('user_approval.approve_user', ['user' => $user->uid])
      )->toRenderable();

      $reject_link = Link::fromTextAndUrl(
        $this->t('Reject'),
        Url::fromRoute('user_approval.reject_user', ['user' => $user->uid])
      )->toRenderable();

      // Add a row with the user data and actions in separate columns.
      $rows[] = [
        'data' => [
          ['#markup' => $user->name],   // Name column
          ['#markup' => $user->mail],   // Email column
          ['#markup' => $roles],        // Roles column
          ['#markup' => ($user->status ? $this->t('Active') : $this->t('Blocked'))],  // Status column
          [                              // Actions column
            'data' => [
              '#type' => 'container',
              'approve' => $approve_link,
              'separator' => ['#markup' => ' | '],
              'reject' => $reject_link,
            ],
          ],
        ],
      ];
    }

    // Return the table render array.
    return [
      '#type' => 'table',
      '#header' => [
        $this->t('Name'),
        $this->t('Email'),
        $this->t('Roles'),
        $this->t('Status'),
        $this->t('Actions'),
      ],
      '#rows' => $rows,
      '#empty' => $this->t('No users found for approval.'),
    ];
  }

  /**
   * Approves a user by setting their status to 1.
   */
  public function approveUser($user) {
    $connection = Database::getConnection();

    // Update the user's status to approved (status = 1).
    $connection->update('users_field_data')
      ->fields(['status' => 1])
      ->condition('uid', $user)
      ->execute();

    $this->messenger()->addStatus($this->t('User @uid has been approved.', ['@uid' => $user]));

    return new RedirectResponse(Url::fromRoute('user_approval.user_approval_page')->toString());
  }

  /**
   * Rejects (blocks) a user by setting their status to 0.
   */
  public function rejectUser($user) {
    $connection = Database::getConnection();

    // Block the user by setting their status to 0.
    $connection->update('users_field_data')
      ->fields(['status' => 0])
      ->condition('uid', $user)
      ->execute();

    $this->messenger()->addStatus($this->t('User @uid has been rejected.', ['@uid' => $user]));

    return new RedirectResponse(Url::fromRoute('user_approval.user_approval_page')->toString());
  }
}
