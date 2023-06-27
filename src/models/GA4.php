<?php

namespace Springtimesoft\TrackingScripts\Models;

use SilverStripe\View\Requirements;

class GA4 extends TrackingScript
{
    /**
     * Human-readable singular name.
     *
     * @var string
     *
     * @config
     */
    private static $singular_name = 'Google Analytics 4';

    /**
     * The table name.
     *
     * @var string
     *
     * @config
     */
    private static $table_name = 'TrackingScript_GA4';

    /**
     * Field labels
     *
     * @var array
     */
    private static $field_labels = [
        'TrackingID' => 'GA4 tracking ID',
    ];

    /**
     * Used to set whether a previous GA4 config has been generated
     * to prevent JS duplication of the <script src> and some of the JS.
     *
     * @var bool
     */
    private static $already_included = false;

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
                'Add your Google Analytics 4 tracking ID.'
            )
            ->setAttribute('placeholder', 'Google Analytics 4 tracking ID');

        return $fields;
    }

    /**
     * Return tracking code for the HTML head
     *
     * @param mixed $trackingID GA4 ID
     *
     * @return mixed
     */
    public function getTrackingScriptTemplateHead($trackingID)
    {
        if (!self::$already_included) {
            Requirements::insertHeadTags(
                "<script async src=\"https://www.googletagmanager.com/gtag/js?id={$trackingID}\"></script>"
            );
        }

        $code = $this->customise(
            [
                'TrackingID' => $trackingID,
            ]
        )->renderWith(['GA4_head']);

        // set the variable for additional GA4 scripts
        self::$already_included = true;

        return $code;
    }

    /**
     * Getter for template
     *
     * @return bool
     */
    public function getAlreadyIncluded()
    {
        return self::$already_included;
    }
}
