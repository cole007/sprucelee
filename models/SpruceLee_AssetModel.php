<?php
/**
 * Spruce Lee plugin for Craft CMS
 *
 * SpruceLee_Asset Model
 *
 * --snip--
 * Models are containers for data. Just about every time information is passed between services, controllers, and
 * templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 * --snip--
 *
 * @author    @cole007
 * @copyright Copyright (c) 2017 @cole007
 * @link      http://ournameismud.co.uk/
 * @package   SpruceLee
 * @since     1.0.0
 */

namespace Craft;

class SpruceLee_AssetModel extends BaseModel
{
    /**
     * Defines this model's attributes.
     *
     * @return array
     */
    protected function defineAttributes()
    {
        return array_merge(parent::defineAttributes(), array(
            'asset'     => array(AttributeType::Number),
            'folder'     => array(AttributeType::Number),
            'parent'     => array(AttributeType::Number),
            // 'rel'     => array(AttributeType::Number),
            'status'     => array(AttributeType::String,'default'=>'identified'),
        ));
    }

}