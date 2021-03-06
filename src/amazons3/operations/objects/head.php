<?php
/**
 * @package     Joomla.Cloud
 * @subpackage  AmazonS3
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Defines the HEAD operations on objects
 *
 * @since  1.0
 */
class JAmazons3OperationsObjectsHead extends JAmazons3OperationsObjects
{
	/**
	 * The HEAD operation retrieves metadata from an object without returning the object itself.
	 *
	 * @param   string  $bucket          The bucket name
	 * @param   string  $objectName      The object name
	 * @param   string  $versionId       The object's version ID
	 * @param   string  $requestHeaders  Additional request headers
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function headObject($bucket, $objectName, $versionId = null, $requestHeaders = array())
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/' . $objectName;

		if (! is_null($versionId))
		{
			$url .= '?versionId=' . $versionId;
		}

		// Create the headers
		$headers = array(
			'Date' => date('D, d M Y H:i:s O'),
		);

		// Set the additional request headers
		foreach ($requestHeaders as $requestHeaderKey => $requestHeaderValue)
		{
			$headers[$requestHeaderKey] = $requestHeaderValue;
		}

		$authorization = $this->createAuthorization('HEAD', $url, $headers);
		$headers['Authorization'] = $authorization;

		// Send the http request
		$response = $this->client->head($url, $headers);

		// Process the response
		return $this->processResponse($response);
	}
}
