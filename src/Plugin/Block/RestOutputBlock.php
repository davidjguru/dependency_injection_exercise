<?php

namespace Drupal\dependency_injection_exercise\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\dependency_injection_exercise\Service\DependencyInjectionExerciseServiceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'RestOutputBlock' block.
 *
 * @Block(
 *  id = "rest_output_block",
 *  admin_label = @Translation("Rest output block"),
 * )
 */
class RestOutputBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The DependencyInjectionExerciseService resource.
   *
   * @var \Drupal\dependency_injection_exercise\Service\DependencyInjectionExerciseService
   */
  protected $diesResource;

  /**
   * Constructs a new RestOutputBlock.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param Drupal\dependency_injection_exercise\Service\DependencyInjectionExerciseServiceInterface $dies_resource
   *   The dependency injection exercise service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, DependencyInjectionExerciseServiceInterface $dies_resource) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->diesResource = $dies_resource;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('dependency_injection_exercise.api_client'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    // Call to the processing method from Service.
    return $this->diesResource->showPhotos(TRUE);
  }

}
