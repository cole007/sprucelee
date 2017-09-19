<?php
/**
 * Spruce Lee plugin for Craft CMS
 *
 * SpruceLee_Scan Service
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

class SpruceLee_ScanService extends BaseApplicationComponent
{
    /**
     * This function can literally be anything you want, and you can have as many service functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     craft()->spruceLee_scan->exampleService()
     */
    public function processScan($id)
    {
        // $criteria = craft()->elements->getCriteria(ElementType::Asset);
        // $criteria->sourceId = $id;
        // $assets = $criteria->find();
        // 

        $rels = craft()->db->createCommand()
            ->selectDistinct('targetId')
            ->from('relations');
        $relAssets = $rels->queryColumn();
        // $relIds = ArrayHelper::stringToArray($rels, 'id');    
        
        $pending = craft()->db->createCommand()
            ->selectDistinct('asset')
            ->from('sprucelee_Asset');
        $pendingAssets = $pending->queryColumn();

        $ids = implode(',',array_unique(array_merge($relAssets,$pendingAssets)));
        $params = [
            ':sourceId'=>$id,
            ':ids'=>$ids,
        ];

        $conditions = array('and',
            'sourceId = '.$id,
            'id NOT IN ('.$ids.')'
        );
        $assets = craft()->db->createCommand()
            ->from('assetfiles')
            ->where($conditions);            
        
        // redirect here?
        if (count($assets->query()) == 0) return false;
        $i = 0;        
        foreach ($assets->query() AS $row) {
            $asset = new SpruceLee_AssetModel();
            $asset->asset = $row['id'];
            $asset->folder = $row['folderId'];
            $asset->parent = $row['sourceId'];
            if ($asset->validate()) {
                $assetRecord = new SpruceLee_AssetRecord();
                $assetRecord->asset = $asset->asset;
                $assetRecord->folder = $asset->folder;
                $assetRecord->parent = $asset->parent;
                if ($assetRecord->save()) $i++;
            }             
        }
        return $i;
        exit;
    }

}