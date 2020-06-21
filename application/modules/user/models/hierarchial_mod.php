<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  HTree Hierarchial Model
 *
 * @author    PX Webdesign
 * @link    http://www.pxwebdesign.com.au
 * @version   3.0
 *
 * This model is used for manipulating data in a Hierarchial Model 
 * - Gets data into a model from DB
 * - Moves, re-orders, adds and deletes entries
 * - Provides support functions such as "is at top"
 *
 * HTree is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * HTree is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 
*/


class Hierarchial_mod extends CI_Model {
    
    var $attribute_fields = array();
        
    /*
    |   Get Overview
    |
    |   Description: Gets a level's worth of Menu Items
    |   Use: Takes a Menu Item PK as URI segment 4
    */
    function get_overview($iStart) {
        $this->db->where($this->parent_field, $iStart);
        if (isset($this->condition_field)) {
            $this->db->where($this->condition_field, '1');
        }
        $this->db->order_by($this->order_field, "asc");
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    /*
    |   Get Items
    |
    |   Description: Gets Menu Items recursively and builds an $items array
    |   Use: Takes a Parent ID as input
    */
    function & get_items($iStart = 0) {
        $itemOverview =& $this->get_overview($iStart);
        foreach ($itemOverview as $key => $val) {
            $item = array();
            $item['id'] = $itemOverview[$key][$this->PK_field];
            $item['parent'] = $itemOverview[$key][$this->parent_field];
            if (isset($this->live_field)) {
                $item['live'] = $itemOverview[$key][$this->live_field];
            }
            if (is_array($this->attribute_fields)) {
                foreach ($this->attribute_fields as $attr) {
                       $item[$attr] = $itemOverview[$key][$attr];
                } 
            }
            $item['name'] = $itemOverview[$key][$this->name_field];
            if ($item['id'] != 0) {
                $childItems =& $this->get_items($item['id']);
            }
            if (!empty($childItems)) {
                $item['childs'] =& $childItems;   
            }
            $items[] = $item;
        }
        return $items;
    }
    
    /*
    |   Show Items
    |
    |   Description: Ouput all the Menu Items  NOTE: Not Used
    |   Use: Takes no input
    */
    function showItems() {
        $this->_output_items($this->get_items(), 0);
    }
    /*
    |   Get Item List
    |
    |   Description: Gets a List of Menu Items  NOTE: Not Used
    |   Use: Takes no input
    */
    function get_item_list($prepend="") {
        return $this->_build_list($this->get_items(), 0, $prepend);
        
    }
    
    /*
    |   Get Item Name
    |
    |   Description: Returns the Name of a Menu Item given the Item PK
    |   Use: Takes a Menu Item PK as input
    */
    function get_item_name($item_PK) {
        $this->db->where($this->PK_field, $item_PK);
        $query = $this->db->get($this->table);
        if ($result = $query->row_array()) {
            return $result[$this->name_field];
        } else {
            return 0;   
        }
    }
    /*
    |   Is Item Live
    |
    |   Description: Returns TRUE if the Menu Item is Live
    |   Use: Takes a Menu Item PK as input
    */
    function is_item_live($item_PK) {
        $this->db->where($this->PK_field, $item_PK);
        $query = $this->db->get($this->table);
        if ($result = $query->row_array()) {
            return $result[$this->live_field];    
        } else {
            return 0;
        }
    }

    /*
    |   Move Item Up
    |
    |   Description: Moves a Menu Item Up
    |   Use: Takes a Menu Item PK as input
    */
    function move_item_up($item_PK) {
        // make sure we're not trying to move the "Home" item
        if (isset($this->home_mode)) {
            if ($item_PK == 1) {
                $editable = 0;
            } else {
                $editable = 1;   
            }
        } else {
            $editable = 1;   
        }
        // make sure item is not already at the top
        if (!$this->_is_item_at_top($item_PK) && $editable == 1) {
            // get position and parent of item
            $thisPosition = $this->_get_position($item_PK);
            $thisParent = $this->_get_parent($item_PK);
            // get previous item
            $this->db->where($this->parent_field, $thisParent);
            $this->db->where("{$this->order_field} <", $thisPosition);
            if (isset($this->condition_field)) {
			    $this->db->where($this->condition_field, '1');
            }
            $this->db->order_by($this->order_field, "desc");
            $query = $this->db->get($this->table, 1);
            $result = $query->row_array();
            $prev_PK = $result[$this->PK_field];
            // move this item up
            $this->db->where($this->PK_field, $item_PK);
            $this->db->set($this->order_field, $thisPosition - 1);
            $this->db->update($this->table);
            // move previous item down
            $this->db->where($this->PK_field, $prev_PK);
            $this->db->set($this->order_field, $thisPosition);
            $this->db->update($this->table);
            // set status message
            $this->session->set_flashdata('message','Item moved up');
        }
    }
    /*
    |   Move Item Down
    |
    |   Description: Moves a Menu Item Down
    |   Use: Takes a Menu Item PK as input
    */
    function move_item_down($item_PK) {
        // make sure we're not trying to move the "Home" item
        if (isset($this->home_mode)) {
            if ($item_PK == 1) {
                $editable = 0;
            } else {
                $editable = 1;   
            }
        } else {
            $editable = 1;   
        }
        // make sure item is not already at the bottom
        if (!$this->_is_item_at_bottom($item_PK) && $editable == 1) {
            // get position and parent of item
            $thisPosition = $this->_get_position($item_PK);
            $thisParent = $this->_get_parent($item_PK);
            // get next item
            $this->db->where($this->parent_field, $thisParent);
            $this->db->where("{$this->order_field} >", $thisPosition);
            if (isset($this->condition_field)) {
			    $this->db->where($this->condition_field, '1'); 
            }
            $this->db->order_by($this->order_field, "asc");
            $query = $this->db->get($this->table, 1);
            $result = $query->row_array();
            $next_PK = $result[$this->PK_field];
            // move this item down
            $this->db->where($this->PK_field, $item_PK);
            $this->db->set($this->order_field, $thisPosition + 1);
            $this->db->update($this->table);
            // move next item up
            $this->db->where($this->PK_field, $next_PK);
            $this->db->set($this->order_field, $thisPosition);
            $this->db->update($this->table);            
            // set status message
            $this->session->set_flashdata('message','Item moved down');
        }    
    }
    /*
    |   Add Item
    |
    |   Description: Adds a New Menu Item
    |   Use: Takes an Item Name and the Parent Item PK as input
    */
    function add_item($itemName, $category) {
        if (isset($this->condition_field)) {
            // check for highest position in category
            $highest = $this->_get_highest_in_category($this->parent_field, $this->order_field, $this->condition_field, $category);
        } else {
            // check for highest position in category
            $highest = $this->_get_highest_in_category($this->parent_field, $this->order_field, 0, $category);
        }
        // add new item
        $this->db->set($this->name_field, $itemName);
        $this->db->set($this->parent_field, $category);
        $this->db->set($this->order_field, $highest + 1);
        if (isset($this->live_field)) {
            $this->db->set($this->live_field, 1);   
        }
        if (isset($this->condition_field)) {
            $this->db->set($this->condition_field, 1);   
        }
        $this->db->insert($this->table);
    }
    /*
    |   Delete Item
    |
    |   Description: Deletes a Menu Item
    |   Use: Takes a Menu PK as input
    */
    function delete_item($menu_PK) {
        // make sure we're not trying to move the "Home" item
        if (isset($this->home_mode)) {
            if ($menu_PK == 1) {
                $editable = 0;
            } else {
                $editable = 1;   
            }
        } else {
            $editable = 1;   
        }
        if ($editable) {
            $parent_PK = $this->_get_parent($menu_PK);
            $position = $this->_get_position($menu_PK);
            // reorder higher items down before deleting item
            if (isset($this->condition_field)) {
                $this->reorder_above($this->condition_field, $this->parent_field, $this->order_field, $parent_PK, $menu_PK);     
            } else {
                $this->reorder_above(0, $this->parent_field, $this->order_field, $parent_PK, $menu_PK);     
            }
            // delete item
            $this->db->where($this->PK_field, $menu_PK);
            $this->db->delete($this->table);
        }        
    }
    /*
    |   Re-order Above
    |
    |   Description: Re-orders all the items in a menu category above a certain position down by one
    |   Use: Takes the condition field, parent field, order field, the parent PK, the menu_PK of the item to be removed
    */
    function reorder_above($condition_field, $parent_field, $order_field, $parent_id, $menu_PK) {
        $position = $this->_get_position($menu_PK);
        
        if ($condition_field) {
            $this->db->where($condition_field, 1);
        }
        $this->db->where($parent_field, $parent_id);
        $this->db->where($order_field." >", $position);
        $this->db->set($order_field, $order_field." - 1 ", FALSE);
        $this->db->update($this->table);
        
    }
    /*
    |   Move To End
    |
    |   Description: Moves item to the end of it's parent category
    |   Use: Takes the condition field, parent field, order field, the parent PK, the menu_PK of the item to move
    */
    function move_to_end($condition_field, $parent_field, $order_field, $parent_id, $menu_PK) {
        // make sure we're not trying to move the "Home" item
        if (isset($this->home_mode)) {
            if ($menu_PK == 1) {
                $editable = 0;
            } else {
                $editable = 1;   
            }
        } else {
            $editable = 1;   
        }
        if ($editable) {
            $highest = $this->_get_highest_in_category($parent_field, $order_field, $condition_field ,$parent_id);
            $this->db->where('menu_PK', $menu_PK);
            $this->db->set($order_field, $highest + 1);
            $this->db->update($this->table);
        }
    }
    /*
    |   Toggle Live
    |
    |   Description: Toggles a Menu Item's Live status
    |   Use: Takes a Menu Item PK as input
    */
    function toggle_live($item_PK) {
        // get current live status
        $this->db->where($this->PK_field, $item_PK);
        $query = $this->db->get($this->table);
        $result = $query->row_array();
        // set new live status
        if ($result[$this->live_field]) {
            $this->db->where($this->PK_field, $item_PK);
            $this->db->set($this->live_field, 0);
        } else {
            $this->db->where($this->PK_field, $item_PK);
            $this->db->set($this->live_field, 1);
        }
        $this->db->update($this->table); 
    }

    
    /*
    |   Force Re-order
    |
    |   Description: Forcefully re-orders all the items with the same Parent PK
    |   Use: Accepts a Parent PK as input
    */
    function force_reorder($parent_PK) {
        $this->db->where($this->parent_field, $parent_PK);
        $query = $this->db->get($this->table);
        $result = $query->result_array();
        $i = 1;
        foreach ($result as $item) {
            $this->db->where($this->PK_field, $item['menu_PK']);
            $this->db->set($this->order_field, $i);
            $this->db->update($this->table);
            $i++;
        }
    }
    /*
    |   Move Item
    |
    |   Description: Moves an Item ($from) to a new Parent ($to)
    |   Use: Takes a Menu Item PK and a Parent Item PK as input
    */
    function move_item($from, $to) {
        // make sure we're not trying to move the "Home" item
        if (isset($this->home_mode)) {
            if ($from == 1) {
                $editable = 0;
            } else {
                $editable = 1;   
            }
        } else {
            $editable = 1;   
        }
        if ($editable) {
            // find current position of item
            $currentPosition = $this->_get_position($from);
            // get current parent of item
            $currentParent = $this->_get_parent($from);
            if (isset($this->condition_field)) {
                // find highest item in parent cat
                $highest = $this->_get_highest_in_category($this->parent_field, $this->order_field, $this->condition_field, $to);
            } else {
                // find highest item in parent cat
                $highest = $this->_get_highest_in_category($this->parent_field, $this->order_field, 0, $to);
            }
            // don't do anything if moving to the same level
            if ($currentParent != $to) {
                $this->db->where($this->PK_field, $from);
                $this->db->set($this->parent_field, $to);
                $this->db->set($this->order_field, $highest + 1);
                $this->db->update($this->table);
            }
            // reorder remaining items in source category
            $this->db->where($this->parent_field, $currentParent);
            $this->db->where($this->order_field." >", $currentPosition);
            $this->db->set($this->order_field, $this->order_field."-1", FALSE);
            $this->db->update($this->table);
        }
    }
    
       
/* ------------------------------------------ PRIVATE FUNCTIONS ------------------------------------------------ */

    
    /*
    |   Is Item At Top
    |
    |   Description: Returns TRUE if the Menu Item is at the top of its Parent Category
    |   Use: Takes a Menu Item PK as input. 
    */
    function _is_item_at_top($item_PK) {
        $parent = $this->_get_parent($item_PK);
        if (isset($this->home_mode) && $parent == 0) {
            $append = 1;    
        } else {
            $append = 0;   
        }
        // get details of this item
        $this->db->where($this->PK_field, $item_PK);
        $query = $this->db->get($this->table);
        $item = $query->row_array();
        // if order position is 1 then item is at top of it's section
        if ($item[$this->order_field] == (1 + $append)) {
            return 1;   
        } else {
            return 0;
        }
    }
    /*
    |   Is Item At Bottom
    |
    |   Description: Returns TRUE if the Menu Item is the last item in its Parent Category
    |   Use: Takes a Menu Item PK as input
    */
    function _is_item_at_bottom($item_PK) {
        // get details of this item
        $this->db->where($this->PK_field, $item_PK);
        $query = $this->db->get($this->table);
        $item = $query->row_array();
        // get number of items with this same parent
        $this->db->where($this->parent_field, $item[$this->parent_field]);
        if (isset($this->condition_field)) {
            $this->db->where($this->condition_field, 1);
        }
        $this->db->where($this->PK_field." !=", 0);
        $query = $this->db->get($this->table);
        $numRows = $query->num_rows();
        // if order position is the same as number of rows, then item is at the bottom
        if ($item[$this->order_field] == $numRows) {
            return 1;
        } else {
            return 0;
        }
    }
    /*
    |   Get Parent
    |
    |   Description: Gets the Parent PK for a Menu Item
    |   Use: Takes a Menu Item PK as input
    */
    function _get_parent($item_PK) {
        $this->db->where($this->PK_field, $item_PK);
        $query = $this->db->get($this->table);   
        $result = $query->row_array();
        return $result[$this->parent_field];
    }
    /*
    |   Get Position
    |
    |   Description: Gets the Order Position for a Menu Item
    |   Use: Takes a Menu Item PK as input
    */
    function _get_position($item_PK) {
        $this->db->where($this->PK_field, $item_PK);
        $query = $this->db->get($this->table);
        $result = $query->row_array();   
        return $result[$this->order_field];
    }
    /*
    |   Get Highest In Category
    |
    |   Description: Gets the Order Position for the last Menu Item with a particular Parent PK
    |   Use: Takes the Parent Field name, Order Field name, Appear Field name and Parent PK as input
    */
    function _get_highest_in_category($parentField, $orderField, $conditionField ,$category) {
        $this->db->where($parentField, $category);
        if ($conditionField) {
            $this->db->where($conditionField, 1);
        }
        $this->db->order_by($orderField, 'DESC');
        $query = $this->db->get($this->table, 1);
        if ($result = $query->row_array()) {
            return $result[$orderField];
        } else {
            return 0;
        }
    }
    /*
    |   Get Highest In Category (Public)
    |
    |   Description: Gets the Order Position for the last Menu Item with a particular Parent PK
    |   Use: Takes the Parent Field name, Order Field name, Appear Field name and Parent PK as input
    */
    function get_highest_in_category($parent_PK) {
        if (isset($this->condition_field)) {
            return $this->_get_highest_in_category($this->parent_field, $this->order_field, $this->condition_field, $parent_PK);
        } else {
            return $this->_get_highest_in_category($this->parent_field, $this->order_field, 0, $parent_PK);
        }
    }
    
    
}
 
?>
