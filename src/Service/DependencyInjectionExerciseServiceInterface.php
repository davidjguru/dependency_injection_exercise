<?php

namespace Drupal\dependency_injection_exercise\Service;

/**
 * Dependency Injection Exercise Service Interface.
 *
 * PHP version 8.1.23
 *
 * @category Class
 * @package DependencyInjectionExercise
 * @author David Rodríguez, @davidjguru
 * @link https://therussianlullaby.com
 */
interface DependencyInjectionExerciseServiceInterface {

  /**
   * Get resources from external API connections.
   *
   * @param bool|null $randomize
   *   Boolean indicating if use fixed value for results or not.
   *
   * @return array
   *   Returns a set of results.
   */
  public function getResources(bool $randomize): array;

  /**
   * Show resources from external API connections.
   *
   * @param bool|null $randomize
   *   Boolean indicating if use fixed value for results or not.
   *
   * @return array
   *   Returns a set of images.
   */
  public function showPhotos(bool $randomize): array;

}
