<?php
/*
This program can be used to create a feed,
containing the block XML of an index block. The block id must be
passed in as part of the query string. The url of this program
then can be fed into a feed block and and the block will be populated
with the retrieved XML. 
*/

require_once('cascade_ws_ns/auth_web_services_for_feeds.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try
{
    // retrieve the block ID
    $block_id = $_GET[ "block_id" ];
    
    if( isset( $block_id ) &&  $service->isHexString( $block_id ) )
    {
        // site containing the page
        $site_name = "cascade-admin";
    
        // the page used to expose index block XML
        $page_path = "/intra/xml/index";
    
        // the block containing XML to be exposed
        $block = $cascade->getAsset( a\IndexBlock::TYPE, $block_id );
    
        // retrieve the page
        $page = $cascade->getAsset( a\Page::TYPE, $page_path, $site_name );
    
        // attach the block to the page's default region and publish it
        $page->setRegionBlock( 'XML', 'DEFAULT', $block )->edit()->publish();
    
        sleep( 10 );
    
        // retrieve and output the XML
        $url = "http://www.upstate.edu/" . $site_name . $page_path . ".xml";
        $file_content = file_get_contents( $url );
        echo $file_content;
    }
    else
    {
        echo "<error>No valid block ID supplied.</error>";
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE; 
}
?>