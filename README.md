# The Dependency Injection exercise for Drupal
It shows how to approach service implementation and adaptation tasks in the context of the latest major Drupal versions: 8.x, 9.x. 10.x.

## Setup

1. Clone the repository within the `/web/modules/custom/` path.
1. Install this module enabling the resource. Run `drush en dependency_injection_exercise`.
1. Add the new provided custom block 'Rest output block' to a page.

### Optional

The default initial branch is `main` branch it contains the starting point of the module (the initial scenario) without any change, but you can move to different branches in order to check refactoring tasks and/or features.

For instance, you can check the first exercise (see next section) by moving to the related branch: 
```
git checkout refactor/rebuild_feature_as_service
```

## Exercises

1. We've got a controller and block, both outputting roughly the same thing. Please refactor these so the call to fetch data happens in a service. Then, inject that service in both the controller and block instead of using \Drupal::service()
1. Take over the MailManager service and ensure all mails are redirected to "nope@doesntexist.com"
1. On the path /dropsolid/example/photos the breadcrumb should be Home > Dropsolid > Example > Photos
1. Take over the LanguageManager service in a way that doesn't preclude others from also taking over the LanguageManager service

## Questions (Annotations of the rubber duck technique 🐤)

* **Why are you defining an interface for the new service?** It is considered "best practice" to do so. See "Defining a service" in [api.drupal.org/container/9.4.x](https://api.drupal.org/api/drupal/core%21core.api.php/group/container/9.4.x).  
* **Are you using the logger to log messages?** Yes, although it is not used for production environments (dblog is usually disabled), I have found it useful in development environments to gather information.  
* **Wait a minute, you're not implementing `ContainerInjectionInterface` in Controller!** Yes, indeed. Because I'm extending from `ControllerBase` class and this implements `ContainerInjectionInterface`. See [api.drupal.org/ControllerBase.php](https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Controller%21ControllerBase.php/10).  

## Extra

1. Review and clean related menu item 'Photos' when install and uninstall from hooks in `.install` file.

## TODO

1. Add some unit testing in order to execute automatized checks of the features.

## Documentation

- [Services and dependency injection in Drupal 8+](https://www.drupal.org/docs/drupal-apis/services-and-dependency-injection/services-and-dependency-injection-in-drupal-8)
- [Altering existing services, providing dynamic services](https://www.drupal.org/docs/drupal-apis/services-and-dependency-injection/altering-existing-services-providing-dynamic-services)
