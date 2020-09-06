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

class ThirdPartyAuth_SignInHook extends ThirdPartyAuth
{
	
    /**
     * 
     * 
     */
	public static function hook( $object, $method, & $data )
    {    
		try
		{ 
            switch( $method )
            {
                case 'setForm':
                    if( ! $object->getParameter( 'no_redirect' ) )
                    {
                        $view = ThirdPartyAuth_DoAuth::viewInLine();
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
