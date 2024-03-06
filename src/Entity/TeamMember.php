<?php

namespace Drupal\my_team_member\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\image\Entity\Image;

/**
 * Defines the Team Member entity.
 *
 * @ingroup team_member
 */
class TeamMember extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityInterface $entity, $clone) {
    parent::preCreate($entity, $clone);
    $entity->setNewRevision();
  }

  /**
   * {@inheritdoc}
   */
  public function getBaseFieldDefinitions() {
    $fields = parent::getBaseFieldDefinitions();

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setRequired(TRUE);

    $fields['field_position'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Position'));

    $fields['field_biography'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Biography'));

    $fields['field_photo'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Photo'))
      ->setSetting('target_type', 'image')
      ->setSetting('style', 'thumbnail')
      ->setCardinality(1);

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getEntityType() {
    return $this->entityType;
  }

  /**
   * {@inheritdoc}
   */
  public static function entityTypeLabel() {
    return t('Team Member');
  }
}
