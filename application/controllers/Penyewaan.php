<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penyewaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->model('Penyewa_model');
        $this->load->model('Penyewaan_model');
		$this->load->model('DetailPenyewaan_model');
		$this->load->model('Movie_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'penyewaan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'penyewaan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'penyewaan/index.html';
            $config['first_url'] = base_url() . 'penyewaan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Penyewaan_model->total_rows($q);
        $penyewaan = $this->Penyewaan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'penyewaan_data' => $penyewaan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('penyewaan/penyewaan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Penyewaan_model->get_by_id($id);		
		foreach($row->result_array() as $data1)
		{
		 $data = array(
		'id_sewa' => $data1['id_sewa'],
		'tgl_sewa' => $data1['tgl_sewa'],
		'tgl_kembali' => $data1['tgl_kembali'],
		'total_harga' => $data1['total_harga'],
		'denda' => $data1['denda'],
		'nama' => $data1['nama'],
		'query' => $this->DetailPenyewaan_model->get_by_id($id)
	    );
		}
            $this->load->view('penyewaan/penyewaan_read', $data);
		
    }

    public function create() 
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'penyewaan/create.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'penyewaan/create.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'penyewaan/create.html';
            $config['first_url'] = base_url() . 'penyewaan/create.html';
        }
		$qry=$this->Penyewa_model->get_data($q);
		$data = array(
            'button' => 'Create',
            'action' => site_url('penyewaan/create_action'),
			'action1' => site_url('penyewaan/create'),
	    'id_sewa' => set_value('id_sewa'),
	    //'tgl_sewa' => set_value('tgl_sewa'),
		'total_harga' => set_value(null),
	    'id_penyewa' => set_value('id_penyewa'),
		'penyewa_data' => $qry,
		'q' => $q,
		'start' => $start,
	);
        $this->load->view('penyewaan/penyewaan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_sewa' => $this->input->post('id_sewa',TRUE),
		'tgl_sewa' => date("Y-m-d"),
		'total_harga' => $this->input->post('total_harga',TRUE),
		'id_penyewa' => $this->input->post('id_penyewa',TRUE),
		//'tgl_kembali' => null
	    );

            $this->Penyewaan_model->insert($data);
			$row = $this->Penyewaan_model->get_id(date("Y-m-d"), $this->input->post('id_penyewa',TRUE));
            $this->session->set_flashdata('message', 'Create Record Success');
           
		   redirect(site_url('penyewaan/sewa_vcd/'.$row->id_sewa));
        }
    }
	
	public function sewa_vcd($id_sewa)
	{
		$q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'penyewaan/create.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'penyewaan/create.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'penyewaan/create.html';
            $config['first_url'] = base_url() . 'penyewaan/create.html';
        }
		$qry=$this->Movie_model->get_data($q);
		$data = array(
            'button' => 'Pilih',
            'action' => site_url('penyewaan/sewa_vcd_action/'.$id_sewa),
	    'id_detail' => set_value('id_detail'),
		'id_sewa' => $id_sewa,
	    'id_movie' => set_value('id_movie'),
		'q' => $q,
		'start' => $start,
		'movie_data' => $qry,
	    //'jumlah' => set_value('jumlah'),
		);
        $this->load->view('penyewaan/sewa_vcd', $data);
	}
	
	 public function sewa_vcd_action($id_sewa) 
    {
        $this->form_validation->set_rules('id_sewa', 'ID Sewa', 'trim|required');
		$this->form_validation->set_rules('id_movie', 'ID Movie', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->sewa_vcd($id_sewa);
        } else {
            
		$qry = $this->Movie_model->cek_stok($this->input->post('id_movie'));
		foreach($qry->result_array() as $dat)
		{
			$stok = $dat['stok'];
		}
		$qry1 = $this->Movie_model->cek_harga($this->input->post('id_movie'));
		foreach($qry1->result_array() as $dataa)
		{
			$hrg1 = $dataa['harga_sewa'];
		}
		$qry2 = $this->Penyewaan_model->cek_harga($id_sewa);
		foreach($qry2->result_array() as $dataaa)
		{
			$hrg2 = $dataaa['total_harga'];
		}
		$total = $hrg1+$hrg2;
		$id = $this->input->post('id_sewa',TRUE);
		
		$id_movie = $this->input->post('id_movie',TRUE);
        if($stok > 0)
		{
			$data = array(
			'id_detail' => '',
			'id_movie' => $this->input->post('id_movie',TRUE),
			
			'id_sewa' => $this->input->post('id_sewa',TRUE),
			);
			$id_sewa = $this->input->post('id_sewa',TRUE);
			$this->DetailPenyewaan_model->insert($data);
			
			$stok=0;
			$this->Movie_model->update_stok($id_movie, $stok);
			$this->Penyewaan_model->update_harga($id_sewa,$total);
			$this->session->set_flashdata('message', 'Create Record Success');
            
			$this->load->view('design/header');
			echo "<div class='row'>
				<div class='col-md-8'>
				
				
				<center><h2 style='margin-top:0px'>Penyewaan</h2>";
			echo "<h3>Movie berhasil disewa!</h3>".anchor('penyewaan/sewa_vcd/'.$id_sewa, 'Sewa Lagi')."<br/>".anchor('penyewaan/', 'Kembali')."</center>";
			echo "</div></div>";
			//$this->load->view('design/member');
			/* $data1 =  "<h3>Movie berhasil disewa!</h3>".anchor('penyewaan/sewa_vcd/'.$id_sewa, 'Sewa Lagi')."<br/>".anchor('penyewaan/', 'Kembali');
			$this->load->view('design/content',$data1); */
		}
		else
		{
			$this->load->view('penyewaan/stok_tidak_mencukupi');
		}
        }
    }
	
	public function pengembalian() 
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'penyewaan/pengembalian.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'penyewaan/pengembalian.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'penyewaan/pengembalian.html';
            $config['first_url'] = base_url() . 'penyewaan/pengembalian.html';
        }
		$qry=$this->Penyewaan_model->get_data_sewa($q);
		
		$data = array(
            'button' => 'Pengembalian',
            'action' => site_url('penyewaan/pengembalian_action'),
	    'id_sewa' => set_value('id_sewa'),
	    //'tgl_kembali' => set_value('tgl_kembali'),
		'q' => $q,
		'start' => $start,
		'penyewaan_data' => $qry,
	);
        $this->load->view('penyewaan/pengembalian_form', $data);
    }
	
	public function pengembalian_action() 
    {
        $this->form_validation->set_rules('id_sewa', 'ID Sewa', 'trim|required');
		//$this->form_validation->set_rules('tgl_kembali', 'Tanggal Kembali', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->pengembalian();
        } else {

            $tgl_kembali = date("Y-m-d");
			$id_sewa = $this->input->post('id_sewa',TRUE);
			$row = $this->Penyewaan_model->get_by_id1($id_sewa);
			$tgl_sewa = $row->tgl_sewa;
			$pecah1 = explode("-", $tgl_sewa);
			$date1 = $pecah1[2];
			$month1 = $pecah1[1];
			$year1 = $pecah1[0];
			$pecah2 = explode("-", $tgl_kembali);
			$date2 = $pecah2[2];
			$month2 = $pecah2[1];
			$year2 = $pecah2[0];
			$jd1 = GregorianToJD($month1, $date1, $year1);
			$jd2 = GregorianToJD($month2, $date2, $year2);
			$selisih = $jd2 - $jd1;
			if ($selisih > 3)
			{
				$denda = ($selisih-3)*1000;
			}
			else
			{
				$denda = 0;
			}
			 $data = array(
		'id_sewa' => $this->input->post('id_sewa',TRUE),
		'tgl_kembali' => date("Y-m-d"),
		'denda' => $denda,
	    );
			$qry = $this->DetailPenyewaan_model->get_id_movie($id_sewa);
			foreach($qry->result_array() as $data1)
			{
				$data['id_movie'] = $data1['id_movie'];
				$stok = 1;
				$this->Movie_model->update_stok($data['id_movie'], $stok);
			}
			$this->Penyewaan_model->pengembalian($data);
            $this->session->set_flashdata('message', 'Pengembalian Success');
           
		   redirect(site_url('penyewaan'));
        }
    }
    
    public function update($id) 
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'penyewaan/update/'.$id.'html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'penyewaan/update/'.$id.'html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'penyewaan/update/'.$id.'html';
            $config['first_url'] = base_url() . 'penyewaan/update/'.$id.'html';
        }
		
		$row = $this->Penyewaan_model->get_by_id1($id);
		$qry=$this->Penyewa_model->get_data($q);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('penyewaan/update_action'),
				'action1' => site_url('penyewaan/update/'.$row->id_sewa),
		'id_sewa' => set_value('id_sewa', $row->id_sewa),
		'tgl_sewa' => date("Y-m-d"),
		'total_harga' => set_value('total_harga', $row->total_harga),
		'id_penyewa' => set_value('id_penyewa', $row->id_penyewa),
		'penyewa_data' => $qry,
		//'q' => $row->nama,
		'q' => $q,
		'start' => $start,
	    );
           // echo $row->id_penyewa;
			$this->load->view('penyewaan/penyewaan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penyewaan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_sewa', TRUE));
        } else {
            $data = array(
		'id_sewa' => $this->input->post('id_sewa',TRUE),
		'tgl_sewa' => date("Y-m-d"),
		'total_harga' => $this->input->post('total_harga',TRUE),
		'id_penyewa' => $this->input->post('id_penyewa',TRUE),
	    );

            $this->Penyewaan_model->update($this->input->post('id_sewa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            //redirect(site_url('penyewaan'));
			redirect(site_url('penyewaan/sewa_vcd/'.$this->input->post('id_sewa',TRUE)));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Penyewaan_model->get_by_id($id);

        if ($row) {
            $this->Penyewaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penyewaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penyewaan'));
        }
    }

    public function _rules() 
    {
	//$this->form_validation->set_rules('tgl_sewa', 'tgl sewa', 'trim|required');
	$this->form_validation->set_rules('total_harga', 'total harga', 'trim|required');
	$this->form_validation->set_rules('id_penyewa', 'id penyewa', 'trim|required');

	//$this->form_validation->set_rules('id_sewa', 'id_sewa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "penyewaan.xls";
        $judul = "penyewaan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Sewa");
	xlsWriteLabel($tablehead, $kolomhead++, "Total Harga");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Penyewa");

	foreach ($this->Penyewaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_sewa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total_harga);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_penyewa);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=penyewaan.doc");

        $data = array(
            'penyewaan_data' => $this->Penyewaan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('penyewaan/penyewaan_doc',$data);
    }

}

/* End of file Penyewaan.php */
/* Location: ./application/controllers/Penyewaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-06 16:19:21 */
/* http://harviacode.com */