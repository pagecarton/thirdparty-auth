<?php

/**
 * @package    ThirdPartyAuth
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

abstract class ThirdPartyAuth extends Ayoola_Abstract_Table
{
	
    /**
     * Whether class is playable or not
     *
     * @var boolean
     */
	protected static $_playable = true;
	
    /**
     * Access level for player
     *
     * @var boolean
     */
	protected static $_accessLevel = 99;
	
    /**
     * 
     * 
     */
	public static function getAuthHomeLink()
    {    
		try
		{ 
            //  Code that runs the widget goes here...
			$domain = Application_Settings_Abstract::getSettings( 'thirdparty_auth', 'auth_domain' );
			
			$authSettings = Application_Settings_Abstract::getSettings( 'thirdparty_auth', 'auth_options' );

			if( is_array( $authSettings ) && in_array( 'disable_hybrid_auth', $authSettings ) )
			{
				// We don't want to use this'
				return false;			
			}
			$slimDomain = str_ireplace( 'www.', '', $domain );
			$slimDomainHere = str_ireplace( 'www.', '', Ayoola_Page::getDefaultDomain() );
			if( $slimDomain === $slimDomainHere )
			{
				return false;
			}
			if( ! $domain )
			{
				return false;
			}
			if( strpos( $domain, ':' ) === false )
			{
				$domain = Ayoola_Application::getDomainSettings( 'protocol' ) . '://' . $domain;
			}
            return $domain;
		}  
		catch( Exception $e )
        { 
            return false; 
        }
	}
	
	// END OF CLASS
}
