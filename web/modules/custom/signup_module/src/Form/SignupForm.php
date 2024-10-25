<?php

namespace Drupal\signup_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\user\Entity\User;
use Drupal\Core\Mail\MailManagerInterface;

class SignupForm extends FormBase {
  protected $mailManager;

  public function __construct(MailManagerInterface $mailManager) {
    $this->mailManager = $mailManager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.mail')
    );
  }

  public function getFormId() {
    return 'signup_module_signup_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attached']['library'][] = 'signup_module/signup_form_styles';

    $form['#prefix'] = '<div class="signup-form-wrapper">';
    $form['#suffix'] = '</div>';

    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#required' => TRUE,
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];
    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Sign Up'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $username = $form_state->getValue('username');
    $email = $form_state->getValue('email');
    $password = $form_state->getValue('password');

    // Create the user with status = 0 (blocked).
    $user = User::create([
      'name' => $username,
      'mail' => $email,
      'pass' => $password,
      'status' => 0,
    ]);
    $user->save();

    // Generate verification link.
    $user_id = $user->id();
    $verification_link = $GLOBALS['base_url'] . '/signup/verify/' . $user_id;

    // Send email.
    $module = 'signup_module';
    $key = 'verify_user';
    $to = $user->getEmail();
    $params['subject'] = $this->t('Verify your email address');
    $params['body'] = $this->t('Thank you for registering. Please click the following link to verify your account: @link', ['@link' => $verification_link]);

    $langcode = $user->getPreferredLangcode();
    $send = TRUE;

    // Ensure mail is sent properly with subject and body.
    $result = $this->mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
    
    if ($result['result'] !== TRUE) {
      \Drupal::messenger()->addError($this->t('There was a problem sending your email. Please contact the site administrator.'));
    } else {
      \Drupal::messenger()->addStatus($this->t('A verification email has been sent to your email address.'));
    }

    // Redirect to a page that shows verification sent message.
    $form_state->setRedirect('signup_module.verification_sent');
  }
}
