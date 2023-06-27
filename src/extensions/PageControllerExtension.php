<?php

namespace Springtimesoft\TrackingScripts\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\FieldType\DBHTMLVarchar;
use SilverStripe\View\Requirements;
use Springtimesoft\TrackingScripts\Models\TrackingScript;

class PageControllerExtension extends DataExtension
{
    /**
     * Generate tracking scripts. You should have $TrackingScripts just below
     * the <body> tag in Page.ss
     *
     * @return mixed
     */
    public function trackingScripts()
    {
        $trackingScripts = TrackingScript::get();
        if (!$trackingScripts->count()) {
            return;
        }

        $head = '';
        $body = '';

        foreach ($trackingScripts as $ts) {
            $head .= (string) $ts->getTrackingScriptTemplateHead($ts->TrackingID);
            $body .= (string) $ts->getTrackingScriptTemplateBody($ts->TrackingID);
        }

        $head = trim($head);
        $body = trim($body);

        // insert header scripts if required
        if (strlen($head)) {
            Requirements::insertHeadTags("<script>\n{$head}\n</script>");
        }

        // return body code (html / javascript) set
        if (strlen($body)) {
            return DBHTMLVarchar::create()->setValue($body);
        }
    }
}
