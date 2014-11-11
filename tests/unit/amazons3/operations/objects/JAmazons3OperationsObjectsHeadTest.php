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
 * Test class for JAmazons3OperationsObjectsHead.
 *
 * @since  1.0
 */
class JAmazons3OperationsObjectsHeadTest extends PHPUnit_Framework_TestCase
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
		$this->options->set('api.accessKeyId', 'testAccessKeyId');
		$this->options->set('api.secretAccessKey', 'testSecretAccessKey');
		$this->options->set('api.url', 's3.amazonaws.com');
		$this->options->set('testBucket', 'testBucket');
		$this->options->set('testObject', 'testObject');
		$this->options->set('versionId', '3/L4kqtJlcpXroDTDmpUMLUo');
		$this->options->set('range', 'bytes=0-9');

		$this->client = $this->getMock('JAmazons3Http', array('delete', 'get', 'head', 'put', 'post', 'optionss3'));

		$this->object = new JAmazons3OperationsObjects($this->options, $this->client);
	}

	/**
	 * Tests the headObject method
	 */
	public function testHeadObject()
	{
		$url = "https://" . $this->options->get("testBucket") . "." . $this->options->get("api.url")
			. "/" . $this->options->get("testObject");

		$url .= "?versionId=" . $this->options->get("versionId");

		$headers = array(
			"Date"  => date("D, d M Y H:i:s O"),
			"Range" => $this->options->get("range"),
		);

		$authorization = $this->object->createAuthorization("HEAD", $url, $headers);
		$headers['Authorization'] = $authorization;

		$returnData = new JHttpResponse;
		$returnData->code = 200;
		$returnData->body = "Response code: " . $returnData->code . ".\n";
		$expectedResult = $returnData->body;

		$this->client->expects($this->once())
			->method('head')
			->with($url, $headers)
			->will($this->returnValue($returnData));

		$this->assertThat(
			$this->object->head->headObject(
				$this->options->get("testBucket"),
				$this->options->get("testObject"),
				$this->options->get("versionId"),
				array("Range" => $this->options->get("range"))
			),
			$this->equalTo($expectedResult)
		);
	}
}
