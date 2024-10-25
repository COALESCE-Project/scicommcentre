<?php

namespace Drupal\signup_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\user\UserInterface;

class SignupController extends ControllerBase {

  /**
   * Verifies the user registration.
   *
   * @param \Drupal\user\UserInterface $user
   *   The user entity to verify.
   *
   * @return array
   *   A render array for the user verification page.
   */
  public function verifyUser(UserInterface $user) {
    // Set the user status to active.
    $user->set('status', 1);
    $user->save();

    // Display a success message with a button to sign in.
    $build = [
      '#markup' => $this->t('Your account has been successfully verified. You can now sign in.'),
    ];

    // Add a button that redirects to the sign-in page.
    $build['sign_in_button'] = [
      '#type' => 'link',
      '#title' => $this->t('Sign In Now'),
      '#url' => \Drupal\Core\Url::fromUri('internal:/signin'),
      '#attributes' => [
        'class' => ['button', 'button--primary'],
      ],
    ];

    return $build;
  }

  /**
   * Displays a message indicating that the verification email has been sent.
   *
   * @return array
   *   A render array for the verification sent page.
   */
  public function verificationSent() {
    return [
      '#markup' => $this->t('Please check your inbox and follow the instructions to complete the registration.'),
    ];
  }
}
