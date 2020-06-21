<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 if (!function_exists('create_pdf')) {

    function create_pdf($html_data, $file_name = "") {
        if ($file_name == "") {
            $file_name = 'test' . date('d-M-Y');
        }
        require APPPATH.'third_party/mpdf/mpdf.php';
       // $mypdf = new mPDF('', 'Letter', 0, '', 12.7, 12.7, 14, 12.7, 8, 8);
        $mypdf = new mPDF('','A2');
        
		//$stylesheet = file_get_contents(base_url().'bucket/css/heirarchy/emphierarchy.css');
        $mypdf->allow_charset_conversion = false;
        //$mypdf->WriteHTML($stylesheet,1);
        $mypdf->WriteHTML($html_data);
        $mypdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 
        $mypdf->Output($file_name . 'pdf','D');
        $mypdf->Output($file_name . 'pdf');
       }

}
?>