<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Amazons3
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Test class for JAmazons3Http.
 *
 * @since  1.0
 */
class JAmazons3HttpTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var  JAmazons3Http  Object under test.
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

		$this->object = new JAmazons3Http;
	}

	/**
	 * Tests the __construct method
	 */
	public function test__Construct()
	{
		$this->assertThat(
			$this->object->getOption('timeout'),
			$this->equalTo(120)
		);
	}
}
