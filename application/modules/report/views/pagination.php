<ul class="pagination" style="float:right;">
            <?php
			    
			$adjacents = 1;	
		    $counter=1;
            $page=$page_offset;
			if($page) 
				$start = ($page - 1) * $limit; 			//first item to display on this page
			else
				$start = 0;								//if no page var is given, set start to 0
	
	
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;			
	$lastpage = ceil($total/$limit);		//lastpage is = total pages / items per page, rounded up.
					//last page minus 1

	$total_pages = $total;

	$pagination = "";
	if($lastpage > 1)
	{
		//previous button
		if ($page > 1) 
			$pagination.= "<a onclick='loadgenerateReport($prev)'>&lt;</a>";

		if ($lastpage < 2 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<strong>$counter</strong>";
				else
					$pagination.= "<a onclick='loadgenerateReport($counter)'>$counter</a>";					
			}
		}elseif ($lastpage < 6 ) {	
			if($page==1){
				for ($counter = 1; $counter < 1+($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<strong>$counter</strong>";
					else
						$pagination.= "<a onclick='loadgenerateReport($counter)'>$counter</a>";					
				}
			}
			elseif($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 2 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<strong>$counter</strong>";
					else
						$pagination.= "<a onclick='loadgenerateReport($counter)'>$counter</a>";					
				}					
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) >= $page && $page > ($adjacents * 2))
			{
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<strong>$counter</strong>";
					else
						$pagination.= "<a onclick='loadgenerateReport($counter)'>$counter</a>";					
				}
			}
			//close to end; only hide early pages
			else
			{
				for ($counter = ($page-1); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<strong>$counter</strong>";
					else
						$pagination.= "<a onclick='loadgenerateReport($counter)'>$counter</a>";					
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
						$pagination.= "<strong>$counter</strong>";
					else
						$pagination.= "<a onclick='loadgenerateReport($counter)'>$counter</a>";					
				}
			}
			elseif($page < 1 + ($adjacents * 2))		
			{
				
				for ($counter = 1; $counter < 2 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<strong>$counter</strong>";
					else
						$pagination.= "<a onclick='loadgenerateReport($counter)'>$counter</a>";					
				}
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) >= $page && $page > ($adjacents * 2))
			{
				
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<strong>$counter</strong>";
					else
						$pagination.= "<a onclick='loadgenerateReport($counter)'>$counter</a>";					
				}
			}
			//close to end; only hide early pages
			else
			{
				for ($counter = ($page-1); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<strong>$counter</strong>";
					else
						$pagination.= "<a onclick='loadgenerateReport($counter)'>$counter</a>";					
				}
			}
		}


		if($page < $counter - 1) 
			$pagination.= "<a onclick='loadgenerateReport($next)'>&gt;</a>";	
			
	}
	?>
    
           <?php
            echo $pagination;
            ?>
             
            </ul>