<?php

/**
 * @author  FlipZoom Media Inc. - David Karich
 * @contact David Karich <david.karich@flipzoom.de>
 * @website www.flipzoom.de
 * @create  2013-12-21
 * @style   Tab size: 4 / Soft tabs: YES
 * ----------------------------------------------------------------------------------
 * @licence
 * Copyright (c) 2013 FlipZoom Media Inc. - David Karich
 * Permission is hereby granted, free of charge, to any person obtaining a copy 
 * of this software and associated documentation files (the "Software"), to deal 
 * in the Software without restriction, including without limitation the rights 
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell 
 * copies of the Software, and to permit persons to whom the Software is furnished 
 * to do so, subject to the following conditions: The above copyright notice and 
 * this permission notice shall be included in all copies or substantial portions 
 * of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION 
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * ----------------------------------------------------------------------------------
 *
 * Inspiration for this class
 * ------------------------------------------------------------------------
 * @see Yahoo! YUI PHP-Port https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port
 * @see http://staticfloat.com/php-programmieren/php-css-minifier-klasse-css-dateien-komprimieren-und-vereinen/
 * @see https://code.google.com/p/minify/
 * -------------------------------------------------------------------------
 */

/**
 * ------------------------------------------------------------------------
 * CSS minimize class
 * ------------------------------------------------------------------------
 * CssMin is a css minfier. It minifies css by removing unneeded whitespace 
 * character, comments, empty blocks and empty declarations. In addition 
 * declaration values can get rewritten to shorter notation if available.
 */
class CssMin {

    /**
     * ------------------------------------------------------------------------
     * Split CSS string into separate chunks, minimize each and return the 
     * composed string.
     * ------------------------------------------------------------------------
     * @param  string $css     The CSS code is to be minimized.
     * @return string          The minimized CSS code.
     */
    public static function minify($css) {

        // ------------------------------------------------------------------------
        // Let's divide css code in chunks of 5.000 chars aprox.
        // Reason: PHP's PCRE functions like preg_replace have a "backtrack limit"
        // of 100.000 chars by default (php < 5.3.7) so if we're dealing with really
        // long strings and a (sub)pattern matches a number of chars greater than
        // the backtrack limit number (i.e. /(.*)/s) PCRE functions may fail silently
        // returning NULL and $css would be empty.
        // ------------------------------------------------------------------------
        $charset            = '';
        $charset_regexp     = '/(@charset)( [^;]+;)/i';
        $css_chunks         = array();
        $css_chunk_length   = 5000; // aprox size, not exact
        $start_index        = 0;
        $i                  = $css_chunk_length; // save initial iterations
        $l                  = strlen($css);

        // ------------------------------------------------------------------------
        // If the number of characters is 5000 or less, do not chunk
        // ------------------------------------------------------------------------
        if ($l <= $css_chunk_length) {
            $css_chunks[] = $css;

        } else {

            // ------------------------------------------------------------------------
            // Chunk css code securely
            // -------------------------------------------------------------------------
            while ($i < $l) {

                $i += 50; // save iterations

                if ($l - $start_index <= $css_chunk_length || $i >= $l) {
                    $css_chunks[] = self::str_slice($css, $start_index);
                    break;
                }

                if ($css[$i - 1] === '}' && $i - $start_index > $css_chunk_length) {
                    
                    // ------------------------------------------------------------------------
                    // If there are two ending curly braces }} separated or not by spaces,
                    // join them in the same chunk (i.e. @media blocks)
                    // ------------------------------------------------------------------------
                    $next_chunk = substr($css, $i);

                    if (preg_match('/^\s*\}/', $next_chunk)) {
                        $i = $i + self::index_of($next_chunk, '}') + 1;
                    }

                    $css_chunks[]   = self::str_slice($css, $start_index, $i);
                    $start_index    = $i;
                }
            }
        }

        // ------------------------------------------------------------------------
        // Minify each chunk
        // ------------------------------------------------------------------------
        for ($i = 0, $n = count($css_chunks); $i < $n; $i++) {
            
            $css_chunks[$i] = self::_minify($css_chunks[$i]);

            // ------------------------------------------------------------------------
            // Keep the first @charset at-rule found
            // ------------------------------------------------------------------------
            if (empty($charset) && preg_match($charset_regexp, $css_chunks[$i], $matches)) {
                $charset = strtolower($matches[1]).$matches[2];
            }

            // ------------------------------------------------------------------------
            // Delete all @charset at-rules
            // ------------------------------------------------------------------------
            $css_chunks[$i] = preg_replace($charset_regexp, '', $css_chunks[$i]);
        }

        // ------------------------------------------------------------------------
        // Update the first chunk and push the charset to the top of the file.
        // ------------------------------------------------------------------------
        $css_chunks[0] = $charset.$css_chunks[0];

        // ------------------------------------------------------------------------
        // Return the minimized string.
        // ------------------------------------------------------------------------
        return implode('', $css_chunks);
    }

    /**
     * ------------------------------------------------------------------------
     * Minimizing the CSS code.
     * ------------------------------------------------------------------------
     * @param  string $_source The CSS code is to be minimized.
     * @return string          The minimized CSS code.
     */
    protected static function _minify($_source) {

        // ------------------------------------------------------------------------
        // Shorten hex ​​values​​. For example, #ff0000 to #f00.
        // ------------------------------------------------------------------------
        $_source = preg_replace('/(?<![\'"])#([0-9a-z])\\1([0-9a-z])\\2([0-9a-z])\\3(?![\'"])/i', '#$1$2$3', $_source);

        // ------------------------------------------------------------------------
        // Remove all comments.
        // ------------------------------------------------------------------------
        $_source = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $_source);

        // ------------------------------------------------------------------------
        // Remove the last semicolon within a block.
        // ------------------------------------------------------------------------
        $_source = preg_replace('/;?\s*}/', '}', $_source);

        // ------------------------------------------------------------------------
        // Remove any white space after a colon, comma, semicolon or a bracket.
        // ------------------------------------------------------------------------
        $_source = preg_replace('/\s*([\{:;,])\s*/', '$1', $_source);

        // ------------------------------------------------------------------------
        // Remove white space at the beginning and at the end.
        // ------------------------------------------------------------------------
        $_source = preg_replace('/^\s*|\s*$/m', '', $_source);

        // ------------------------------------------------------------------------
        // Remove all line breaks.
        // ------------------------------------------------------------------------
        $_source = preg_replace('/\n/', '', $_source);

        // ------------------------------------------------------------------------
        // Preserve empty comment after '>'
        // @see http://www.webdevout.net/css-hacks#in_css-selectors
        // ------------------------------------------------------------------------
        $_source = preg_replace('@>/\\*\\s*\\*/@', '>/*keep*/', $_source);
         
        // ------------------------------------------------------------------------
        // Preserve empty comment between property and value.
        // @see http://css-discuss.incutio.com/?page=BoxModelHack
        // ------------------------------------------------------------------------
        $_source = preg_replace('@/\\*\\s*\\*/\\s*:@', '/*keep*/:', $_source);
        $_source = preg_replace('@:\\s*/\\*\\s*\\*/@', ':/*keep*/', $_source);

        // ------------------------------------------------------------------------
        // Prevent triggering IE6 bug. 
        // @see http://www.crankygeek.com/ie6pebug/
        // ------------------------------------------------------------------------
        $_source = preg_replace('/:first-l(etter|ine)\\{/', ':first-l$1 {', $_source);

        // ------------------------------------------------------------------------
        // Remove empty blocks.
        // ------------------------------------------------------------------------
        $_source = preg_replace('/}[^\/}]+{}/', '}', $_source);

        // ------------------------------------------------------------------------
        // Replace positive sign from numbers preceded by : or a white-space before the leading space is removed
        // +1.2em to 1.2em, +.8px to .8px, +2% to 2%
        // ------------------------------------------------------------------------
        $_source = preg_replace('/((?<!\\\\)\:|\s)\+(\.?\d+)/S', '$1$2', $_source);

        // ------------------------------------------------------------------------
        // Remove leading zeros from integer and float numbers preceded by : or a 
        // white-space: 000.6 to .6, -0.8 to -.8, 0050 to 50, -01.05 to -1.05
        // ------------------------------------------------------------------------
        $_source = preg_replace('/((?<!\\\\)\:|\s)(\-?)0+(\.?\d+)/S', '$1$2$3', $_source);

        // ------------------------------------------------------------------------
        // Remove trailing zeros from float numbers preceded by : or a white-space
        // -6.0100em to -6.01em, .0100 to .01, 1.200px to 1.2px
        // ------------------------------------------------------------------------
        $_source = preg_replace('/((?<!\\\\)\:|\s)(\-?)(\d?\.\d+?)0+([^\d])/S', '$1$2$3$4', $_source);

        // ------------------------------------------------------------------------
        // Remove trailing .0 -> -9.0 to -9
        // ------------------------------------------------------------------------
        $_source = preg_replace('/((?<!\\\\)\:|\s)(\-?\d+)\.0([^\d])/S', '$1$2$3', $_source);

        // ------------------------------------------------------------------------
        // Replace 0 length units 0(px,em,%) with 0.
        // ------------------------------------------------------------------------
        $_source = preg_replace('/(?<!transition-delay:|transition-duration:|animation-delay:|ease|ease-in|ease-out|linear|step-start|step-end|steps|cubic-bezier|transition:all|transition:margin|transition:top|transition:right|transition:bottom|transition:left|transition:width|transition:height|transition:background|transition:background-image|transition:background-position)(^|[^0-9])(?:0?\.)?0(?:em|ex|ch|rem|vw|vh|vm|vmin|cm|mm|in|px|pt|pc|%|deg|g?rad|m?s|k?hz)/iS', '${1}0', $_source);

        // ------------------------------------------------------------------------
        // 0% step in a keyframe? restore the % unit
        // ------------------------------------------------------------------------
        $_source = preg_replace_callback('/(@[a-z\-]*?keyframes[^\{]*?\{)(.*?\}\s*\})/iS', 'self::replace_keyframe_zero', $_source);

        // ------------------------------------------------------------------------
        // Replace 0 0; or 0 0 0; or 0 0 0 0; with 0.
        // ------------------------------------------------------------------------
        $_source = preg_replace('/\:0(?: 0){1,3}(;|\}| \!)/', ':0$1', $_source);

        // ------------------------------------------------------------------------
        // Replace text-shadow:0; with text-shadow:0 0 0;
        // ------------------------------------------------------------------------
        $_source = preg_replace('/(text-shadow\:0)(;|\}| \!)/i', '$1 0 0$2', $_source);

        // ------------------------------------------------------------------------
        // Replace background-position:0; with background-position:0 0;
        // same for transform-origin | Changing -webkit-mask-position: 0 0 to just 
        // a single 0 will result in the second parameter defaulting to 50% (center)
        // ------------------------------------------------------------------------
        $_source = preg_replace('/(background\-position|webkit-mask-position|(?:webkit|moz|o|ms|)\-?transform\-origin)\:0(;|\}| \!)/iS', '$1:0 0$2', $_source);

        // ------------------------------------------------------------------------
        // Replace border: none to border:0, outline: none to outline:0
        // ------------------------------------------------------------------------
        $_source = preg_replace('/(border\-?(?:top|right|bottom|left|)|outline)\:none(;|\}| \!)/iS', '$1:0$2', $_source);

        // ------------------------------------------------------------------------
        // Put the space back in some cases, to support stuff like
        // @media screen and (-webkit-min-device-pixel-ratio:0){
        // ------------------------------------------------------------------------
        $_source = preg_replace('/\band\(/i', 'and (', $_source);

        // ------------------------------------------------------------------------
        // Shorter opacity IE filter
        // ------------------------------------------------------------------------
        $_source = preg_replace('/progid\:DXImageTransform\.Microsoft\.Alpha\(Opacity\=/i', 'alpha(opacity=', $_source);

        // ------------------------------------------------------------------------
        // Replace multiple semi-colons in a row by a single one
        // ------------------------------------------------------------------------
        $_source = preg_replace('/;;+/', ';', $_source);

        // ------------------------------------------------------------------------
        // Lowercase all uppercase properties
        // ------------------------------------------------------------------------
        $_source = preg_replace_callback('/(\{|\;)([A-Z\-]+)(\:)/', 'self::lowercase_properties', $_source);

        // ------------------------------------------------------------------------
        // Subsequent improvements with Find and Replace.
        // ------------------------------------------------------------------------
        $search  = array(' !important', ' > ', ' + ', ', ');
        $replace = array('!important', '>', '+', ',');
        $_source = str_ireplace($search, $replace, $_source);
        
        // ------------------------------------------------------------------------
        // Return the minimized string.
        // ------------------------------------------------------------------------
        return trim($_source);
    }

    /**
     * ------------------------------------------------------------------------
     * 0% step in a keyframe? restore the % unit.
     * ------------------------------------------------------------------------
     * @param  array  $matches Regex-Result-Array
     * @return string          Restored string
     */
    protected static function replace_keyframe_zero($matches) {
        return $matches[1].preg_replace('/0\s*,/', '0%,', preg_replace('/\s*0\s*\{/', '0%{', $matches[2]));
    }

    /**
     * ------------------------------------------------------------------------
     * Convert all Properties to lowercase.
     * ------------------------------------------------------------------------
     * @param  array  $matches Regex-Result-Array
     * @return string          Converted string
     */
    protected static function lowercase_properties($matches) {
        return $matches[1].strtolower($matches[2]).$matches[3];
    }

    /**
     * ------------------------------------------------------------------------
     * PHP port of Javascript's "slice" function for strings only
     * Author: Tubal Martin http://blog.margenn.com
     * Tests: http://margenn.com/tubal/str_slice/
     * ------------------------------------------------------------------------
     * @param  string   $str
     * @param  int      $start index
     * @param  int|bool $end index (optional)
     * @return string
     */
    protected static function str_slice($str, $start = 0, $end = false) {
        
        if ($end !== false && ($start < 0 || $end <= 0)) {
            
            $max = strlen($str);

            if ($start < 0) {
                if (($start = $max + $start) < 0) {
                    return '';
                }
            }

            if ($end < 0) {
                if (($end = $max + $end) < 0) {
                    return '';
                }
            }

            if ($end <= $start) {
                return '';
            }
        }

        $slice = ($end === false) ? substr($str, $start) : substr($str, $start, $end - $start);
        return ($slice === false) ? '' : $slice;
    }

    /**
     * ------------------------------------------------------------------------
     * PHP port of Javascript's "indexOf" function for strings only
     * Author: Tubal Martin http://blog.margenn.com
     * ------------------------------------------------------------------------
     * @param  string $haystack
     * @param  string $needle
     * @param  int    $offset index (optional)
     * @return int
     */
    protected static function index_of($haystack, $needle, $offset = 0) {
        $index = strpos($haystack, $needle, $offset);
        return ($index !== false) ? $index : -1;
    }
}
?>
