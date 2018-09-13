
/*********************************************************************
 *   Script for YOAST SEO Analyzis enable
 * *******************************************************************/

/* global jQuery, YoastSEO */
(function ( $, document ) {
    'use strict';

    /**
     * The analyze module for Yoast SEO.
     */
    var module = {
        timeout: undefined,

        // Initialize
        init: function () {
            addEventListener( 'load', module.load );
        },

        // Load plugin and add hooks.
        load: function () {
            YoastSEO.app.registerPlugin( 'CruminaYoast', {status: 'loading'} );

            YoastSEO.app.pluginReady( 'CruminaYoast' );

            YoastSEO.app.registerModification( 'content', module.addContent, 'CruminaYoast', 5 );

            // Make the Yoast SEO analyzer works for existing content when page loads.
            module.update();
        },

        // Add content to Yoast SEO Analyzer.
        addContent: function ( content ) {
            content = $('#crumina-yoast-text').val();
            return content;
        },

        // Update the YoastSEO result. Use debounce technique, which triggers only when keys stop being pressed.
        update: function () {
            clearTimeout( module.timeout );
            module.timeout = setTimeout( function () {
                YoastSEO.app.pluginReloaded('CruminaYoast');
            }, 1000 );
        }

    };

    // Run on document ready.
    $( module.init );

})( jQuery, document );

