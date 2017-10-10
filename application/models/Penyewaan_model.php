<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penyewaan_model extends CI_Model
{

    public $table = 'penyewaan';
    public $id = 'id_sewa';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where('penyewaan.id_sewa', $id);
		$this->db->join('penyewa', 'penyewa.id_penyewa = penyewaan.id_penyewa');
		$this->db->join('detail_penyewaan', 'penyewaan.id_sewa = detail_penyewaan.id_sewa');
		//$this-db->join('movie', 'movie.id_movie = detail_penyewaan.id_movie');
        return $this->db->get($this->table);
    }
	
	function get_by_id1($id, $q = NULL)
    {
        $this->db->where($this->id, $id);
		//$this->db->like('id_sewa', $q);
		//$this->db->or_like('tgl_sewa', $q);
		//$this->db->or_like('total_harga', $q);
		//$this->db->or_like('penyewaan.id_penyewa', $q);
		$this->db->join('penyewa', 'penyewa.id_penyewa = penyewaan.id_penyewa');
        return $this->db->get($this->table)->row();
    }
	
	function get_id($tgl, $id_penyewa)
    {
        $this->db->select('id_sewa');
		$this->db->where('tgl_sewa', $tgl);
		$this->db->where('id_penyewa', $id_penyewa);
		//$this->db->or_like('tgl_sewa', $q);
		//$this->db->or_like('total_harga', $q);
		//$this->db->or_like('penyewaan.id_penyewa', $q);
		//$this->db->join('penyewa', 'penyewa.id_penyewa = penyewaan.id_penyewa');
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_sewa', $q);
	$this->db->or_like('tgl_sewa', $q);
	$this->db->or_like('total_harga', $q);
	$this->db->or_like('id_penyewa', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_sewa', $q);
	$this->db->or_like('tgl_sewa', $q);
	$this->db->or_like('total_harga', $q);
	$this->db->or_like('penyewaan.id_penyewa', $q);
	$this->db->join('penyewa', 'penyewa.id_penyewa = penyewaan.id_penyewa');
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
	
	function get_data_sewa($q = NULL) {
        $this->db->order_by($this->id, $this->order);
		$this->db->where('tgl_kembali', null);
        $this->db->like('id_sewa', $q);
	$this->db->or_like('tgl_sewa', $q);
	$this->db->or_like('total_harga', $q);
	$this->db->or_like('penyewaan.id_penyewa', $q);
	$this->db->join('penyewa', 'penyewa.id_penyewa = penyewaan.id_penyewa');
	
        return $this->db->get($this->table)->result();
    }
	
	function get_data($q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_sewa', $q);
	$this->db->or_like('tgl_sewa', $q);
	$this->db->or_like('total_harga', $q);
	$this->db->or_like('penyewaan.id_penyewa', $q);
	$this->db->join('penyewa', 'penyewa.id_penyewa = penyewaan.id_penyewa');
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
	
	// cek harga
    function cek_harga($id)
    {
        $this->db->select('total_harga');
		//$this->db->from('penyewaan');
		$this->db->where($this->id, $id);
        $hasil = $this->db->get($this->table);
		return $hasil;
    }
	
	// update harga
    function update_harga($id, $harga)
    {
       $data['total_harga'] = $harga;
		$this->db->where($this->id, $id);
		$this->db->update('penyewaan', $data);
    }
	
	// update tgl_kembali
    function pengembalian($data)
    {
       //$data['total_harga'] = $harga;
	   $data1['tgl_kembali'] = $data['tgl_kembali'];
	   $data1['denda'] = $data['denda'];
		$this->db->where($this->id, $data['id_sewa']);
		$this->db->update('penyewaan', $data1);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Penyewaan_model.php */
/* Location: ./application/models/Penyewaan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-06 16:19:21 */
/* http://harviacode.com */