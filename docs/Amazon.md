## The AmazonS3 Package

### Using the AmazonS3 Package

The AmazonS3 package is designed to be a straightforward interface for working with Amazon Simple Storage Service. It is based on the REST API provided by Amazon, which can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/APIRest.html.

AmazonS3 is built upon the HTTP package which provides an easy way to consume URLs and web services in a transport independent way.

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
	protected function doExecute()
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

* $bucket - The bucket name

###### buckets->get->getBucketCors

* $bucket - The bucket name

###### buckets->get->getBucketLifecycle

* $bucket - The bucket name

###### buckets->get->getBucketPolicy

* $bucket - The bucket name

###### buckets->get->getBucketLocation

* $bucket - The bucket name

###### buckets->get->getBucketLogging

* $bucket - The bucket name

###### buckets->get->getBucketNotification

* $bucket - The bucket name

###### buckets->get->getBucketTagging

* $bucket - The bucket name

###### buckets->get->getBucketVersions

* $bucket - The bucket name
* $parameters - An associative array which can take the following keys:
    * `delimiter`
    * `marker`
    * `max-keys`
    * `prefix`
    * `version-id-marker`

###### buckets->get->getBucketRequestPayment

* $bucket - The bucket name

###### buckets->get->getBucketVersioning

* $bucket - The bucket name

###### buckets->get->getBucketWebsite

* $bucket - The bucket name

###### buckets->get->listMultipartUploads

* $bucket - The bucket name
* $parameters - An associative array which can take the following keys:
    * `delimiter`
    * `max-uploads`
    * `key-marker`
    * `prefix`
    * `upload-id-marker`

##### HEAD Bucket

###### buckets->head->headBucket

* $bucket - The bucket name

##### PUT Bucket

###### buckets->put->putBucket

* $bucket - The bucket name
* $bucketRegion - The bucket region: You can specify the geographic location for your bucket by providing a location constraint. This tells AmazonS3 to store the bucket and its contents on a server in the specified location. For more information, see http://docs.aws.amazon.com/general/latest/gr/rande.html#s3_region.
* $acl - An array containing the ACL permissions (see below for more information)

The `$acl` parameter can specify canned ACL permissions:
* `private`
* `public-read`
* `public-read-write`
* `authenticated-read`
* `log-delivery-write`

More details about canned ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/latest/dev/ACLOverview.html#CannedACL.

You can also set explicit ACL permissions. You specify each grantee as a type=value pair, where the type can be one of the following:
* `emailAddress` if value specified is the email address of an AWS account
* `id` if value specified is the canonical User ID of an AWS account
* `uri` if granting permission to a predefined Amazon S3 group

Valid values for the explicit ACL permissions are:
* `read`
* `write`
* `read-acp`
* `write-acp`
* `full-control`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUT.html#RESTBucketPUT-requests-request-headers.

An example for the `$acl` parameter would be:

```php
array(
	"read" => "uri=\"http://acs.amazonaws.com/groups/global/AuthenticatedUsers\"",
	"write-acp" => "emailAddress=\"alex.ukf@gmail.com\"",
	"full-control" => "id=\"6e887773574284f7e38cacbac9e1455ecce62f79929260e9b68db3b84720ed96\""
)
```

###### buckets->put->putBucketAcl

* $bucket - The bucket name
* $acl - An array containing the ACL permissions (see the putBucket section for more on the ACL configuration)

###### buckets->put->putBucketCors

* $bucket - The bucket name
* $rules - An array containing the CORS rules (see below for more)

The `$cors` parameter is an array of rules which allow cross-origin resource sharing on a bucket. Each rule is defined as an array and it can contain the following elements:
* `ID` 
* `AllowedOrigin` 
* `AllowedMethod` 
* `AllowedHeader`
* `MaxAgeSec`
* `ExposeHeader`

More details about these elements can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTcors.html#RESTBucketPUTcors-requests-request-elements.

A good example would be:

```php
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
```

###### buckets->put->putBucketLifecycle

* $bucket - The bucket name
* $rules - An array containing the lifecycle configuration rules (see below for more information)

The `$rules` parameter is an array of rule arrays, which in turn are structured as follows:
* `ID`
* `Prefix`
* `Status`
* `Transition`
	* `Date`
	* `StorageClass`
* `Expiration`
	* `Date`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTlifecycle.html#RESTBucketPUTlifecycle-requests-request-elements.

A good example would be:

```php
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
```	

###### buckets->put->putBucketPolicy

* $bucket - The bucket name
* $policy - An array containing the bucket policy (see below for more information)

The `$policy` elements are:
* `Version`
* `Id`
* `Statement`
	* `Effect`
	* `Sid`
	* `Principal`
		* `CanonicalUser`
	* `Action` 
	* `Resource`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTpolicy.html#RESTBucketPUTpolicy-responses-examples-sample-request.

A good example would be:

```php
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
```

###### buckets->put->putBucketLogging

* $bucket - The bucket name
* $logging - An array containing the logging details (see below for more information)

The `$logging` elements are:
* `TargetBucket`
* `TargetPrefix`
* `TargetGrants`
	* `Grant`
		* `Grantee`
			* `EmailAddress`
		* `Permission`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTlogging.html#RESTBucketPUTlogging-requests-request-elements.

A good example would be:

```php
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
```

###### buckets->put->putBucketNotification

* $bucket - The bucket name
* $notification - An array containing the $notification details (see below for more information)

The `$notification` parameter is an array which can contain:
* `Topic`
* `Event`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTnotification.html#RESTBucketPUTnotification-requests-request-elements.

###### buckets->put->putBucketTagging

* $bucket - The bucket name
* $tags - An array containing the tags (see below for more information)

The `$tags` parameter is an array of Tag elements, which in turn are arrays of with:
* `Key`
* `Value`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTtagging.html#RESTBucketPUTtagging-requests-request-elements.

A good example would be:

```php
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
```

###### buckets->put->putBucketRequestPayment

* $bucket - The bucket name
* $payer - Specifies who pays for the download and request fees.  Valid values are Requester or BucketOwner

###### buckets->put->putBucketVersioning

* $bucket - The bucket name
* $versioning - Array with Status and MfaDelete
* $serialNr - The serial number is generated using either a hardware or virtual MFA device, required for MfaDelete
* $tokenCode - Also required for MfaDelete

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTVersioningStatus.html#RESTBucketPUTVersioningStatus-requests-request-headers.

###### buckets->put->putBucketWebsiteConfig

* $bucket - The bucket name
* $website - An array containing website parameters

The `website` parameter can take the following values:
* `IndexDocument`
	* `Suffix` 
* `ErrorDocument`
	* `Key` 
* `RoutingRules`
	* `RoutingRule`
		* `Condition`
			* `KeyPrefixEquals`
			* `HttpErrorCodeReturnedEquals`
		* `Redirect`
			* `Protocol`
			* `HostName`
			* `ReplaceKeyPrefixWith`
			* `ReplaceKeyWith`
			* `HttpRedirectCode`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTBucketPUTwebsite.html#RESTBucketPUTwebsite-requests-request-elements.

A good example would be:

```php
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
```

##### DELETE Bucket

###### buckets->delete->deleteBucket

* $bucket - The bucket name

###### buckets->delete->deleteBucketCors

* $bucket - The bucket name

###### buckets->delete->deleteBucketLifecycle

* $bucket - The bucket name

###### buckets->delete->deleteBucketPolicy

* $bucket - The bucket name

###### buckets->delete->deleteBucketTagging

* $bucket - The bucket name

###### buckets->delete->deleteBucketWebsite

* $bucket - The bucket name

#### Objects

##### GET Object

###### objects->get->getObject

* $bucket - The bucket name
* $object - The object name
* $generation - Used for fetching a specific object version
* $optionalHeaders - An array of optional headers to be set

The `$optionalHeaders` parameter is an array which can contain one or more of the following headers:

* x-goog-if-generation-match
* If-Match
* If-Modified-Since
* If-None-Match
* If-Unmodified-Since
* Range

###### objects->get->getObjectAcl

* $bucket - The bucket name
* $object - The object name

###### objects->get->getObjectTorrent

* $bucket - The bucket name
* $object - The object name

###### objects->get->listParts

* $bucket - The bucket name
* $object - The object name
* $parameters - The upload parameters

The `$parameters` parameter can take the following values:
* `uploadId`
* `max-parts`
* `part-number-marker`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/mpUploadListParts.html#mpUploadListParts-requests-request-parameters.

##### HEAD Object

###### objects->head->headObject

* $bucket - The bucket name
* $object - The object name
* $generation - Used for fetching a specific object version
* $optionalHeaders - An array of optional headers to be set

The `$optionalHeaders` parameter is an array which can contain one or more of the following headers:

* If-Match
* If-Modified-Since
* If-None-Match
* If-Unmodified-Since
* Range
* x-goog-if-generation-match
* x-goog-if-metageneration-match

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTObjectHEAD.html#RESTObjectHEAD-requests-request-headers.

##### OPTIONSS3 Object

###### objects->optionss3->optionsObject

* $bucket - The bucket name
* $object - The object name
* $requestHeaders - Additional request headers

The `$requestHeaders` parameter can take the following values:
* `Origin`
* `Access-Control-Request-Method`
* `Access-Control-Request-Headers`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTOPTIONSobject.html#RESTOPTIONSobject-requests-request-headers.

##### PUT Object

###### objects->put->putObject

* $bucket - The bucket name
* $object - The object name
* $content - The content of the object
* $requestHeaders - An array of request headers

The `$requestHeaders` parameter can take the following values:
* `Expect`
* `Expires`
* `x-amz-meta-`
* `x-amz-server-side-encryption`
* `x-amz-storage-class`
* `x-amz-website-redirect-location`

###### objects->put->putObjectAcl

* $bucket - The bucket name
* $object - The object name
* $acl - An array containing the ACL permissions (either canned or explicitly specified)

The `$acl` parameter can specify canned ACL permissions:
* `private`
* `public-read`
* `public-read-write`
* `authenticated-read`
* `log-delivery-write`

You can also set explicit ACL permissions. You specify each grantee as a type=value pair, where the type can be one of the following:
* `emailAddress` if value specified is the email address of an AWS account
* `id` if value specified is the canonical User ID of an AWS account
* `uri` if granting permission to a predefined Amazon S3 group

Valid values for the explicit ACL permissions are:
* `read`
* `write`
* `read-acp`
* `write-acp`
* `full-control` 

A good example for the `$acl` parameter would be:

```php
array(
	"read" => "uri=\"http://acs.amazonaws.com/groups/global/AuthenticatedUsers\"",
	"write-acp" => "emailAddress=\"alex.ukf@gmail.com\"",
	"full-control" => "id=\"6e887773574284f7e38cacbac9e1455ecce62f79929260e9b68db3b84720ed96\""
)
```

More details about request headers and ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTObjectPUTacl.html#RESTObjectPUTacl-requests-request-headers.

Additional details about canned ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/latest/dev/ACLOverview.html#CannedACL.

###### objects->put->putObjectCopy

* $bucket - The bucket name
* $object - The object name
* $copySource - The path to the file to be copied (bucket + object)
* $requestHeaders - An array containing request headers

The `$requestHeaders` parameter can take the following values:
* `x-amz-metadata-directive`
* `x-amz-copy-source-if-match`
* `x-amz-copy-source-if-none-match`
* `x-amz-copy-source-if-unmodified-since`
* `x-amz-copy-source-if-modified-since`
* `x-amz-server-sideâ€‹-encryption`
* `x-amz-storage-class`
* `x-amz-website-redirect-location`

###### objects->put->initiateMultipartUpload

* $bucket - The bucket name
* $object - The object name
* $requestHeaders - An array containing request headers
* $acl - An array containing the ACL permissions (either canned or explicitly specified)

The `$requestHeaders` parameter can take the following values:
* `Expires`
* `x-amz-meta-`
* `x-amz-server-side-encryption`
* `x-amz-storage-class`
* `x-amz-website-redirect-location`

The `$acl` parameter can specify canned ACL permissions:
* `private`
* `public-read`
* `public-read-write`
* `authenticated-read`
* `log-delivery-write`

You can also set explicit ACL permissions. You specify each grantee as a type=value pair, where the type can be one of the following:
* `emailAddress` if value specified is the email address of an AWS account
* `id` if value specified is the canonical User ID of an AWS account
* `uri` if granting permission to a predefined Amazon S3 group

Valid values for the explicit ACL permissions are:
* `read`
* `write`
* `read-acp`
* `write-acp`
* `full-control` 

A good example for the `$acl` parameter would be:

```php
array(
	"read" => "uri=\"http://acs.amazonaws.com/groups/global/AuthenticatedUsers\"",
	"write-acp" => "emailAddress=\"alex.ukf@gmail.com\"",
	"full-control" => "id=\"6e887773574284f7e38cacbac9e1455ecce62f79929260e9b68db3b84720ed96\""
)
```

More details about the request headers and ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/mpUploadInitiate.html#mpUploadInitiate-requests-request-headers.

Additional details about canned ACL permissions can be found at http://docs.aws.amazon.com/AmazonS3/latest/dev/ACLOverview.html#CannedACL.

###### objects->put->uploadPart

* $bucket - The bucket name
* $object - The object name
* $partNumber - The part number
* $uploadId - The upload ID
* $requestHeaders - An array containing request headers

The `$requestHeaders` parameter can take one of the following values:
* `Content-MD5`
* `Expect`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/mpUploadUploadPart.html#mpUploadUploadPart-requests-request-headers.

###### objects->put->uploadPartCopy

* $bucket - The bucket name
* $object - The object name
* $partNumber - The part number
* $uploadId - The upload ID
* $requestHeaders - An array containing request headers

The `$requestHeaders` parameter can take one of the following values:
* `x-amz-copy-source`
* `x-amz-copy-source-range`
* `x-amz-copy-source-if-match`
* `x-amz-copy-source-if-none-match`
* `x-amz-copy-source-if-unmodified-since`
* `x-amz-copy-source-if-modified-since`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/mpUploadUploadPartCopy.html#mpUploadUploadPartCopy-requests-request-headers.

###### objects->put->completeMultipartUpload

* $bucket - The bucket name
* $object - The object name
* $uploadId - The upload ID
* $parts - An array of PartNumber and ETag pairs

The `$parts` parameter is an array of part elements, which can take the following values:
* `PartNumber`
* `ETag`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/mpUploadComplete.html#mpUploadComplete-requests-request-elements.

A good example for the `$parts` parameter would be:

```php
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
```

##### POST Object

###### objects->post->deleteMultipleObjects

* $bucket - The bucket name
* $objects - An array of objects to be deleted
* $quiet - In quiet mode the response includes only keys where the delete operation encountered an error
* $serialNr - The serial number is generated using either a hardware or a virtual MFA device. Required for MfaDelete
* $tokenCode - Also required for MfaDelete

The `$objects` parameter is an array of object elements which can take the following values:
* `Key`
* `VersionId`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/multiobjectdeleteapi.html#multiobjectdeleteapi-requests-request-elements.

A good example for the `$objects` parameter would be:

```php
array(
	array(
		"Key" => "404.txt"
	),
	array(
		"Key" => "SampleDocument.txt",
		"VersionId" => "OYcLXagmS.WaD..oyH4KRguB95_YhLs7",
	),
)
```

###### objects->post->postObject

* $bucket - The bucket name
* $fields - An array of fields to be deleted

The `$fields` parameter can take the following values:
* `AWSAccessKeyId`
* `acl`
* `file`
* `key`
* `policy`
* `success_action_redirect`
* `redirect`
* `success_action_status`
* `x-amz-storage-class`
* `x-amz-meta-*`
* `x-amz-security-token`
* `x-amz-server-side-encryption`
* `x-amz-website-redirect-location`

More details can be found at http://docs.aws.amazon.com/AmazonS3/2006-03-01/API/RESTObjectPOST.html#RESTObjectPOST-requests-form-fields.

A good example for the `$fields` parameter would be:

```php
array(
	"key" => "testFile.txt",
	"file" => "test content",
)
```

###### objects->post->postObjectRestore

* $bucket - The bucket name
* $object - The name of the object to be restored
* $days - The number of days that you want the restored copy to exist

##### DELETE Object

###### objects->delete->deleteObject

* $bucket - The bucket name
* $object - The name of the object to be deleted
* $versionId - The version id of the object to be deleted
* $serialNr - The serial number is generated using either a hardware or a virtual MFA device. Required for MfaDelete
* $tokenCode - Also required for MfaDelete

###### objects->delete->abortMultipartUpload

* $bucket - The bucket name
* $object - The name of the object
* $uploadId - The upload id
