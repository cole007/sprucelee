<?php
/**
 * Spruce Lee plugin for Craft CMS
 *
 * SpruceLee_Purge Service
 *
 * --snip--
 * All of your plugin’s business logic should go in services, including saving data, retrieving data, etc. They
 * provide APIs that your controllers, template variables, and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 * --snip--
 *
 * @author    @cole007
 * @copyright Copyright (c) 2017 @cole007
 * @link      http://ournameismud.co.uk/
 * @package   SpruceLee
 * @since     1.0.0
 */

namespace Craft;

class SpruceLee_PurgeService extends BaseApplicationComponent
{
    /**
     * This function can literally be anything you want, and you can have as many service functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     craft()->spruceLee_purge->exampleService()
     */
    public function purgeAssets($step)
    {
        SpruceLeePlugin::log('SpruceLee_PurgeService::purge trigger (step #' . $step . ')');
        $attr = ['status'=>'identified'];
        $records = SpruceLee_AssetRecord::model()->findAllByAttributes($attr);
        $i = 0;
        foreach ($records AS $record) {
            $error = false;
            if ($i >= 25) return true;
            $file = craft()->assets->getFileById($record['asset']);
            if($file) {
                $purge = craft()->assets->deleteFiles([$record['asset']]);
                if ($purge) {
                    SpruceLeePlugin::log('SpruceLee_PurgeController::actionPurge asset destroyed (#' . $record['asset'] . ')');
                    $record->status = 'destroyed';
                    $record->save();
                    $i++;
                } else {
                    $error = 'cannot delete file';
                }
            } else {
                $error = 'cannot find file';
                $record->status = 'missing';
                $record->save();
            }
            if ($error) SpruceLeePlugin::log('SpruceLee_PurgeController::actionPurge ' . $error  .' (#' . $record['asset'] . ')');
        }        
    }

}