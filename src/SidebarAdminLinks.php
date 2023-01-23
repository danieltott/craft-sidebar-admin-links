<?php
/**
 * Sidebar Admin Links plugin for Craft CMS 3.x
 *
 * Add links from Settings directly to the sidebar for admin users
 *
 * @link      https://dtott.com
 * @copyright Copyright (c) 2021 Dan Ott
 */

namespace danieltott\sidebaradminlinks;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\View;
use craft\helpers\UrlHelper;

use yii\base\Event;

/**
 * Craft plugins are very much like little applications in and of themselves. We’ve made
 * it as simple as we can, but the training wheels are off. A little prior knowledge is
 * going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL,
 * as well as some semi-advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://docs.craftcms.com/v3/extend/
 *
 * @author    Dan Ott
 * @package   SidebarAdminLinks
 * @since     1.0.0
 *
 */
class SidebarAdminLinks extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * SidebarAdminLinks::$plugin
     *
     * @var SidebarAdminLinks
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    /**
     * Set to `true` if the plugin should have a settings view in the control panel.
     *
     * @var bool
     */
    public bool $hasCpSettings = false;

    /**
     * Set to `true` if the plugin should have its own section (main nav item) in the control panel.
     *
     * @var bool
     */
    public bool $hasCpSection = false;

    // Public Methods
    // =========================================================================

    /**
     * Set our $plugin static property to this class so that it can be accessed via
     * SidebarAdminLinks::$plugin
     *
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        if (!\Craft::$app->request->getIsConsoleRequest()) {

            if (
                \Craft::$app->request->getIsCpRequest() &&
                \Craft::$app->user &&
                \Craft::$app->user->identity &&
                \Craft::$app->user->identity->admin &&
                Craft::$app->getConfig()->general->allowAdminChanges) {
                $this->view->registerAssetBundle("danieltott\\sidebaradminlinks\\assetbundles\\sidebaradminlinks\\SidebarAdminLinksAsset");
                $cpUrl = UrlHelper::cpUrl();
                $this->view->registerJs('sidebarEnhancer.init("' .  $cpUrl . '");', View::POS_END);
            }
        }

/**
 * Logging in Craft involves using one of the following methods:
 *
 * Craft::trace(): record a message to trace how a piece of code runs. This is mainly for development use.
 * Craft::info(): record a message that conveys some useful information.
 * Craft::warning(): record a warning message that indicates something unexpected has happened.
 * Craft::error(): record a fatal error that should be investigated as soon as possible.
 *
 * Unless `devMode` is on, only Craft::warning() & Craft::error() will log to `craft/storage/logs/web.log`
 *
 * It's recommended that you pass in the magic constant `__METHOD__` as the second parameter, which sets
 * the category to the method (prefixed with the fully qualified class name) where the constant appears.
 *
 * To enable the Yii debug toolbar, go to your user account in the AdminCP and check the
 * [] Show the debug toolbar on the front end & [] Show the debug toolbar on the Control Panel
 *
 * http://www.yiiframework.com/doc-2.0/guide-runtime-logging.html
 */
        Craft::info(
            Craft::t(
                'sidebar-admin-links',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
