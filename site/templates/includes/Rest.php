<?php
/*
 * ProcessWire REST Helper.
 *
 * Copyright (c) 2014 Camilo Castro <camilo@cervezapps.cl>
 *
 * Some portions of code are based on the Lime Project
 * https://github.com/aheinze/Lime/
 * Copyright (c) 2014 Artur Heinze
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Rest;

class Header {
    public static $statusCodes = array(
       // Informational 1xx
       100 => 'Continue',
       101 => 'Switching Protocols',
       // Successful 2xx
       200 => 'OK',
       201 => 'Created',
       202 => 'Accepted',
       203 => 'Non-Authoritative Information',
       204 => 'No Content',
       205 => 'Reset Content',
       206 => 'Partial Content',
       // Redirection 3xx
       300 => 'Multiple Choices',
       301 => 'Moved Permanently',
       302 => 'Found',
       303 => 'See Other',
       304 => 'Not Modified',
       305 => 'Use Proxy',
       307 => 'Temporary Redirect',
       // Client Error 4xx
       400 => 'Bad Request',
       401 => 'Unauthorized',
       402 => 'Payment Required',
       403 => 'Forbidden',
       404 => 'Not Found',
       405 => 'Method Not Allowed',
       406 => 'Not Acceptable',
       407 => 'Proxy Authentication Required',
       408 => 'Request Timeout',
       409 => 'Conflict',
       410 => 'Gone',
       411 => 'Length Required',
       412 => 'Precondition Failed',
       413 => 'Request Entity Too Large',
       414 => 'Request-URI Too Long',
       415 => 'Unsupported Media Type',
       416 => 'Request Range Not Satisfiable',
       417 => 'Expectation Failed',
       // Server Error 5xx
       500 => 'Internal Server Error',
       501 => 'Not Implemented',
       502 => 'Bad Gateway',
       503 => 'Service Unavailable',
       504 => 'Gateway Timeout',
       505 => 'HTTP Version Not Supported'
       );

   	/* mime types */
   	public static $mimeTypes = array(
           'asc'   => 'text/plain',
           'au'    => 'audio/basic',
           'avi'   => 'video/x-msvideo',
           'bin'   => 'application/octet-stream',
           'class' => 'application/octet-stream',
           'css'   => 'text/css',
           'csv'   => 'application/vnd.ms-excel',
           'doc'   => 'application/msword',
           'dll'   => 'application/octet-stream',
           'dvi'   => 'application/x-dvi',
           'exe'   => 'application/octet-stream',
           'htm'   => 'text/html',
           'html'  => 'text/html',
           'json'  => 'application/json',
           'js'    => 'application/x-javascript',
           'txt'   => 'text/plain',
           'bmp'   => 'image/bmp',
           'rss'   => 'application/rss+xml',
           'atom'  => 'application/atom+xml',
           'gif'   => 'image/gif',
           'jpeg'  => 'image/jpeg',
           'jpg'   => 'image/jpeg',
           'jpe'   => 'image/jpeg',
           'png'   => 'image/png',
           'ico'   => 'image/vnd.microsoft.icon',
           'mpeg'  => 'video/mpeg',
           'mpg'   => 'video/mpeg',
           'mpe'   => 'video/mpeg',
           'qt'    => 'video/quicktime',
           'mov'   => 'video/quicktime',
           'wmv'   => 'video/x-ms-wmv',
           'mp2'   => 'audio/mpeg',
           'mp3'   => 'audio/mpeg',
           'rm'    => 'audio/x-pn-realaudio',
           'ram'   => 'audio/x-pn-realaudio',
           'rpm'   => 'audio/x-pn-realaudio-plugin',
           'ra'    => 'audio/x-realaudio',
           'wav'   => 'audio/x-wav',
           'zip'   => 'application/zip',
           'pdf'   => 'application/pdf',
           'xls'   => 'application/vnd.ms-excel',
           'ppt'   => 'application/vnd.ms-powerpoint',
           'wbxml' => 'application/vnd.wap.wbxml',
           'wmlc'  => 'application/vnd.wap.wmlc',
           'wmlsc' => 'application/vnd.wap.wmlscriptc',
           'spl'   => 'application/x-futuresplash',
           'gtar'  => 'application/x-gtar',
           'gzip'  => 'application/x-gzip',
           'swf'   => 'application/x-shockwave-flash',
           'tar'   => 'application/x-tar',
           'xhtml' => 'application/xhtml+xml',
           'snd'   => 'audio/basic',
           'midi'  => 'audio/midi',
           'mid'   => 'audio/midi',
           'm3u'   => 'audio/x-mpegurl',
           'tiff'  => 'image/tiff',
           'tif'   => 'image/tiff',
           'rtf'   => 'text/rtf',
           'wml'   => 'text/vnd.wap.wml',
           'wmls'  => 'text/vnd.wap.wmlscript',
           'xsl'   => 'text/xml',
           'xml'   => 'text/xml'
       );

    public static function mimeType($_mime) {
   		$mime = Header::$mimeTypes[$_mime];
   		$mime = "Content-Type: $mime";
   		return $mime;
   	}
}

class Request {
		public static $types = array 
		(
			'get', 
			'post', 
			'put', 
			'patch', 
			'delete', 
			'options', 
			'ajax', 
			'mobile', 
			'ssl'
		);
		
    	/**
         * Request helper function
         * @param  String $type
         * @return Boolean
         */
         public static function is($type){

             switch(strtolower($type)){
                 case 'ajax':
                 return (
                     (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))       ||
                     (isset($_SERVER["CONTENT_TYPE"]) && stripos($_SERVER["CONTENT_TYPE"],'application/json')!==false)           ||
                     (isset($_SERVER["HTTP_CONTENT_TYPE"]) && stripos($_SERVER["HTTP_CONTENT_TYPE"],'application/json')!==false)
                 );
                 break;

                 case 'mobile':

                 $mobileDevices = array(
                     "midp","240x320","blackberry","netfront","nokia","panasonic","portalmmm","sharp","sie-","sonyericsson",
                     "symbian","windows ce","benq","mda","mot-","opera mini","philips","pocket pc","sagem","samsung",
                     "sda","sgh-","vodafone","xda","iphone", "ipod","android"
                 );

                 return preg_match('/(' . implode('|', $mobileDevices). ')/i',strtolower($_SERVER['HTTP_USER_AGENT']));
                 break;

                 case 'post':
                 return (strtolower($_SERVER['REQUEST_METHOD']) == 'post');
                 break;

                 case 'get':
                 return (strtolower($_SERVER['REQUEST_METHOD']) == 'get');
                 break;

                 case 'put':
                 return (strtolower($_SERVER['REQUEST_METHOD']) == 'put');
                 break;
		  
   	      case 'options':
                 return (strtolower($_SERVER['REQUEST_METHOD']) == 'options');
                 break;
		  
   	      case 'patch':
                 return (strtolower($_SERVER['REQUEST_METHOD']) == 'patch');
                 break;

                 case 'delete':
                 return (strtolower($_SERVER['REQUEST_METHOD']) == 'delete');
                 break;

                 case 'ssl':
                 return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
                 break;
             }

             return false;
         }
	
	  /**
	  * Get current request type
	  * @return String
	  */
	  
	  public static function currentType() {
		  $currentType = null;
		  foreach(Request::$types as $type) {
			  if(Request::is($type)){
				  $currentType = $type;
				  break;
			  }
		  }
		  
		  return $currentType;
	  }
  
   	  /**
   	    * Get request variables
   	    * @param  String $index
   	    * @param  Misc $default
   	    * @param  Array $source
   	    * @return Misc
   	    */
   	    
   	    public static function params($index=null, $default = null, $source = null) {

   	        // check for php://input and merge with $_REQUEST
   	          if ((isset($_SERVER["CONTENT_TYPE"]) && 
   				  stripos($_SERVER["CONTENT_TYPE"],'application/json') !== false) ||
   	              (isset($_SERVER["HTTP_CONTENT_TYPE"]) && 
   				  stripos($_SERVER["HTTP_CONTENT_TYPE"],'application/json') !== false) // PHP build in Webserver !?
   			  	  ) {
   	              if ($json = json_decode(@file_get_contents('php://input'), true)) {
   	                  $_REQUEST = array_merge($_REQUEST, $json);
   	              }
   	          }
		  
   		      $src = $source ? $source : $_REQUEST;

		      //Basic HTTP Authetication
		      if (isset($_SERVER['PHP_AUTH_USER'])) {
		      $credentials = [
		      "uname" => $_SERVER['PHP_AUTH_USER'],
		      "upass" => $_SERVER['PHP_AUTH_PW']
		      ];
		      $src = array_merge($src, $credentials);
		      }
      
   		      return REQUEST::fetch_from_array($src, $index, $default);
   	    }
		
		/**
		* Helper function for params method
		*/
   		public static function fetch_from_array(&$array, $index=null, $default = null) {

   		    if (is_null($index)) {

   		        return $array;

   		    } elseif (isset($array[$index])) {

   		        return $array[$index];

   		    } elseif (strpos($index, '/')) {

   		        $keys = explode('/', $index);

   		        switch(count($keys)){

   		            case 1:
   		                if (isset($array[$keys[0]])){
   		                    return $array[$keys[0]];
   		                }
   		                break;

   		            case 2:
   		                if (isset($array[$keys[0]][$keys[1]])){
   		                    return $array[$keys[0]][$keys[1]];
   		                }
   		                break;

   		            case 3:
   		                if (isset($array[$keys[0]][$keys[1]][$keys[2]])){
   		                    return $array[$keys[0]][$keys[1]][$keys[2]];
   		                }
   		                break;

   		            case 4:
   		                if (isset($array[$keys[0]][$keys[1]][$keys[2]][$keys[3]])){
   		                    return $array[$keys[0]][$keys[1]][$keys[2]][$keys[3]];
   		                }
   		                break;
   		        }
   		    }

   		    return $default;
   		}
   }

/* end of file templates/helpers/Rest.php */