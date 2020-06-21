<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Company Controller
 *
 * @package     CodeIgniter
 * @subpackage  Library
 * @category    Company
 * @author      Pradeep Kumar
 * @website     http://www.techbuddieit.com
 * @company     Techbuddiesit Inc
 * @since       Version 1.0 (initial)
 */
/*Note: This library is dependent library to Export All Data*/

class Export_lib {
    
    public $export_limit    = NULL;
    public $delete_limit    = NULL;
    public $type            = NULL;
    public $submodule       = NULL;
     /**
     * Constructor
     */
    public function __construct($submodule = '')
    {
        isProtected();
        
    }
    
    public function export($column_name, $result, $filename)
    {
        $thisObj            = &get_instance();
        $thisObj->load->library("excel");
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $table_columns = $column_name;
        $excel_row = 2;
        $column     = 0;
        /*Set Header columns of the file*/
        if(isset($table_columns) && !empty($table_columns))
        {
            foreach($table_columns as $field)
            {
                 
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $object->getActiveSheet()->getStyle("1")->getFont()->setBold( true );
                $column++;
            } 
        }
        //pr($column);die;
        /*Fill record*/   
        if(isset($result) && (!empty($result[0]->id) || !empty($result[0]->lead_id || !empty($result[0]->form_id))))
        { 
            
            foreach ($result as $key=>$record) {
                unset($record->form_id);
                $record = (array) $record;
                $i = 0;
                foreach($table_columns as $col=> $row){
                     
                    $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $record[$col]);
                } 
                $excel_row++;
            }
        }

        
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$filename);
        
        if(!empty($result[0]->id)){ 
            $object_writer->save('php://output');
        }else if(!empty($result[0]->lead_id)){ 
             $path = 'upload/temp_download/'.$filename;
            $object_writer->save(FCPATH.$path);
            echo base_url('upload/temp_download/'.$filename);
            exit;
        }else{  
            $object_writer->save('php://output');
        }
        //$object_writer->save('php://output');
        

    }
}

    
 