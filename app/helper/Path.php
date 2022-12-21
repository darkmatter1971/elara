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

 declare(strict_types = 1);

 namespace App\Helper\Path;

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

    /**
     * Properties 
     * 
     * 
     * @access private
     * @since Properties available since Release of Elara v0.0.1
     */
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