<?php

/**
 * @package    ThirdPartyAuth
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

class ThirdPartyAuth_VerifyAuth extends ThirdPartyAuth
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
			if( empty( $_REQUEST['auth_key'] ) )
			{
				return false;
			}
		//	if( $userInfo = Ayoola_Application::getUserInfo() )
			{
			//	return false;
			}
			$table = new ThirdPartyAuth_Table();
			$authInfo = $userInfo =  array();
			$authInfo['auth_key'] = $_REQUEST['auth_key'];
			$authInfo['u_time'] = '';
			if( $aInfoResult = $table->selectOne( null, $authInfo ) )
			{
				
				if( ! empty( $aInfoResult['u_time'] ) )
				{
					//	used info
					$table->delete( array( 'auth_key' => $aInfoResult['auth_key'] ) );
				}
				elseif( ( time() - $aInfoResult['c_time'] ) > 300 )
				{
					//	expired info
				//	$table->delete( array( 'auth_key' => $aInfoResult['auth_key'] ) );
				}
				elseif( $userInfo = Ayoola_Access::getAccessInformation( $aInfoResult['username'] ) )
				{
					$response = $table->update( array( 'u_time' => time() ), array( 'username' => $aInfoResult['username'] ) );
				}
			}
			$jsonInfo = json_encode( $userInfo );
			echo $jsonInfo;
			exit();
		}
		catch( Exception $e ){ return false; }
    }
	// END OF CLASS
}
