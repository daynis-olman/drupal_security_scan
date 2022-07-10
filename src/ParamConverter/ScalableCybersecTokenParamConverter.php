<?php

namespace Drupal\scalable_cybersec\ParamConverter;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\ParamConverter\ParamConverterInterface;
use Symfony\Component\Routing\Route;

/**
 * Converts parameters for upcasting database record IDs to full std objects.
 *
 * @DCG
 * To use this converter specify parameter type in a relevant route as follows:
 * @code
 * scalable_cybersec.scalable_cybersec_token_parameter_converter:
 *   path: example/{record}
 *   defaults:
 *     _controller:
 *   '\Drupal\scalable_cybersec\Controller\ScalableCybersecController::build'
 *   requirements:
 *     _access: 'TRUE'
 *   options:
 *     parameters:
 *       record:
 *        type: scalable_cybersec_token
 * @endcode
 *
 * Note that for entities you can make use of existing parameter converter
 * provided by Drupal core.
 * @see \Drupal\Core\ParamConverter\EntityConverter
 */
class ScalableCybersecTokenParamConverter implements ParamConverterInterface {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Constructs a new ScalableCybersecTokenParamConverter.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public function convert($value, $definition, $name, array $defaults) {
    $settings = $this->configFactory->get('scalable_cybersec.settings');
    $token = $settings->get('token');
    if (empty($token)) {
      return NULL;
    }

    if ($token !== $value) {
      return NULL;
    }

    return $token;
  }

  /**
   * {@inheritdoc}
   */
  public function applies($definition, $name, Route $route) {
    return !empty($definition['type']) && $definition['type'] == 'scalable_cybersec_token';
  }

}
