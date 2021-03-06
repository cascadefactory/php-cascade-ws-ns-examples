<?php
require_once('cascade_ws_ns/auth_chanw.php');

use cascade_ws_AOHS      as aohs;
use cascade_ws_constants as c;
use cascade_ws_asset     as a;
use cascade_ws_property  as p;
use cascade_ws_utility   as u;
use cascade_ws_exception as e;

try 
{
    $dd   = $cascade->getAsset( 
        a\DataDefinition::TYPE, "5f45269f8b7f08ee76b12c41d6c74918" );
    $xml  = new \SimpleXMLElement( $dd->getXml() );
    // get the node
    $node = $xml->xpath( "group[@identifier='site-config-group']" );
    // groups to be added
    $group_name1 = "Administrators";
    $group_name2 = "CWT-Designers";
    
    if( isset( $node ) )
    {
        $id         = "restrict-to-groups";
        $attributes = $node[ 0 ]->attributes();
        
        // if attribute does not exist
        if( !isset( $attributes->$id ) )
        {
            $node[ 0 ]->addAttribute( $id, "" );
        }
        
        $groups       = $attributes[ $id ];
        $group_array  = explode( ',', $groups );
        
        // add group names
        if( !in_array( $group_name1, $group_array ) )
        {
            $group_array[] = $group_name1;
        }
        
        if( !in_array( $group_name2, $group_array ) )
        {
            $group_array[] = $group_name2;
        }
        
        $groups            = implode( ',', $group_array );
        $groups            = trim( $groups, ',' );
        $attributes[ $id ] = $groups;
        $dd->setXml( $xml->asXML() )->edit();
    }
}
catch( \Exception $e ) 
{
    echo S_PRE . $e . E_PRE;
}
?>