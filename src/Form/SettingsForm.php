<?php

namespace Drupal\drupal_helpcrunch\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Drupal HelpCrunch settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupal_helpcrunch_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['drupal_helpcrunch.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('drupal_helpcrunch.settings')->get('settings');

    $form['#attached']['library'][] = 'drupal_helpcrunch/drupal_helpcrunch_styles';

    $form['widget_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Widget name'),
      '#default_value' => $config['widget_name'] ?? '',
    ];

    $form['application_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Application id'),
      '#default_value' => $config['application_id'] ?? '',
    ];

    $form['application_secret'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Application secret'),
      '#default_value' => $config['application_secret'] ?? '',
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('drupal_helpcrunch.settings')
      ->set('settings', [
        'widget_name' => $form_state->getValue('widget_name'),
        'application_id' => $form_state->getValue('application_id'),
        'application_secret' => $form_state->getValue('application_secret'),
      ])
      ->save();

    parent::submitForm($form, $form_state);
  }

}
