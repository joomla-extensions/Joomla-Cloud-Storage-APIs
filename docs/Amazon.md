## The AmazonS3 Package

### Using the AmazonS3 Package

The AmazonS3 package is designed to be a straightforward interface for working with Amazon Simple Storage Service. It is based on the REST API provided by Amazon, which can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/APIRest.html.

AmazonS3 is built upon the Http package which provides an easy way to consume URLs and web services in a transport independent way.

#### Instantiating JAmazons3

```php
$amazon = new JAmazons3;
```

This creates a basic `JAmazons3` object that can be used to access publicly available resources on AmazonS3. For certain operations, such as those which require authorization, you can configure additional options by using a `Joomla\Registry\Registry` object with your preferred details:

```php
use Joomla\Registry\Registry;

$options = new Registry;
$options->set('api.accessKeyId', 'AKIAIYASRIGEYY2MB6UQ');
$options->set('api.secretAccessKey', 'xtnNNdVPjfOfJJ6ohE4JoyK+dJL7crROT78T4G17');

$amazon = new JAmazons3($options);
```

#### Accessing the AmazonS3 API

Once an object has been created, it is simple to use it to access AmazonS3:

```php
$response = $amazon->service->get->getService();
```
	
This call will list all of the buckets owned by the authenticated sender of the request.

#### A more complete example

The following is a cli application that will return a list of all buckets owned by the authenticated sender of the request.

```php
<?php
// We are a valid Joomla entry point.
define('_JEXEC', 1);

// Setup the base path related constant.
define('JPATH_BASE', __DIR__);

// Maximise error reporting.
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Bootstrap the application.
require __DIR__ . '/import.php';

class Amazons3App extends JApplicationCli
{
	public function doExecute()
	{
		$options = new \Joomla\Registry\Registry;

		$options->set('api.accessKeyId', 'AKIAIYASRIGEYY2MB6UQ');
		$options->set('api.secretAccessKey', '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');

		$amazon = new JAmazons3($options);

		try
		{
			$response = $amazon->service->get->getService();

			print_r($response);
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}

$cli = JApplicationCli::getInstance('Amazons3App');
JFactory::$application = $cli;

$session = JFactory::getSession();
if ($session->isActive() == false)
{
	$session->initialise(JFactory::getApplication()->input);
	$session->start();
}

// Run the application
$cli->execute();
```

### Supported operations

This section presents all the supported operations and corresponding arguments.

Most of them use common request headers which are documented at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTCommonRequestHeaders.html.


#### Service

##### GET Service

###### service->get->getService

This operation requires no arguments.

#### Buckets

##### GET Bucket

###### buckets->get->getBucket

* $bucket - The bucket name
* $parameters - An associative array which can take the following keys:
    * `delimiter`
    * `marker`
    * `max-keys`
    * `prefix`

###### buckets->get->getBucketAcl

	/**
	 * Creates the request for getting a bucket's acl and returns the response from Amazon
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
	 * and returns the response from Amazon
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
	 * Creates the request for getting a bucket's lifecycle and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketLifecycle($bucket)

###### buckets->get->getBucketPolicy

	/**
	 * Creates the request for getting a bucket's policy and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketPolicy($bucket)


###### buckets->get->getBucketLocation

	/**
	 * Creates the request for getting a bucket's location and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketLocation($bucket)

###### buckets->get->getBucketLogging

	/**
	 * Creates the request for getting a bucket's logging and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketLogging($bucket)

###### buckets->get->getBucketNotification

	/**
	 * Creates the request for getting a bucket's notification configuration
	 * and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketNotification($bucket)


###### buckets->get->getBucketTagging

	/**
	 * Creates the request for getting a bucket's tagging and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketTagging($bucket)

###### buckets->get->getBucketVersions

	/**
	 * Creates the request for getting the versions of a bucket's objects
	 * and returns the response from Amazon
	 *
	 * @param   string  $bucket      The bucket name
	 * @param   string  $parameters  An array of optional parameters that can be set
	 *                               to filter the results
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketVersions($bucket, $parameters = null)

The `$parameters` argument can take the following values:
 - `delimiter`
 - `marker`
 - `max-keys`
 - `prefix`
 - `version-id-marker`

###### buckets->get->getBucketRequestPayment

	/**
	 * Creates the request for getting a bucket's request payment configuration
	 * and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketRequestPayment($bucket)

###### buckets->get->getBucketVersioning

	/**
	 * Creates the request for getting a bucket's versioning state and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketVersioning($bucket)

###### buckets->get->getBucketWebsite

	/**
	 * Creates the request for getting a bucket's website and returns the response from Amazon
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getBucketWebsite($bucket)

###### buckets->get->listMultipartUploads

	/**
	 * Creates the request for listing a bucket's multipart uploads
	 * and returns the response from Amazon
	 *
	 * @param   string  $bucket      The bucket name
	 * @param   string  $parameters  An array of optional parameters that can be set
	 *                               to filter the results
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function listMultipartUploads($bucket, $parameters = null)


The `$parameters` argument can take the following values:
- `delimiter`
- `max-uploads`
- `key-marker`
- `prefix`
- `upload-id-marker`


##### HEAD Bucket

###### buckets->head->headBucket

	/**
	 * Creates a request to determine if a bucket exists and you have permission to access it.
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function headBucket($bucket)


##### PUT Bucket

	/**
	 * Creates the request for creating a bucket and returns the response from Amazon
	 *
	 * @param   string  $bucket        The bucket name
	 * @param   string  $bucketRegion  The bucket region (default: US Standard)
	 * @param   string  $acl           An array containing the ACL permissions
	 *                                 (either canned or explicitly specified)
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucket($bucket, $bucketRegion = "", $acl = null)

You can specify the geographic location for your bucket by providing a location constraint in the `$bucketRegion` parameter. This tells Amazons3 to store the bucket and its contents on a server in the specified location. For more information, see http://docs.aws.amazon.com/general/latest/gr/rande.html#s3_region.

The `$acl` parameter can specify canned ACL permissions:
- `private`
- `public-read`
- `public-read-write`
- `authenticated-read`
- `log-delivery-write`

More details about canned ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/latest/dev/ACLOverview.html#CannedACL.

You can also set explicit ACL permissions. You specify each grantee as a type=value pair, where the type can be one of the following:
- `emailAddress` â€” if value specified is the email address of an AWS account
- `id` â€” if value specified is the canonical User ID of an AWS account
- `uri` â€” if granting permission to a predefined Amazon S3 group

Valid values for the explicit ACL permissions are:
- `read`
- `write`
- `read-acp`
- `write-acp`
- `full-control`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUT.html#RESTBucketPUT-requests-request-headers.

A good example for the `$acl` parameter would be:

	array(
		"read" => "uri=\"http://acs.amazonaws.com/groups/global/AuthenticatedUsers\"",
		"write-acp" => "emailAddress=\"alex.ukf@gmail.com\"",
		"full-control" => "id=\"6e887773574284f7e38cacbac9e1455ecce62f79929260e9b68db3b84720ed96\""
	)


###### buckets->put->putBucketAcl

	/**
	 * Creates the request for setting the permissions on an existing bucket
	 * using access control lists (ACL)
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $acl     An array containing the ACL permissions
	 *                           (either canned or explicitly specified)
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketAcl($bucket, $acl = null)


The `$acl` parameter can specify canned ACL permissions:
- `private`
- `public-read`
- `public-read-write`
- `authenticated-read`
- `log-delivery-write`

More details about canned ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/latest/dev/ACLOverview.html#CannedACL.

You can also set explicit ACL permissions. You specify each grantee as a type=value pair, where the type can be one of the following:
- `emailAddress` â€” if value specified is the email address of an AWS account
- `id` â€” if value specified is the canonical User ID of an AWS account
- `uri` â€” if granting permission to a predefined Amazon S3 group

Valid values for the explicit ACL permissions are:
- `read`
- `write`
- `read-acp`
- `write-acp`
- `full-control`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUT.html#RESTBucketPUT-requests-request-headers.

A good example for the `$acl` parameter would be:

	array(
		"read" => "uri=\"http://acs.amazonaws.com/groups/global/AuthenticatedUsers\"",
		"write-acp" => "emailAddress=\"alex.ukf@gmail.com\"",
		"full-control" => "id=\"6e887773574284f7e38cacbac9e1455ecce62f79929260e9b68db3b84720ed96\""
	)
	

###### buckets->put->putBucketCors

	/**
	 * Creates the request for setting the CORS configuration for your bucket
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $rules   An array containing the CORS rules
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketCors($bucket, $rules = null)

The `$cors` parameter is an array of rules which allow cross-origin resource sharing on a bucket. Each rule is defined as an array and it can contain the following elements:
- `ID` 
- `AllowedOrigin` 
- `AllowedMethod` 
- `AllowedHeader`
- `MaxAgeSec`
- `ExposeHeader`

More details about these elements can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTcors.html#RESTBucketPUTcors-requests-request-elements.

A good example would be:

	array(
		array(
			"ID" => "RuleUniqueId",
			"AllowedOrigin" => array("http://*.example1.com", "http://*.example2.com"),
			"AllowedMethod" => array("PUT", "POST", "DELETE"),
			"AllowedHeader" => "*",
			"MaxAgeSeconds" => "3000",
			"ExposeHeader"  => "x-amz-server-side-encryption",
		),
		array(
			"AllowedOrigin" => "*",
			"AllowedMethod" => "GET",
			"AllowedHeader" => "*",
			"MaxAgeSeconds" => "3000",
		)
	)


###### buckets->put->putBucketLifecycle

	/**
	 * Creates a new lifecycle configuration for the bucket or replaces
	 * an existing lifecycle configuration
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $rules   An array containing the lifecycle configuration rules
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketLifecycle($bucket, $rules = null)

The `$lifecycle` parameter is an array of rule arrays, which in turn are structured as follows:
- `ID`
- `Prefix`
- `Status`
- `Transition`
	- `Date`
	- `StorageClass`
- `Expiration`
	- `Date`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTlifecycle.html#RESTBucketPUTlifecycle-requests-request-elements.

A good example would be:

	array(
		array(
			"ID" => "RuleUniqueId",
			"Prefix" => "glacierobjects",
			"Status"  => "Enabled",
			"Transition" => array(
				"Date" => "2013-12-31T00:00:00.000Z",
				"StorageClass" => "GLACIER",
			),
			"Expiration" => array(
				"Date" => "2022-10-12T00:00:00.000Z",
			),
		),
	)
	

###### buckets->put->putBucketPolicy

	/**
	 *  Adds to or replaces a policy on a bucket.
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $policy  An array containing the bucket policy
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketPolicy($bucket, $policy = null)

The `$policy` elements are:
- `Version`
- `Id`
- `Statement`
	- `Effect`
	- `Sid`
	- `Principal`
		- `CanonicalUser`
	- `Action` 
	- `Resource`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTpolicy.html#RESTBucketPUTpolicy-responses-examples-sample-request.

A good example would be:

	array(
		"Version" => "2008-10-17",
		"Id" => "aaaa-bbbb-cccc-eeee",
		"Statement" => array(
			array(
			"Effect" => "Allow",
			"Sid" => "1",
			"Principal" => array(
				"CanonicalUser" => "6e887773574284f7e38cacbac9e1455ecce62f79929260e9b68db3b84720ed96"
			),
			"Action" => "s3:*",
			"Resource" => "arn:aws:s3:::gsoc-test-2/*",
			),
		),
	)

###### buckets->put->putBucketLogging

	/**
	 * Sets the logging parameters for a bucket and specifies permissions for
	 * who can view and modify the logging parameters
	 *
	 * @param   string  $bucket   The bucket name
	 * @param   string  $logging  An array containing the logging details
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketLogging($bucket, $logging = null)

The `$logging` elements are:
- `TargetBucket`
- `TargetPrefix`
- `TargetGrants`
	- `Grant`
		- `Grantee`
			- `EmailAddress`
		- `Permission`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTlogging.html#RESTBucketPUTlogging-requests-request-elements.

A good example would be:

	array(
		"TargetBucket" => "gsoc-test-2",
		"TargetPrefix" => "mybucket-access_log",
		"TargetGrants" => array(
			"Grant" => array(
				"Grantee" => array(
					"EmailAddress" => "alex.ukf@gmail.com",
				),
				"Permission" => "READ",
			),
		),
	)


###### buckets->put->putBucketNotification

	/**
	 * Enables notifications of specified events for a bucket
	 *
	 * @param   string  $bucket        The bucket name
	 * @param   string  $notification  An array containing the $notification details
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketNotification($bucket, $notification = null)

The `$notification` parameter is an array which can contain:
- `Topic`
- `Event`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTnotification.html#RESTBucketPUTnotification-requests-request-elements.

###### buckets->put->putBucketTagging

	/**
	 * Adds a set of tags to an existing bucket
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $tags    An array containing the tags
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketTagging($bucket, $tags = null)

The `$tags` parameter is an array of Tag elements, which in turn are arrays of with:
- `Key`
- `Value`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTtagging.html#RESTBucketPUTtagging-requests-request-elements.

A good example would be:

	array(
		array(
			"Key" => "Project",
			"Value" => "Project One",
		),
		array(
			"Key" => "User",
			"Value" => "alexukf",
		),
	)






###### buckets->put->putBucketRequestPayment

	/**
	 * Sets the request payment configuration of a bucket
	 *
	 * @param Â  string Â $bucket Â The bucket name
	 * @param Â  string Â $payer Â  Specifies who pays for the download and request fees.
	 * Â  Â  Â  Â  Â  Â  Â  Â  Â  Â  Â  Â  Â  Valid Values: Requester | BucketOwner
	 *
	 * @return string Â The response body
	 *
	 * @since Â  ??.?
	 */
	public function putBucketRequestPayment($bucket, $payer)


###### buckets->put->putBucketVersioning

	/**
	 * Sets the versioning state of an existing bucket
	 *
	 * @param   string  $bucket      The bucket name
	 * @param   string  $versioning  Array with Status and MfaDelete
	 * @param   string  $serialNr    The serial number is generated using either a hardware or virtual MFA device
	 *                               Required for MfaDelete
	 * @param   string  $tokenCode   Also required for MfaDelete
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketVersioning($bucket, $versioning, $serialNr = null, $tokenCode = null)

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTVersioningStatus.html#RESTBucketPUTVersioningStatus-requests-request-headers.

###### buckets->put->putBucketWebsiteConfig

	/**
	 * Sets the configuration of the website that is specified in the website subresource
	 *
	 * @param   string  $bucket   The bucket name
	 * @param   string  $website  An array containing website parameters
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putBucketWebsite($bucket, $website)

The `website` parameter can take the following values:
- `IndexDocument`
	- `Suffix` 
- `ErrorDocument`
	- `Key` 
- `RoutingRules`
	- `RoutingRule`
		- `Condition`
			- `KeyPrefixEquals`
			- `HttpErrorCodeReturnedEquals`
		- `Redirect`
			- `Protocol`
			- `HostName`
			- `ReplaceKeyPrefixWith`
			- `ReplaceKeyWith`
			- `HttpRedirectCode`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTwebsite.html#RESTBucketPUTwebsite-requests-request-elements.

A good example would be:

	array(
		"IndexDocument" => array(
			"Suffix" => "index.html"
		),
		"ErrorDocument" => array(
			"Key" => "SomeErrorDocument.html"
		),
		"RoutingRules" => array(
			"RoutingRule" => array(
				"Condition" => array(
					"KeyPrefixEquals" => "docs/"
				),
				"Redirect" => array(
					"ReplaceKeyPrefixWith" => "documents/"
				)
			)
		)
	)


##### DELETE Bucket

###### buckets->delete->deleteBucket

	/**
	 * Deletes the bucket named in the URI
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function deleteBucket($bucket)


###### buckets->delete->deleteBucketCors

	/**
	 * Deletes the cors configuration information set for the bucket.
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function deleteBucketCors($bucket)


###### buckets->delete->deleteBucketLifecycle

	/**
	 * Deletes the lifecycle configuration from the specified bucket
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function deleteBucketLifecycle($bucket)


###### buckets->delete->deleteBucketPolicy

	/**
	 * This implementation of the DELETE operation uses the policy subresource
	 * to delete the policy on a specified bucket.
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function deleteBucketPolicy($bucket)

###### buckets->delete->deleteBucketTagging

	/**
	 * This implementation of the DELETE operation uses the tagging
	 * subresource to remove a tag set from the specified bucket.
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function deleteBucketTagging($bucket)

###### buckets->delete->deleteBucketWebsite

	/**
	 * This operation removes the website configuration for a bucket.
	 *
	 * @param   string  $bucket  The bucket name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function deleteBucketWebsite($bucket)


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


#### Objects

##### GET Object

###### Objects->get->getObject

	/**
	 * Creates the request for getting a bucket and returns the response from Amazon
	 *
	 * @param   string  $bucket      The bucket name
	 * @param   string  $objectName  The object name
	 * @param   string  $versionId   The version id
	 * @param   string  $range       The range of bytes to be returned
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getObject($bucket, $objectName, $versionId = null, $range = null)

###### Objects->get->getObjectAcl

	/**
	 * Returns the access control list (ACL) of an object
	 *
	 * @param   string  $bucket      The bucket name
	 * @param   string  $objectName  The object name
	 * @param   string  $versionId   The version id
	 * @param   string  $range       The range of bytes to be returned
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getObjectAcl($bucket, $objectName, $versionId = null, $range = null)

###### Objects->get->getObjectTorrent

	/**
	 * Returns torrent files from a bucket
	 *
	 * @param   string  $bucket      The bucket name
	 * @param   string  $objectName  The object name
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function getObjectTorrent($bucket, $objectName)

###### Objects->get->listParts

	/**
	 * Returns torrent files from a bucket
	 *
	 * @param   string  $bucket      The bucket name
	 * @param   string  $objectName  The object name
	 * @param   string  $parameters  The upload parameters
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function listParts($bucket, $objectName, $parameters)

The `$parameters` parameter can take the following values:
- `uploadId`
- `max-parts`
- `part-number-marker`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/mpUploadListParts.html#mpUploadListParts-requests-request-parameters.


##### HEAD Object

###### Objects->head->headObject

	/**
	 * The HEAD operation retrieves metadata from an object without returning the object itself.
	 *
	 * @param   string  $bucket          The bucket name
	 * @param   string  $objectName      The object name
	 * @param   string  $versionId       The object's version ID
	 * @param   string  $requestHeaders  Additional request headers
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function headObject($bucket, $objectName, $versionId = null, $requestHeaders = array())

The `$requestHeaders` parameter can take one of the following values:
- `Range`
- `If-Modified-Since`
- `If-Unmodified-Since`
- `If-Match`
- `If-None-Match`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTObjectHEAD.html#RESTObjectHEAD-requests-request-headers.

##### OPTIONSS3 Object

###### Objects->optionss3->optionsObject

	/**
	 * A browser can send this preflight request to Amazon S3 to determine if it can
	 * send an actual request with the specific origin, HTTP method, and headers.
	 *
	 * @param   string  $bucket          The bucket name
	 * @param   string  $objectName      The object name
	 * @param   array   $requestHeaders  Additional request headers
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function optionsObject($bucket, $objectName, $requestHeaders)

The `$requestHeaders` parameter can take the following values:
- `Origin`
- `Access-Control-Request-Method`
- `Access-Control-Request-Headers`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTOPTIONSobject.html#RESTOPTIONSobject-requests-request-headers.


##### PUT Object

###### Objects->put->putObject

	/**
	 * Adds an object to a bucket
	 *
	 * @param   string  $bucket          The bucket name
	 * @param   string  $object          The object to be added
	 * @param   string  $content         The content of the object
	 * @param   array   $requestHeaders  An array of request headers
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putObject($bucket, $object, $content = "", $requestHeaders = null)

The `$requestHeaders` parameter can take the following values:
- `Expect`
- `Expires`
- `x-amz-meta-`
- `x-amz-server-side-encryption`
- `x-amz-storage-class`
- `x-amz-website-redirect-location`

The `$acl` parameter can specify canned ACL permissions:
- `private`
- `public-read`
- `public-read-write`
- `authenticated-read`
- `log-delivery-write`

You can also set explicit ACL permissions. You specify each grantee as a type=value pair, where the type can be one of the following:
- `emailAddress` â€” if value specified is the email address of an AWS account
- `id` â€” if value specified is the canonical User ID of an AWS account
- `uri` â€” if granting permission to a predefined Amazon S3 group

Valid values for the explicit ACL permissions are:
- `read`
- `write`
- `read-acp`
- `write-acp`
- `full-control` 

A good example for the `$acl` parameter would be:

	array(
		"read" => "uri=\"http://acs.amazonaws.com/groups/global/AuthenticatedUsers\"",
		"write-acp" => "emailAddress=\"alex.ukf@gmail.com\"",
		"full-control" => "id=\"6e887773574284f7e38cacbac9e1455ecce62f79929260e9b68db3b84720ed96\""
	)

More details about request headers and ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTObjectPUT.html#RESTObjectPUT-requests-request-headers.

Additional details about canned ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/latest/dev/ACLOverview.html#CannedACL.


###### Objects->put->putObjectAcl

	/**
	 * Creates the request for setting the permissions on an existing bucket
	 * using access control lists (ACL)
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $object  The object name
	 * @param   string  $acl     An array containing the ACL permissions
	 *                           (either canned or explicitly specified)
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putObjectAcl($bucket, $object, $acl = null)

The `$acl` parameter can specify canned ACL permissions:
- `private`
- `public-read`
- `public-read-write`
- `authenticated-read`
- `log-delivery-write`

You can also set explicit ACL permissions. You specify each grantee as a type=value pair, where the type can be one of the following:
- `emailAddress` â€” if value specified is the email address of an AWS account
- `id` â€” if value specified is the canonical User ID of an AWS account
- `uri` â€” if granting permission to a predefined Amazon S3 group

Valid values for the explicit ACL permissions are:
- `read`
- `write`
- `read-acp`
- `write-acp`
- `full-control` 

A good example for the `$acl` parameter would be:

	array(
		"read" => "uri=\"http://acs.amazonaws.com/groups/global/AuthenticatedUsers\"",
		"write-acp" => "emailAddress=\"alex.ukf@gmail.com\"",
		"full-control" => "id=\"6e887773574284f7e38cacbac9e1455ecce62f79929260e9b68db3b84720ed96\""
	)

More details about request headers and ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTObjectPUTacl.html#RESTObjectPUTacl-requests-request-headers.

Additional details about canned ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/latest/dev/ACLOverview.html#CannedACL.


###### Objects->put->putObjectCopy

	/**
	 * This implementation of the PUT operation creates a copy of an object
	 * that is already stored in Amazon S3.
	 *
	 * @param   string  $bucket          The name of the bucket to copy in
	 * @param   string  $object          The name of the new file
	 * @param   string  $copySource      The path to the file to be copied (bucket + object)
	 * @param   string  $requestHeaders  An array containing request headers
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function putObjectCopy($bucket, $object, $copySource, $requestHeaders = null)

The `$requestHeaders` parameter can take the following values:
- `x-amz-metadata-directive`
- `x-amz-copy-source-if-match`
- `x-amz-copy-source-if-none-match`
- `x-amz-copy-source-if-unmodified-since`
- `x-amz-copy-source-if-modified-since`
- `x-amz-server-sideâ€‹-encryption`
- `x-amz-storage-class`
- `x-amz-website-redirect-location`

The `$acl` parameter can specify canned ACL permissions:
- `private`
- `public-read`
- `public-read-write`
- `authenticated-read`
- `log-delivery-write`

You can also set explicit ACL permissions. You specify each grantee as a type=value pair, where the type can be one of the following:
- `emailAddress` â€” if value specified is the email address of an AWS account
- `id` â€” if value specified is the canonical User ID of an AWS account
- `uri` â€” if granting permission to a predefined Amazon S3 group

Valid values for the explicit ACL permissions are:
- `read`
- `write`
- `read-acp`
- `write-acp`
- `full-control` 

A good example for the `$acl` parameter would be:

	array(
		"read" => "uri=\"http://acs.amazonaws.com/groups/global/AuthenticatedUsers\"",
		"write-acp" => "emailAddress=\"alex.ukf@gmail.com\"",
		"full-control" => "id=\"6e887773574284f7e38cacbac9e1455ecce62f79929260e9b68db3b84720ed96\""
	)


More details about the request headers and ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTObjectCOPY.html#RESTObjectCOPY-requests-request-headers.

Additional details about canned ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/latest/dev/ACLOverview.html#CannedACL.


###### Objects->put->initiateMultipartUpload

	/**
	 * This operation initiates a multipart upload and returns an upload ID
	 *
	 * @param   string  $bucket          The name of the bucket to upload to
	 * @param   string  $object          The name of the uploaded file
	 * @param   string  $requestHeaders  An array containing request headers
	 * @param   string  $acl             An array containing the ACL permissions
	 *                                   (either canned or explicitly specified)
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function initiateMultipartUpload($bucket, $object, $requestHeaders = null, $acl = null)

The `$requestHeaders` parameter can take the following values:
- `Expires`
- `x-amz-meta-`
- `x-amz-server-side-encryption`
- `x-amz-storage-class`
- `x-amz-website-redirect-location`

The `$acl` parameter can specify canned ACL permissions:
- `private`
- `public-read`
- `public-read-write`
- `authenticated-read`
- `log-delivery-write`

You can also set explicit ACL permissions. You specify each grantee as a type=value pair, where the type can be one of the following:
- `emailAddress` â€” if value specified is the email address of an AWS account
- `id` â€” if value specified is the canonical User ID of an AWS account
- `uri` â€” if granting permission to a predefined Amazon S3 group

Valid values for the explicit ACL permissions are:
- `read`
- `write`
- `read-acp`
- `write-acp`
- `full-control` 

A good example for the `$acl` parameter would be:

	array(
		"read" => "uri=\"http://acs.amazonaws.com/groups/global/AuthenticatedUsers\"",
		"write-acp" => "emailAddress=\"alex.ukf@gmail.com\"",
		"full-control" => "id=\"6e887773574284f7e38cacbac9e1455ecce62f79929260e9b68db3b84720ed96\""
	)


More details about the request headers and ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/mpUploadInitiate.html#mpUploadInitiate-requests-request-headers.

Additional details about canned ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/latest/dev/ACLOverview.html#CannedACL.


###### Objects->put->uploadPart

	/**
	 * This operation uploads a part in a multipart upload.
	 *
	 * @param   string  $bucket          The name of the bucket to upload to
	 * @param   string  $object          The name of the uploaded file
	 * @param   string  $partNumber      The part number
	 * @param   string  $uploadId        The upload ID
	 * @param   string  $requestHeaders  An array containing request headers
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function uploadPart($bucket, $object, $partNumber, $uploadId, $requestHeaders = null)

The `$requestHeaders` parameter can take one of the following values:
- `Content-MD5`
- `Expect`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/mpUploadUploadPart.html#mpUploadUploadPart-requests-request-headers.


###### Objects->put->uploadPartCopy

	/**
	 * Uploads a part by copying data from an existing object as data source.
	 * You specify the data source by adding the request header x-amz-copy-source in your request
	 * and a byte range by adding the request header x-amz-copy-source-range in your request.
	 *
	 * @param   string  $bucket          The name of the bucket to upload to
	 * @param   string  $object          The name of the uploaded file
	 * @param   string  $partNumber      The part number
	 * @param   string  $uploadId        The upload ID
	 * @param   string  $requestHeaders  An array containing request headers
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function uploadPartCopy($bucket, $object, $partNumber, $uploadId, $requestHeaders = null)

The `$requestHeaders` parameter can take one of the following values:
- `x-amz-copy-source`
- `x-amz-copy-source-range`
- `x-amz-copy-source-if-match`
- `x-amz-copy-source-if-none-match`
- `x-amz-copy-source-if-unmodified-since`
- `x-amz-copy-source-if-modified-since`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/mpUploadUploadPartCopy.html#mpUploadUploadPartCopy-requests-request-headers.


###### Objects->put->completeMultipartUpload

	/**
	 * This operation completes a multipart upload by assembling previously uploaded parts.
	 *
	 * @param   string  $bucket    The name of the bucket to upload to
	 * @param   string  $object    The name of the uploaded file
	 * @param   string  $uploadId  The upload ID
	 * @param   string  $parts     An array of PartNumber and ETag pairs
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function completeMultipartUpload($bucket, $object, $uploadId, $parts)

The `$parts` parameter is an array of part elements, which can take the following values:
- `PartNumber`
- `ETag`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/mpUploadComplete.html#mpUploadComplete-requests-request-elements.

A good example for the `$parts` parameter would be:

	array(
		array(
			"PartNumber" => "1",
			"ETag" => "a54357aff0632cce46d942af68356b38",
		),
		array(
			"PartNumber" => "2",
			"ETag" => "0c78aef83f66abc1fa1e8477f296d394",
		),
		array(
			"PartNumber" => "3",
			"ETag" => "acbd18db4cc2f85cedef654fccc4a4d8",
		),
	)


##### POST Object

###### Objects->post->deleteMultipleObjects

	/**
	 * Deletes multiple objects from a bucket
	 *
	 * @param   string  $bucket     The bucket name
	 * @param   array   $objects    An array of objects to be deleted
	 * @param   array   $quiet      In quiet mode the response includes only keys
	 *                              where the delete operation encountered an error
	 * @param   string  $serialNr   The serial number is generated using either a hardware or
	 *                              a virtual MFA device. Required for MfaDelete
	 * @param   string  $tokenCode  Also required for MfaDelete
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function deleteMultipleObjects($bucket, $objects, $quiet = false, $serialNr = null, $tokenCode = null)

The `$objects` parameter is an array of object elements which can take the following values:
- `Key`
- `VersionId`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/multiobjectdeleteapi.html#multiobjectdeleteapi-requests-request-elements.

A good example for the `$objects` parameter would be:

	array(
		array(
			"Key" => "404.txt"
		),
		array(
			"Key" => "SampleDocument.txt",
			"VersionId" => "OYcLXagmS.WaD..oyH4KRguB95_YhLs7",
		),
	),


###### Objects->post->postObject

	/**
	 * The POST operation adds an object to a specified bucket using HTML forms
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   array   $fields  An array of objects to be deleted
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function postObject($bucket, $fields)

The `$fields` parameter can take the following values:
- `AWSAccessKeyId`
- `acl`
- `file`
- `key`
- `policy`
- `success_action_redirect`
- `redirect`
- `success_action_status`
- `x-amz-storage-class`
- `x-amz-meta-*`
- `x-amz-security-token`
- `x-amz-server-side-encryption`
- `x-amz-website-redirect-location`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTObjectPOST.html#RESTObjectPOST-requests-form-fields.

A good example for the `$fields` parameter would be:

	array(
		"key" => "testFile.txt",
		"file" => "test content",
	)

###### Objects->post->postObjectRestore
	
	/**
	 * Restores a temporary copy of an archived object. In the request, you
	 * specify the number of days that you want the restored copy to exist.
	 *
	 * @param   string  $bucket  The bucket name
	 * @param   string  $object  The name of the object to be restored
	 * @param   string  $days    The number of days that you want the restored copy to exist
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function postObjectRestore($bucket, $object, $days)

##### DELETE Object

###### Objects->delete->deleteObject

	/**
	 * Deletes an object from a bucket
	 *
	 * @param   string  $bucket     The bucket name
	 * @param   string  $object     The name of the object to be deleted
	 * @param   string  $versionId  The version id of the object to be deleted
	 * @param   string  $serialNr   The serial number is generated using either a hardware or
	 *                              a virtual MFA device. Required for MfaDelete
	 * @param   string  $tokenCode  Also required for MfaDelete
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function deleteObject($bucket, $object, $versionId = null, $serialNr = null, $tokenCode = null)


###### Objects->delete->abortMultipartUpload

	/**
	 * This operation aborts a multipart upload
	 *
	 * @param   string  $bucket    The bucket name
	 * @param   string  $object    The name of the object
	 * @param   string  $uploadId  The upload id
	 *
	 * @return string  The response body
	 *
	 * @since   ??.?
	 */
	public function abortMultipartUpload($bucket, $object, $uploadId)
