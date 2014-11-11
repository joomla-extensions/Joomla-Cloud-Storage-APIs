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
 * Defines the OPTIONS operations on objects
 *
 * @since  1.0
 */
class JAmazons3OperationsObjectsOptionss3 extends JAmazons3OperationsObjects
{
	/**
	 * A browser can send this preflight request to Amazon S3 to determine if it can
	 * send an actual request with the specific origin, HTTP method, and headers.
	 *
	 * @param   string  $bucket          The bucket name
	 * @param   string  $objectName      The object name
	 * @param   array   $requestHeaders  Additional request headers
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function optionsObject($bucket, $objectName, $requestHeaders)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/' . $objectName;

		// Create the headers
		$headers = array(
			'Date' => date('D, d M Y H:i:s O'),
		);

		// Set the additional request headers
		foreach ($requestHeaders as $requestHeaderKey => $requestHeaderValue)
		{
			$headers[$requestHeaderKey] = $requestHeaderValue;
		}

		$authorization = $this->createAuthorization('OPTIONS', $url, $headers);
		$headers['Authorization'] = $authorization;

		// Send the http request
		$response = $this->client->options($url, $headers);

		// Process the response
		return $this->processResponse($response);
	}
}
