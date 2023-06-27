<?php

/**
 * Extension to add tracking scripts to pages
 */

namespace Springtimesoft\TrackingScripts\Extensions;

use SilverStripe\Core\ClassInfo;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\ORM\DataExtension;
use Springtimesoft\TrackingScripts\Models\TrackingScript;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Symbiote\GridFieldExtensions\GridFieldTitleHeader;

class SiteConfigExtension extends DataExtension
{
    /**
     * Update CMS fields
     *
     * @param FieldList $fields Fields
     *
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        // find all classes extending TrackingScript::class
        $trackers = array_values(
            ClassInfo::subclassesFor(TrackingScript::class, false)
        );

        $config = GridFieldConfig_RecordEditor::create();

        $config->addComponent(new GridFieldOrderableRows('SortOrder'));
        $config->removeComponentsByType(GridFieldSortableHeader::class);
        $config->addComponent(new GridFieldTitleHeader());

        $mc_add = new GridFieldAddNewMultiClass();
        $mc_add->setClasses($trackers);
        $config->removeComponentsByType(GridFieldAddNewButton::class)
            ->addComponent($mc_add);

        $fields->addFieldsToTab(
            'Root.TrackingScripts',
            [
                GridField::create(
                    'TrackingScripts',
                    'Tracking Scripts',
                    TrackingScript::get(),
                    $config
                ),
            ]
        );

        return $fields;
    }
}
