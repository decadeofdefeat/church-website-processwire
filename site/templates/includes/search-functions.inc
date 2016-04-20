<?php



function notIncluding( $q )
{
   return  preg_replace('/(\s+[\S\.])+(\s)/','$2', preg_replace('/(^|\s+)(\w{1,3}|\S{1,3})\s*([^@\w\.-]|$)/','$3',$q));
}

function neat_trim($str, $n, $delim='…') {
   $len = strlen($str);
   if ($len > $n) {
       preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
       return rtrim($matches[1]) . $delim;
   }
   else {
       return $str;
   }
}

function truncatePreserveWords ($h,$n,$w=5,$tag='b') {
    $original_text = $h;
    $n = explode(" ",trim(strip_tags($n))); //needles words
    $b = explode(" ",trim(strip_tags($h))); //haystack words
    $c = array();                       //array of words to keep/remove
    for ($j=0;$j<count($b);$j++) $c[$j]=false;
    for ($i=0;$i<count($b);$i++)
        for ($k=0;$k<count($n);$k++)
            if (stristr($b[$i],$n[$k])) {
                $b[$i]=preg_replace("/".$n[$k]."/i","<$tag>\\0</$tag>",$b[$i]);
                for ( $j= max( $i-$w , 0 ) ;$j<min( $i+$w, count($b)); $j++) $c[$j]=true;
            }
    $o = "";    // reassembly words to keep
    for ($j=0;$j<count($b);$j++) if ($c[$j]) $o.=" ".$b[$j]; else $o.=".";

    $returnValue = preg_replace("/\.{3,}/i","...",$o);
    if($returnValue == "...") {
        $delim='...';
       $len = strlen($original_text);
       $nn = 224;
       if ($len > $nn) {
           preg_match('/(.{' . $nn . '}.*?)\b/', $original_text, $matches);
           $matchSet = isset($matches[1]) ? $matches[1] : "";
           return rtrim($matchSet) . $delim;
       }
       else {
           return $str;
       }


        $returnValue = neat_trim($h);
    }

    $returnArray = explode("... ", $returnValue);

    $returnValueMin8 = '';
    $xx = 0;
    foreach ($returnArray as $key => $value) {

       //print "<br><br>".$value;
       //print "<br>".$xx;
      if($xx <6)
      {
        if( $value != '')
          $returnValueMin8 .= "... ".$value." ";

        if( $xx == 5) $returnValueMin8 .= " ...";
      }
      $xx++;
    }

    return $returnValueMin8;
}



function isDate( $str )
{

    $formats = array("m.d.Y", "m/d/Y", "m d Y", "m d, Y", "Y-m-d", "m-d-Y",
      "m.d.y", "m/d/y", "m d y", "m d, y", "m-d-y",
      "n.j.Y", "n/j/Y", "n j Y", "n j, Y", "Y-n-j", "n-j-Y",
      "n.j.y", "n/j/y", "n j y", "n j, y",  "n-j-y", "n/j", "n-j","n-d", "n-d-y","n-d-Y", "n/d",
      "l F j Y",  "l F j, Y", "l F jS, Y",  "l F jS", "l F j y", "l F j, y", "l F j",
      "l M j Y", "l M j, Y", "l M j y", "l M j, y", "l M j",
      "M j Y", "M j y",
      "M j",
      "F j, Y", "F j", "F j Y", "F j y", "F jS, Y", "F jS Y",  "F j, y", "F jS, y", "F jS y", "F jS"
      );


    if( strlen($str) < 5 ) return "false";

    $doNothing = true;

    $str = ucwords($str);

    foreach ($formats as $format)
    {
      $date = DateTime::createFromFormat($format, $str);
      if ($date == false || !(date_format($date,$format) == $str) )
       $doNothing = true;
      else
       return "true";
    }


    return "false";
}




?>