<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter My Form Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Form * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
 // ------------------------------------------------------------------------

/**
 * Is Post Back 
 * 
 * Check Post Request or not
 *
 * @access	public
 * @return	boolean
 */ 
if(!function_exists('isPostBack'))
{
    function get_input_box($name,$title,$type,$value,$isRequired = '')
    {
        echo '<tr>
                <td class="col1">
                    <label>'.$title.'</label>
                </td>
                <td class="col2">
                    <input type="'.$type.'" id="'.$type.'" name="'.$name.'" value="'.$value.'" class="'.$isRequired.'"/>
                </td>
            </tr>';
    }
}

if(!function_exists('_chart_report')) {
	
    function _chart_report() {
        $data = array(
            'client' => 'Client',
            'client_contact' => 'Client Contact',
            'supplier_india' => 'Suppler India',
            'supplier_china' => 'Suppler China',
            'installation_base' => 'Installation Base',
			'set_notification' => 'Set Notification',
            
            );
        return $data;
    }
}
