<?php

namespace Drupal\signin_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;

class SigninForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'signin_module_signin_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attached']['library'][] = 'signin_module/signin_form_styles';

    $form['#prefix'] = '<div class="signin-form-wrapper">';
    $form['#suffix'] = '</div>';

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Enter Email'),
      '#required' => TRUE,
    ];

    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Enter Password'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Sign In'),
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

    if (empty($user_query)) {
      $form_state->setErrorByName('email', $this->t('No user account found for this email.'));
      return;
    }

    $user = User::load(reset($user_query));

    // Check the provided password against the stored password.
    if (!$user || !\Drupal::service('password')->check($password, $user->getPassword())) {
      $form_state->setErrorByName('password', $this->t('The password you have entered is incorrect.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    $user_query = \Drupal::entityQuery('user')
      ->condition('mail', $email)
      ->condition('status', 1)
      ->accessCheck(FALSE) // Disable access checking to avoid permissions errors.
      ->execute();

    $user = User::load(reset($user_query));

    // Sign in the user.
    user_login_finalize($user);

    // Redirect to user dashboard or home page.
    $url = Url::fromRoute('<front>');
    $response = new RedirectResponse($url->toString());
    $response->send();
  }
}
