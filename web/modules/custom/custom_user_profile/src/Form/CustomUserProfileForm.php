<?php

namespace Drupal\custom_user_profile\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\file\Entity\File;
use Drupal\user\Entity\User;

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

  public function getFormId() {
    return 'custom_user_profile_form';
  }

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

    // Consent and confirmation fields.
    $form['consent_read'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I confirm I have read and understood the privacy policy'),
      '#required' => TRUE,
      '#default_value' => $user_data['consent_read'] ?? 0,
    ];

    $form['consent_data'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I consent to the collection of data'),
      '#required' => TRUE,
      '#default_value' => $user_data['consent_data'] ?? 0,
    ];

    $form['consent_public'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('I consent to have my profile publicly visible in the matchmaking tool'),
      '#required' => TRUE,
      '#default_value' => $user_data['consent_public'] ?? 0,
    ];

    // User details
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
      '#default_value' => $user_data['name'] ?? '',
    ];

    $form['surname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Surname'),
      '#required' => TRUE,
      '#default_value' => $user_data['surname'] ?? '',
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
      '#default_value' => $user_data['email'] ?? '',
    ];

    $form['email_visible'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Make email visible on profile'),
      '#default_value' => $user_data['email_visible'] ?? 0,
    ];

    $form['picture'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Profile Picture'),
      '#upload_location' => 'public://profile_pictures/',
      '#default_value' => $user_data['picture'] ?? '',
      '#required' => FALSE,
      '#description' => $this->t('Upload a profile picture. Allowed extensions: jpg, jpeg, png.'),
    ];

    $form['gender'] = [
      '#type' => 'select',
      '#title' => $this->t('Gender'),
      '#options' => [
        'woman' => $this->t('Woman'),
        'man' => $this->t('Man'),
        'non_binary' => $this->t('Non-binary'),
        'prefer_not_disclose' => $this->t('Prefer not to disclose'),
        'self_describe' => $this->t('Prefer to self-describe'),
      ],
      '#required' => TRUE,
      '#default_value' => $user_data['gender'] ?? '',
    ];

    $form['year_of_birth'] = [
      '#type' => 'select',
      '#title' => $this->t('Year of Birth'),
      '#options' => array_combine(range(date('Y'), 1934), range(date('Y'), 1934)),
      '#required' => TRUE,
      '#default_value' => $user_data['year_of_birth'] ?? '',
    ];

    $form['is_over_18'] = [
      '#type' => 'radios',
      '#title' => $this->t('Are you over 18?'),
      '#options' => [
        '1' => $this->t('Yes'),
        '0' => $this->t('No'),
      ],
      '#required' => TRUE,
      '#default_value' => $user_data['is_over_18'] ?? 1,
    ];

    $form['languages'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Languages'),
      '#description' => $this->t('Enter languages separated by commas.'),
      '#required' => TRUE,
      '#default_value' => $user_data['languages'] ?? '',
    ];

    $form['languages_public'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Make languages visible on profile'),
      '#default_value' => $user_data['languages_public'] ?? 0,
    ];

    // Country and city fields
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#required' => TRUE,
      '#default_value' => $user_data['country'] ?? '',
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#required' => TRUE,
      '#default_value' => $user_data['city'] ?? '',
    ];

    $form['location_public'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Make location visible on profile'),
      '#default_value' => $user_data['location_public'] ?? 0,
    ];

    // Organisation details
    $form['organisation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Organisation'),
      '#default_value' => $user_data['organisation'] ?? '',
    ];

    $form['organisation_public'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Make organisation visible on profile'),
      '#default_value' => $user_data['organisation_public'] ?? 0,
    ];

    $form['organisation_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Type of Organisation'),
      '#options' => [
        'university' => $this->t('University'),
        'sme' => $this->t('SME'),
        'company' => $this->t('Company'),
        'research_centre' => $this->t('Research Centre'),
        'civic_organisation' => $this->t('Civic Organisation'),
        'museum' => $this->t('Museum'),
        'none' => $this->t('None'),
        'other' => $this->t('Other'),
      ],
      '#required' => TRUE,
      '#default_value' => $user_data['organisation_type'] ?? '',
    ];

    $form['position'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Position within the Organisation'),
      '#default_value' => $user_data['position'] ?? '',
    ];

    $form['position_public'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Make position visible on profile'),
      '#default_value' => $user_data['position_public'] ?? 0,
    ];

    // Submit button
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Profile'),
      '#attributes' => [
        'class' => ['button--primary'],
      ],
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Add custom validation rules here if necessary.
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $user = \Drupal::currentUser();
    $user_id = $user->id();

    // Save uploaded file and set it to permanent.
    $file_id = $form_state->getValue('picture');
    if (!empty($file_id) && is_array($file_id)) {
      $file = File::load($file_id[0]);
      if ($file) {
        $file->setPermanent();
        $file->save();
      }
    }

    // Insert or update the user's custom profile data.
    $fields = [
      'user_id' => $user_id,
      'name' => $form_state->getValue('name'),
      'surname' => $form_state->getValue('surname'),
      'email' => $form_state->getValue('email'),
      'email_visible' => $form_state->getValue('email_visible'),
      'picture' => !empty($file_id) ? $file_id[0] : NULL,
      'gender' => $form_state->getValue('gender'),
      'year_of_birth' => $form_state->getValue('year_of_birth'),
      'is_over_18' => $form_state->getValue('is_over_18'),
      'languages' => $form_state->getValue('languages'),
      'languages_public' => $form_state->getValue('languages_public'),
      'country' => $form_state->getValue('country'),
      'city' => $form_state->getValue('city'),
      'location_public' => $form_state->getValue('location_public'),
      'organisation' => $form_state->getValue('organisation'),
      'organisation_public' => $form_state->getValue('organisation_public'),
      'organisation_type' => $form_state->getValue('organisation_type'),
      'position' => $form_state->getValue('position'),
      'position_public' => $form_state->getValue('position_public'),
    ];

    $existing = $this->database->select('user_custom_profile', 'ucp')
      ->fields('ucp', ['id'])
      ->condition('user_id', $user_id)
      ->execute()
      ->fetchField();

    if ($existing) {
      // Update the existing profile.
      $this->database->update('user_custom_profile')
        ->fields($fields)
        ->condition('user_id', $user_id)
        ->execute();
    } else {
      // Insert new profile data.
      $this->database->insert('user_custom_profile')
        ->fields($fields)
        ->execute();
    }

    // Success message.
    $this->messenger()->addMessage($this->t('Your profile has been successfully updated.'));
  }
}
