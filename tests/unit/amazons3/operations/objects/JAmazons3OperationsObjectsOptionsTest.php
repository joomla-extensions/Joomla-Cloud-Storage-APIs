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
 * Test class for JAmazons3OperationsObjectsOptions.
 *
 * @since  1.0
 */
class JAmazons3OperationsObjectsOptionsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var  Registry  Options for the Amazons3 object.
	 */
	protected $options;

	/**
	 * @var  JAmazons3OperationsObjects  Object under test.
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
		$this->options->set('api.url', 's3.amazonaws.com');
		$this->options->set('testBucket', 'testBucket');
		$this->options->set('testObject', 'testObject');
		$this->options->set(
			'testRequestHeaders',
			array(
				"Origin" => "http://www.example.com",
				"Access-Control-Request-Method" => "PUT",
			)
		);

		$this->client = $this->getMock('JAmazons3Http', array('delete', 'get', 'head', 'put', 'post', 'optionss3'));

		$this->object = new JAmazons3OperationsObjects($this->options, $this->client);
	}

	/**
	 * Tests the optionsObject method
	 *
	 * @expectedException  DomainException
     */
	public function testOptionsObject()
	{
		$this->object->optionss3->optionsObject(
			$this->options->get("testBucket"),
			$this->options->get("testObject"),
			$this->options->get("testRequestHeaders")
		);
	}
}
