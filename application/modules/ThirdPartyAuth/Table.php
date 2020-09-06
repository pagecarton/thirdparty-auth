<?php

/**
 * @category   PageCarton CMS
 * @package    ThirdPartyAuth
 * @copyright  Copyright (c) 2011-2016 PageCarton (http://www.pagecarton.com)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

class ThirdPartyAuth_Table extends Ayoola_Dbase_Table_Abstract_Xml_Private
{

    /**
     * The Version of the present table (SVN COMPATIBLE)
     *
     * @param int
     */
    protected $_tableVersion = '0.01';

	protected $_dataTypes = array
	( 
		'auth_key' => 'INPUTTEXT',
		'username' => 'INPUTTEXT',
		'goto' => 'INPUTTEXT',
		'u_time' => 'INT',
		'c_time' => 'INT',
	);
	// END OF CLASS
}
