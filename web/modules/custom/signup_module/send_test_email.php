<?php

use Drupal\Core\Mail\MailManagerInterface;
use Drupal\Core\Language\LanguageInterface;

/**
 * Sends a test email.
 */
function send_test_email() {
  $mailManager = \Drupal::service('plugin.manager.mail');
  $module = 'signup_module';
  $key = 'test_email';
  $to = 'itturzo@gmail.com';
  $params['from'] = 'turzo.lut@gmail.com';
  $params['message'] = 'This is a test email to verify SMTP settings.';
  $langcode = \Drupal::currentUser()->getPreferredLangcode();
  $send = TRUE;

  $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

  if ($result['result'] !== TRUE) {
    \Drupal::messenger()->addMessage(t('There was a problem sending your email and it was not sent.'), 'error');
  }
  else {
    \Drupal::messenger()->addMessage(t('The test email has been sent.'));
  }
}

// Call the function.
send_test_email();
