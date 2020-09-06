<?php

/**
 * @package    ThirdPartyAuth
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

class ThirdPartyAuth_GetAuth extends ThirdPartyAuth
{
		
    /**
     * Access level for player
     *
     * @var boolean
     */
	protected static $_accessLevel = array( 1, 98 );
	
    /**
     * The method does the whole Class Process
     * 
     */
	protected function init()
    {
		try
		{ 
		//	var_export( Ayoola_Application::getUserInfo() );    
			if( ! $userInfo = Ayoola_Application::getUserInfo() )
			{
			//	var_export( $userInfo ); 
				return false;
			}
			if( empty( $_REQUEST['goto'] ) )
			{
				$this->setViewContent( '<div class="boxednews badnews">Redirection Error.</div>', true );
				return false;
			}
	//		var_export( $_REQUEST );      
			$table = new ThirdPartyAuth_Table();
			$authInfo = array();
			$authInfo['username'] = $userInfo['username'];
			$authInfo['auth_key'] = sha1( microtime() . rand() . json_encode( $_REQUEST ) . $userInfo['username'] );
			$authInfo['goto'] = $_REQUEST['goto'];
			$authInfo['c_time'] = time();
			$table->insert( $authInfo );
			
			$authString = 'auth_key=' . $authInfo['auth_key']  .'&c_time=' . $authInfo['c_time'] ;
			$authInfo['goto'] = urldecode( $authInfo['goto'] );
			if( strpos( $authInfo['goto'], '?' ) === false )
			{
				$authInfo['goto'] = $authInfo['goto'] . '?' . $authString;
			}
			else
			{
				$authInfo['goto'] = $authInfo['goto'] . '&' . $authString;
			}
			header( 'Location: ' . $authInfo['goto'] );  
			exit();
			
		}
		catch( Exception $e ){ return false; }
    }
	// END OF CLASS
}
