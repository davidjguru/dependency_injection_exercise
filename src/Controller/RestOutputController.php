<?php

namespace Drupal\dependency_injection_exercise\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\dependency_injection_exercise\Service\DependencyInjectionExerciseService;
use Drupal\dependency_injection_exercise\Service\DependencyInjectionExerciseServiceInterface;

/**
 * RestOutputController Class.
 *
 * Manage the REST output to screen.
 *
 * PHP version 8.1.23
 *
 * @category Class
 * @package DependencyInjectionExerciseyo
 * @author Dropsolid + David Rodríguez, @davidjguru
 * @link https://therussianlullaby.com
 */
class RestOutputController extends ControllerBase {

  /**
   * The DependencyInjectionExerciseService resource.
   *
   * @var \Drupal\dependency_injection_exercise\Service\DependencyInjectionExerciseService
   */
  protected $diesResource;

  /**
   * RestOutputController constructor.
   *
   * @param \Drupal\dependency_injection_exercise\Service\DependencyInjectionExerciseServiceInterface $dies_resource
   *   The dependency injection exercise service.
   */
  public function __construct(DependencyInjectionExerciseServiceInterface $dies_resource) {
    $this->diesResource = $dies_resource;
  }

  /**
   * {@inheritdoc}
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The Drupal service container.
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('dependency_injection_exercise.api_client')
    );
  }
  /**
   * Displays the photos.
   *
   * @return array[]
   *   A renderable array representing the photos or error messages.
   */
  public function getPhotos(): array {
    // Call to the processing method from Service.
    return $diesResource->showPhotos();
  }

}
