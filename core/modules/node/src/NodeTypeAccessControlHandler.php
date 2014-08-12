<?php

/**
 * @file
 * Contains \Drupal\taxonomy\NodeTypeAccessControlHandler.
 */

namespace Drupal\node;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the node type entity type.
 *
 * @see \Drupal\node\Entity\NodeType
 */
class NodeTypeAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {
    if ($operation == 'delete' && $entity->isLocked()) {
      return FALSE;
    }
    return parent::checkAccess($entity, $operation, $langcode, $account);
  }

}