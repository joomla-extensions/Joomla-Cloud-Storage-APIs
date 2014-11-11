<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Amazons3
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

use Joomla\Registry\Registry;

/**
 * Test class for JAmazons3.
 *
 * @since  1.0
 */
class JAmazons3Test extends PHPUnit_Framework_TestCase
{
	/**
	 * @var  Registry  Options for the Amazons3 object.
	 */
	protected $options;

	/**
	 * @var  JAmazons3  Object under test.
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->options = new Registry;
		$this->object = new JAmazons3($this->options);
	}

	/**
	 * Tests the __construct method
	 */
	public function test__Construct()
	{
		$this->assertThat(
			$this->object->getOption('api.url'),
			$this->equalTo("s3.amazonaws.com")
		);
	}

	/**
	 * Tests the magic __get method - service
	 */
	public function test__GetService()
	{
		$this->assertThat(
			$this->object->service,
			$this->isInstanceOf('JAmazons3OperationsService')
		);
	}

	/**
	 * Tests the magic __get method - buckets
	 */
	public function test__GetBuckets()
	{
		$this->assertThat(
			$this->object->buckets,
			$this->isInstanceOf('JAmazons3OperationsBuckets')
		);
	}

	/**
	 * Tests the magic __get method - objects
	 */
	public function test__GetObjects()
	{
		$this->assertThat(
			$this->object->objects,
			$this->isInstanceOf('JAmazons3OperationsObjects')
		);
	}

	/**
	 * Tests the setOption method
	 */
	public function testSetOption()
	{
		$this->object->setOption('api.url', 'https://example.com/settest');

		$this->assertThat(
			$this->options->get('api.url'),
			$this->equalTo('https://example.com/settest')
		);
	}

	/**
	 * Tests the getOption method
	 */
	public function testGetOption()
	{
		$this->options->set('api.url', 'https://example.com/gettest');

		$this->assertThat(
			$this->object->getOption('api.url', 'https://example.com/gettest'),
			$this->equalTo('https://example.com/gettest')
		);
	}
}
