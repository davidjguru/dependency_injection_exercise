<?php

namespace Drupal\dependency_injection_exercise\Service;

use Drupal\Core\Language\LanguageManager;

/**
 * Dependency Injection Exercise Service Decorator Class.
 *
 * @category Class
 * @package DependencyInjectionExercise
 * @author David Rodríguez, @davidjguru
 * @link https://therussianlullaby.com
 */
class LanguageManagerDecorator extends LanguageManager {

  /**
   * Language Manager Original service object.
   *
   * @var \Drupal\Core\Language\LanguageManager
   */
  protected $originalLanguageManager;

  /**
   * The default language object.
   *
   * @var \Drupal\Core\Language\LanguageDefault
   */
  protected $defaultLanguage;

  /**
   * LanguageManagerServiceOverride constructor.
   *
   * @param \Drupal\Core\Language\LanguageManager $language_manager_original_service
   *   The original service.
   * @param \Drupal\Core\Language\LanguageDefault $default_language
   *   The default language.
   */
  public function __construct(LanguageManager $language_manager_original_service, LanguageDefault $default_language) {
    $this->originalLanguageManager = $language_manager_original_service;
    $this->defaultLanguage = $default_language;
    parent::__construct($this->defaultLanguage);
  }

  /**
   * {@inheritdoc}
   */
  public static function getStandardLanguageList() {

    return [
      'af' => ['Afrikaans', 'Afrikaans'],
      'am' => ['Amharic', 'አማርኛ'],
      // Add a new extra language.
      'an' => ['Andalusian', 'Andalûh'],
      'ar' => ['Arabic', /* Left-to-right marker "‭" */ 'العربية', LanguageInterface::DIRECTION_RTL],
      'ast' => ['Asturian', 'Asturianu'],
      'az' => ['Azerbaijani', 'Azərbaycanca'],
      'be' => ['Belarusian', 'Беларуская'],
      'bg' => ['Bulgarian', 'Български'],
      'bn' => ['Bengali', 'বাংলা'],
      'bo' => ['Tibetan', 'བོད་སྐད་'],
      'br' => ['Breton', 'Breton'],
      'bs' => ['Bosnian', 'Bosanski'],
      'ca' => ['Catalan', 'Català'],
      'cs' => ['Czech', 'Čeština'],
      'cy' => ['Welsh', 'Cymraeg'],
      'da' => ['Danish', 'Dansk'],
      'de' => ['German', 'Deutsch'],
      'dz' => ['Dzongkha', 'རྫོང་ཁ'],
      'el' => ['Greek', 'Ελληνικά'],
      'en' => ['English', 'English'],
      'en-gb' => ['English, British', 'English, British'],
      'en-x-simple' => ['Simple English', 'Simple English'],
      'eo' => ['Esperanto', 'Esperanto'],
      'es' => ['Spanish', 'Español'],
      'et' => ['Estonian', 'Eesti'],
      'eu' => ['Basque', 'Euskera'],
      'fa' => ['Persian, Farsi', /* Left-to-right marker "‭" */ 'فارسی', LanguageInterface::DIRECTION_RTL],
      'fi' => ['Finnish', 'Suomi'],
      'fil' => ['Filipino', 'Filipino'],
      'fo' => ['Faeroese', 'Føroyskt'],
      'fr' => ['French', 'Français'],
      'fy' => ['Frisian, Western', 'Frysk'],
      'ga' => ['Irish', 'Gaeilge'],
      'gd' => ['Scots Gaelic', 'Gàidhlig'],
      'gl' => ['Galician', 'Galego'],
      'gsw-berne' => ['Swiss German', 'Schwyzerdütsch'],
      'gu' => ['Gujarati', 'ગુજરાતી'],
      'haw' => ['Hawaiian', 'ʻŌlelo Hawaiʻi'],
      'he' => ['Hebrew', /* Left-to-right marker "‭" */ 'עברית', LanguageInterface::DIRECTION_RTL],
      'hi' => ['Hindi', 'हिन्दी'],
      'hr' => ['Croatian', 'Hrvatski'],
      'ht' => ['Haitian Creole', 'Kreyòl ayisyen'],
      'hu' => ['Hungarian', 'Magyar'],
      'hy' => ['Armenian', 'Հայերեն'],
      'id' => ['Indonesian', 'Bahasa Indonesia'],
      'is' => ['Icelandic', 'Íslenska'],
      'it' => ['Italian', 'Italiano'],
      'ja' => ['Japanese', '日本語'],
      'jv' => ['Javanese', 'Basa Java'],
      'ka' => ['Georgian', 'ქართული ენა'],
      'kk' => ['Kazakh', 'Қазақ'],
      'km' => ['Khmer', 'ភាសាខ្មែរ'],
      'kn' => ['Kannada', 'ಕನ್ನಡ'],
      'ko' => ['Korean', '한국어'],
      'ku' => ['Kurdish', 'Kurdî'],
      'ky' => ['Kyrgyz', 'Кыргызча'],
      'lo' => ['Lao', 'ພາສາລາວ'],
      'lt' => ['Lithuanian', 'Lietuvių'],
      'lv' => ['Latvian', 'Latviešu'],
      'mg' => ['Malagasy', 'Malagasy'],
      'mk' => ['Macedonian', 'Македонски'],
      'ml' => ['Malayalam', 'മലയാളം'],
      'mn' => ['Mongolian', 'монгол'],
      'mr' => ['Marathi', 'मराठी'],
      'ms' => ['Bahasa Malaysia', 'بهاس ملايو'],
      'mt' => ['Maltese', 'Malti'],
      'my' => ['Burmese', 'ဗမာစကား'],
      'ne' => ['Nepali', 'नेपाली'],
      'nl' => ['Dutch', 'Nederlands'],
      'nb' => ['Norwegian Bokmål', 'Norsk, bokmål'],
      'nn' => ['Norwegian Nynorsk', 'Norsk, nynorsk'],
      'oc' => ['Occitan', 'Occitan'],
      'or' => ['Odia', 'ଓଡିଆ'],
      'os' => ['Ossetian', 'Ossetian'],
      'pa' => ['Punjabi', 'ਪੰਜਾਬੀ'],
      'pl' => ['Polish', 'Polski'],
      'prs' => ['Persian, Afghanistan', /* Left-to-right marker "‭" */ 'دری', LanguageInterface::DIRECTION_RTL],
      'ps' => ['Pashto', /* Left-to-right marker "‭" */ 'پښتو', LanguageInterface::DIRECTION_RTL],
      'pt' => ['Portuguese, International', 'Português, Internacional'],
      'pt-pt' => ['Portuguese, Portugal', 'Português, Portugal'],
      'pt-br' => ['Portuguese, Brazil', 'Português, Brasil'],
      'rhg' => ['Rohingya', 'Ruáinga'],
      'rm-rumgr' => ['Rumantsch Grischun', 'Rumantsch Grischun'],
      'ro' => ['Romanian', 'Română'],
      'ru' => ['Russian', 'Русский'],
      'rw' => ['Kinyarwanda', 'Kinyarwanda'],
      'sco' => ['Scots', 'Scots'],
      'se' => ['Northern Sami', 'Sámi'],
      'si' => ['Sinhala', 'සිංහල'],
      'sk' => ['Slovak', 'Slovenčina'],
      'sl' => ['Slovenian', 'Slovenščina'],
      'sq' => ['Albanian', 'Shqip'],
      'sr' => ['Serbian', 'Српски'],
      'sv' => ['Swedish', 'Svenska'],
      'sw' => ['Swahili', 'Kiswahili'],
      'ta' => ['Tamil', 'தமிழ்'],
      'ta-lk' => ['Tamil, Sri Lanka', 'தமிழ், இலங்கை'],
      'te' => ['Telugu', 'తెలుగు'],
      'th' => ['Thai', 'ภาษาไทย'],
      'tr' => ['Turkish', 'Türkçe'],
      'tyv' => ['Tuvan', 'Тыва дыл'],
      'ug' => ['Uyghur', /* Left-to-right marker "‭" */ 'ئۇيغۇرچە', LanguageInterface::DIRECTION_RTL],
      'uk' => ['Ukrainian', 'Українська'],
      'ur' => ['Urdu', /* Left-to-right marker "‭" */ 'اردو', LanguageInterface::DIRECTION_RTL],
      'vi' => ['Vietnamese', 'Tiếng Việt'],
      'xx-lolspeak' => ['Lolspeak', 'Lolspeak'],
      'zh-hans' => ['Chinese, Simplified', '简体中文'],
      'zh-hant' => ['Chinese, Traditional', '繁體中文'],
    ];
  }

}
