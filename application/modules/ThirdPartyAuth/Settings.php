<?php

/**
 * @category   PageCarton CMS
 * @package    ThirdPartyAuth
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

class ThirdPartyAuth_Settings extends PageCarton_Settings
{
	
    /**
     * creates the form for creating and editing
     * 
     * param string The Value of the Submit Button
     * param string Value of the Legend
     * param array Default Values
     */
	public function createForm( $submitValue = null, $legend = null, Array $settings = null )
    {
        $form = new Ayoola_Form( array( 'name' => $this->getObjectName() ) );
		$form->submitValue = $submitValue ;
		$form->oneFieldSetAtATime = true;
		$fieldset = new Ayoola_Form_Element;

        if( ! empty( $settings['data'] ) )
        {
            $settings = $settings['data'];
        }
				//self::v( $settings );

		//	auth levels
		$fieldset->addElement( array( 'name' => 'auth_domain', 'label' => 'Auth Domain', 'value' => @$settings['auth_domain'], 'type' => 'InputText' ) );
		$options = array( 
							'disable_hybrid_auth' => 'Disable Hybrid Auth', 
							'no_fallback' => 'Don\'t fall back to other auth mechanisms', 
							);
		$fieldset->addElement( array( 'name' => 'auth_options', 'label' => 'Options', 'value' => @$settings['auth_options'], 'type' => 'Checkbox' ), $options );
		
		$fieldset->addLegend( 'ThirdPartyAuth Settings' );        
		$form->addFieldset( $fieldset );
		$this->setForm( $form );
		//		$form->addFieldset( $fieldset );
	//	$this->setForm( $form );
    } 
	// END OF CLASS
}
