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
//$mode = 'copy';
//$mode = 'raw';

try
{
    $id = "b893fd058b7f0856002a5e11185ff809";
    $ms = $cascade->getAsset( a\MetadataSet::TYPE, $id );
    
    switch( $mode )
    {
        case 'all':
        case 'display':
            $ms->display();
            
            if( $mode != 'all' )
                break;
                
        case 'dump':
            $ms->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'get':
            echo "ID: " .            $ms->getId() . BR .
                 "Name: " .          $ms->getName() . BR .
                 "Path: " .          $ms->getPath() . BR .
                 "Property name: " . $ms->getPropertyName() . BR .
                 "Site name: " .     $ms->getSiteName() . BR .
                 "Type: " .          $ms->getType() . BR .
                 
                 "Author field required: " . 
                 $ms->getAuthorFieldRequired() . BR .
                 "Author field visibility: " . 
                 $ms->getAuthorFieldVisibility() . BR .
                 "Description field required: " . 
                 $ms->getDescriptionFieldRequired() . BR .
                 "Description field visibility: " . 
                 $ms->getDescriptionFieldVisibility() . BR .
                 "Display name field required: " . 
                 $ms->getDisplayNameFieldRequired() . BR .
                 "Display name field visibility: " . 
                 $ms->getDisplayNameFieldVisibility() . BR .
                 "End date field required: " . 
                 $ms->getEndDateFieldRequired() . BR .
                 "End date field visibility: " . 
                 $ms->getEndDateFieldVisibility() . BR .
                 "Keywords field required: " . 
                 $ms->getKeywordsFieldRequired() . BR .
                 "Keywords field visibility: " . 
                 $ms->getKeywordsFieldVisibility() . BR .
                 "Review date field required: " . 
                 $ms->getReviewDateFieldRequired() . BR .
                 "Review date field visibility: " . 
                 $ms->getReviewDateFieldVisibility() . BR .
                 "Start date field required: " . 
                 $ms->getStartDateFieldRequired() . BR .
                 "Start date field visibility: " . 
                 $ms->getStartDateFieldVisibility() . BR .
                 "Summary field required: " . 
                 $ms->getSummaryFieldRequired() . BR .
                 "Summary field visibility: " . 
                 $ms->getSummaryFieldVisibility() . BR .
                 "Teaser field required: " . 
                 $ms->getTeaserFieldRequired() . BR .
                 "Teaser field visibility: " . 
                 $ms->getTeaserFieldVisibility() . BR .
                 "Title field required: " . 
                 $ms->getTitleFieldRequired() . BR .
                 "Title field visibility: " . 
                 $ms->getTitleFieldVisibility() . BR ;
            
            $name = "show-intra-icon";
            
            if( $ms->hasDynamicMetadataFieldDefinition( $name ) )
            {
                echo "Definition found" . BR;
                $dmd = $ms->getDynamicMetadataFieldDefinition( $name );
                echo S_PRE;
                var_dump( $dmd );
                echo E_PRE. BR;                
                
                echo S_PRE;
                var_dump( $dmd->getPossibleValueStrings() );
                echo E_PRE;
            }
            
            $ms->dump();
            if( $mode != 'all' )
                break;
                
        case 'set':       
            $ms->
                setAuthorFieldRequired( false )->
                setAuthorFieldVisibility( a\MetadataSet::INLINE )->
                setDescriptionFieldRequired( false )->
                setDescriptionFieldVisibility( a\MetadataSet::INLINE )->
                setDisplayNameFieldRequired( false )->
                setDisplayNameFieldVisibility( a\MetadataSet::INLINE )->
                setEndDateFieldRequired( false )->
                setEndDateFieldVisibility( a\MetadataSet::INLINE )->
                setKeywordsFieldRequired( false )->
                setKeywordsFieldVisibility( a\MetadataSet::INLINE )->
                setReviewDateFieldRequired( false )->
                setReviewDateFieldVisibility( a\MetadataSet::INLINE )->
                setStartDateFieldRequired( false )->
                setStartDateFieldVisibility( a\MetadataSet::INLINE )->
                setSummaryFieldRequired( false )->
                setSummaryFieldVisibility( a\MetadataSet::INLINE )->
                setTeaserFieldRequired( false )->
                setTeaserFieldVisibility( a\MetadataSet::INLINE )->
                setTitleFieldRequired( false )->
                setTitleFieldVisibility( a\MetadataSet::INLINE );
        
            $name = "exclude-from-left";
            
            if( $ms->hasDynamicMetadataFieldDefinition( $name ) )
            {
                echo S_PRE;
                var_dump( 
                    $ms->getDynamicMetadataFieldPossibleValueStrings( $name ) );
                echo E_PRE;
            
                $ms->setSelectedByDefault( $name, "Yes" );
                $ms->unsetSelectedByDefault( $name, "Maybe" );
            }
            
            echo S_PRE;
            $ms->appendValue( $name, "No" )->
                setSelectedByDefault( $name, "No" )->
                setLabel( $name, "Exclude from Left Menu" )->
                setRequired( $name, false )->
                setVisibility( $name, c\T::INLINE )->
                edit()->dump();
            echo E_PRE;
                
            $ms->//removeValue( $name, "Maybe" )->
                swapValues( $name, "Yes", "No" );
                
            /*
            $field = 'text';
            
            if( $ms->hasDynamicMetadataFieldDefinition( $field ) )
            {
                // can be removed only once
                $ms->removeDynamicMetadataFieldDefinition( $field )->edit();
            }
            */
            
            $field1 = "radio";
            $field2 = "dropdown";
            $field3 = "multiselect";
            
            if( $ms->hasDynamicMetadataFieldDefinition( $field1 ) &&  
                $ms->hasDynamicMetadataFieldDefinition( $field2 ) && 
                $ms->hasDynamicMetadataFieldDefinition( $field3 )
            )
            {
                $ms->swapDynamicMetadataFieldDefinitions( $field1, $field2 )->
                    swapDynamicMetadataFieldDefinitions( $field1, $field3 )->
                    edit();
            }
                
            if( $mode != 'all' )
                break;
                
        case 'copy':
        	$new_name = 'Test 2';
            $new_ms   = $ms->copy( 
            	$cascade->getAsset( 
            		a\MetadataSetContainer::TYPE, $ms->getParentContainerId() ), 
            	$new_name );
            $new_ms->dump( true );
            
            if( $mode != 'all' )
                break;
                
        case 'raw':
            $ms = $service->retrieve( 
                $service->createId( c\T::METADATASET, $id ), c\P::METADATASET );
            $ms->authorFieldRequired = fal;
            $asset = new \stdClass();
            $asset->metadataSet = $ms;
            $service->edit( $asset );
            
            $ms = $service->retrieve( 
                $service->createId( c\T::METADATASET, $id ), c\P::METADATASET );
            echo S_PRE;
            var_dump( $ms );
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