<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_constants as c;
use cascade_ws_asset as a;
use cascade_ws_property as p;
use cascade_ws_utility as u;
use cascade_ws_exception as e;

$mode = 'all';
//$mode = 'display';
//$mode = 'dump';
//$mode = 'get';
//$mode = 'set';
//$mode = 'raw';

try
{
    $wc_name = 'test-wordpress-connector';
    $wc      = $cascade->getWordPressConnector( 
        a\WordPressConnector::TYPE, $wc_name, 'cascade-admin' );
        
    if( !isset( $wc ) )
    {
        $wc = $cascade->createWordPressConnector(
            $cascade->getAsset(
                a\ConnectorContainer::TYPE, '980a826b8b7f0856015997e424411695'
            ),
            $wc_name,
            'www.upstate.edu',
            $cascade->getAsset( 
                a\ContentType::TYPE, 
                'a00d531c8b7f0856011c5ec62b24292d' ),
            'RWD' // configuration
       );
    }

    switch( $mode )
    {
        case 'all':
        case 'display':
            $wc->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $wc->dump( true );
            
            if( $mode != 'all' )
                break;

        case 'get':
            echo "ID: " . $wc->getId() . BR .
                 "Name: " . $wc->getName() . BR .
                 "Path: " . $wc->getPath() . BR .
                 "Property name: " . $wc->getPropertyName() . BR .
                 "Site name: " . $wc->getSiteName() . BR .
                 "Type: " . $wc->getType() . BR .
                 "";
                 
            if( $mode != 'all' )
                break;

        case 'set':
/*
            $ct1 = a\Asset::getAsset( 
                $service,
                a\ContentType::TYPE,
                'a55e8c598b7f0856002a5e116c7ddaa3' ); // 3 Collumns Test
            $ct2 = a\Asset::getAsset( 
                $service,
                a\ContentType::TYPE,
                '82e710ac8b7f085600ebf23e120dd1d8' ); // XML
            $wc->setMetadataMapping( 
                    $ct1,
                    a\WordPressConnector::CATEGORIES,
                    a\MetadataSet::SUMMARY )->
                    
                setMetadataMapping( 
                    $ct2,
                    a\WordPressConnector::CATEGORIES,
                    a\MetadataSet::KEYWORDS )->
                setMetadataMapping( 
                    $ct2,
                    a\WordPressConnector::TAGS,
                    'exclude-from-left' )->
                edit();
            $ct = a\Asset::getAsset( 
                $service,
                a\ContentType::TYPE,
                '7e0d51968b7f0856015997e42c3ede8e' );

            $wc->addContentTypeLink( $ct, 'Default' )->
                setMetadataMapping( 
                    $ct,
                    a\WordPressConnector::CATEGORIES,
                    a\MetadataSet::SUMMARY )->
                edit();
*/
            if( $mode != 'all' )
                break;

        case 'raw':
            $wc_std = $service->retrieve( 
                $service->createId( 
                    c\T::WORDPRESSCONNECTOR, '073dfa928b7f085600963f385376c2ae' ), 
                    c\P::WORDPRESSCONNECTOR );
            
            echo S_PRE;
            var_dump( $wc_std );
            echo E_PRE;
            
            if( $mode != 'all' )
                break;
    }
}
catch( \Exception $e )
{
    echo S_PRE . $e . E_PRE;
}
?>
