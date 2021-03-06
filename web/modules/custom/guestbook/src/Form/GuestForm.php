<?php

namespace Drupal\guestbook\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class GuestForm extends ContentEntityForm {

  public function save(array $form, FormStateInterface $form_state) {
    parent::save($form, $form_state);

    $entity = $this->getEntity();
    $entity_type = $entity->getEntityType();

    $arguments = [
      '@entity_type' => $entity_type->getSingularLabel(),
      '%entity' => $entity->label(),
      'link' => $entity->toLink($this->t('View'), 'canonical')->toString(),
    ];

    $this->logger($entity->getEntityTypeId())->notice('Form was submited', $arguments);
    $this->messenger()->addStatus($this->t('The file was saved - 2.', $arguments));

    $form_state->setRedirectUrl($entity->toUrl('canonical'));
  }

}
