<?php

class Admin_manager extends CI_Model {

    public function SelectByID($table, $key, $value, $output = '', $params = '*') {
        $this->db->select($params);
        $this->db->from($table);
        $this->db->where(array($key => $value));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if ($output == "OBJECT") {
                return $query->result();
            } else if ($output == "ARRAY") {
                return $query->result_array();
            } else if ($output == "ROW") {
                return $query->row();
            } else if ($output == "ROW_A") {
                return $query->row_array();
            } else {
                return $query->result();
            }
        } else {
            return false;
        }
    }

    public function Counts($table, $output = '') {
        $this->db->select('COUNT(*)');
        $this->db->from($table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if ($output == "OBJECT") {
                return $query->result();
            } else if ($output == "ARRAY") {
                return $query->result_array();
            } else if ($output == "ROW") {
                return $query->row();
            } else if ($output == "ROW_A") {
                return $query->row_array();
            } else {
                return $query->result();
            }
        } else {
            return false;
        }
    }

    public function CountsIfExist($table, $key, $value, $output = '') {
        $this->db->select('COUNT(*) AS `count`');
        $this->db->where($key, $value);
        $this->db->from($table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if ($output == "OBJECT") {
                return $query->result();
            } else if ($output == "ARRAY") {
                return $query->result_array();
            } else if ($output == "ROW") {
                return $query->row();
            } else if ($output == "ROW_A") {
                return $query->row_array();
            } else {
                return $query->result();
            }
        } else {
            return false;
        }
    }

    public function SelectAll($table, $output = '', $params = '*') {
        $this->db->select($params);
        $this->db->from($table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if ($output == "OBJECT") {
                return $query->result();
            } else if ($output == "ARRAY") {
                return $query->result_array();
            } else if ($output == "ROW") {
                return $query->row();
            } else if ($output == "ROW_A") {
                return $query->row_array();
            } else {
                return $query->result();
            }
        } else {
            return false;
        }
    }

    public function SelectJoinData($table, $joinTable, $getParams, $compare, $output = '') {
        $this->db->select($getParams);
        $this->db->from($table);
        $this->db->where(array($table.'.status' => '1'));
        $this->db->join($joinTable, $compare, 'LEFT');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if ($output == "OBJECT") {
                return $query->result();
            } else if ($output == "ARRAY") {
                return $query->result_array();
            } else if ($output == "ROW") {
                return $query->row();
            } else if ($output == "ROW_A") {
                return $query->row_array();
            } else {
                return $query->result();
            }
        } else {
            return false;
        }
    }

    public function SelectAllQuery($query, $output = '') {
        $query = $this->db->query($query);
        foreach ($query->result() as $row) {
            if ($query->num_rows() > 0) {
                if ($output == "OBJECT") {
                    return $query->result();
                } else if ($output == "ARRAY") {
                    return $query->result_array();
                } else if ($output == "ROW") {
                    return $query->row();
                } else if ($output == "ROW_A") {
                    return $query->row_array();
                } else {
                    return $query->result();
                }
            } else {
                return false;
            }
        }
    }

    public function SelectWhole($table, $key, $value, $output = '') {
        $this->db->select('*');
        $this->db->where($key, $value);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            if ($output == "OBJECT") {
                return $query->result();
            } else if ($output == "ARRAY") {
                return $query->result_array();
            } else if ($output == "ROW") {
                return $query->row();
            } else if ($output == "ROW_A") {
                return $query->row_array();
            } else {
                return $query->result();
            }
        }
    }

    public function CompareColumns($table, $data,$output=''){
     $query = $this->db->get_where($table, $data);
     if ($query->result() > 0) {
        if ($output == "OBJECT") {
            return $query->result();
        } else if ($output == "ARRAY") {
            return $query->result_array();
        } else if ($output == "ROW") {
            return $query->row();
        } else if ($output == "ROW_A") {
            return $query->row_array();
        } else {
            return $query->result();
        }
    }
}

public function SelectByMultipleCol($table, $data, $output = '', $orderCol, $OrderBy) {
    $query = $this->db->order_by($orderCol, $OrderBy)->get_where($table, $data);
    if ($query->result() > 0) {
        if ($output == "OBJECT") {
            return $query->result();
        } else if ($output == "ARRAY") {
            return $query->result_array();
        } else if ($output == "ROW") {
            return $query->row();
        } else if ($output == "ROW_A") {
            return $query->row_array();
        } else {
            return $query->result();
        }
    }
}

public function Insert($table, $data) {
    if ($this->db->insert($table, $data)) {
        return true;
    } else {
        return false;
    }
}

public function DeleteMultiple($table, $data) {
    if ($this->db->delete($table, $data)) {
        return true;
    } else {
        return false;
    }
}

public function Delete($table, $key, $value) {
    $this->db->where($key, $value);
    if ($this->db->delete($table)) {
        return true;
    } else {
        return false;
    }
}

public function Update($table, $data, $where) {
    if ($this->db->update($table, $data, $where)) {
        return true;
    } else {
        return false;
    }
}

}
