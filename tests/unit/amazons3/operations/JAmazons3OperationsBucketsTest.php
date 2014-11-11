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
 * Test class for JAmazons3OperationsBuckets.
 *
 * @since  1.0
 */
class JAmazons3OperationsBucketsTest extends PHPUnit_Framework_TestCase
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
	 * Tests the magic __get method - get
	 */
	public function test__GetGet()
	{
		$this->assertThat(
			$this->object->buckets->get,
			$this->isInstanceOf('JAmazons3OperationsBucketsGet')
		);
	}

	/**
	 * Tests the magic __get method - head
	 */
	public function test__GetHead()
	{
		$this->assertThat(
			$this->object->buckets->head,
			$this->isInstanceOf('JAmazons3OperationsBucketsHead')
		);
	}

	/**
	 * Tests the magic __get method - delete
	 */
	public function test__GetDelete()
	{
		$this->assertThat(
			$this->object->buckets->delete,
			$this->isInstanceOf('JAmazons3OperationsBucketsDelete')
		);
	}

	/**
	 * Tests the magic __get method - put
	 */
	public function test__GetPut()
	{
		$this->assertThat(
			$this->object->buckets->put,
			$this->isInstanceOf('JAmazons3OperationsBucketsPut')
		);
	}
}
