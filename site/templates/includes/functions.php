<?php
// Form url configs for modals
$tckidsvolunteerapp = "https://forms.thursdaychurch.org/forms/embed.php?id=12843";
$prayerrequests = "https://forms.thursdaychurch.org/forms/embed.php?id=12170";
$techsupport = "https://forms.thursdaychurch.org/forms/embed.php?id=11234";
$sharestory = "https://forms.thursdaychurch.org/forms/embed.php?id=10708";
$contactus = "https://forms.thursdaychurch.org/forms/embed.php?id=10437";
// when in development mode, all emails go to mgoldsmith@thechapel.com

// and other things...

wire("config")->dev_mode = true;

// when our credit card transactions fail, turn all card processing pages off

wire("config")->maintenance_mode = false;

wire("config")->bcc_admin = 'jay@thursdaychurch.org';

//// Custom root name for development

wire("config")->rootName = 'http://thursdaychurch.org';

wire("config")->ssl_rootName = 'https://thursdaychurch.org';

// giving administrator (also needs to be set in global.php.php in giving includes)

wire("config")->giving_admin = 'jay@thursdaychurch.org';


// Live boolean

wire("config")->live = false;
wire("config")->live_need_countdown = false;

// determine live status
$start = strtotime( date('Y-m-d') . " 00:00:00");
$end = strtotime( date('Y-m-d') . " 23:59:59");
$currentTime =  strtotime(date("Y-m-d H:i:s"));
$service_found = wire("pages")->get("parent='/tools/services/', event_date>=$start,event_date<=$end");

if($service_found->id)

{

    $datetime_from = strtotime("-15 minutes",strtotime($service_found->event_date));

    if( $datetime_from  <= $currentTime && strtotime($service_found->event_date_end) >= $currentTime)

    {

      wire("config")->live = true;

      wire("config")->live_need_countdown = true;



      if( strtotime($service_found->event_date) <= $currentTime && strtotime($service_found->event_date_end) >= $currentTime)

      {

        wire("config")->live_need_countdown = false;

      }

    }

}





if(count($service_found) > 0)

{

    if( $ser)

    print $service_found->title;

    wire("config")->live = true;

}



wire("config")->live = false; 

if ((date("w") == 0) && (date("Hi")>1040) && (date("Hi")<1300)) {

    wire("config")->live = true;

}



/*

//if( (date("Ymd") == "20151213") && (date("Hi")>1835) && (date("Hi")<2130) )

if( (date("Ymd") == "20151213") && (date("Hi")>1828) && (date("Hi")<2130) )

{

  wire("config")->live = true;

}

*/



wire("config")->live = false;





// Sunday service times

if ((date("w") == 0) && (date("Hi")>1030) && (date("Hi")<1200)) wire("config")->live = true;
if ((date("w") == 0) && (date("Hi")>1030) && (date("Hi")<1200)) wire("config")->live_need_countdown = true;

// Thursday service times
if ((date("w") == 4) && (date("Hi")>1830) && (date("Hi")<2000)) wire("config")->live = true;
if ((date("w") == 4) && (date("Hi")>1830) && (date("Hi")<2000)) wire("config")->live_need_countdown = true;



/// and live overrides on special dates

//Easter 2015

if ((date("Ymd") == "20150405") && (date("Hi")>645) && (date("Hi")<1430)) wire("config")->live = true;

if ((date("Ymd") == "20150405") && (date("Hi")>659) && (date("Hi")<1430)) wire("config")->live_need_countdown = true;



// Good Friday 2015

if ((date("Ymd") == "20150403") && (date("Hi")>1830) && (date("Hi")<2000)) wire("config")->live = true;

if ((date("Ymd") == "20150403") && (date("Hi")>1830) && (date("Hi")<2000))wire("config")->live_need_countdown = true;



// Christmas Eve 2015

if ((date("Ymd") == "20151224") && (date("Hi")>1145) && (date("Hi")<1915)) wire("config")->live = true;

if ((date("Ymd") == "20151224") && (date("Hi")>1159) && (date("Hi")<1915)) wire("config")->live_need_countdown = true;



//testing

//wire("config")->live = true;

//wire("config")->live_need_countdown = true;



if(isset($input->get->live))

{

    wire("config")->live = true;

}





// Intelligently truncate a string to a certain number of characters.

// Each uppercase or wider-than-normal character reduces the final length.



function truncate($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true) {

    if ($considerHtml) {

        // if the plain text is shorter than the maximum length, return the whole text

        if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {

            return $text;

        }

        // splits all html-tags to scanable lines

        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

        $total_length = strlen($ending);

        $open_tags = array();

        $truncate = '';

        foreach ($lines as $line_matchings) {

            // if there is any html-tag in this line, handle it and add it (un!emptyed) to the output

            if (!empty($line_matchings[1])) {

                // if it's an "empty element" with or without xhtml-conform closing slash

                if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {

                    // do nothing

                // if tag is a closing tag

                } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {

                    // delete tag from $open_tags list

                    $pos = array_search($tag_matchings[1], $open_tags);

                    if ($pos !== false) {

                    unset($open_tags[$pos]);

                    }

                // if tag is an opening tag

                } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {

                    // add tag to the beginning of $open_tags list

                    array_unshift($open_tags, strtolower($tag_matchings[1]));

                }

                // add html-tag to $truncate'd text

                $truncate .= $line_matchings[1];

            }

            // calculate the length of the plain text part of the line; handle entities as one character

            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));

            if ($total_length+$content_length> $length) {

                // the number of characters which are left

                $left = $length - $total_length;

                $entities_length = 0;

                // search for html entities

                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {

                    // calculate the real length of all entities in the legal range

                    foreach ($entities[0] as $entity) {

                        if ($entity[1]+1-$entities_length <= $left) {

                            $left--;

                            $entities_length += strlen($entity[0]);

                        } else {

                            // no more characters left

                            break;

                        }

                    }

                }

                $truncate .= substr($line_matchings[2], 0, $left+$entities_length);

                // maximum lenght is reached, so get off the loop

                break;

            } else {

                $truncate .= $line_matchings[2];

                $total_length += $content_length;

            }

            // if the maximum length is reached, get off the loop

            if($total_length>= $length) {

                break;

            }

        }

    } else {

        if (strlen($text) <= $length) {

            return $text;

        } else {

            $truncate = substr($text, 0, $length - strlen($ending));

        }

    }

    // if the words shouldn't be cut in the middle...

    if (!$exact) {

        // ...search the last occurance of a space...

        $spacepos = strrpos($truncate, ' ');

        if (isset($spacepos)) {

            // ...and cut the text in this position

            $truncate = substr($truncate, 0, $spacepos);

        }

    }

    // add the defined ending to the text

    $truncate .= $ending;

    if($considerHtml) {

        // close all unclosed html-tags

        foreach ($open_tags as $tag) {

            $truncate .= '</' . $tag . '>';

        }

    }



    // replace line breaks with spaces...

    //$truncate = str_replace('</p><p>', "  ", $truncate);

    //$truncate = str_replace('\r\n', "  ", $truncate);



    return $truncate;

}



if (!function_exists('debugUser')) {

function debugUser() {



        $ip = $_SERVER['REMOTE_ADDR'];

        $isDebugUser = false;



        switch ($ip) {

            case "192.168.10.70": // Ken

            case "192.168.10.71":

            case "192.168.10.72":

            case "192.168.10.73":

            case "192.168.10.74":

                $isDebugUser = true;

            break;



        /*  case "192.168.8.59": // Mark G.

            case "192.168.8.60":

            case "192.168.9.124":

                $isDebugUser = true;

            break;

        */



        }



        return $isDebugUser;

     }

}





function prependHTTP( $m )

{

    $mStr = $m[1].$m[2].$m[3];



    // if its an email address

    if( preg_match('#([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#', $mStr))

    {

        $email = $m[2].$m[3];

        return $email;

    }

    else

    {

        $http = (!preg_match("#(https://)#", $mStr)) ? 'http://' : 'https://';

        return "<a href=\"".$http.$m[3]."\" >".$m[1].$m[2].$m[3]."</a>";

    }

}







function make_links_blank($text)

{

    // urls

    return preg_replace_callback('#(?i)(http|https)?(://)?(([-\w^@]+\.)+(net|org|edu|ms|pl|com+)(?:/[^,.\s]*|))#','prependHTTP',$text);

}







function linkify($value, $protocols = array('http', 'mail'), array $attributes = array())

    {

        // Link attributes

        $attr = '';

        foreach ($attributes as $key => $val) {

            $attr = ' ' . $key . '="' . htmlentities($val) . '"';

        }



        $links = array();



        // Extract existing links and tags

        $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);



        // Extract text links for each protocol

        foreach ((array)$protocols as $protocol) {

            switch ($protocol) {

                case 'http':

                case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { if ($match[1]) $protocol = $match[1]; $link = $match[2] ?: $match[3]; return '<' . array_push($links, "<a $attr href=\"$protocol://$link\">$link</a>") . '>'; }, $value); break;

                case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;

                case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\">{$match[0]}</a>") . '>'; }, $value); break;

                default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;

            }

        }



        // Insert all link

        return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);

    }















if (!function_exists('encryptData')) {

function encryptData($SensitiveData = "", $Type = "CreditCard") {

        // Encrypt a string with AES-256 / CBC / ZeroBytePadding encryption



        $SecretKey['CreditCard'] = pack("H*", "59a99be795c5fe6cadbb3d813f099de459a99be795c5fe6cadbb3d813f099de4");



        $SecretKey['IV_Size'] = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC); // returns 16

        $IV = mcrypt_create_iv($SecretKey['IV_Size'], MCRYPT_RAND);

        $Cipher = base64_encode($IV . mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $SecretKey[$Type], $SensitiveData, MCRYPT_MODE_CBC, $IV));



        return $Cipher;



    }

}



if (!function_exists('decryptData')) {

    function decryptData($Cipher, $Type = "CreditCard") {

        // Decrypt a string with AES-256 / CBC / ZeroBytePadding encryption



        $SecretKey['CreditCard'] = pack("H*", "59a99be795c5fe6cadbb3d813f099de459a99be795c5fe6cadbb3d813f099de4");



        $SecretKey['IV_Size'] = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC); // returns 16

        $Cipher = base64_decode($Cipher);

        $SensitiveData = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $SecretKey[$Type], substr($Cipher, $SecretKey['IV_Size']), MCRYPT_MODE_CBC, substr($Cipher, 0, $SecretKey['IV_Size']));



        $SensitiveData = str_replace("\\0", "", $SensitiveData);                // remove possible padding

        $SensitiveData = preg_replace("/[^a-zA-Z0-9\s]/", "", $SensitiveData);  // remove any invalid characters



        return $SensitiveData;



    }

}

?>