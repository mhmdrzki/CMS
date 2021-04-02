<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Posts Model Class
 *
 * @package     CMS
 * @subpackage  Models
 * @category    Models
 * @author      Achyar Anshorie
 */

class Mobil_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($id = null)
    {   
        if ($id) {
        $this->db->where('id', $id);
        }

        return $result = $this->db->get('mobil');
    }

    function getBy($params)
    {   
        $this->db->like($params);

        return $this->db->get('mobil')->result_array();
    }

    function add($data = array()) {
        $this->db->set($data);
        return $this->db->insert('mobil');
    }

    function edit($data = array(), $id) {
        $this->db->where('id', $id);
        $this->db->where('create_at IS NOT NULL');

        return $this->db->update('mobil', $data);

    }


    function delete($id) {
        $this->db->where('id', $id);
        
        return $this->db->delete('mobil');
    }



}
