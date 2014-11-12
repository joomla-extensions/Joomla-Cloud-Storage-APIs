## The Google Cloud Storage Package

### Using the Google Cloud Storage Package

The Google Cloud Storage package is designed to be a straightforward interface for working with Google Cloud Storage. It is based on version 2.0 of the Google Cloud Storage XML API. You can find documentation on the API at https://developers.google.com/storage/docs/xml-api-overview.

Google Cloud Storage is built upon the HTTP package which provides an easy way to consume URLs and web services in a transport independent way.

#### Instantiating Google Cloud Storage

```php
$google = new JGooglecloudstorage;
```

This creates a basic Google Cloud Storage object that can be used to access publicly available resources on Google Cloud Storage. For certain operations, such as those which require authorization, it is necessary to provide account related details. The authentication is done via OAuth 2.0 and you can configure additional options by using a `Joomla\Registry\Registry` object with your preferred details:

```php
use Joomla\Registry\Registry;

$options = new Registry;
$options->set('project.id', 'project_id');
$options->set('client.id', 'project_id.apps.googleusercontent.com');
$options->set('client.email', 'project_id@developer.gserviceaccount.com');
$options->set('client.keyFile', 'e8ed82a38e26fbec0ef7df4ea32f5ed0ccd57aff-privatekey.p12');

$google = new JGooglecloudstorage($options);
```

#### Accessing the Google Cloud Storage API

Once an object has been created, it is simple to use it to access Google Cloud Storage:

```php
$response = $google->service->get->getService();
```
	
This call will list all of the buckets that you own.

#### A more complete example

The following is a cli application that will set the Access Control List permissions on the `testFile.txt` object in the `test-put-bucket-2` bucket.

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
 
class GoogleCloudStorageApp extends JApplicationCli
{
	protected function doExecute()
	{
		$options = new \Joomla\Registry\Registry;
 
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
```

### Supported operations

This section presents all the supported operations and corresponding arguments. More details about these can be found at https://developers.google.com/storage/docs/reference-methods.

Most of them use query string parameters and request headers which are documented at https://developers.google.com/storage/docs/reference-headers.

Details about valid bucket and object names can be found at https://developers.google.com/storage/docs/bucketnaming.


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
    * `generationmarker`
    * `marker`
    * `max-keys`
    * `prefix`
    * `versions`

###### buckets->get->getBucketAcl

* $bucket - The bucket name

###### buckets->get->getBucketCors

* $bucket - The bucket name

###### buckets->get->getBucketLifecycle

* $bucket - The bucket name

###### buckets->get->getBucketLogging

* $bucket - The bucket name

###### buckets->get->getBucketVersioning

* $bucket - The bucket name

##### PUT Bucket

###### buckets->put->putBucket

* $bucket - The bucket name
* $bucketLocation - The bucket region: You can specify the geographic location for your bucket by providing a location constraint. This tells Google Cloud Storage to store the bucket and its contents on a server in the specified location. For more information, see https://developers.google.com/storage/docs/concepts-techniques#specifyinglocations.
* $predefinedAcl - An array containing the ACL permissions (see below for more information)

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

* $bucket - The bucket name
* $acl - An array containing the ACL permissions

The `$acl` parameter is an array and has the following structure:
* The first element's key is `Owner` and its value is a valid Google Cloud Storage ID, which you can obtain after logging into your account at https://code.google.com/apis/console/ in the Google Cloud Storage section.
* The second element's key is `Entries` and this is an array of Entry arrays.
* An Entry Array only needs the definition of its value, which is a pair of `Permission`/`Scope values`.
	* `Permission` - can be any of the Google Cloud Storage permissions, including:
		* READ
		* WRITE
		* FULL_CONTROL
	* `Scope` is the key for an array which can include
		* `type` - can be one of
			* GroupByEmail
			* GroupById
			* UserByEmail
			* UserById
		* `ID` - a valid Google Cloud Storage ID (required for UserById, GroupById)
		* `EmailAddress` - a valid email address (required for UserByEmail, GroupByEmail)
		* `Name` - if missing, the name is filled with the email address (required for UserByEmail, GroupByEmail)


A good example would be:

```php
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
```

###### buckets->put->putBucketCors

* $bucket - The bucket name
* $rules - An array containing the CORS configuration

The `$cors` parameter is an array of arrays. Each subarray is a CORS configuration that can be applied to the bucket, having the following structure:
* `Origins` - array of origin URLs.
* `Methods` - array of HTTP methods.
* `ResponseHeaders` - array of response headers that the user agent is permitted to share across origins.
* `MaxAgeSec` - the number of seconds that the client (browser) is allowed to make requests before the client must repeat the preflight request.

A good example would be:

```php
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
```

###### buckets->put->putBucketLifecycle

* $bucket - The bucket name
* $lifecycle - An array containing the lifecycle configuration rules

The `$lifecycle` parameter is an array of rule arrays, which in turn are structured as follows:
* `Action` - at the moment, the only value which can be assigned to this is `Delete`
* `Condition` - an array of optional conditions:
	* `Age`
	* `CreatedBefore`
	* `NumberOfNewerVersions`
	* `IsLive`

A good example would be:

```php
array(
	array(
		"Action" => "Delete",
		"Condition" => array(
			"Age" => 30,
		),
	),
)
```	

###### buckets->put->putBucketLogging

* $bucket - The bucket name
* $logBucket - The bucket that will receive log objects
* $logObjectPrefix - The object prefix for log objects. It can be at most 900 characters and must be a valid object name

###### buckets->put->putBucketVersioning

* $bucket - The bucket name
* $status - Versioning status of a bucket. Can be `Enabled` or `Suspended`

###### buckets->put->putBucketWebsiteConfig

* $bucket - The bucket name
* $mainPageSuffix - An object name suffix to simulate directory index behavior
* $notFoundPage - Name of the object to return with 404 responses

##### DELETE Bucket

###### buckets->delete->deleteBucket

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

##### HEAD Object

###### objects->head->headObject

* $bucket - The bucket name
* $object - The object name
* $generation - Parameter which can be used if you want to fetch a specific object generation
* $optionalHeaders - An array of optional headers to be set

The `$optionalHeaders` parameter is an array which can contain one or more of the following headers:

* If-Match
* If-Modified-Since
* If-None-Match
* If-Unmodified-Since
* Range
* x-goog-if-generation-match
* x-goog-if-metageneration-match

##### PUT Object

###### objects->put->putObject

* $bucket - The bucket name
* $object - The object name
* $content - The content of the object
* $optionalHeaders - An array of optional headers to be set

The `$optionalHeaders` parameter is an array which can contain one or more of the following headers:

* Content-Encoding
* Content-Type
* Content-Disposition
* Transfer-Encoding
* x-goog-acl
* x-goog-hash
* x-goog-if-generation-match
* x-goog-if-metageneration-match
* x-goog-meta-

###### objects->put->putObjectCopy

* $bucket - The bucket name
* $object - The object name
* $copySource - The path to the file to be copied (bucket + object)
* $optionalHeaders - An array of optional headers to be set

The `$optionalHeaders` parameter is an array which can contain one or more of the following headers:

* Content-Encoding
* Content-Type
* Content-Disposition
* Transfer-Encoding
* x-goog-copy-source-if-match	
* x-goog-copy-source-if-none-match
* x-goog-copy-source-if-modified-since
* x-goog-copy-source-if-unmodified-since
* x-goog-acl
* x-goog-hash
* x-goog-if-generation-match
* x-goog-if-metageneration-match
* x-goog-meta-


###### objects->put->putObjectAcl

* $bucket - The bucket name
* $object - The object name
* $acl - An array with the acl permissions
* $parameters - An array of optional parameters that can be set to filter the results. These should only be one of: generation or metageneration
* $optionalHeaders - An array of optional headers to be set

The `$acl` parameter is an array and has the following structure:
* The first element's key is `Owner` and its value is a valid Google Cloud Storage ID, which you can obtain after logging into your account at https://code.google.com/apis/console/ in the Google Cloud Storage section.
* The second element's key is `Entries` and this is an array of Entry arrays.
* An Entry Array only needs the definition of its value, which is a pair of `Permission`/`Scope values`.
	* `Permission` - can be any of the Google Cloud Storage permissions, including:
		* READ
		* WRITE
		* FULL_CONTROL
	* `Scope` is the key for an array which can include
		* `type` - can be one of
			* GroupByEmail
			* GroupById
			* UserByEmail
			* UserById
		* `ID` - a valid Google Cloud Storage ID (required for UserById, GroupById)
		* `EmailAddress` - a valid email address (required for UserByEmail, GroupByEmail)
		* `Name` - if missing, the name is filled with the email address (required for UserByEmail, GroupByEmail)


A good example would be:

```php
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
```	

##### DELETE Object

###### objects->delete->deleteObject

* $bucket - The bucket name
* $object - The object to be deleted
* $generation - A query string parameter for a specific object generation
* $ifGenerationMatch - x-goog-if-generation-match request header
