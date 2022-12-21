<?php 
/**
 * A Class to find Path.
 *  
 * PHP version 8.2
 *
 * @version v0.0.1
 * @category Helper
 * @package Elara
 * @license Public Domain
 * @author Tafhimul kabir <https://github.com/tafhimulkabir>
 * @link  
 * @since File available since Release of Elara v0.0.1
 * @copyright   
 **/

//  if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] != 'https://example.com/expected-page') {
//     // Display an error message or redirect the user
//   }

 declare(strict_types = 1);

 namespace App\Helper\Path;

 require_once __DIR__ . '/func.php';

 // Create an instance of the class
//  $generator = new RandomStringGenerator();
 
 // Generate a random string using the method
//  $randomString = $generator->generateString();
 
 // Generate a string
//  $string = generateString();

//  // Set a custom constant with a long, random string.
//  define('ELARA_FRAMEWORK_KEY', $string);
 
//  // Prevent from directly accessing the file.
//  if (!defined('ELARA_FRAMEWORK_KEY') || ELARA_FRAMEWORK_KEY !== $string) {
//     die(http_response_code(404));
//     return false;
// }

 // Prevent from directly accessing the file.
 if (!defined('ELARA')) {
    die(http_response_code(404));
    return false;
}


/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @category Helper
 * @package Elara
 * @license        
 * @since Class available since Release of Elara v0.0.1
 */
class PathFinder 
{

    /*
    getUrlParameters(): This method could return an array of the URL parameters, if any, in the current request.

    getUrlFragment(): This method could return the URL fragment (the part of the URL after the # symbol) in the current request, if any.

    getRelativeUrl(): This method could return the relative URL of the current request (the portion of the URL after the domain name).

    getDomainName(): This method could return the domain name of the current request (e.g. "example.com").

    getProtocol(): This method could return the protocol of the current request (e.g. "http" or "https").

    redirect($url): This method could redirect the user to the specified URL using the header() function and the Location header.
     */

    /**
     * Properties 
     * 
     * 
     * @access protected
     * @since Properties available since Release of Elara v0.0.1
     */
    // protected static $base_host;
    // protected static $base_app;
    // protected static $base_script;
    // protected static $base_current;
    // protected static $base_public;
    // protected static $base_skin;
    private $baseUrl;
    
    public function setBaseUrl($baseUrl) {
        $this->baseUrl = $baseUrl;
    }
    
    public function getBaseUrl() {
        return $this->baseUrl;
    }
    
    public function getCurrentUrl() {
        return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    
    public function getScriptPath() {
        return $_SERVER['SCRIPT_FILENAME'];
    }
    
    public function getDocumentRoot() {
        return $_SERVER['DOCUMENT_ROOT'];
    }
    
    public function getParentDirectory() {
        $scriptPath = $this->getScriptPath();
        $parentDirectory = dirname($scriptPath);
        return $parentDirectory;
    }
    
    public function getAbsoluteUrl($relativeUrl) {
        return $this->getBaseUrl() . $relativeUrl;
    }
    
    public function getUrlParameters() {
        $parameters = array();
        $queryString = $_SERVER['QUERY_STRING'];
        if ($queryString) {
        parse_str($queryString, $parameters);
        }
        return $parameters;
    }
    
    public function getUrlFragment() {
        $url = $this->getCurrentUrl();
        $fragment = parse_url($url, PHP_URL_FRAGMENT);
        return $fragment;
    }
    
    public function getRelativeUrl() {
        $url = $this->getCurrentUrl();
        $relativeUrl = parse_url($url, PHP_URL_PATH);
        return $relativeUrl;
    }
    
    public function getDomainName() {
        $url = $this->getCurrentUrl();
        $domainName = parse_url($url, PHP_URL_HOST);
        return $domainName;
    }
    
    public function getProtocol() {
        $url = $this->getCurrentUrl();
        $protocol = parse_url($url, PHP_URL_SCHEME);
        return $protocol;
    }
    
    public function getClientIp() {
        return $_SERVER['REMOTE_ADDR'];
    }
     
    public function getServerIp() {
        return $_SERVER['SERVER_ADDR'];
    }      

    public function redirect($url) {
        header('Location: ' . $url);
    }
      
}


// class PathFinder
// {
//     private $baseUrl;

//     public function setBaseUrl($baseUrl)
//     {
//         $this->baseUrl = filter_var($baseUrl, FILTER_SANITIZE_URL);
//     }

//     public function getBaseUrl()
//     {
//         return $this->baseUrl;
//     }

//     public function getCurrentUrl()
//     {
//         return filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
//     }

//     public function getScriptPath()
//     {
//         return filter_var($_SERVER['SCRIPT_FILENAME'], FILTER_SANITIZE_URL);
//     }

//     public function getDocumentRoot()
//     {
//         return filter_var($_SERVER['DOCUMENT_ROOT'], FILTER_SANITIZE_URL);
//     }

//     public function getParentDirectory()
//     {
//         $scriptPath = $this->getScriptPath();
//         $parentDirectory = dirname($scriptPath);
//         return $parentDirectory;
//     }

//     public function getAbsoluteUrl($relativeUrl)
//     {
//         $relativeUrl = filter_var($relativeUrl, FILTER_SANITIZE_URL);
//         return $this->getBaseUrl() . $relativeUrl;
//     }

//     public function getUrlParameters()
//     {
//         $parameters = array();
//         $queryString = filter_var($_SERVER['QUERY_STRING'], FILTER_SANITIZE_STRING);
//         if ($queryString) {
//             parse_str($queryString, $parameters);
//         }
//         return $parameters;
//     }

//     public function getUrlFragment()
//     {
//         $url = $this->getCurrentUrl();
//         $fragment = filter_var(parse_url($url, PHP_URL_FRAGMENT), FILTER_SANITIZE_STRING);
//         return $fragment;
//     }

//     public function getRelativeUrl()
//     {
//         $url = $this->getCurrentUrl();
//         $relativeUrl = filter_var(parse_url($url, PHP_URL_PATH), FILTER_SANITIZE_URL);
//         return $relativeUrl;
//     }

//     public function getDomainName()
//     {
//         $url = $this->getCurrentUrl();
//         $domainName = filter_var(parse_url($url, PHP_URL_HOST), FILTER_SANITIZE_URL);
//         return $domainName;
//     }

//     public function getProtocol()
//     {
//         $url = $this->getCurrentUrl();
//         $protocol = filter_var(parse_url($url, PHP_URL_SCHEME), FILTER_SANITIZE_URL);
//         return $protocol;
//     }

//     public function getClientIp()
//     {
//         return filter_var($_SERVER['REMOTE_ADDR'], FILTER_SANITIZE_IP);
//     }

//     public function getServerIp()
//     {
//         return filter_var($_SERVER['SERVER_ADDR'], FILTER_SANITIZE_IP);
//     }
// }







/*
    Add a constructor method to allow users to pass in the base URL as an argument when creating a new instance of the class. This would allow users to easily change the base URL without having to call the setBaseUrl() method separately.

    Consider adding a method to retrieve the current server name or hostname. This could be useful for applications that are hosted on multiple servers or environments.

    Add a method to retrieve the current port number. This could be useful for applications that run on non-standard ports.

    Add a method to retrieve the current request method (e.g. 'GET', 'POST', etc.). This could be useful for handling different types of requests.

    Add a method to retrieve the current user agent. This could be useful for determining the type of device or browser being used to make the request.

    Add a method to retrieve the referrer URL. This could be useful for tracking where users are coming from.

    Add methods to retrieve additional server variables. There are many other variables available in the $_SERVER superglobal array that may be useful for some applications.

By adding these and other methods, the PathFinder class can become a more comprehensive tool for retrieving information about the current request and server environment.
*/





// class PathFinder
// {
//     private $baseUrl;

//     public function __construct($baseUrl = null)
//     {
//         if ($baseUrl !== null) {
//             $this->setBaseUrl($baseUrl);
//         }
//     }

//     public function setBaseUrl($baseUrl)
//     {
//         $this->baseUrl = filter_var($baseUrl, FILTER_SANITIZE_URL);
//     }

//     public function getBaseUrl()
//     {
//         return $this->baseUrl;
//     }

//     public function getCurrentUrl()
//     {
//         return filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
//     }

//     public function getScriptPath()
//     {
//         return filter_var($_SERVER['SCRIPT_FILENAME'], FILTER_SANITIZE_URL);
//     }

//     public function getDocumentRoot()
//     {
//         return filter_var($_SERVER['DOCUMENT_ROOT'], FILTER_SANITIZE_URL);
//     }

//     public function getParentDirectory()
//     {
//         $scriptPath = $this->getScriptPath();
//         $parentDirectory = dirname($scriptPath);
//         return $parentDirectory;
//     }

//     public function getAbsoluteUrl($relativeUrl)
//     {
//         $relativeUrl = filter_var($relativeUrl, FILTER_SANITIZE_URL);
//         return $this->getBaseUrl() . $relativeUrl;
//     }

//     public function getUrlParameters()
//     {
//         $parameters = array();
//         $queryString = filter_var($_SERVER['QUERY_STRING'], FILTER_SANITIZE_STRING);
//         if ($queryString) {
//             parse_str($queryString, $parameters);
//         }
//         return $parameters;
//     }

//     public function getUrlFragment()
//     {
//         $url = $this->getCurrentUrl();
//         $fragment = filter_var(parse_url($url, PHP_URL_FRAGMENT), FILTER_SANITIZE_STRING);
//         return $fragment;
//     }

//     public function getRelativeUrl()
//     {
//         $url = $this->getCurrentUrl();
//         $relativeUrl = filter_var(parse_url($url, PHP_URL_PATH), FILTER_SANITIZE_URL);
//         return $relativeUrl;
//     }

//     public function getDomainName()
//     {
//         $url = $this->getCurrentUrl();
//         $domainName = filter_var(parse_url($url, PHP_URL_HOST), FILTER_SANITIZE_URL);
//         return $domainName;
//     }

//     public function getProtocol()
//     {
//         $url = $this->getCurrentUrl();
//         $protocol = filter_var(parse_url($url, PHP_URL_SCHEME), FILTER_SANITIZE_URL);
//         return $protocol;
//     }

//     public function getServerName()
//     {
//         return filter_var($_SERVER['SERVER_NAME'],





















// class PathFinder
// {
//     private $baseUrl;

//     public function __construct($baseUrl = null)
//     {
//         if ($baseUrl !== null) {
//             $this->setBaseUrl($baseUrl);
//         }
//     }

//     public function setBaseUrl($baseUrl)
//     {
//         $this->baseUrl = filter_var($baseUrl, FILTER_SANITIZE_URL);
//     }

//     public function getBaseUrl()
//     {
//         return $this->baseUrl;
//     }

//     public function getCurrentUrl()
//     {
//         return filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
//     }

//     public function getScriptPath()
//     {
//         return filter_var($_SERVER['SCRIPT_FILENAME'], FILTER_SANITIZE_URL);
//     }

//     public function getDocumentRoot()
//     {
//         return filter_var($_SERVER['DOCUMENT_ROOT'], FILTER_SANITIZE_URL);
//     }

//     public function getParentDirectory()
//     {
//         $scriptPath = $this->getScriptPath();
//         $parentDirectory = dirname($scriptPath);
//         return $parentDirectory;
//     }

//     public function getAbsoluteUrl($relativeUrl)
//     {
//         $relativeUrl = filter_var($relativeUrl, FILTER_SANITIZE_URL);
//         return $this->getBaseUrl() . $relativeUrl;
//     }

//     public function getUrlParameters()
//     {
//         $parameters = array();
//         $queryString = filter_var($_SERVER['QUERY_STRING'], FILTER_SANITIZE_STRING);
//         if ($queryString) {
//             parse_str($queryString, $parameters);
//         }
//         return $parameters;
//     }

//     public function getUrlFragment()
//     {
//         $url = $this->getCurrentUrl();
//         $fragment = filter_var(parse_url($url, PHP_URL_FRAGMENT), FILTER_SANITIZE_STRING);
//         return $fragment;
//     }

//     public function getRelativeUrl()
//     {
//         $url = $this->getCurrentUrl();
//         $relativeUrl = filter_var(parse_url($url, PHP_URL_PATH), FILTER_SANITIZE_URL);
//         return $relativeUrl;
//     }

//     public function getDomainName()
//     {
//         $url = $this->getCurrentUrl();
//         $domainName = filter_var(parse_url($url, PHP_URL_HOST), FILTER_SANITIZE_URL);
//         return $domainName;
//     }

//     public function getProtocol()
//     {
//         $url = $this->getCurrentUrl();
//         $protocol = filter_var(parse_url($url, PHP_URL_SCHEME), FILTER_SANITIZE_URL);
//         return $protocol;
//     }

//     public function getClientIp()
//     {
//         return filter_var($_SERVER['REMOTE_ADDR'], FILTER_SANITIZE_IP);
//     }

//     public function getServerIp()
//     {
//         return filter_var($_SERVER['SERVER_ADDR'], FILTER_SANITIZE_IP);
//     }
// }