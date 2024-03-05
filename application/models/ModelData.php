<?php

class ModelData extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->santri = $this->load->database('santri', true);
    }

    function getAll($table)
    {
        return $this->db->get($table);
    }

    function getBy($table, $where, $dtwhere)
    {
        $this->db->where($where, $dtwhere);
        return $this->db->get($table);
    }

    function getBy2($table, $where, $dtwhere, $where1, $dtwhere1)
    {
        $this->db->where($where, $dtwhere);
        $this->db->where($where1, $dtwhere1);
        return $this->db->get($table);
    }
    function getBy3($table, $where, $dtwhere, $where1, $dtwhere1, $where2, $dtwhere2)
    {
        $this->db->where($where, $dtwhere);
        $this->db->where($where1, $dtwhere1);
        $this->db->where($where2, $dtwhere2);
        return $this->db->get($table);
    }

    function getBy2Select($table, $where, $dtwhere, $where1, $dtwhere1, $select)
    {
        $this->db->select($select);
        $this->db->where($where, $dtwhere);
        $this->db->where($where1, $dtwhere1);
        return $this->db->get($table);
    }

    function simpan($table, $data)
    {
        $this->db->insert($table, $data);
    }
    function simpanBatch($table, $data)
    {
        $this->db->insert_batch($table, $data);
    }

    function hapus($table, $where, $dtwhere)
    {
        $this->db->where($where, $dtwhere);
        $this->db->delete($table);
    }

    function getByJoin($table, $table2, $where, $dtwhere, $on1, $on2)
    {
        $this->db->from($table);
        $this->db->join($table2, "ON $table.$on1=$table2.$on2");
        $this->db->where($where, $dtwhere);
        return $this->db->get();
    }
    function getByJoinSelect($table, $table2, $where, $dtwhere, $on1, $on2, $select)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, "ON $table.$on1=$table2.$on2");
        $this->db->where($where, $dtwhere);
        return $this->db->get();
    }
    function getBy2JoinSelect($table, $table2, $where, $dtwhere, $where1, $dtwhere1, $on1, $on2, $select)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, "ON $table.$on1=$table2.$on2");
        $this->db->where($where, $dtwhere);
        $this->db->where($where1, $dtwhere1);
        return $this->db->get();
    }
    function getBy3JoinSelect($table, $table2, $where, $dtwhere, $where1, $dtwhere1, $where2, $dtwhere2, $on1, $on2, $select)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($table2, "ON $table.$on1=$table2.$on2");
        $this->db->where($where, $dtwhere);
        $this->db->where($where1, $dtwhere1);
        $this->db->where($where2, $dtwhere2);
        return $this->db->get();
    }

    function getGroup($table, $group)
    {
        $this->db->group_by($group);
        return $this->db->get($table);
    }

    function edit($table, $where, $dtwhere, $data)
    {
        $this->db->where($where, $dtwhere);
        $this->db->update($table, $data);
    }



    // DB Santri Functs
    function getBySantri($table, $where, $dtwhere)
    {
        $this->santri->where($where, $dtwhere);
        return $this->santri->get($table);
    }

    function simpanBatchSantri($table, $data)
    {
        $this->santri->insert_batch($table, $data);
        if ($this->santri->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function hapusSantri($table, $where, $dtwhere)
    {
        $this->santri->where($where, $dtwhere);
        $this->santri->delete($table);

        if ($this->santri->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
