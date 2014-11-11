<?php
/**
 * @package     Joomla.Cloud
 * @subpackage  AmazonS3
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

use Joomla\Registry\Registry;

/**
 * Joomla! Platform class for interacting with an Amazons3 server instance.
 *
 * @since  1.0
 */
class JAmazons3
{
	/**
	 * @var    Registry  Options for the Amazons3 object.
	 * @since  1.0
	 */
	protected $options;

	/**
	 * @var    JAmazons3Http  The HTTP client object to use in sending HTTP requests.
	 * @since  1.0
	 */
	protected $client;

	/**
	 * @var    JAmazons3OperationsService  Amazons3 API object for Service.
	 * @since  1.0
	 */
	protected $service;

	/**
	 * @var    JAmazons3OperationsBuckets  Amazons3 API object for Buckets.
	 * @since  1.0
	 */
	protected $buckets;

	/**
	 * @var    JAmazons3OperationsObjects  Amazons3 API object for Objects.
	 * @since  1.0
	 */
	protected $objects;

	/**
	 * Constructor.
	 *
	 * @param   Registry       $options  Amazons3 options object. Should include api.accessKeyId and api.secretAccessKey
	 * @param   JAmazons3Http  $client   The HTTP client object.
	 *
	 * @since   1.0
	 */
	public function __construct(Registry $options = null, JAmazons3Http $client = null)
	{
		$this->options = isset($options) ? $options : new Registry;
		$this->client  = isset($client) ? $client : new JAmazons3Http($this->options);

		// Setup the default API url if not already set.
		$this->options->def('api.url', 's3.amazonaws.com');
	}

	/**
	 * Magic method to lazily create API objects
	 *
	 * @param   string  $name  Name of property to retrieve.
	 *
	 * @return  JAmazons3Object  Amazons3 API object
	 *
	 * @since   1.0
	 * @throws  InvalidArgumentException
	 */
	public function __get($name)
	{
		$class = 'JAmazons3Operations' . ucfirst($name);

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

	/**
	 * Get an option from the JAmazons3 instance.
	 *
	 * @param   string  $key  The name of the option to get.
	 *
	 * @return  mixed  The option value.
	 *
	 * @since   1.0
	 */
	public function getOption($key)
	{
		return $this->options->get($key);
	}

	/**
	 * Set an option for the JAmazons3 instance.
	 *
	 * @param   string  $key    The name of the option to set.
	 * @param   mixed   $value  The option value to set.
	 *
	 * @return  JAmazons3  This object for method chaining.
	 *
	 * @since   1.0
	 */
	public function setOption($key, $value)
	{
		$this->options->set($key, $value);

		return $this;
	}
}
