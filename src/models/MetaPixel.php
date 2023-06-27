<?php

namespace Springtimesoft\TrackingScripts\Models;

class MetaPixel extends TrackingScript
{
    /**
     * Human-readable singular name.
     *
     * @var string
     *
     * @config
     */
    private static $singular_name = 'Meta (Facebook) Pixel';

    /**
     * The table name.
     *
     * @var string
     *
     * @config
     */
    private static $table_name = 'TrackingScript_MetaPixel';

    /**
     * Field labels
     *
     * @var array
     */
    private static $field_labels = [
        'TrackingID' => 'Meta Pixel tracking ID',
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
                'Add your Meta Pixel tracking ID.'
            )
            ->setAttribute('placeholder', 'Meta Pixel tracking ID');

        return $fields;
    }

    /**
     * Return tracking code for the HTML head
     *
     * @param mixed $trackingID Meta Pixel ID
     *
     * @return string
     */
    public function getTrackingScriptTemplateHead($trackingID)
    {
        return $this->customise(
            [
                'TrackingID' => $trackingID,
            ]
        )->renderWith(['MetaPixel_head']);
    }

    /**
     * Return tracking code for the HTML body
     *
     * @param mixed $trackingID Meta Pixel ID
     *
     * @return mixed
     */
    public function getTrackingScriptTemplateBody($trackingID)
    {
        return $this->customise(
            [
                'TrackingID' => $trackingID,
            ]
        )->renderWith(['MetaPixel_body']);
    }
}
