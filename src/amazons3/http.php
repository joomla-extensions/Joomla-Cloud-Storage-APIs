<?php
/**
 * @package     Joomla.Cloud
 * @subpackage  Amazons3
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

use Joomla\Registry\Registry;

/**
 * HTTP client class for connecting to an Amazons3 instance.
 *
 * @package     Joomla.Cloud
 * @subpackage  Amazons3
 * @since       1.0
 */
class JAmazons3Http extends JHttp
{
	/**
	 * Constructor.
	 *
	 * @param   Registry        $options    Client options object.
	 * @param   JHttpTransport  $transport  The HTTP transport object.
	 *
	 * @since   1.0
	 */
	public function __construct(Registry $options = null, JHttpTransport $transport = null)
	{
		// Call the JHttp constructor to setup the object.
		parent::__construct($options, $transport);

		// Set the default timeout to 120 seconds.
		$this->options->def('timeout', 120);
	}
}
