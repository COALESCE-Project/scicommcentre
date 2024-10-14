<?php

namespace Drupal\custom_user_profile\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

class CustomUserProfileForm extends FormBase {

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
    $form['#attached']['library'][] = 'custom_user_profile/custom_user_profile_styles';

    // Personal Information fields.
    $form['over_18'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Are you over 18 years old?'),
    ];

    $form['gender'] = [
      '#type' => 'select',
      '#title' => $this->t('Gender'),
      '#options' => [
        'M' => $this->t('Male'),
        'F' => $this->t('Female'),
        'other' => $this->t('Other'),
        'prefer_not_to_say' => $this->t('Prefer not to say'),
      ],
    ];

    $form['age'] = [
      '#type' => 'number',
      '#title' => $this->t('Year of Birth'),
      '#min' => 1900,
      '#max' => date('Y'),
      '#required' => TRUE,
    ];

    $form['languages'] = [
      '#type' => 'select',
      '#title' => $this->t('Languages'),
      '#options' => $this->getLanguagesList(),
      '#multiple' => TRUE,
      '#required' => TRUE,
    ];

    $form['country'] = [
      '#type' => 'select',
      '#title' => $this->t('Country'),
      '#options' => $this->getCountriesList(),
      '#required' => TRUE,
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#required' => TRUE,
    ];

    // Professional Information fields.
    $form['organization'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Organization'),
      '#required' => TRUE,
    ];

    $form['organization_type'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Type of Organization'),
      '#required' => TRUE,
    ];

    $form['position'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Position within the Organization'),
      '#required' => TRUE,
    ];

    // Stakeholder Categories fields.
    $form['primary_stakeholder_category'] = [
      '#type' => 'select',
      '#title' => $this->t('Primary Stakeholder Category'),
      '#options' => $this->getStakeholderCategories(),
      '#required' => TRUE,
    ];

    $form['secondary_stakeholder_categories'] = [
      '#type' => 'select',
      '#title' => $this->t('Secondary Stakeholder Categories'),
      '#options' => $this->getStakeholderCategories(),
      '#multiple' => TRUE,
      '#required' => TRUE,
    ];

    // Areas of Science Communication Expertise.
    $form['scicomm_expertise'] = [
      '#type' => 'select',
      '#title' => $this->t('Areas of Science Communication Expertise (select up to 2)'),
      '#options' => $this->getScicommExpertise(),
      '#multiple' => TRUE,
      '#required' => TRUE,
      '#validated' => TRUE,
      '#element_validate' => [[get_class($this), 'validateMaxSelection']],
      '#max_selection' => 2,
    ];

    // Scale of Action.
    $form['scale_of_action'] = [
      '#type' => 'select',
      '#title' => $this->t('Scale of Action'),
      '#options' => $this->getScaleOfAction(),
      '#multiple' => TRUE,
      '#required' => TRUE,
    ];

    // Scientific Areas of Expertise.
    $form['scientific_expertise'] = [
      '#type' => 'select',
      '#title' => $this->t('Scientific Areas of Expertise'),
      '#options' => $this->getScientificExpertise(),
      '#multiple' => TRUE,
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Profile'),
    ];

    return $form;
  }

  protected function getStakeholderCategories() {
    return [
      'scientists_researchers' => $this->t('Stakeholder category - Scientists/researchers'),
      'science_communication_scholar' => $this->t('Stakeholder category - Science communication scholar'),
      'science_journalists' => $this->t('Stakeholder category - Science journalists'),
      'generalist_journalist' => $this->t('Stakeholder category - Generalist journalist'),
      'museum_expert' => $this->t('Stakeholder category - Museum expert'),
      'communication_officer' => $this->t('Stakeholder category - Communication officer'),
      'science_communication_practitioner' => $this->t('Stakeholder category - Science communication practitioner'),
      'policy_maker' => $this->t('Stakeholder category - Policy maker'),
      'citizen' => $this->t('Stakeholder category - Citizen'),
      'software_developer' => $this->t('Stakeholder category - Software developer'),
      'science_communication_trainer' => $this->t('Stakeholder category - Science communication trainer'),
      'other' => $this->t('Stakeholder category - Other'),
    ];
  }

  protected function getScicommExpertise() {
    return [
      'journalism' => $this->t('Area of Scicomm expertise - Journalism'),
      'science_journalism' => $this->t('Area of Scicomm expertise - Science journalism'),
      'museums' => $this->t('Area of Scicomm expertise - Museums'),
      'social_media' => $this->t('Area of Scicomm expertise - Social media'),
      'art_science' => $this->t('Area of Scicomm expertise - Art & science'),
      'none' => $this->t('Area of Scicomm expertise - None'),
      'other' => $this->t('Area of Scicomm expertise - Other'),
    ];
  }

  protected function getScaleOfAction() {
    return [
      'international' => $this->t('Scale of action - International'),
      'national' => $this->t('Scale of action - National'),
      'local' => $this->t('Scale of action - Local'),
      'other' => $this->t('Scale of action - Other'),
    ];
  }

    protected function getScientificExpertise() {
        return [
        'does_not_apply' => $this->t('Scientific area of expertise - does not apply'),
        'climate' => $this->t('Scientific area of expertise - Climate'),
        'water_ocean_soils' => $this->t('Scientific area of expertise - Water, ocean, and soils'),
        'ai_digital_transformation' => $this->t('Scientific area of expertise - AI and digital transformation'),
        'health_vaccines' => $this->t('Scientific area of expertise - Health and vaccines'),
        'social_sciences' => $this->t('Scientific area of expertise - Social sciences'),
        'policy' => $this->t('Scientific area of expertise - Policy'),
        'food' => $this->t('Scientific area of expertise - Food'),
        'energy' => $this->t('Scientific area of expertise - Energy'),
        'waste' => $this->t('Scientific area of expertise - Waste'),
        'other' => $this->t('Scientific area of expertise - Other'),
        ];
    }


    protected function getLanguagesList() {
    // A sample list of languages, this could be replaced by a more comprehensive source.
        return [
        'en' => $this->t('English'),
        'es' => $this->t('Spanish'),
        'fr' => $this->t('French'),
        'de' => $this->t('German'),
        'fi' => $this->t('Finning'),
        'sw' => $this->t('Swedish'),
        'other' => $this->t('Other'),
        ];
    }

    protected function getCountriesList() {
        // A sample list of countries, this could be replaced by a more comprehensive source.
        return [
            'fi' => $this->t('Finland'),
            'ca' => $this->t('Canada'),
            'uk' => $this->t('United Kingdom'),
            'au' => $this->t('Australia'),
            'other' => $this->t('Other'),
        ];
    }


  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Additional validation for max selection.
    if (count($form_state->getValue('scicomm_expertise')) > 2) {
      $form_state->setErrorByName('scicomm_expertise', $this->t('You can select up to 2 areas of science communication expertise.'));
    }
  }

    protected function generateCode() {
        return 'USER-' . strtoupper(substr(sha1(uniqid(mt_rand(), TRUE)), 0, 8));
    }

    /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $connection = Database::getConnection();
        $connection->insert('user_profile')
        ->fields([
            'code' => $this->generateCode(),
            'registration_time' => date('Y-m-d H:i:s'), // Add registration time
            'over_18' => $form_state->getValue('over_18'),
            'gender' => $form_state->getValue('gender'),
            'age' => $form_state->getValue('age'),
            'languages' => implode(',', $form_state->getValue('languages')),
            'country' => $form_state->getValue('country'),
            'city' => $form_state->getValue('city'),
            'organization' => $form_state->getValue('organization'),
            'organization_type' => $form_state->getValue('organization_type'),
            'position' => $form_state->getValue('position'),
            'primary_stakeholder_category' => $form_state->getValue('primary_stakeholder_category'),
            'secondary_stakeholder_categories' => implode(',', $form_state->getValue('secondary_stakeholder_categories')),
            'scicomm_expertise' => implode(',', $form_state->getValue('scicomm_expertise')),
            'scale_of_action' => implode(',', $form_state->getValue('scale_of_action')),
            'scientific_expertise' => implode(',', $form_state->getValue('scientific_expertise')),
        ])
        ->execute();

        \Drupal::messenger()->addMessage($this->t('User profile has been saved successfully.'));
    }


}
