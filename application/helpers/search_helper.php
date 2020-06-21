<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * CodeIgniter Hr Helpers
 *
 * @package        CodeIgniter
 * @subpackage    Helpers
 * @category    Helpers
 * @author        Ranjeet Singh
 * @company     Tekshapers Inc
 * @since        Version 1.0
 */

// ------------------------------------------------------------------------
function stringmodifyifsinglequotes($string)
{
    $totalcount = substr_count($string, "'");

    if ($totalcount % 2 == 0) {
        //it means even no of braces are there
        //echo "even no of braces are there";
    } else {
        //it means odd no of braces so remove last occurence
        $search = "'";
        $replace = '';
        $string = strrev(implode(strrev($replace), explode($search, strrev($string), 2)));
    }

    $pattern = "'";
    $start = 0;
    $arraycontainingallpositions = array();
    while (($newLine = strpos($string, $pattern, $start)) !== false) {
        $start = $newLine + 1;
        $newLine . '<br>';
        $arraycontainingallpositions[] = $newLine;
    }

    for ($i = 0; $i < count($arraycontainingallpositions); $i++) {

        if ($i % 2 == 0) {
            $nowstring = updateChar($string, '(', $arraycontainingallpositions[$i]);
        } else {
            $nowstring = updateChar($string, ')', $arraycontainingallpositions[$i]);
        }

        $string = $nowstring;

    }
    return $string;

}

function stringmodifyifdoublequotes($string)
{
    $totalcount = substr_count($string, '"');

    if ($totalcount % 2 == 0) {
        //it means even no of braces are there
        //echo "even no of braces are there";
    } else {
        //it means odd no of braces so remove last occurence
        $search = '"';
        $replace = '';
        $string = strrev(implode(strrev($replace), explode($search, strrev($string), 2)));
    }

    $pattern = '"';
    $start = 0;
    $arraycontainingallpositions = array();
    while (($newLine = strpos($string, $pattern, $start)) !== false) {
        $start = $newLine + 1;
        $newLine . '<br>';
        $arraycontainingallpositions[] = $newLine;
    }

    for ($i = 0; $i < count($arraycontainingallpositions); $i++) {

        if ($i % 2 == 0) {
            $nowstring = updateChar($string, '(', $arraycontainingallpositions[$i]);
        } else {
            $nowstring = updateChar($string, ')', $arraycontainingallpositions[$i]);
        }

        $string = $nowstring;

    }
    return $string;

}

function updateChar($str, $char, $offset)
{

    if (!isset($str[$offset])) {
        return false;
    }

    $str[$offset] = $char;

    return $str;

}

function ran_mark_atomshr($string)
{
    $result = trim($string);
    $result = preg_replace("/([[:space:]]{2,})/", ' ', $result);

    /* convert normal boolean operators to shortened syntax */
    $result = str_replace(' not ', ' -', $result);
    $result = str_replace(' and ', ' ', $result);
    $result = str_replace(' or ', ',', $result);

    $result = str_replace(' NOT ', ' -', $result);
    $result = str_replace(' AND ', ' ', $result);
    $result = str_replace(' OR ', ',', $result);

    //$result=preg_replace(' or ',',',$result);

    /* strip excessive whitespace */
    $result = str_replace('( ', '(', $result);
    $result = str_replace(' )', ')', $result);
    $result = str_replace(', ', ',', $result);
    $result = str_replace(' ,', ',', $result);
    $result = str_replace('- ', '-', $result);

    //added ranjeet
    $result = str_replace('+ ', '+', $result); //added on 9sept
    // $result=str_replace('"', "", $result);
    //$result=str_replace("'", "", $result);

//echo $result.'<br>';
    /* apply arbitrary function to all 'word' atoms */
    $result = preg_replace(
        "/([A-Za-z0-9\.]{1,}[A-Za-z0-9\.\#\_-]{0,})/",
        "foo[('$0')]bar",
        $result);

    // echo $result;

//exit;

    /* strip empty or erroneous atoms */
    $result = str_replace("foo[('')]bar", '', $result);
    $result = str_replace("foo[('-')]bar", '-', $result);

    /* add needed space */
    $result = str_replace(')foo[(', ') foo[(', $result);
    $result = str_replace(')]bar(', ')]bar (', $result);

    /* dispatch ' ' to ' AND ' */
    $result = str_replace(' ', ' AND ', $result);

    /* dispatch ',' to ' OR ' */
    $result = str_replace(',', ' OR ', $result);

    /* dispatch '-' to ' NOT ' */
    $result = str_replace(' -', ' NOT ', $result);

    /* dispatch '+' to '' */
    $result = str_replace(' +', '', $result); //added on 9sept

    return $result;
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *     function used to transform identified atoms into mysql
 *    parseable boolean fulltext sql string; allows for
 *    nesting by letting the mysql boolean parser evaluate
 *    grouped statements
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 
function ran_sql_wherehr($string, $match)
{
    
	$string = str_replace('or', ' ', $string);
	$string = str_replace('OR', ' ', $string);
	$string = str_replace('and', '+', $string);
	$string = str_replace('AND', '+', $string);
	$string = str_replace('not', '-', $string);
	$string = str_replace('NOT', '-', $string);
	$string = str_replace('+ ', '+', $string);
	$string = str_replace('- ', '-', $string);
	
	
	return " MATCH (" . $match . ") AGAINST ('+" . $string . "' IN BOOLEAN MODE) ";
	//echo $string;exit;
}
 
function ran_sql_wherehr_live($string, $match)
{
    //echo $string;exit;
    $result = ran_mark_atomshr($string);

    /* dispatch 'foo[(#)]bar to actual sql involving (#) */
    $result = preg_replace("/foo\[\(\'([^\.\)]{4,})\'\)\]bar/", " match ($match) against ('$1' IN BOOLEAN MODE) ", $result);

    $result = preg_replace_callback("/foo\[\(\'([^\)]{1,})\'\)\]bar/", function ($match) {return $match[1];}, $result);
    $result = ran_sql_where_shorthr($string, $match);
    //$result=ran_sql_where_shorthr("$result","$match");
    //echo $result;exit;
    //echo $result;   exit;

    //echo $result;exit;
    return $result;
    return "( " . $match . " LIKE '%" . $string . "%' )";
}

function ran_sql_wherehr_new($string, $match)
{
    //echo $string;exit;
    $result = ran_mark_atomshr($string);
    /* dispatch 'foo[(#)]bar to actual sql involving (#) */
    /*$result=preg_replace(
    "/foo\[\(\'([^\.\)]{4,})\'\)\]bar/e",
    " match ($match) against ('$1' IN BOOLEAN MODE) ",
    $result);*/
    //echo $match;exit;
    $result = preg_replace_callback("/foo\[\(\'([^\.\)]{4,})\'\)\]bar/", function ($match) {return " match ($match) against ('$1' IN BOOLEAN MODE) ";}, $result);
    //echo $result;   exit;
    //echo $match.'sumit'.$result;   exit;
    /*$result=preg_replace(
    "/foo\[\(\'([^\)]{1,})\'\)\]bar/e",
    " '('.ran_sql_where_shorthr(\"$1\",\"$match\").')' ",
    $result);*/

    $result = preg_replace_callback("/foo\[\(\'([^\)]{1,})\'\)\]bar/", function ($match) {return $match[1];}, $result);
    $result = ran_sql_where_shorthr($string, $match);
    //$result=ran_sql_where_shorthr("$result","$match");
    //echo $result;exit;
    //echo $result;   exit;

//echo $result;exit;
    return $result;
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *    parses short words <4 chars into proper SQL: special adaptive
 *    case to force return of records without using fulltext index
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function ran_sql_where_shorthr($string, $match)
{
    // echo $string.'aa';exit;
    $match_a = explode(',', $match);
    for ($ith = 0; $ith < count($match_a); $ith++) {
        $like_a[$ith] = " $match_a[$ith] LIKE '%$string%' ";
    }
    $like = implode(" OR ", $like_a);

    return $like;
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *    function used to transform a boolean search string into a
 *    mysql parseable fulltext sql string used to determine the
 *    relevance of each record;
 *    1. put all subject words into array
 *    2. enumerate array elements into scoring sql syntax
 *    3. return sql string
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function ran_sql_selecthr($string, $match)
{

    /* build sql for determining score for each record */
    preg_match_all(
        "([A-Za-z0-9\.]{1,}[A-Za-z0-9\-\.\#\_]{0,})",
        $string,
        $result);
    $result = $result[0];
    //pr(count($result));die;
    $stringsum_long = '';
    $stringsum = '';
    for ($cth = 0; $cth < count($result); $cth++) {
        if (strlen($result[$cth]) >= 15) {
            //echo "ddd";exit;
            $stringsum_long .=
                " $result[$cth] ";
        } else {
            //echo "sss";exit;
            $stringsum_a[] =
            ' ' . ran_sql_select_shorthr($result[$cth], $match) . ' ';
        }
    }
    if (strlen($stringsum_long) > 0) {
        $stringsum_a[] = " match ($match) against ('$stringsum_long') ";
    }
    $stringsum .= implode("+", $stringsum_a);
    //echo $stringsum;die;
    return $stringsum;
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *    parses short words <4 chars into proper SQL: special adaptive
 *    case to force 'scoring' of records without using fulltext index
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function ran_sql_select_shorthr($string, $match)
{

    $match_a = explode(',', $match);
    $score_unit_weight = .2;
    for ($ith = 0; $ith < count($match_a); $ith++) {
        $score_a[$ith] =
            " $score_unit_weight*(
			LENGTH($match_a[$ith]) -
			LENGTH(REPLACE(LOWER($match_a[$ith]),LOWER('$string'),'')))
			/LENGTH('$string') ";
    }
    $score = implode(" + ", $score_a);
    // echo $score.'<br/>';
    return $score;
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *    returns only inclusive atoms within boolean statement
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function ran_inclusive_atomshr($string)
{

    $result = trim($string);
    $result = preg_replace("/([[:space:]]{2,})/", ' ', $result);

    /* convert normal boolean operators to shortened syntax */
    /*$result=eregi_replace(' not ',' -',$result);
    $result=eregi_replace(' and ',' ',$result);
    $result=eregi_replace(' or ',',',$result);*/

    $result = str_replace(' not ', ' -', $result);
    $result = str_replace(' and ', ' ', $result);
    $result = str_replace(' or ', ',', $result);

    $result = str_replace(' NOT ', ' -', $result);
    $result = str_replace(' AND ', ' ', $result);
    $result = str_replace(' OR ', ',', $result);

    /* drop unnecessary spaces */
    $result = str_replace(' ,', ',', $result);
    $result = str_replace(', ', ',', $result);
    $result = str_replace('- ', '-', $result);
    $result = str_replace('+ ', '+', $result); //added on 9sept

    /* strip exlusive atoms */
    $result = preg_replace(
        "(\-\([A-Za-z0-9\.]{1,}[A-Za-z0-9\-\_\,]{0,}\))",
        '',
        $result);
    $result = preg_replace(
        "(\-[A-Za-z0-9\.]{1,}[A-Za-z0-9\-\_]{0,})",
        '',
        $result);

    $result = str_replace('(', ' ', $result);
    $result = str_replace(')', ' ', $result);
    $result = str_replace(',', ' ', $result);

    //added
    $result = str_replace('"', "", $result);
    $result = str_replace("'", "", $result);

    return $result;
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *    returns the equivalent boolean statement in user readable form
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function ran_parsed_ashr($string)
{
    $result = ran_mark_atomshr($string);

    /* dispatch 'foo[(%)]bar' to empty string */
    $result = str_replace("foo[('", "", $result);
    $result = str_replace("')]bar", "", $result);

    return $result;
}

/*****************************************************************/
function bq_handle_shorthand($text)
{
    $text = preg_replace("/ \+/", " and ", $text);
    $text = preg_replace("/ -/", " not ", $text);
    return $text;
}

/****************************************************************/

/*********************************************************************/
