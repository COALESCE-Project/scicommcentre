<?php

namespace Drupal\simple_menu_permissions\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('entity.menu.add_form')) {
      $route->setRequirement('_permission', 'create new menu');
    }

    if ($route = $collection->get('entity.menu.add_link_form')) {
      $route->setRequirement('_custom_access', '\Drupal\simple_menu_permissions\Controller\SimpleMenuPermissionsAccess::createMenuLinkAccess');
    }
  }

}
