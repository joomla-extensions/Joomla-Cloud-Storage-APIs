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
 * Defines the GET operations on buckets
 *
 * @since  1.0
 */
class JAmazons3OperationsBucketsGet extends JAmazons3OperationsBuckets
{
	/**
	 * Creates the request for getting a bucket and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucket($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's acl and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketAcl($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?acl';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's cors configuration information set
	 * and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketCors($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?cors';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's lifecycle and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketLifecycle($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?lifecycle';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's policy and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketPolicy($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?policy';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's location and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketLocation($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?location';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's logging and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketLogging($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?logging';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's notification and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketNotification($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?notification';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's tagging and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketTagging($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?tagging';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting the versions of a bucket's objects
	 * and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketVersions($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?versions';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's request payment configuration
	 * and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketRequestPayment($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?requestPayment';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's versioning state and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketVersioning($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?versioning';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for getting a bucket's website and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getBucketWebsite($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?website';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}

	/**
	 * Creates the request for listing a bucket's multipart uploads
	 * and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function listMultipartUploads($bucket)
	{
		$url = 'https://' . $bucket . '.' . $this->options->get('api.url') . '/?uploads';

		// Send the request and process the response
		return $this->commonGetOperations($url);
	}
}
