<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_auth {

    public function __construct() {
        $this->CI = & get_instance();
    }

    ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
    // LOGIN STATUS FUNCTIONS
    ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

    /**
     * is_logged_in
     * Verifies a user is logged in either via entering a valid password or using the 'Remember me' feature.
     *
     * @return bool
     * @author Rob Hussey
     */
    public function is_logged_in() {
        return (bool) $this->CI->session->userdata('admin_logged_in');
    }

    /**
     * is_admin
     * Verifies a user belongs to a user group with admin permissions.
     *
     * @return bool
     * @author Rob Hussey
     */
    public function is_admin() {
        return (bool) $this->CI->session->userdata('is_admin');
    }

    /**
     * is_privileged
     * Verifies whether a user has a specific privilege, by comparing by either privilege id or name.
     *
     * @return bool
     * @author Rob Hussey
     */
    public function is_privileged($privileges = FALSE) {
        // Get users privileges and convert names to lowercase for comparison.
        $user_privileges = array();
        $priv = $this->CI->session->userdata('privileges');
        if (!empty($priv)) {
              foreach ($this->CI->session->userdata('privileges') as $id => $name) {
                $user_privileges[$id] = strtolower($name);
            }
        }

        // If multiple groups submitted as an array, loop through each.
        if (is_array($privileges)) {
            foreach ($privileges as $privilege) {
                if ((is_numeric($privilege) && array_key_exists($privilege, $user_privileges)) || in_array(strtolower($privilege), $user_privileges)) {
                    return TRUE;
                }
            }
            return FALSE;
        }
        return ((is_numeric($privileges) && array_key_exists($privileges, $user_privileges)) || in_array(strtolower($privileges), $user_privileges));
    }


     public function is_submoduleprivileged($submoduleprivileges = FALSE) {
        // Get users privileges and convert names to lowercase for comparison.
         $user_submoduleprivileges = array();
        $subpriv = $this->CI->session->userdata('submoduleprivileges');
        if (!empty($subpriv)) {
              foreach ($this->CI->session->userdata('submoduleprivileges') as $id => $name) {
                $user_submoduleprivileges[$id] = strtolower($name);
            }
        }

        // If multiple groups submitted as an array, loop through each.
        if (is_array($submoduleprivileges)) {
            foreach ($submoduleprivileges as $subprivilege) {
                if ((is_numeric($subprivilege) && array_key_exists($subprivilege, $user_submoduleprivileges)) || in_array(strtolower($subprivilege), $user_submoduleprivileges)) {
                    return TRUE;
                }
            }
            return FALSE;
        }
        return ((is_numeric($submoduleprivileges) && array_key_exists($submoduleprivileges, $user_submoduleprivileges)) || in_array(strtolower($submoduleprivileges), $user_submoduleprivileges));
    }



    ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
    // GET USER FUNCTIONS
    ###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

    /**
     * get_user_id
     * Get the users id from the session.
     *
     * @return void
     * @author Rob Hussey
     */
    public function get_user_id() {
        return ($this->CI->session->userdata('admin_id') !== FALSE) ? $this->CI->session->userdata('admin_id') : FALSE;
    }

    /**
     * get_user_group_id
     * Get the users group id from the session.
     *
     * @return void
     * @author Rob Hussey
     */
    public function get_user_group_id() {
        return ($this->CI->session->userdata('admin_group') !== FALSE) ? $this->CI->session->userdata('admin_group') : FALSE;
    }

    /**
     * get_user_group
     * Get the users user group name from the session.
     *
     * @return void
     * @author Rob Hussey
     */
    public function get_user_group() {
        return ($this->CI->session->userdata('admin_group_name') !== FALSE) ? $this->CI->session->userdata('admin_group_name') : FALSE;
    }

}

/* End of file flexi_auth_lite.php */
/* Location: ./application/controllers/flexi_auth_lite.php */