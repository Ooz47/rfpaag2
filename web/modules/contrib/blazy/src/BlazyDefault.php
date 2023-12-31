<?php

namespace Drupal\blazy;

/**
 * Defines shared plugin default settings for field formatter and Views style.
 */
class BlazyDefault {

  /**
   * Defines constant for the supported text tags.
   */
  const TAGS = ['a', 'em', 'strong', 'h2', 'p', 'span', 'ul', 'ol', 'li'];

  /**
   * The current class instance.
   *
   * @var self
   */
  private static $instance = NULL;

  /**
   * Returns the static instance of this class.
   */
  public static function getInstance() {

    if (is_null(self::$instance)) {
      self::$instance = new BlazyDefault();
    }

    return self::$instance;
  }

  /**
   * Returns Blazy specific breakpoints.
   *
   * @todo remove custom breakpoints anytime before blazy:3.x.
   */
  public static function getConstantBreakpoints() {
    return ['xs', 'sm', 'md', 'lg', 'xl'];
  }

  /**
   * Returns alterable plugin settings to pass the tests.
   */
  public function alterableSettings(array &$settings = []) {
    $context = ['class' => get_called_class()];
    \Drupal::moduleHandler()->alter('blazy_base_settings', $settings, $context);

    return $settings;
  }

  /**
   * Returns settings provided by various UI.
   */
  public static function anywhereSettings() {
    return [
      'fx'      => '',
      'lazy'    => '',
      'loading' => 'lazy',
      'preload' => FALSE,
      'style'   => '',
    ];
  }

  /**
   * Returns basic plugin settings.
   */
  public static function baseSettings() {
    $settings = [
      'cache'             => 0,
      'current_view_mode' => '',
      'skin'              => '',
    ] + self::anywhereSettings();

    blazy_alterable_settings($settings);
    return $settings;
  }

  /**
   * Returns cherry-picked settings for field formatters and Views fields.
   */
  public static function cherrySettings() {
    return [
      'box_style'       => '',
      'image_style'     => '',
      'media_switch'    => '',
      'ratio'           => '',
      'thumbnail_style' => '',
      '_item'           => '',
      '_uri'            => '',
    ];
  }

  /**
   * Returns image-related field formatter and Views settings.
   */
  public static function baseImageSettings() {
    return [
      'background'             => FALSE,
      'box_caption'            => '',
      'box_caption_custom'     => '',
      'box_media_style'        => '',
      'caption'                => [],
      'responsive_image_style' => '',
    ] + self::cherrySettings();
  }

  /**
   * Returns deprecated settings.
   *
   * @todo remove custom breakpoints anytime before 3.x.
   */
  public static function deprecatedSettings() {
    return [
      'breakpoints' => [],
      'icon'        => '',
      'sizes'       => '',
      'grid_header' => '',
    ];
  }

  /**
   * Returns image-related field formatter and Views settings.
   */
  public static function imageSettings() {
    return [
      'layout'    => '',
      'view_mode' => '',
      // @todo remove + self::deprecatedSettings()
    ] + self::baseSettings() + self::baseImageSettings();
  }

  /**
   * Returns Views specific settings.
   */
  public static function viewsSettings() {
    return [
      'class'   => '',
      'id'      => '',
      'image'   => '',
      'link'    => '',
      'overlay' => '',
      'title'   => '',
      'vanilla' => FALSE,
    ];
  }

  /**
   * Returns fieldable entity formatter and Views settings.
   */
  public static function extendedSettings() {
    return self::viewsSettings() + self::imageSettings();
  }

  /**
   * Returns optional grid field formatter and Views settings.
   */
  public static function gridBaseSettings() {
    return [
      'grid'        => '',
      'grid_medium' => '',
      'grid_small'  => '',
    ];
  }

  /**
   * Returns optional grid field formatter and Views settings.
   */
  public static function gridSettings() {
    return ['grid_header' => '']
      + self::gridBaseSettings()
      + self::anywhereSettings();
  }

  /**
   * Returns sensible default options common for Views lacking of UI.
   */
  public static function lazySettings() {
    return [
      'blazy' => TRUE,
      'lazy'  => 'blazy',
      'ratio' => 'fluid',
    ];
  }

  /**
   * Returns sensible default options common for entities lacking of UI.
   */
  public static function entitySettings() {
    return [
      'media_switch' => 'media',
      'rendered'     => FALSE,
      'view_mode'    => 'default',
      '_detached'    => TRUE,
    ] + self::lazySettings();
  }

  /**
   * Returns default options common for rich Media entities: Facebook, etc.
   *
   * This basically disables few Blazy features for rendered-entity-like.
   */
  public static function richSettings() {
    return [
      'background'   => FALSE,
      'lightbox'     => FALSE,
      'media_switch' => '',
      'placeholder'  => '',
      'resimage'     => FALSE,
      'use_loading'  => FALSE,
      'type'         => 'rich',
    ] + self::anywhereSettings();
  }

  /**
   * Returns shared global form settings which should be consumed at formatters.
   */
  public static function uiSettings() {
    return [
      'nojs'                => [],
      'one_pixel'           => TRUE,
      'noscript'            => FALSE,
      'placeholder'         => '',
      'responsive_image'    => FALSE,
      'unstyled_extensions' => '',
    ] + self::anywhereSettings();
  }

  /**
   * Grouping for sanity till all settings converted into BlazySettings.
   *
   * It was a pre-release RC7 @todo, partially implemented since 2.7.
   * The hustle is sub-modules are not aware, yet. Yet better started before 3.
   */
  public static function blazies() {
    return [
      '_api' => FALSE,
      'bgs' => [],
      'initial' => 0,
      'is' => [],
      'libs' => ['animate' => FALSE, 'blur' => FALSE, 'compat' => FALSE],
      'ui' => self::uiSettings(),
      'uris' => [],
      'urls' => [],
      'use' => ['ajax' => FALSE, 'dataset' => FALSE, 'field' => FALSE],
      'image' => ['style' => NULL],
      'item' => ['delta' => 0],
      'resimage' => ['sources' => [], 'style' => NULL],
    ];
  }

  /**
   * Returns sensible default container settings to shutup notices when lacking.
   *
   * @todo remove blazy_data for blazies due to problematic with picture where
   * we can't have uniform sizes or aspect ratios.
   * @todo move safe settings into blazies: new or not used by sub-modules.
   */
  public static function htmlSettings() {
    return [
      'blazies'          => new BlazySettings(self::blazies()),
      'blazy_data'       => [],
      'bundle'           => '',
      'check_blazy'      => FALSE,
      'namespace'        => 'blazy',
      'id'               => '',
      '_richbox'         => FALSE,
      'route_name'       => '',
      'view_name'        => '',
      'first_image'      => NULL,
      'accessible_title' => '',
      'unlazy'           => FALSE,

      // @todo deprecated for blazies after sub-module updates:
      // 'unstyled'         => FALSE,
      'compat'           => FALSE,
      'is_preview'       => FALSE,
      'lightbox'         => FALSE,
      'resimage'         => FALSE,
      '_resimage'        => FALSE,
      // @todo revert  + self::uiSettings()
    ] + self::imageSettings() + self::gridSettings();
  }

  /**
   * Returns sensible default item settings to shutup notices when lacking.
   */
  public static function itemSettings() {
    return [
      'classes'        => [],
      'content_url'    => '',
      'delta'          => 0,
      'embed_url'      => '',
      'entity_type_id' => '',
      'extension'      => '',
      'image_url'      => '',
      'placeholder_fx' => '',
      'placeholder_ui' => '',
      'player'         => FALSE,
      'scheme'         => '',
      'type'           => 'image',
      'uri'            => '',
      'height'         => NULL,
      'width'          => NULL,

      // @todo move into and deprecated for BlazySettings under blazies:
      'use_data_uri'   => FALSE,
      'use_loading'    => TRUE,
      'use_media'      => FALSE,
      'item_id'        => 'blazy',
      'lazy_attribute' => 'src',
      'lazy_class'     => 'b-lazy',
    ] + self::htmlSettings();
  }

  /**
   * Returns blazy theme properties, its image and container attributes.
   *
   * The reserved attributes is defined before entering Blazy as bonus variable.
   * Consider other bonuses: title and content attributes at a later stage.
   */
  public static function themeProperties() {
    return [
      'attributes',
      'captions',
      'content',
      'iframe',
      'image',
      'icon',
      'item',
      'item_attributes',
      'noscript',
      'overlay',
      'preface',
      'postscript',
      'settings',
      'url',
    ];
  }

  /**
   * Returns additional/ optional blazy theme attributes.
   *
   * The attributes mentioned here are only instantiated at theme_blazy() and
   * might be an empty array, not instanceof \Drupal\Core\Template\Attribute.
   */
  public static function themeAttributes() {
    return ['caption', 'media', 'url', 'wrapper'];
  }

  /**
   * Returns available components.
   */
  public static function components(): array {
    return [
      'animate',
      'background',
      'blur',
      'column',
      'compat',
      'filter',
      'flex',
      'grid',
      'media',
      'mfp',
      'nativegrid',
      'nativegrid.masonry',
      'photobox',
      'ratio',
    ];
  }

  /**
   * Returns available plugins.
   */
  public static function plugins(): array {
    return [
      'viewport',
      'xlazy',
      'css',
      'dom',
      'animate',
      'dataset',
      'background',
      'observer',
    ];
  }

  /**
   * Returns available nojs components related to core Blazy functionality.
   */
  public static function polyfills(): array {
    return [
      'polyfill',
      'classlist',
      'promise',
      'raf',
      'webp',
    ];
  }

  /**
   * Returns available nojs components related to core Blazy functionality.
   */
  public static function nojs(): array {
    return array_merge(['lazy'], self::polyfills());
  }

  /**
   * Returns optional polyfills, not loaded till enabled and a feature meets.
   */
  public static function ondemandPolyfills(): array {
    return [
      'fullscreen',
    ];
  }

}
