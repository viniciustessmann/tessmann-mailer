<?php

/**
 * Class ShortCodeDevileries
 *
 * @author Vinícius Schlee Tessmann <vinicius.tessmann@possible.com>
 */
class ShortCodeDevileries
{
    public function __construct()
    {
        add_shortcode(DELIVERIES_MODULE_SHORTCODE, [&$this, 'shortCode']);
    }

    public function shortCode($atts, $content = null)
    {
        return Timber::compile(
            'views/deliveries.html.twig',
            setSpaces($viewData, $atts)
        );
    }
}
