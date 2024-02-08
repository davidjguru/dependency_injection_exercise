<?php

namespace Drupal\dependency_injection_exercise\Breadcrumb;


use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Link;


class DependencyInjectionExerciseBreadcrumbBuilder implements BreadcrumbBuilderInterface {
  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $attributes) {
    // TODO: Add some logic here in order to check if applies or not.
    // It must return a BOOLEAN TRUE or FALSE.
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $breadcrumb = new Breadcrumb();
    // Add link to the homepage as first crumb.
    $breadcrumb->addLink(Link::createFromRoute('Home', '<front>'));
    // TODO: Add some logic here.

    // Add cache control.
    $breadcrumb->addCacheContexts(['route']);

    return $breadcrumb;
  }

}

