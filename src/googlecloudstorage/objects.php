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
 * Common items for operations on objects
 *
 * @package     Joomla.Cloud
 * @subpackage  Googlecloudstorage
 * @since       1.0
 */
class JGooglecloudstorageObjects extends JGooglecloudstorageObject
{
	/**
	 * @var    JGooglecloudstorageObjectsGet  Googlecloudstorage API object for
	 *                                        GET operations on objects.
	 * @since  1.0
	 */
	protected $get;

	/**
	 * @var    JGooglecloudstorageObjectsHead  Googlecloudstorage API object for
	 *                                         HEAD operations on objects.
	 * @since  1.0
	 */
	protected $head;

	/**
	 * @var    JGooglecloudstorageObjectsPut  Googlecloudstorage API object for
	 *                                        PUT operations on objects.
	 * @since  1.0
	 */
	protected $put;

	/**
	 * @var    JGooglecloudstorageObjectsPost  Googlecloudstorage API object for
	 *                                         POST operations on objects.
	 * @since  1.0
	 */
	protected $post;

	/**
	 * @var    JGooglecloudstorageObjectsDelete  Googlecloudstorage API object for
	 *                                           DELETE operations on objects.
	 * @since  1.0
	 */
	protected $delete;

	/**
	 * Magic method to lazily create API objects
	 *
	 * @param   string  $name  Name of property to retrieve.
	 *
	 * @return  JGooglecloudstorageObject  Googlecloudstorage API object
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 */
	public function __get($name)
	{
		$class = 'JGooglecloudstorageObjects' . ucfirst($name);

		if (class_exists($class))
		{
			if (false == isset($this->$name))
			{
				$this->$name = new $class($this->options, $this->client);
			}

			return $this->$name;
		}

		throw new InvalidArgumentException(
			sprintf('Argument %s produced an invalid class name: %s', $name, $class)
		);
	}
}
