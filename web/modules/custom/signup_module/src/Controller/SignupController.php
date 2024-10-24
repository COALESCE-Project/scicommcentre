<?php

namespace Drupal\signup_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;

class SignupController extends ControllerBase {

  /**
   * Verifies the user registration.
   *
   * @param \Drupal\user\UserInterface $user
   *   The user entity to verify.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   *   A redirect to the user login page after verification.
   */
  public function verifyUser(UserInterface $user) {
    // Set the user status to active.
    $user->set('status', 1);
    $user->save();

    // Display a success message.
    $this->messenger()->addMessage($this->t('Your account has been successfully verified. You can now log in.'));

    // Redirect to the user login page.
    return $this->redirect('user.login');
  }

  /**
   * Displays a message indicating that the verification email has been sent.
   *
   * @return array
   *   A render array for the verification sent page.
   */
  public function verificationSent() {
    return [
      '#markup' => $this->t('A verification email has been sent to your email address. Please check your inbox and follow the instructions to complete the registration.'),
    ];
  }
}
