<?php defined('BASEPATH') OR exit('No direct script access allowed');
    function in_check($table, $dataArray)
    {
        $ci = &get_instance();
        $data = $ci->db->get_where($table, $dataArray)->num_rows();
        if ($data > 0) {
            return 0;
        } else {
            return 1;
        }
    }
?>