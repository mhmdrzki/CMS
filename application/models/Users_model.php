<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Posts Model Class
 *
 * @package     CMS
 * @subpackage  Models
 * @category    Models
 * @author      Achyar Anshorie
 */

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($id = null)
    {   if ($id) {
        $this->db->where('id', $id);
    }

        return $result = $this->db->get('mobil');
    }

    // Add and update to database
    function add($data = array()) {
        $this->db->set($data);
        return $this->db->insert('users');
    }



}
