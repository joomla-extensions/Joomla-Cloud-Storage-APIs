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
 * Defines the GET operation on the service
 *
 * @since  1.0
 */
class JGooglecloudstorageServiceGet extends JGooglecloudstorageService
{
	/**
	 * Lists all of the buckets in a specified project.
	 *
	 * @return  SimpleXMLElement|string  The response body
	 *
	 * @since   1.0
	 */
	public function getService()
	{
		$url = "https://" . $this->options->get("api.url") . "/";

		// The headers may be optionally set in advance
		$headers = array(
			"Host" => $this->options->get("api.url"),
			"x-goog-project-id" => $this->options->get("project.id"),
		);

		return $this->commonGetOperations($url, $headers);
	}
}
