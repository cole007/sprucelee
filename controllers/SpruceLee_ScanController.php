<?php
/**
 * Spruce Lee plugin for Craft CMS
 *
 * SpruceLee_Scan Controller
 *
 * --snip--
 * Generally speaking, controllers are the middlemen between the front end of the CP/website and your plugin’s
 * services. They contain action methods which handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering post data, saving it on a model,
 * passing the model off to a service, and then responding to the request appropriately depending on the service
 * method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what the method does (for example,
 * actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 * --snip--
 *
 * @author    @cole007
 * @copyright Copyright (c) 2017 @cole007
 * @link      http://ournameismud.co.uk/
 * @package   SpruceLee
 * @since     1.0.0
 */

namespace Craft;

class SpruceLee_ScanController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array('actionIndex',
        );

    /**
     * Handle a request going to our plugin's index action URL, e.g.: actions/spruceLee
     */
    public function actionScan()
    {
        $src = craft()->request->getParam('src');
        $i = 0;
        foreach ($src AS $id) {
            $i += craft()->spruceLee_scan->processScan($id);
        }
        $msg = $i . ' record';
        if ($i <> 1) $msg .= 's';
        $msg .= ' found from ' . count($src) . ' folder';
        if (count($src) <> 1) $msg .= 's';
        craft()->userSession->setNotice($msg);
        $this->redirectToPostedUrl();
        // do something here 
    }
}