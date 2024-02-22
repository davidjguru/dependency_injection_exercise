<?php

namespace Drupal\dependency_injection_exercise\Breadcrumb;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Link;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Dependency Injection Exercise Breadcrumb Class.
 *
 * PHP version 8.1.23
 *
 * @category Class
 * @package DependencyInjectionExercise
 * @author David Rodríguez, @davidjguru
 * @link https://therussianlullaby.com
 */
class DependencyInjectionExerciseBreadcrumbBuilder implements BreadcrumbBuilderInterface {

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $route_match) {
    // Only work with the registered route.
    return ($route_match->getRouteName() === 'dependency_injection_exercise.rest_output_controller_photos');
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    // Prepare breadcrumb.
    $breadcrumb = new Breadcrumb();
    $breadcrumb->addCacheContexts(['route']);
    $node = $route_match->getParameter('node');
    $breadcrumb->addCacheableDependency($node);
    // Add the required items to the breadcrum.
    $breadcrumb->addLink(Link::createFromRoute('Home', '<none>'));
    $breadcrumb->addLink(Link::createFromRoute('Dropsolid', '<none>'));
    $breadcrumb->addLink(Link::createFromRoute('Example', '<none>'));
    $breadcrumb->addLink(Link::createFromRoute('Photos', '<none>'));

    return $breadcrumb;
  }

}
