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
 
 // Set a custom constant with a long, random string.
 define('ELARA_FRAMEWORK_KEY', 'VfLbC6QQwLHTc4ecU4V6GJhkLzo7VzXq3pU7V4U6');
 
 // Prevent from directly accessing the file.
 if (!defined('ELARA_FRAMEWORK_KEY') || ELARA_FRAMEWORK_KEY !== 'VfLbC6QQwLHTc4ecU4V6GJhkLzo7VzXq3pU7V4U6') {
     die(http_response_code(404));
     return;
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
abstract class Path 
{
    /**
     * Properties 
     * 
     * 
     * @access protected
     * @since Properties available since Release of Elara v0.0.1
     */
    protected static $base_host;
    protected static $base_app;
    protected static $base_script;
    protected static $base_current;
    protected static $base_public;
    protected static $base_skin;
}