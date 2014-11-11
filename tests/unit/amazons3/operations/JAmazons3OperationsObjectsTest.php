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
 * Test class for JAmazons3OperationsObjects.
 *
 * @since  1.0
 */
class JAmazons3OperationsObjectsTest extends PHPUnit_Framework_TestCase
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
			$this->object->objects->get,
			$this->isInstanceOf('JAmazons3OperationsObjectsGet')
		);
	}

	/**
	 * Tests the magic __get method - head
	 */
	public function test__GetHead()
	{
		$this->assertThat(
			$this->object->objects->head,
			$this->isInstanceOf('JAmazons3OperationsObjectsHead')
		);
	}

	/**
	 * Tests the magic __get method - delete
	 */
	public function test__GetDelete()
	{
		$this->assertThat(
			$this->object->objects->delete,
			$this->isInstanceOf('JAmazons3OperationsObjectsDelete')
		);
	}

	/**
	 * Tests the magic __get method - put
	 */
	public function test__GetPut()
	{
		$this->assertThat(
			$this->object->objects->put,
			$this->isInstanceOf('JAmazons3OperationsObjectsPut')
		);
	}

	/**
	 * Tests the magic __get method - post
	 */
	public function test__GetPost()
	{
		$this->assertThat(
			$this->object->objects->post,
			$this->isInstanceOf('JAmazons3OperationsObjectsPost')
		);
	}

	/**
	 * Tests the magic __get method - options
	 */
	public function test__GetOptions()
	{
		$this->assertThat(
			$this->object->objects->optionss3,
			$this->isInstanceOf('JAmazons3OperationsObjectsOptionss3')
		);
	}
}
