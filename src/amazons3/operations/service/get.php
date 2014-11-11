<?php
/**
 * @package     Joomla.Cloud
 * @subpackage  Amazons3
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Defines the GET operation on the service
 *
 * @since  1.0
 */
class JAmazons3OperationsServiceGet extends JAmazons3OperationsService
{
	/**
	 * Creates the get request and returns the response from Amazon
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getService()
	{
		$url = 'https://' . $this->options->get('api.url') . '/';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}
}
