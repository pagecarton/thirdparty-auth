<?php

/**
 * @package    ThirdPartyAuth
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

class ThirdPartyAuth_DoAuth extends ThirdPartyAuth
{
		
    /**
     * Access level for player
     *
     * @var boolean
     */
	protected static $_accessLevel = 0;
	
    /**
     * The method does the whole Class Process
     * 
     */
	protected function init()
    {
		try
		{ 
		//	var_export( Ayoola_Application::getUserInfo() );     
		//	exit();
			if( $userInfo = Ayoola_Application::getUserInfo() )
			{
				$this->setViewContent( '<div class="boxednews goodnews">Already logged in as @' . $userInfo['username'] . '.</div>', true );   
				return false;
			}
				
			if( ! $authHome = self::getAuthHomeLink() )
			{
				$this->setViewContent( '<span class="boxednews badnews">No Auth Domain Set</span>', true );
				$this->setViewContent( '<a href="javascript:;" onclick="ayoola.spotLight.showLinkInIFrame( \'' . Ayoola_Application::getUrlPrefix() . '/tools/classplayer/get/object_name/Application_Settings_Editor/settingsname_name/ThirdPartyAuth/\', \'' . __CLASS__ . '\' )" class="boxednews goodnews">Set Domain...</a>' );
				return false;
			}
            $goto = Ayoola_Page::getHomePageUrl() . Ayoola_Application::getRequestedUri() . '?' . http_build_query( $_GET );
			$logInLink = $authHome . '/object/name/ThirdPartyAuth_GetAuth?goto=' . urlencode( $goto );
			if( empty( $_REQUEST['auth_key'] )  )
			{
				header( 'Location: ' . $logInLink );
				exit();			
			}
			if( ( time() - $_REQUEST['c_time'] ) > 300 )
			{
				header( 'Location: ' . $logInLink );
				exit();			
			}
			$link = self::getAuthHomeLink() . '/object/name/ThirdPartyAuth_VerifyAuth?auth_key=' . $_REQUEST['auth_key'];
		//	var_export( $link );  
			$response = self::fetchLink( $link );  
			
		//	var_export( $link );
		//	var_export( $response );
		//	exit();
			$response = json_decode( $response, true );
		//	var_export( $response );
		//	exit();
			
			if( isset( $response['username'], $response['email'] ) )
			{
				$response['logout_url'] = $domain . '/accounts/signout';
				Ayoola_Access_Login::login( $response );
				$this->setViewContent( '<div class="boxednews goodnews">Log in successful as @' . $response['username'] . '.</div>', true );
			}
			else
			{
				if(  is_array( $authSettings )  && 	in_array( 'no_fallback', $authSettings ) )
				{
					// Go back for new auth
					header( 'Location: ' . $logInLink );
					exit();			
				}
				else
				{
					$this->setViewContent( '<div class="boxednews badnews">Log in failed.</div>', true );
				}
			}
		}
		catch( Exception $e ){ return false; }   
    }
	// END OF CLASS
}
