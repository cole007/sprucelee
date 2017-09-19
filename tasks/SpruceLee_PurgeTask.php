<?php
/**
 * Spruce Lee plugin for Craft CMS
 *
 * SpruceLee_Purge Task
 *
 * --snip--
 * Tasks let you run background processing for things that take a long time, dividing them up into steps.  For
 * example, Asset Transforms are regenerated using Tasks.
 *
 * Keep in mind that tasks only get timeslices to run when Craft is handling requests on your website.  If you
 * need a task to be run on a regular basis, write a Controller that triggers it, and set up a cron job to
 * trigger the controller.
 *
 * https://craftcms.com/classreference/services/TasksService
 * --snip--
 *
 * @author    @cole007
 * @copyright Copyright (c) 2017 @cole007
 * @link      http://ournameismud.co.uk/
 * @package   SpruceLee
 * @since     1.0.0
 */

namespace Craft;

class SpruceLee_PurgeTask extends BaseTask
{
    /**
     * Defines the settings.
     *
     * @access protected
     * @return array
     */    

    /**
     * Returns the default description for this task.
     *
     * @return string
     */
    public function getDescription()
    {
        return 'SpruceLee_Purge Tasks';
    }

    /**
     * Gets the total number of steps for this task.
     *
     * @return int
     */
    public function getTotalSteps()
    {
        $attr = ['status'=>'identified'];
        $records = SpruceLee_AssetRecord::model()->findAllByAttributes($attr);
        $steps = ceil(count($records)/25);
        SpruceLeePlugin::log('SpruceLee_PurgeTask::getTotalSteps ' . $steps . ' steps');
        return $steps;
    }

    /**
     * Runs a task step.
     *
     * @param int $step
     * @return bool
     */
    public function runStep($step)
    {
        if ($step == 0) {
            $backup = craft()->db->backup();
            if ($backup) SpruceLeePlugin::log('SpruceLee_PurgeTask::getTotalSteps DB bkup triggered');
        }
        SpruceLeePlugin::log('SpruceLee_PurgeTask::runSteps Step (' . $step . ')');
        craft()->spruceLee_purge->purgeAssets($step);
        return true;
    }
}
