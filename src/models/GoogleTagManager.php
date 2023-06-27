<?php

namespace Springtimesoft\TrackingScripts\Models;

class GoogleTagManager extends TrackingScript
{
    /**
     * Human-readable singular name.
     *
     * @var string
     *
     * @config
     */
    private static $singular_name = 'Google Tag Manager';

    /**
     * The table name.
     *
     * @var string
     *
     * @config
     */
    private static $table_name = 'TrackingScript_GoogleTagManager';

    /**
     * Field labels
     *
     * @var array
     */
    private static $field_labels = [
        'TrackingID' => 'Google Tag Manager ID',
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

        $anchor = $fields->dataFieldByName('TrackingID')
            ->setDescription(
                'Add your Google Tag Manager tracking ID.'
            )
            ->setAttribute('placeholder', 'Google Tag Manager tracking ID');

        return $fields;
    }

    /**
     * Return tracking code for the HTML head
     *
     * @param mixed $trackingID GTM ID
     *
     * @return mixed
     */
    public function getTrackingScriptTemplateHead($trackingID)
    {
        return $this->customise(
            [
                'TrackingID' => $trackingID,
            ]
        )->renderWith(['GoogleTagManager_head']);
    }

    /**
     * Return tracking code for the HTML body
     *
     * @param mixed $trackingID GTM ID
     *
     * @return mixed
     */
    public function getTrackingScriptTemplateBody($trackingID)
    {
        return $this->customise(
            [
                'TrackingID' => $trackingID,
            ]
        )->renderWith(['GoogleTagManager_body']);
    }
}
