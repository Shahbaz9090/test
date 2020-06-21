<style>
.pagination {
  display: inline-block;
  padding-left: 0;
  margin:0px;
  border-radius: 4px;
}

.pagination > li {
  display: inline;
}

.pagination > li > a,
.pagination > li > span {
  position: relative;
  float: left;
  padding: 6px 12px;
  margin-left: -1px;
  line-height: 1.428571429;
  text-decoration: none;
  background-color: #ffffff;
  border: 1px solid #dddddd;
}

.pagination > li:first-child > a,
.pagination > li:first-child > span {
  margin-left: 0;
  border-bottom-left-radius: 4px;
  border-top-left-radius: 4px;
}

.pagination > li:last-child > a,
.pagination > li:last-child > span {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

.pagination > li > a:hover,
.pagination > li > span:hover,
.pagination > li > a:focus,
.pagination > li > span:focus {
  background-color: #eeeeee;
}

.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus {
  z-index: 2;
  color: #ffffff;
  cursor: default;
  background-color: #428bca;
  border-color: #428bca;
}

.pagination > .disabled > span,
.pagination > .disabled > span:hover,
.pagination > .disabled > span:focus,
.pagination > .disabled > a,
.pagination > .disabled > a:hover,
.pagination > .disabled > a:focus {
  color: #999999;
  cursor: not-allowed;
  background-color: #ffffff;
  border-color: #dddddd;
}



.pagination-sm > li > a,
.pagination-sm > li > span {
  padding: 5px 10px;
  font-size: 12px;
}

.pagination-sm > li:first-child > a,
.pagination-sm > li:first-child > span {
  border-bottom-left-radius: 3px;
  border-top-left-radius: 3px;
}

.pagination-sm > li:last-child > a,
.pagination-sm > li:last-child > span {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
.pagination a {
    background: -moz-linear-gradient(center top , rgba(255, 255, 255, 1) 1%, rgba(243, 243, 243, 1) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #c4c4c4;
    border-radius: 2px;
    box-shadow: 0 1px 0 #eaeaea, 0 1px 0 #fff inset;
    color: #717171;
    cursor: pointer;
    display: inline-block;
    float: left;
    font-weight: normal;
    line-height: 28px;
    margin-bottom: 0;
    margin-right: 0;
    min-height: 16px;
    padding: 0 14px;
    text-decoration: none;
}
.pagination a:hover{border:1px solid #c4c4c4; }
</style>


<?php			    
	$adjacents = 1;	
	$counter=1;
	$page=$page_offset;
	if($page) 
		$start = ($page - 1) * $limit; //first item to display on this page
	else
		$start = 0;//if no page var is given, set start to 0
	
	/* Setup page vars for display. */

	if ($page == 0) $page = 1;        //if no page var is given, default to 1.
	$prev = $page - 1;	              //previous page is page - 1
	$next = $page + 1;			
	$lastpage = ceil($total/$limit);		//lastpage is = total pages / items per page, rounded up.
	$total_pages = $total;
	$pagination = "";
	if($lastpage > 1)
	{
		//previous button
		$pagination.= "<div class='row dataTables_paginate'>";
		$pagination.= "<ul class='pagination pagination-sm' >";

		if ($page > 1) 
			$pagination.= "<li><a onclick='changePagination($prev)'>&laquo;</a>&nbsp;</li>";

		if ($lastpage < 2 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li><a  class='active_pg'>$counter</a></li>";
				else
					$pagination.= "<li><a onclick='changePagination($counter)'>$counter</a></li>";					
			}
		}elseif ($lastpage < 6 ) {	
			if($page==1){
				for ($counter = 1; $counter < 1+($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><a>$counter</a></li>";
					else
						$pagination.= "<li><a onclick='changePagination($counter)'>$counter</a></li>";					
				}
			}
			elseif($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 2 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><a>$counter</a></li>";
					else
						$pagination.= "<li><a onclick='changePagination($counter)'>$counter</a></li>";					
				}					
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) >= $page && $page > ($adjacents * 2))
			{
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><a>$counter</a></li>";
					else
						$pagination.= "<li><a onclick='changePagination($counter)'>$counter</a></li>";					
				}
			}
			//close to end; only hide early pages
			else
			{
				for ($counter = ($page-1); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><a>$counter</a></li>";
					else
						$pagination.= "<li><a onclick='changePagination($counter)'>$counter</a></li>";					
				}
			}
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			
			//close to beginning; only hide later pages

			if($page==1){
				for ($counter = 1; $counter < 1+($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><a>$counter</a></li>";
					else
						$pagination.= "<li><a onclick='changePagination($counter)'>$counter</a></li>";					
				}
			}
			elseif($page < 1 + ($adjacents * 2))		
			{
				
				for ($counter = 1; $counter < 2 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><a>$counter</a></li>";
					else
						$pagination.= "<li><a onclick='changePagination($counter)'>$counter</a></li>";					
				}
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) >= $page && $page > ($adjacents * 2))
			{
				
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><a>$counter</a></li>";
					else
						$pagination.= "<li><a onclick='changePagination($counter)'>$counter</a></li>";					
				}
			}
			//close to end; only hide early pages
			else
			{
				for ($counter = ($page-1); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><a>$counter</a></li>";
					else
						$pagination.= "<li><a onclick='changePagination($counter)'>$counter</a></li>";					
				}
			}
		}

		if($page < $counter - 1) 
			$pagination.= "<li><a onclick='changePagination($next)'>&raquo;</a></li>";	
		
			$pagination.= "<ul></div>";
	}	
	echo $pagination;