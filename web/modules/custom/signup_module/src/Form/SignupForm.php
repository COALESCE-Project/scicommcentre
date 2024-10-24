<?php

namespace Drupal\signup_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\user\Entity\User;
use Drupal\Core\Mail\MailManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
      '#description' => $this->t('Please enter a valid email address.'),
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

    // Validate email format.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $form_state->setErrorByName('email', $this->t('The email address is not valid.'));
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
    // Create a new user entity with status 0 (blocked) until verified.
    $user = User::create([
      'mail' => $form_state->getValue('email'),
      'pass' => $form_state->getValue('password'),
      'status' => 0,
    ]);

    // Save the user entity.
    $user->save();

    // Generate verification link.
    $verification_link = Url::fromRoute('signup_module.verify', ['user' => $user->id()], ['absolute' => TRUE])->toString();

    // Send verification email.
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'signup_module';
    $key = 'user_verification';
    $to = $user->getEmail();
    $params['message'] = $this->t('Please click the following link to verify your registration: @link', ['@link' => $verification_link]);
    $langcode = $user->getPreferredLangcode();
    $send = TRUE;

    $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

    // Redirect to the confirmation page.
    $form_state->setRedirect('signup_module.verification_sent');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.mail')
    );
  }
}
