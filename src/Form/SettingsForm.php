<?php

namespace Drupal\scalable_cybersec\Form;

use Drupal\Core\Extension\ExtensionPathResolver;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Defines a form that configures Scalable Networks Vulnerability Scanner
 * Settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * The current request.
   *
   * @var \Symfony\Component\HttpFoundation\Request
   */
  protected $request;

  /**
   * The extension path resolver.
   *
   * @var \Drupal\Core\Extension\ExtensionPathResolver
   */
  protected $extensionPathResolver;

  /**
   * Constructs the Scalable Networks Vulnerability Scanner settings form.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The current request.
   * @param \Drupal\Core\Extension\ExtensionPathResolver $extension_path_resolver
   *   The extension path resolver.
   */
  public function __construct(Request $request, ExtensionPathResolver $extension_path_resolver = NULL) {
    $this->request = $request;
    $this->extensionPathResolver = $extension_path_resolver;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('request_stack')->getCurrentRequest(),
      $container->get('extension.path.resolver'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'scalable_cybersec_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('scalable_cybersec.settings');

    $form['logo'] = [
      '#type' => 'html_tag',
      '#tag' => 'img',
      '#attributes' => [
        'src' => $this->logoPath(),
      ],
    ];

    $form['token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Token'),
      '#default_value' => $config->get('token'),
      '#disabled' => TRUE,
    ];

    $form['copy'] = [
      '#type' => 'link',
      '#title' => $this->t('Copy to clipboard'),
      '#url' => Url::fromRoute('<none>'),
      '#options' => [
        'absolute' => TRUE,
        'fragment' => '/',
      ],
      '#attributes' => [
        'href' => '#',
        'class' => 'copy-clipboard',
      ],
    ];

    $form['url'] = [
      '#type' => 'item',
      '#title' => $this->t('URL'),
      '#markup' => $this->url(),
      '#disabled' => TRUE,
    ];

    $form['help_text'] = [
      '#type' => 'item',
      '#title' => $this->t('Help Text'),
      '#markup' => $this->helpText(),
      '#disabled' => TRUE,
    ];

    $form = parent::buildForm($form, $form_state);
    $form['actions']['#access'] = FALSE;

    $form['#attached']['library'][] = 'scalable_cybersec/scalable_cybersec.form';

    return $form;
  }

  /**
   * Helper function to get logo path.
   *
   * @return string
   */
  public function logoPath(): string {
    return base_path() . '' . $this->extensionPathResolver->getPath('module', 'scalable_cybersec') . '/images/logo.png';
  }

  /**
   * Helper function to get url.
   *
   * @return string
   */
  public function url(): string {
    return $this->request->getSchemeAndHttpHost();
  }

  /**
   * Helper function to get help text.
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   */
  public function helpText() {
    return $this->t('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ');
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['scalable_cybersec.settings'];
  }

}
