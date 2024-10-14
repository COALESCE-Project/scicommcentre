<?php

namespace Drupal\signup_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

class SignupForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'signup_module_signup_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attached']['library'][] = 'signup_module/signup_form_styles';

    $form['#prefix'] = '<div class="signup-form-wrapper">';
    $form['#suffix'] = '</div>';

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Enter Email'),
      '#required' => TRUE,
    ];

    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Full Name'),
      '#required' => TRUE,
    ];

    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Username'),
      '#required' => TRUE,
    ];

    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Enter Password'),
      '#required' => TRUE,
    ];

    $form['confirm_password'] = [
      '#type' => 'password',
      '#title' => $this->t('Re-enter Password'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Register'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    $username = $form_state->getValue('username');
    $password = $form_state->getValue('password');

    // Check if a user with the provided email exists.
    $user_query = \Drupal::entityQuery('user')
      ->condition('mail', $email)
      ->condition('status', 1) // Ensure the user is active.
      ->accessCheck(FALSE) // Disable access checking to avoid permissions errors.
      ->execute();

    if (!empty($user_query)) {
      $form_state->setErrorByName('email', $this->t('A user account with this email already exists.'));
      return;
    }

    // Check if a user with the provided username exists.
    $user_query_username = \Drupal::entityQuery('user')
      ->condition('name', $username)
      ->condition('status', 1) // Ensure the user is active.
      ->accessCheck(FALSE) // Disable access checking to avoid permissions errors.
      ->execute();

    if (!empty($user_query_username)) {
      $form_state->setErrorByName('username', $this->t('Username already exists.'));
    }

    // Validate password match.
    if ($password !== $form_state->getValue('confirm_password')) {
      $form_state->setErrorByName('confirm_password', $this->t('Passwords do not match.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Create a new user entity.
    $user = User::create([
      'name' => $form_state->getValue('username'),
      'mail' => $form_state->getValue('email'),
      'pass' => $form_state->getValue('password'),
      'status' => 1,
    ]);

    // Save the user entity.
    $user->save();

    // Display a success message.
    \Drupal::messenger()->addMessage($this->t('Thank you for registering.'));
  }
}
