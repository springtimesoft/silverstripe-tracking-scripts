<?php

/**
 * Use this class as a base only to extend from.
 */

namespace Springtimesoft\TrackingScripts\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;

class TrackingScript extends DataObject
{
    /**
     * The table name.
     *
     * @var string
     *
     * @config
     */
    private static $table_name = 'TrackingScript';

    /**
     * The default sort.
     *
     * @var string
     *
     * @config
     */
    private static $default_sort = '"SortOrder" ASC';

    /**
     * Database field definitions.
     *
     * @var array
     *
     * @config
     */
    private static $db = [
        'TrackingID' => 'Varchar(50)',
        'SortOrder'  => 'Int',
    ];

    /**
     * Defines summary fields commonly used in table columns
     * as a quick overview of the data for this DataObject
     *
     * @var array
     */
    private static $summary_fields = [
        'ClassToLabel' => 'Script Type',
        'TrackingID'   => 'Tracking ID',
    ];

    /**
     * Data administration interface in Silverstripe.
     *
     * @see    {@link ValidationResult}
     *
     * @return FieldList Returns a TabSet for usage within the CMS
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(
            [
                'SortOrder',
            ]
        );

        return $fields;
    }

    /**
     * Return tracking code for the HTML head. Extending classes should
     * have their own getTrackingScriptTemplateHead() function if applicable.
     *
     * @param mixed $trackingID Tracking script ID
     *
     * @return mixed
     */
    public function getTrackingScriptTemplateHead($trackingID)
    {
        return false;
    }

    /**
     * Return tracking code for the HTML body. Extending classes should
     * have their own getTrackingScriptTemplateBody() function if applicable.
     *
     * @param mixed $trackingID Tracking script ID
     *
     * @return mixed
     */
    public function getTrackingScriptTemplateBody($trackingID)
    {
        return false;
    }

    /**
     * Return label for GridFields
     *
     * @return string
     */
    public function getClassToLabel()
    {
        return $this->singular_name();
    }

    /**
     * Get title for GridField
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getClassToLabel();
    }

    /**
     * Validate the current object.
     *
     * @see    {@link ValidationResult}
     *
     * @return ValidationResult
     */
    public function validate()
    {
        $valid = parent::validate();

        $this->TrackingID = trim(strval($this->TrackingID));

        if (!$this->TrackingID) {
            $valid->addError('Please enter a tracking ID');
        } elseif (preg_match('/[^a-z0-9\-]/i', $this->TrackingID)) {
            $valid->addError('Please enter valid tracking ID');
        }

        return $valid;
    }

    /**
     * Event handler called before writing to the database.
     *
     * @return void
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if (!$this->SortOrder) {
            $this->SortOrder = TrackingScript::get()->max('SortOrder') + 1;
        }
    }

    /**
     * Permissions canView
     *
     * @param Member $member SilverStripe member
     *
     * @return bool
     */
    public function canView($member = null)
    {
        return true;
    }

    /**
     * Permissions canEdit
     *
     * @param Member $member SilverStripe member
     *
     * @return bool
     */
    public function canEdit($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    /**
     * Permissions canCreate
     *
     * @param Member $member  SilverStripe member
     * @param array  $context Array
     *
     * @return bool
     */
    public function canCreate($member = null, $context = [])
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    /**
     * Permissions canDelete
     *
     * @param Member $member SilverStripe member
     *
     * @return bool
     */
    public function canDelete($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }
}
