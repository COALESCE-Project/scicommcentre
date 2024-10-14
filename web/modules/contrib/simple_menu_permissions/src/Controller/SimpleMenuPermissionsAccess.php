<?php

namespace Drupal\simple_menu_permissions\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Builds an example page.
 */
class SimpleMenuPermissionsAccess {

  /**
   * Checks access for a specific request.
   */
  public function createMenuLinkAccess(AccountInterface $account, string $menu): \Drupal\Core\Access\AccessResultReasonInterface|AccessResult {
    return AccessResult::allowedIfHasPermission($account, 'add new links to ' . $menu . ' menu');
  }

}

