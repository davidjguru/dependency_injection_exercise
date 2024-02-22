<?php

namespace Drupal\dependency_injection_exercise\Service;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\Messenger\Messenger;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

/**
 * Dependency Injection Exercise Service Class.
 *
 * PHP version 8.1.23
 *
 * @category Class
 * @package DependencyInjectionExercise
 * @author David Rodríguez, @davidjguru
 * @link https://therussianlullaby.com
 */
class DependencyInjectionExerciseService implements DependencyInjectionExerciseServiceInterface {

  use StringTranslationTrait;

  /**
   * InmutableConfig Instance.
   *
   * @var \Drupal\Core\Config\InmutableConfig
   */
  protected $diesConfig;

  /**
   * HTTP Client.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $diesClient;

  /**
   * The Logger service.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $diesLogger;

  /**
   * The Messenger service.
   *
   * @var \Drupal\Core\Messenger\Messenger
   */
  protected $diesMessenger;

  /**
   * Url for the external connection.
   *
   * @var string
   */
  protected $diesUrl;

  /**
   * DependencyInjectionExerciseService constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The Config Factory.
   * @param \GuzzleHttp\ClientInterface $http_client
   *   The HTTP Client.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $logger_factory
   *   The Logger Factory.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The Messenger service.
   */
  public function __construct(ConfigFactoryInterface $config_factory, ClientInterface $http_client, LoggerChannelFactoryInterface $logger_factory, Messenger $messenger) {
    $this->diesConfig = $config_factory->get('dependency_injection_exercise.settings');
    $this->diesClient = $http_client;
    $this->diesLogger = $logger_factory->get('dependency_injection_exercise');
    $this->diesMessenger = $messenger;
  }

  /**
   * Get Dependency Injection Exercise configuration.
   *
   * @return \Drupal\Core\Config\ImmutableConfig
   *   Dependency Injection Exercise configuration object.
   */
  public function getConfig(): ImmutableConfig {
    return $this->diesConfig;
  }

  /**
   * Get resources from external API connections.
   *
   * @param bool $randomize
   *   Mark if random value is needed.
   *
   * @return array
   *   Returns a set of images.
   *
   * @throws Exception
   *   Throws up a generic Exception if no connection was possible.
   * @throws \GuzzleHttp\Exception\GuzzleException
   *   Throws up a base GuzzleException if there was a generic error.
   * @throws \GuzzleHttp\Exception\RequestException
   *    Throws up a Guzzle RequestException in the event of a networking error.
   * @throws \GuzzleHttp\Exception\ClientException
   *    Throws up a Guzzle ClientException from 400 level errors.
   * @throws GuzzleHttp\Exception\BadResponseException
   *   Throws up a Guzzle BadResponseException from a response level error.
   * @throws \GuzzleHttp\Exception\ServerException
   *   Throws up a Guzzle ServerException from 500 level errors.
   */
  public function getResources(bool $randomize): array {
    // Review if use random value or not.
    $page = $randomize ? random_int(1, 20) : 5;
    // Mount the required URL.
    $this->diesUrl = $this->diesConfig->get('target') . $page . '/photos';

    // Try to obtain the photo data via the external API.
    try {
      $response = $this->diesClient->get($this->diesUrl);
      $data = Json::decode($response->getBody()->getContents());
    }

    catch (ServerException $e) {
      $this->diesLogger->error($this->t('ServerException - Error getting resources, error: @error'), ['@error' => $e->getMessage()]);
      $this->diesMessenger->addMessage($this->t('We are experiencing technical problems, please try again after a few minutes.'), 'error');
      $data['error'] = $this->t('Message: @error', ['@error' => $e->getMessage()]);
    }
    catch (ClientException $e) {
      $this->diesLogger->error($this->t('ClientException - Error getting resources, error: @error'), ['@error' => $e->getMessage()]);
      $this->diesMessenger->addMessage($this->t('We are experiencing technical problems, please try again after a few minutes.'), 'error');
      $data['error'] = $this->t('Message: @error', ['@error' => $e->getMessage()]);
    }
    catch (BadResponseException $e) {
      $this->diesLogger->error($this->t('BadResponseException - Error getting resources, error: @error'), ['@error' => $e->getMessage()]);
      $this->diesMessenger->addMessage($this->t('We are experiencing technical problems, please try again after a few minutes.'), 'error');
      $data['error'] = $this->t('Message: @error', ['@error' => $e->getMessage()]);
    }
    catch (RequestException $e) {
      $this->diesLogger->error($this->t('Request Exception - Error getting resources, error: @error'), ['@error' => $e->getMessage()]);
      $this->diesMessenger->addMessage($this->t('We are experiencing technical problems, please try again after a few minutes.'), 'error');
      $data['error'] = $this->t('Message: @error', ['@error' => $e->getMessage()]);
    }
    catch (GuzzleException $e) {
      $this->diesLogger->error($this->t('GuzzleException - Error getting resources, error: @error'), ['@error' => $e->getMessage()]);
      $this->diesMessenger->addMessage($this->t('We are experiencing technical problems, please try again after a few minutes.'), 'error');
      $data['error'] = $this->t('Message: @error', ['@error' => $e->getMessage()]);
    }
    catch (Exception $e) {
      $this->diesLogger->error($this->t('Exception - Error getting resources, error: @error'), ['@error' => $e->getMessage()]);
      $this->diesMessenger->addMessage($this->t('We are experiencing technical problems, please try again after a few minutes.'), 'error');
      $data['error'] = $this->t('Message: @error', ['@error' => $e->getMessage()]);
    } finally {
      return $data;
    }
  }

  /**
   * Show resources from external API connections.
   *
   * @param bool $randomize
   *   Mark if random value is needed.
   *
   * @return array
   *   Returns a set of images.
   */
  public function showPhotos(bool $randomize): array {

    $data = $this->getResources($randomize);
    if (array_key_exists('error', $data)) {
      // Prepares an error message for user in screen.
      $build['error'] = [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => $this->t('No photos available. Error: @error', ['@error' => $data['error']]),
      ];
    }
    else {
      // Setup build caching.
      $build = [
        '#cache' => [
          'max-age' => 60,
          'contexts' => [
            'url',
          ],
        ],
      ];
      // Build a listing of photos from the photo data.
      $build['photos'] = array_map(static function ($item) {
        return [
          '#theme' => 'image',
          '#uri' => $item['thumbnailUrl'],
          '#alt' => $item['title'],
          '#title' => $item['title'],
        ];
      }, $data);
    }

    return $build;
  }

}
