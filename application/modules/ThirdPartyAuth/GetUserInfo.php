<?php

/**
 * @package    ThirdPartyAuth
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

class ThirdPartyAuth_GetUserInfo extends ThirdPartyAuth
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
			if( empty( $_GET['identifier'] ) || empty( $_GET['value'] ) )
			{
				return false;
			}
            $access = new Ayoola_Access();
            $identifier = array( $_GET['identifier'] => $_GET['value'] );
            //var_export( $identifier );
            $userInfo = $access->getUserInfoByIdentifier( $identifier );

            $jsonInfo = json_encode( $userInfo );
			echo $jsonInfo;
			exit();
		}
		catch( Exception $e ){ return false; }
    }
	// END OF CLASS
}
