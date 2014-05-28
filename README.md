Request
=======

A simple cURL wrapper library in PHP. 

### How to use?
	echo \milankragujevic\Request::get('http://google.com/');

That's the simplest example. You can provide settings as the second parameter of the function.
	
	echo \milankragujevic\Request::get('http://google.com/', ['cookie' => '/tmp/cookies.txt']);
	
You can set the namespace using the Use command, so you don't have to prefix your method calls with the namespace
	
	use milankragujevic\Request;
	echo Request::get('http://google.com/');

##### Sending POST requests
It's really simple to send a POST request. Just put the Data as the third parameter (an array of post fields)

	Request::post('http://google.com/', ['cookie' => '/tmp/cookies.txt'], ['MyField' => 'MyValue', 'AnotherField' => 'OMG! YOU CAN DO EVERYTHING!']);
	
#### Options

 * timeout - Timeout time in seconds (integer)
 * noredirect - Don't follow Location header
 * useragent - The user agent string
 * nofail - Don't fail on error (see CURLOPT_FAILONERROR)
 * header - Return the response headers alongside the body
 * nobody - Perform a HEAD request (recieve on the response headers, not the body itself)
 * cookie - Set the cookie jar location (NOTE: The file must exist or else Request will throw an Exception)
 * referer - Set the Referer header. (NOTE: It's not referrer, the spelling mistake is intentional)
 * proxyip - Proxy IP address. Use it to try and spoof the request's origin IP. 
 
### Handling Errors
To handle errors, simply catch any Exceptions thrown by Request. It will not quit on error, but instead it'll throw an Exception.
The Exceptions are raw cURL errors, except the Cookie Jar Error. 

	try {
		echo Request::get('http://google.com/');
	} catch (Exception $e) {
		echo "Oops! " . $e->getMessage();
	}