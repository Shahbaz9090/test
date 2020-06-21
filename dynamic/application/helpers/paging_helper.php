<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Hr Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Ranjeet Singh
 * @company     Tekshapers Inc
 */
 
// ------------------------------------------------------------------------
if(!function_exists('custompaging'))
{
    function custompaging($cur_page,$no_of_paginations,$previous_btn,$next_btn,$first_btn,$last_btn)
    {
		$msg='';
        if ($cur_page >= 10)
        {
            $start_loop = $cur_page - 5;
            if ($no_of_paginations > $cur_page + 5)
            {
                $end_loop = $cur_page + 5;
            }
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 9)
            {
                $start_loop = $no_of_paginations - 9;
                $end_loop = $no_of_paginations;
            } 
            else
            {
                $end_loop = $no_of_paginations;
            }
        } 
        else 
        {
            $start_loop = 1;
            if ($no_of_paginations > 10)
                $end_loop = 10;
            else
                $end_loop = $no_of_paginations;
        }
        //===========view parts===========//
        $msg .= "<div class='text-right'style='margin-right:15px;'><div class='dataTables_paginate paging_simple_numbers'>
                    <ul class='pagination'>";
                    // FOR ENABLING THE FIRST BUTTON
                    if ($first_btn && $cur_page > 1)
                    {
                        $msg .= "<li p='1' class='paginate_button previous '>First</li>";
                    }
                    else if ($first_btn)
                    {
                        $msg .= "<li p='1' class='paginate_button previous disabled '>First</li>";
                    }
                    // FOR ENABLING THE PREVIOUS BUTTON
                    if ($previous_btn && $cur_page > 1)
                    {
                        $pre = $cur_page - 1;
                        $msg .= "<li p='$pre' class='paginate_button previous '><a href='#'><i class='fa fa-angle-left'></i></a></li>";
                    }
                    else if ($previous_btn)
                    {
                        $msg .= "<li class='paginate_button previous disabled'><a href='#'><i class='fa fa-angle-left'></i></a></li>";
                    }
                    for ($i = $start_loop; $i <= $end_loop; $i++)
                    {
                        if ($cur_page == $i)
                            $msg .= "<li p='$i'  class='paginate_button  active current'><a>{$i}</a></li>";
                        else
                            $msg .= "<li p='$i' class=' paginate_button  active'><a>{$i}</a></li>";
                    }

                    // TO ENABLE THE NEXT BUTTON
                    if ($next_btn && $cur_page < $no_of_paginations)
                    {
                        $nex = $cur_page + 1;
                        $msg .= "<li p='$nex' class='paginate_button next '><a href='#'><i class='fa fa-angle-right'></i></a></li>";
                    }
                    else if ($next_btn)
                    {
                        $msg .= "<li class='paginate_button next disabled '><a href='#'><i class='fa fa-angle-right'></i></a></li>";
                    }

                    // TO ENABLE THE END BUTTON
                    if ($last_btn && $cur_page < $no_of_paginations)
                    {
                        $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
                    } 
                    else if ($last_btn)
                    {
                        $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
                    }
                    $total_string = "<span class='totalfront pull-left' style='padding:20px 15px 0' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
                    $msg = $msg . "</ul>" . $total_string . "</div>";  // Content for pagination
return $msg;
         
    }
}
