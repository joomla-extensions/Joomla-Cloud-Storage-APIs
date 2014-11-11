<?php
/**
 * @package     Joomla.Cloud
 * @subpackage  Googlecloudstorage
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Defines the GET operation on objects
 *
 * @since  1.0
 */
class JGooglecloudstorageObjectsGet extends JGooglecloudstorageObjects
{
	/**
	 * Creates the get object request and returns the response
	 *
	 * @param   string  $bucket           The bucket name
	 * @param   string  $object           The object name
	 * @param   string  $generation       Used for fetching a specific object version
	 * @param   array   $optionalHeaders  An array of optional headers to be set
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getObject($bucket, $object, $generation = null, $optionalHeaders = null)
	{
		$url = "https://" . $bucket . "." . $this->options->get("api.url") . "/" . $object;

		if ($generation != null)
		{
			$url .= "?generation=" . $generation;
		}

		// The headers may be optionally set in advance
		$headers = array(
			"Host" => $bucket . "." . $this->options->get("api.url"),
		);

		if (is_array($optionalHeaders))
		{
			foreach ($optionalHeaders as $header => $value)
			{
				$headers[$header] = $value;
			}
		}

		return $this->commonGetOperations($url, $headers);
	}

	/**
	 * Creates the request for getting an object's acl and returns the response
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $object  The object name
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getObjectAcl($bucket, $object)
	{
		$url = "https://" . $bucket . "." . $this->options->get("api.url") . "/" . $object . "?acl";

		// The headers may be optionally set in advance
		$headers = array(
			"Host" => $bucket . "." . $this->options->get("api.url"),
		);

		return $this->commonGetOperations($url, $headers);
	}
}
