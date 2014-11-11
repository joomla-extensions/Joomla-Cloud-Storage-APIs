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
 * Test class for JAmazons3OperationsBucketsGet.
 *
 * @since  1.0
 */
class JAmazons3OperationsBucketsGetTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var  Registry  Options for the Amazons3 object.
	 */
	protected $options;

	/**
	 * @var  JAmazons3OperationsBuckets  Object under test.
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

		$this->client = $this->getMock('JAmazons3Http', array('delete', 'get', 'head', 'put'));

		$this->object = new JAmazons3OperationsBuckets($this->options, $this->client);
	}

	/**
	 * Common test operations for methods which use GET requests
	 *
	 * @param   string  $subresource  The subresource that is used for creating the GET request.
	 *
	 * @return  SimpleXMLElement
	 */
	protected function commonGetTestOperations($subresource)
	{
		$url = "https://" . $this->options->get("testBucket") . "." . $this->options->get("api.url") . "/" . $subresource;
		$headers = array(
			"Date" => date("D, d M Y H:i:s O"),
		);
		$authorization = $this->object->createAuthorization("GET", $url, $headers);
		$headers['Authorization'] = $authorization;

		$returnData = new JHttpResponse;
		$returnData->code = 200;
		$returnData->body = "<test>response</test>";
		$expectedResult = new SimpleXMLElement($returnData->body);

		$this->client->expects($this->once())
			->method('get')
			->with($url, $headers)
			->will($this->returnValue($returnData));

		return $expectedResult;
	}

	/**
	 * Tests the getBucket method
	 */
	public function testGetBucket()
	{
		$expectedResult = $this->commonGetTestOperations("");
		$this->assertThat(
			$this->object->get->getBucket($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketAcl method
	 */
	public function testGetBucketAcl()
	{
		$expectedResult = $this->commonGetTestOperations("?acl");
		$this->assertThat(
			$this->object->get->getBucketAcl($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketCors method
	 */
	public function testGetBucketCors()
	{
		$expectedResult = $this->commonGetTestOperations("?cors");
		$this->assertThat(
			$this->object->get->getBucketCors($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketLifecycle method
	 */
	public function testGetBucketLifecycle()
	{
		$expectedResult = $this->commonGetTestOperations("?lifecycle");
		$this->assertThat(
			$this->object->get->getBucketLifecycle($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketPolicy method
	 */
	public function testGetBucketPolicy()
	{
		$expectedResult = $this->commonGetTestOperations("?policy");
		$this->assertThat(
			$this->object->get->getBucketPolicy($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketLocation method
	 */
	public function testGetBucketLocation()
	{
		$expectedResult = $this->commonGetTestOperations("?location");
		$this->assertThat(
			$this->object->get->getBucketLocation($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketLogging method
	 */
	public function testGetBucketLogging()
	{
		$expectedResult = $this->commonGetTestOperations("?logging");
		$this->assertThat(
			$this->object->get->getBucketLogging($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketNotification method
	 */
	public function testGetBucketNotification()
	{
		$expectedResult = $this->commonGetTestOperations("?notification");
		$this->assertThat(
			$this->object->get->getBucketNotification($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketTagging method
	 */
	public function testGetBucketTagging()
	{
		$expectedResult = $this->commonGetTestOperations("?tagging");
		$this->assertThat(
			$this->object->get->getBucketTagging($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketVersions method
	 */
	public function testGetBucketVersions()
	{
		$expectedResult = $this->commonGetTestOperations("?versions");
		$this->assertThat(
			$this->object->get->getBucketVersions($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketRequestPayment method
	 */
	public function testGetBucketRequestPayment()
	{
		$expectedResult = $this->commonGetTestOperations("?requestPayment");
		$this->assertThat(
			$this->object->get->getBucketRequestPayment($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketVersioning method
	 */
	public function testGetBucketVersioning()
	{
		$expectedResult = $this->commonGetTestOperations("?versioning");
		$this->assertThat(
			$this->object->get->getBucketVersioning($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the getBucketWebsite method
	 */
	public function testGetBucketWebsite()
	{
		$expectedResult = $this->commonGetTestOperations("?website");
		$this->assertThat(
			$this->object->get->getBucketWebsite($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}

	/**
	 * Tests the listMultipartUploads method
	 */
	public function testListMultipartUploads()
	{
		$expectedResult = $this->commonGetTestOperations("?uploads");
		$this->assertThat(
			$this->object->get->listMultipartUploads($this->options->get("testBucket")),
			$this->equalTo($expectedResult)
		);
	}
}
