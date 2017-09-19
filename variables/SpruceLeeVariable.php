<?php
/**
 * Spruce Lee plugin for Craft CMS
 *
 * Spruce Lee Variable
 *
 * --snip--
 * Craft allows plugins to provide their own template variables, accessible from the {{ craft }} global variable
 * (e.g. {{ craft.pluginName }}).
 *
 * https://craftcms.com/docs/plugins/variables
 * --snip--
 *
 * @author    @cole007
 * @copyright Copyright (c) 2017 @cole007
 * @link      http://ournameismud.co.uk/
 * @package   SpruceLee
 * @since     1.0.0
 */

namespace Craft;

class SpruceLeeVariable
{
    /**
     * Whatever you want to output to a Twig template can go into a Variable method. You can have as many variable
     * functions as you want.  From any Twig template, call it like this:
     *
     *     {{ craft.spruceLee.exampleVariable }}
     *
     * Or, if your variable requires input from Twig:
     *
     *     {{ craft.spruceLee.exampleVariable(twigValue) }}
     */
    public function getSaught($attr = [])
    {   
        if ($attr) {
            $records = SpruceLee_AssetRecord::model()->findAllByAttributes($attr);
        } else {
            $records = SpruceLee_AssetRecord::model()->findAll();
        }
        return $records;
    }
    public function getFolders($optional = null)
    {
        $assetSources = craft()->assetSources->getAllSources();
        $src = [];
        foreach ($assetSources AS $source) {
            $src[$source['id']] = $source['name'];
        }
        // Craft::dd($src);
        return $src;
    }
}