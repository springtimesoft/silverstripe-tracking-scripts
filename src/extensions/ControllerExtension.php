<?php

namespace Springtimesoft\TrackingScripts\Extensions;

use SilverStripe\Core\Extension;
use Silverstripe\CSP\NonceGenerator;
use SilverStripe\ORM\FieldType\DBHTMLVarchar;
use SilverStripe\View\Requirements;
use Springtimesoft\TrackingScripts\Models\TrackingScript;

class ControllerExtension extends Extension
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

        // Retrieve nonce if CSP module is installed
        $scriptAttributes = '';
        if (class_exists('Silverstripe\CSP\NonceGenerator')) {
            $nonce            = NonceGenerator::get();
            $scriptAttributes = " nonce=\"{$nonce}\"";
        }

        // insert header scripts if required
        if (strlen($head)) {
            Requirements::insertHeadTags("<script{$scriptAttributes}>\n{$head}\n</script>");
        }

        // return body code (html / javascript) set
        if (strlen($body)) {
            return DBHTMLVarchar::create()->setValue($body);
        }
    }
}
