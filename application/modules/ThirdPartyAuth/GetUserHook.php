<?php

/**
 * PageCarton
 *
 * LICENSE
 *
 * @category   PageCarton
 * @package    ThirdPartyAuth_SignInHook
 * @copyright  Copyright (c) 2020 PageCarton (http://www.pagecarton.org)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @version    $Id: SignInHook.php Tuesday 19th of May 2020 02:32PM ayoola@ayoo.la $
 */

/**
 * @see PageCarton_Widget
 */

class ThirdPartyAuth_GetUserHook extends ThirdPartyAuth
{
	
    /**
     * 
     * 
     */
	public static function hook( $object, $method, & $data )
    {    
        if( empty( $data ) || ! is_array( $data ) )
        {
            return false;
        }
		try
		{ 
            switch( $method )
            {
                case 'getUserInfoByIdentifier':

                    $query = '?';
                    foreach( $data as $key => $value )
                    {
                        $query .= 'identifier[]=' . $key . '&value[]=' . $value . '&';
                        break;
                    }
                    if( ! $authHome = self::getAuthHomeLink() )
                    {
                        return false;
                    }
                    $link = self::getAuthHomeLink() . '/object/name/ThirdPartyAuth_GetUserInfo' . $query;
                    $response = self::fetchLink( $link );  
                    $response = json_decode( $response, true );
                    if( ! empty( $response ) && is_array( $response ) )
                    {
                        $data = $response;
                    }
                    break;
            }
		}  
		catch( Exception $e )
        { 
            return false; 
        }
	}
	// END OF CLASS
}
