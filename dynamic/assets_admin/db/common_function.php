<?php
include_once("connection.php");
function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

function getFieldValue($table,$field,$id)
{
    $db = $GLOBALS['db'];
    $stmt = $db->prepare("SELECT $field FROM $table where id = :id"); 
    $stmt->bindParam("id", $id,PDO::PARAM_STR) ;
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row[$field];
    
}
function updateValue($table,$field,$value,$id)
{
    $db = $GLOBALS['db'];
    $sql = "UPDATE $table SET $field = $value WHERE id =".$id;
    // use exec() because no results are returned in insert data
    $db->exec($sql);
}

function isExistValue($table,$field,$email)
{
	$db = $GLOBALS['db'];
	$stmt = $db->prepare("SELECT $field FROM $table where email = :email"); 
	$stmt->bindParam("email", $email,PDO::PARAM_STR) ;
    $stmt->execute();
    return $stmt->rowCount();
	
}
function dateFormat($date)
{
    $date = explode("-", $date);
    return $date[2]."/".$date[1]."/".$date[0];
}
function pagination($rowcount,$url,$perpage)
{
	if($rowcount>$perpage)
    { 
    	$perpage = ceil($rowcount/$perpage);
    	if(isset($_REQUEST['page']) && $_REQUEST['page']!='')
    	{
    		$j = $_REQUEST['page'];
    	}else{$j =1;}

    	if(isset($_REQUEST['page']) && $_REQUEST['page']==$perpage)
		{
			$pdisabled = "";
			$ndisabled = "disabled";
			$purl = $url."?page=".($_REQUEST['page']-1);
			$nurl = "javascript:void(0)";
		}
        else if(isset($_REQUEST['page']) && $_REQUEST['page']==2)
        {
            $pdisabled = "";
            $ndisabled = "";
            $purl = $url;
            $nurl = $url."?page=".($_REQUEST['page']+1);
        }
        else if(isset($_REQUEST['page']) && $_REQUEST['page']<$perpage)
        {
            $pdisabled = "";
            $ndisabled = "";
            $purl = $url."?page=".($_REQUEST['page']-1);
            $nurl = $url."?page=".($_REQUEST['page']+1);
        }
		else
		{
			$pdisabled = "disabled";
			$ndisabled = "";
			$purl = "javascript:void(0)";
			$nurl = $url."?page=2";
		}
		// echo "$purl";
		// echo "$nurl";
        echo "<nav>";
            echo "<ul class='pagination pagination-sm'>";
                echo "<li class='".$pdisabled."'><a href='".$purl."' aria-label='Previous'><span aria-hidden='true'>«</span></a></li>";

                for ($i=1; $i <= $perpage; $i++) { 
                	
                    if($i==$j)
                    {
                        $active = "active";
                        $active_url = "javascript:void(0)";
                    }
                	else
            		{
            			$active="";
            			$active_url = $url."?page=$i";
            		}
                	
                    echo "<li class='".$active."'><a href='".$active_url."'>$i <span class='sr-only'>(current)</span></a></li>";
                }
                echo "<li class='".$ndisabled."' ><a href='".$nurl."' aria-label='Next'><span aria-hidden='true'>»</span></a></li>";
            echo "</ul>";
        echo "</nav>";
	} 
}
function uri_segment($segment)
{
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    // When the current URL is http://www.example.com/codex/foo/bar.
    //echo $uriSegments[1]; //returns codex
    //echo $uriSegments[2]; //returns foo
    //echo $uriSegments[3]; //returns bar
    return $uriSegments[$segment];
}