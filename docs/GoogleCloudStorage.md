## The Google Cloud Storage Package

### Using the Google Cloud Storage Package

The Google Cloud Storage package is designed to be a straightforward interface for working with Google Cloud Storage. It is based on version 2.0 of the Google Cloud Storage XML API. You can find documentation on the API at https://developers.google.com/storage/docs/xml-api-overview.

Google Cloud Storage is built upon the Http package which provides an easy way to consume URLs and web services in a transport independent way.

#### Instantiating Google Cloud Storage

	$googlecloudstorage = new JGooglecloudstorage();

This creates a basic Google Cloud Storage object that can be used to access publicly available resources on Google Cloud Storage. For certain operations, such as those which require authorization, it is necessary to provide account related details. The authentication is done via OAuth 2.0 and you can configure additional options by using a Registry object with your preferred details:

	$options = new JRegistry();
	$options->set('project.id', 'project_id');
	$options->set('client.id', 'project_id.apps.googleusercontent.com');
	$options->set('client.email', 'project_id@developer.gserviceaccount.com');
	$options->set('client.keyFile', 'e8ed82a38e26fbec0ef7df4ea32f5ed0ccd57aff-privatekey.p12');

	$googlecloudstorage = new JGooglecloudstorage($options);

#### Accessing the Google Cloud Storage API

Once an object has been created, it is simple to use it to access Google Cloud Storage:

	$response = $googlecloudstorage->service->get->getService();
	
This call will list all of the buckets that you own.

#### A more complete example

The following is a cli application that will set the Access Control List permissions on the `testFile.txt` object in the `test-put-bucket-2` bucket.

	<?php
	// We are a valid Joomla entry point.
	define('_JEXEC', 1);
	 
	// Setup the base path related constant.
	define('JPATH_BASE', dirname(__FILE__));
	 
	// Maximise error reporting.
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	 
	// Bootstrap the application.
	require dirname(__FILE__).'/import.php';
	 
	class GoogleCloudStorageApp extends JApplicationCli
	{
		/**
		 * Display the application.
		 */
		function doExecute(){
			$options = new JRegistry();
	 
			$options->set('project.id', '257453926954');
			$options->set('client.id', '257453926954.apps.googleusercontent.com');
			$options->set('client.email', '257453926954@developer.gserviceaccount.com');
			$options->set('client.keyFile', 'e8ed82a38e26fbec0ef7df4ea32f5ed0ccd57aff-privatekey.p12');
	 
			$googlecloudstorage = new JGooglecloudstorage($options);
			try
			{
				$response = $googlecloudstorage->objects->put->putObjectAcl(
				"test-put-bucket-2",
				"testFile.txt",
				array(
					"Owner" => "00b4903a97138b52f86bbff6ae0f21489cf1428e79641bd6e18c9684f034bf13",
						"Entries" => array(
							array(
								"Permission" => "FULL_CONTROL",
								"Scope" => array(
									"type" => "GroupById",
									"ID" => "00b4903a976ccfcd626423a59ea76477f98e19bfdbaf9ecd9da5dc091ea39eff",
								)
							),
							array(
								"Permission" => "FULL_CONTROL",
								"Scope" => array(
									"type" => "UserByEmail",
									"EmailAddress" => "alex.ukf@gmail.com",
									"Name" => "Alex Marin",
								),
							),
							array(
								"Permission" => "FULL_CONTROL",
								"Scope" => array(
									"type" => "GroupById",
									"ID" => "00b4903a971c9d0699ba584e218b6419b0327c60567599c5a3c12d845a371de9",
								),
							),
						),
					),
					null,
					array(
						"x-goog-if-generation" => "1379366784366000",
						"x-goog-if-metageneration" => 6,
					)
				);

				print_r($response);
			}
			catch (Exception $e)
			{
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
	}
	 
	$cli = JApplicationCli::getInstance('GoogleCloudStorageApp');
	JFactory::$application = $cli;
	 
	$session = JFactory::getSession();
	if ($session->isActive() == false){
		$session->initialise(JFactory::getApplication()->input);
		$session->start();
	}
	 
	// Run the application
	$cli->execute();

### Supported operations

This section presents all the supported operations and corresponding arguments. More details about these can be found at https://developers.google.com/storage/docs/reference-methods.

Most of them use query string parameters and request headers which are documented at https://developers.google.com/storage/docs/reference-headers.

Details about valid bucket and object names can be found at https://developers.google.com/storage/docs/bucketnaming.


#### Service

##### GET Service

###### service->get->getService

This operation requires no arguments.

	/**
	 * Lists all of the buckets in a specified project.
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getService()


#### Buckets

##### GET Bucket

###### buckets->get->getBucket

	/**
	 * Lists the objects that are in a bucket
	 *
	 * @param   string  $bucket      The bucket name
	 * @param   string  $parameters  An array of optional parameters that can be set
	 *                               to filter the results
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucket($bucket, $parameters = null)

The `$parameters` argument can be one of 
 - delimiter
 - generationmarker
 - marker
 - max-keys
 - prefix
 - versions

###### buckets->get->getBucketAcl

	/**
	 * Creates the request for getting a bucket's acl and returns the response
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketAcl($bucket)

###### buckets->get->getBucketCors

	/**
	 * Creates the request for getting a bucket's cors configuration information set
	 * and returns the response
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketCors($bucket)

###### buckets->get->getBucketLifecycle

	/**
	 * Creates the request for getting a bucket's lifecycle and returns the response
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketLifecycle($bucket)

###### buckets->get->getBucketLogging

	/**
	 * Creates the request for getting a bucket's logging and returns the response
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketLogging($bucket)

###### buckets->get->getBucketVersioning

	/**
	 * Creates the request for getting a bucket's versioning state and returns the response
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketVersioning($bucket)


##### PUT Bucket

###### buckets->put->putBucket

	/**
	 * Creates the request for creating a bucket and returns the response
	 *
	 * @param   string  $bucket          The bucket name
	 * @param   string  $bucketLocation  The bucket region (default: US Standard)
	 * @param   string  $predefinedAcl   The predefined ACL
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucket($bucket, $bucketLocation = null, $predefinedAcl = null)

You can specify the geographic location for your bucket by providing a location constraint in the `$bucketLocation` argument. This tells Google Cloud Storage to store the bucket and its contents on a server in the specified location. For more information, see https://developers.google.com/storage/docs/concepts-techniques#specifyinglocations.

Valid values for the `$predefinedAcl` argument are:
- project-private
- private
- public-read
- public-read-write
- authenticated-read
- bucket-owner-read
- bucket-owner-full-control

More details can be found at https://developers.google.com/storage/docs/accesscontrol#extension

###### buckets->put->putBucketAcl

	/**
	 * Creates the request for setting the permissions on an existing bucket
	 * using access control lists (ACL)
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $acl     An array containing the ACL permissions
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketAcl($bucket, $acl)

The `$acl` parameter is an array and has the following structure:
- The first element's key is `Owner` and its value is a valid Google Cloud Storage ID, which you can obtain after logging into your account at https://code.google.com/apis/console/ in the Google Cloud Storage section.
- The second element's key is `Entries` and this is an array of Entry arrays.
- An Entry Array only needs the definition of its value, which is a pair of `Permission`/`Scope values`.
	- `Permission` - can be any of the Google Cloud Storage permissions, including:
		- READ
		- WRITE
		- FULL_CONTROL
	- `Scope` is the key for an array which can include
		- `type` - can be one of
			- GroupByEmail
			- GroupById
			- UserByEmail
			- UserById
		- `ID` - a valid Google Cloud Storage ID (required for UserById, GroupById)
		- `EmailAddress` - a valid email address (required for UserByEmail, GroupByEmail)
		- `Name` - if missing, the name is filled with the email address (required for UserByEmail, GroupByEmail)


A good example would be:

	array(
		"Owner" => "00b4903a976ccfcd626423a59ea76477f98e19bfdbaf9ecd9da5dc091ea39eff",
		"Entries" => array(
			array(
				"Permission" => "WRITE",
				"Scope" => array(
					"type" => "GroupById",
					"ID" => "00b4903a976ccfcd626423a59ea76477f98e19bfdbaf9ecd9da5dc091ea39eff",
				)
			),
			array(
				"Permission" => "FULL_CONTROL",
				"Scope" => array(
					"type" => "UserByEmail",
					"EmailAddress" => "alex.ukf@gmail.com",
					"Name" => "Alex Marin",
				),
			),
			array(
				"Permission" => "FULL_CONTROL",
				"Scope" => array(
					"type" => "GroupById",
					"ID" => "00b4903a971c9d0699ba584e218b6419b0327c60567599c5a3c12d845a371de9",
				),
			),
		),
	)
	

###### buckets->put->putBucketCors

	/**
	 * Creates the request for setting the CORS configuration on an existing bucket
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $cors    An array containing the CORS configuration
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketCors($bucket, $cors = null)

The `$cors` parameter is an array of arrays. Each subarray is a CORS configuration that can be applied to the bucket, having the following structure:
- `Origins` - array of origin URLs.
- `Methods` - array of HTTP methods.
- `ResponseHeaders` - array of response headers that the user agent is permitted to share across origins.
- `MaxAgeSec` - the number of seconds that the client (browser) is allowed to make requests before the client must repeat the preflight request.

A good example would be:

	array(
		array(
			"Origins" => array(
				"http://origin1.example.com",
				"http://origin2.example.com",
			),
			"Methods" => array(
				"GET",
				"HEAD",
				"POST",
				"PUT",
				"DELETE",
			),
			"ResponseHeaders" => array(
				"x-goog-meta-foo1",
				"x-goog-meta-foo2",
			),
			"MaxAgeSec" => 1800,
		),
	)


###### buckets->put->putBucketLifecycle

	/**
	 * Creates the request for setting the lifecycle configuration on an existing bucket
	 *
	 * @param   string  $bucket     The bucket name
	 * @param   string  $lifecycle  An array containing the lifecycle configuration
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketLifecycle($bucket, $lifecycle = null)

The `$lifecycle` parameter is an array of rule arrays, which in turn are structured as follows:
- `Action` - at the moment, the only value which can be assigned to this is `Delete`
- `Condition` - an array of optional conditions:
	- `Age`
	- `CreatedBefore`
	- `NumberOfNewerVersions`
	- `IsLive`

A good example would be:

	array(
		array(
			"Action" => "Delete",
			"Condition" => array(
				"Age" => 30,
			),
		),
	)
	

###### buckets->put->putBucketLogging

	/**
	 * Creates the request for enabling logging on an existing bucket
	 *
	 * @param   string  $bucket           The bucket name
	 * @param   string  $logBucket        The bucket that will receive log objects
	 * @param   string  $logObjectPrefix  The object prefix for log objects. It can be at most
	 *                                    900 characters and must be a valid object name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketLogging($bucket, $logBucket, $logObjectPrefix = null)


###### buckets->put->putBucketVersioning

	/**
	 * Creates the request for setting the versioning configuration
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $status  Versioning status of a bucket. Can be `Enabled` or `Suspended`
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketVersioning($bucket, $status)

###### buckets->put->putBucketWebsiteConfig

	/**
	 * Creates the request for specifying a website configuration for an existing bucket.
	 *
	 * @param   string  $bucket          The bucket name
	 * @param   string  $mainPageSuffix  An object name suffix to simulate directory index behavior
	 * @param   string  $notFoundPage    Name of the object to return with 404 responses
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketWebsiteConfig($bucket, $mainPageSuffix = null, $notFoundPage = null)

##### DELETE Bucket

###### buckets->delete->deleteBucket

	/**
	 * Deletes an empty bucket
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function deleteBucket($bucket)


#### Objects

##### GET Object

###### buckets->get->getObject

	/**
	 * Creates the get object request and returns the response
	 *
	 * @param   string  $bucket           The bucket name
	 * @param   string  $object           The object name
	 * @param   string  $generation       Used for fetching a specific object version
	 * @param   array   $optionalHeaders  An array of optional headers to be set
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getObject($bucket, $object, $generation = null, $optionalHeaders = null)

The `$optionalHeaders` parameter is an array which can contain one or more of the following headers:

- x-goog-if-generation-match
- If-Match
- If-Modified-Since
- If-None-Match
- If-Unmodified-Since
- Range


###### buckets->get->getObjectAcl

	/**
	 * Creates the request for getting an object's acl and returns the response
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $object  The object name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getObjectAcl($bucket, $object)


##### HEAD Object

###### buckets->head->headObject

	/**
	 * Creates the head request and returns the response
	 *
	 * @param   string  $bucket           The bucket name
	 * @param   string  $object           The object name
	 * @param   string  $generation       Parameter which can be used if you want
	 *                                    to fetch a specific object generation
	 * @param   string  $optionalHeaders  An array of optional headers to be set
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function headObject($bucket, $object, $generation = null, $optionalHeaders = null)

The `$optionalHeaders` parameter is an array which can contain one or more of the following headers:

- If-Match
- If-Modified-Since
- If-None-Match
- If-Unmodified-Since
- Range
- x-goog-if-generation-match
- x-goog-if-metageneration-match


##### PUT Object

###### Objects->put->putObject

	/**
	 * Creates a new object (via upload, copy, or compose), or applies object ACLs.
	 *
	 * @param   string  $bucket           The bucket name
	 * @param   string  $object           The object name
	 * @param   string  $content          The content of the object
	 * @param   string  $optionalHeaders  An array of optional headers to be set
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putObject($bucket, $object, $content = "", $optionalHeaders = null)

The `$optionalHeaders` parameter is an array which can contain one or more of the following headers:

- Content-Encoding
- Content-Type
- Content-Disposition
- Transfer-Encoding
- x-goog-acl
- x-goog-hash
- x-goog-if-generation-match
- x-goog-if-metageneration-match
- x-goog-meta-

###### Objects->put->putObjectCopy

	/**
	 * This implementation of the PUT operation creates a copy of an object
	 * that is already stored in Google Cloud Storage.
	 *
	 * @param   string  $bucket           The bucket name
	 * @param   string  $object           The object name
	 * @param   string  $copySource       The path to the file to be copied (bucket + object)
	 * @param   string  $optionalHeaders  An array of optional headers to be set
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putObjectCopy($bucket, $object, $copySource, $optionalHeaders = null)


The `$optionalHeaders` parameter is an array which can contain one or more of the following headers:

- Content-Encoding
- Content-Type
- Content-Disposition
- Transfer-Encoding
- x-goog-copy-source-if-match	
- x-goog-copy-source-if-none-match
- x-goog-copy-source-if-modified-since
- x-goog-copy-source-if-unmodified-since
- x-goog-acl
- x-goog-hash
- x-goog-if-generation-match
- x-goog-if-metageneration-match
- x-goog-meta-


###### Objects->put->putObjectAcl

	/**
	 *  Creates a request for setting the ACL for an object
	 *
	 * @param   string  $bucket           The bucket name
	 * @param   string  $object           The object name
	 * @param   string  $acl              An array with the acl permissions
	 * @param   string  $parameters       An array of optional parameters that can be set
	 *                                    to filter the results. These should only be one of:
	 *                                    generation or metageneration
	 * @param   string  $optionalHeaders  An array of optional headers to be set (such as
	 *                                    x-goog-if-generation or x-goog-if-metageneration)
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putObjectAcl($bucket, $object, $acl, $parameters = null, $optionalHeaders = null)

The `$acl` parameter is an array and has the following structure:
- The first element's key is `Owner` and its value is a valid Google Cloud Storage ID, which you can obtain after logging into your account at https://code.google.com/apis/console/ in the Google Cloud Storage section.
- The second element's key is `Entries` and this is an array of Entry arrays.
- An Entry Array only needs the definition of its value, which is a pair of `Permission`/`Scope values`.
	- `Permission` - can be any of the Google Cloud Storage permissions, including:
		- READ
		- WRITE
		- FULL_CONTROL
	- `Scope` is the key for an array which can include
		- `type` - can be one of
			- GroupByEmail
			- GroupById
			- UserByEmail
			- UserById
		- `ID` - a valid Google Cloud Storage ID (required for UserById, GroupById)
		- `EmailAddress` - a valid email address (required for UserByEmail, GroupByEmail)
		- `Name` - if missing, the name is filled with the email address (required for UserByEmail, GroupByEmail)


A good example would be:

	array(
		"Owner" => "00b4903a976ccfcd626423a59ea76477f98e19bfdbaf9ecd9da5dc091ea39eff",
		"Entries" => array(
			array(
				"Permission" => "WRITE",
				"Scope" => array(
					"type" => "GroupById",
					"ID" => "00b4903a976ccfcd626423a59ea76477f98e19bfdbaf9ecd9da5dc091ea39eff",
				)
			),
			array(
				"Permission" => "FULL_CONTROL",
				"Scope" => array(
					"type" => "UserByEmail",
					"EmailAddress" => "alex.ukf@gmail.com",
					"Name" => "Alex Marin",
				),
			),
			array(
				"Permission" => "FULL_CONTROL",
				"Scope" => array(
					"type" => "GroupById",
					"ID" => "00b4903a971c9d0699ba584e218b6419b0327c60567599c5a3c12d845a371de9",
				),
			),
		),
	)
	

##### DELETE Object

###### buckets->delete->deleteObject

	/**
	 * Deletes an object
	 *
	 * @param   string  $bucket             The bucket name
	 * @param   string  $object             The object to be deleted
	 * @param   string  $generation         A query string parameter for a specific object generation
	 * @param   string  $ifGenerationMatch  x-goog-if-generation-match request header
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function deleteObject($bucket, $object, $generation = null, $ifGenerationMatch = null)
