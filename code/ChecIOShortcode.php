<?php

class ChecIOShortcode extends Object
{
    /**
     * ShortCode which adds a link to a chec.io buy now popup window
     * @param $arguments
     * @param null $content
     * @param null $parser
     * @param null $tagName
     * @return string
     */
    public static function BuyNowButton($arguments, $content = null, $parser = null, $tagName)
    {
        if (isset($arguments['data-chec-product-id'])) {
            $id = Convert::raw2att($arguments['data-chec-product-id']);
            $siteURL = self::config()->get('third-party-url');

            // Add an onclick attribute to prevent following the re-written link anchor.
            $arguments['onclick'] = 'event.preventDefault ? event.preventDefault() : event.returnValue = false;';

            $link = "<a href=\"$siteURL/{$id}\"";
            // Add all arguments as-is as we could potentially be receiving css class styles
            foreach ($arguments as $key => $val) {
                $val = Convert::raw2att($val);
                $link .= " {$key}=\"{$val}\" ";
            }
            $link .= ">{$content}</a>";
            return $link;
        }
        return '';
    }
}
