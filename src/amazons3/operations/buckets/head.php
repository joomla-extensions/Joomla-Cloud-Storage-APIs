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
 * Defines the HEAD operations on buckets
 *
 * @since  1.0
 */
class JAmazons3OperationsBucketsHead extends JAmazons3OperationsBuckets
{
	/**
	 * Creates a request to determine if a bucket exists and you have permission to access it.
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function headBucket($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/';

		// Create the headers
		$headers = array(
			'Date' => date('D, d M Y H:i:s O'),
		);
		$authorization = $this->createAuthorization('HEAD', $url, $headers);
		$headers['Authorization'] = $authorization;

		// Send the http request
		$response = $this->client->head($url, $headers);

		// Process the response
		return $this->processResponse($response);
	}
}
