<?php

namespace Drupal\custom_user_profile\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\file\Entity\File;
use function \Drupal\file_create_url; 

/**
 * Class CustomUserProfileForm.
 */
class CustomUserProfileForm extends FormBase {

  protected $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_user_profile_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $user = \Drupal::currentUser();
    $user_id = $user->id();

    // Load existing data.
    $query = $this->database->select('user_custom_profile', 'ucp')
      ->fields('ucp')
      ->condition('user_id', $user_id)
      ->execute();
    $user_data = $query->fetchAssoc();

    // Attach custom CSS for styling.
    $form['#attached']['library'][] = 'custom_user_profile/profile_form_styles';

    // Form wrapper for alignment and responsiveness.
    $form['#prefix'] = '<div class="custom-user-profile-wrapper">';
    $form['#suffix'] = '</div>';

    // Basic Information Section
    $form['basic_info'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Basic Information'),
      '#attributes' => ['class' => ['form-section']],
    ];

    $form['basic_info']['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#required' => TRUE,
      '#default_value' => $user_data['name'] ?? '',
    ];

    $form['basic_info']['surname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Surname'),
      '#required' => TRUE,
      '#default_value' => $user_data['surname'] ?? '',
    ];

    $form['basic_info']['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
      '#default_value' => $user_data['email'] ?? '',
    ];

    $form['basic_info']['email_visible'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Make email visible in public profile'),
      '#default_value' => $user_data['email_visible'] ?? 0,
    ];

    // Profile Picture Section
    $form['profile_picture'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Profile Picture'),
      '#upload_location' => 'public://profile_pictures/',
      '#default_value' => isset($user_data['picture']) ? [$user_data['picture']] : [],
      '#description' => $this->t('Upload your profile picture.'),
    ];

    if (isset($user_data['picture']) && !empty($user_data['picture'])) {
      $file = File::load($user_data['picture']);
      if ($file) {
        $form['profile_picture_display'] = [
          '#markup' => '<img src="' . \Drupal::service('file_url_generator')->generateAbsoluteString($file->getFileUri()) . '" alt="Profile Picture" class="profile-picture-preview">',
        ];
      }
    }

    // Location Information Section
    $form['location_info'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Location Information'),
      '#attributes' => ['class' => ['form-section']],
    ];

    $form['location_info']['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#required' => TRUE,
      '#default_value' => $user_data['country'] ?? '',
    ];

    $form['location_info']['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#required' => TRUE,
      '#default_value' => $user_data['city'] ?? '',
    ];

    // Organisation Information Section
    $form['organisation_info'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Organisation Information'),
      '#attributes' => ['class' => ['form-section']],
    ];

    $form['organisation_info']['organisation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Organisation'),
      '#default_value' => $user_data['organisation'] ?? '',
    ];

    $form['organisation_info']['organisation_type'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Type of Organisation'),
      '#required' => TRUE,
      '#default_value' => $user_data['organisation_type'] ?? '',
    ];

    $form['organisation_info']['position'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Position within Organisation'),
      '#default_value' => $user_data['position'] ?? '',
    ];

    // Consent Section
    $form['consent'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Consent and Confirmation'),
      '#attributes' => ['class' => ['form-section']],
    ];

    $form['consent']['consent_read'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I confirm I have read and understood.'),
      '#default_value' => $user_data['consent_read'] ?? 0,
    ];

    $form['consent']['consent_data'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I consent to the collection of data.'),
      '#default_value' => $user_data['consent_data'] ?? 0,
    ];

    $form['consent']['consent_public'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I consent to have my profile publicly visible.'),
      '#default_value' => $user_data['consent_public'] ?? 0,
    ];

    // Submit Button
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Profile'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Save form values to database.
    $user = \Drupal::currentUser();
    $user_id = $user->id();
    $values = $form_state->getValues();

    $fields = [
      'user_id' => $user_id,
      'name' => $values['name'],
      'surname' => $values['surname'],
      'email' => $values['email'],
      'email_visible' => $values['email_visible'],
      'country' => $values['country'],
      'city' => $values['city'],
      'organisation' => $values['organisation'],
      'organisation_type' => $values['organisation_type'],
      'position' => $values['position'],
      'consent_read' => $values['consent_read'],
      'consent_data' => $values['consent_data'],
      'consent_public' => $values['consent_public'],
    ];

    if (!empty($values['profile_picture'])) {
      $fields['picture'] = reset($values['profile_picture']);
    }

    $this->database->merge('user_custom_profile')
      ->key(['user_id' => $user_id])
      ->fields($fields)
      ->execute();

    // Display success message.
    $this->messenger()->addMessage($this->t('Your profile has been updated.'));
  }
}
