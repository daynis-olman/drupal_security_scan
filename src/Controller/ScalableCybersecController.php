<?php

namespace Drupal\scalable_cybersec\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\scalable_cybersec\Utility;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Defines the ScalableCybersecController class.
 *
 * @ingroup scalable_cybersec
 */
class ScalableCybersecController extends ControllerBase {

  use Utility;

  /**
   * Generate Composer.json file output.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The incoming request.
   * @param string $token
   *   Request validation token
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   */
  public function composer(Request $request, string $token) {
    return new JsonResponse($this->readComposerFile());
  }

  /**
   * Generate Composer.lock file output.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The incoming request.
   * @param string $token
   *   Request validation token
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   * @throws \Exception
   */
  public function composerLock(Request $request, string $token) {
    return new JsonResponse($this->readComposerFile(TRUE));
  }

}
