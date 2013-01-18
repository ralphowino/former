<?php
/**
 * Legacy
 *
 * Makes Former Laravel 3 compatible
 */
namespace Former\Facades;

class LaravelThree extends FormerBuilder
{
  /**
   * Build a Laravel 3 application
   *
   * @return Container
   */
  protected static function getApp()
  {
    $app = static::buildContainer();

    // Laravel

    $app['form'] = $app->share(function($app) {
      return new Legacy\Redirector('Form');
    });

    $app['html'] = $app->share(function($app) {
      return new Legacy\Redirector('HTML');
    });

    $app['session'] = $app->share(function($app) {
      return new Legacy\Session;
    });

    $app['url'] = $app->share(function($app) {
      return new Legacy\Redirector('Url');
    });

    $app['config'] = $app->share(function($app) {
      return new Legacy\Config;
    });

    $app['request'] = $app->share(function($app) {
      return new Legacy\Redirector('Input');
    });

    $app['translator'] = $app->share(function($app) {
      return new Legacy\Translator;
    });

    \Config::set('former::config', include __DIR__.'/../../config/config.php');
    $app = static::buildFramework($app, 'former::');
    $app = static::buildFormer($app);

    return $app;
  }
}