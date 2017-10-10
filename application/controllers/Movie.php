<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Movie extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Movie_model');
		$this->load->model('Kategori_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'movie/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'movie/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'movie/index.html';
            $config['first_url'] = base_url() . 'movie/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Movie_model->total_rows($q);
        $movie = $this->Movie_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'movie_data' => $movie,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('movie/movie_list', $data);
		$this->load->view('design/footer');
    }

    public function read($id) 
    {
        $row = $this->Movie_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_movie' => $row->id_movie,
		'gambar' => $row->gambar,
		'judul' => $row->judul,
		'harga_sewa' => $row->harga_sewa,
		'stok' => $row->stok,
		'sinopsis' => $row->sinopsis,
		'nama_kategori' => $row->nama_kategori,
	    );
            $this->load->view('movie/movie_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('movie'));
        }
    }

    public function create() 
    {
        $qry=$this->Kategori_model->cetaksemua();
		$data = array(
            'button' => 'Create',
            'action' => site_url('movie/create_action'),
	    'id_movie' => set_value('id_movie'),
	    'judul' => set_value('judul'),
	    'harga_sewa' => set_value('harga_sewa'),
	    'stok' => set_value('stok'),
	    'sinopsis' => set_value('sinopsis'),
	    'id_kategori' => set_value('id_kategori'),
		'gambar' => set_value('gambar'),
		'query' => $qry
	   );
	   
		//$data['query'] = $query;
        $this->load->view('movie/movie_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
			$this->create();
        } else {
		
			$config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|gif|bmp';
            $config['max_size'] = '2000';
			//$config['file_name'] = $nmfile;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('gambar')) {
                // jika validasi file gagal, kirim parameter error ke index
                $error = array('error' => $this->upload->display_errors());
                $this->create($error);
            } else {
                // jika berhasil upload ambil data dan masukkan ke database
                $gambar = $this->upload->data();
            }
			$data = array(
		'judul' => $this->input->post('judul',TRUE),
		'harga_sewa' => $this->input->post('harga_sewa',TRUE),
		'stok' => $this->input->post('stok',TRUE),
		'sinopsis' => $this->input->post('sinopsis',TRUE),
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'gambar' => $_FILES['gambar']['name']
	    );

            $this->Movie_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('movie'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Movie_model->get_by_id($id);
		$qry=$this->Kategori_model->cetaksemua();

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('movie/update_action'),
		'id_movie' => set_value('id_movie', $row->id_movie),
		'judul' => set_value('judul', $row->judul),
		'harga_sewa' => set_value('harga_sewa', $row->harga_sewa),
		'stok' => set_value('stok', $row->stok),
		'sinopsis' => set_value('sinopsis', $row->sinopsis),
		'id_kategori' => set_value('id_kategori', $row->id_kategori),
		'gambar' => set_value('gambar', $row->gambar),
		'query' => $qry
	    );
            $this->load->view('movie/movie_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('movie'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_movie', TRUE));
        } else {
		
			$config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|gif|bmp';
            $config['max_size'] = '2000';
			//$config['file_name'] = $nmfile;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('gambar')) {
                // jika validasi file gagal, kirim parameter error ke index
                $error = array('error' => $this->upload->display_errors());
                $this->create($error);
            } else {
                // jika berhasil upload ambil data dan masukkan ke database
                $gambar = $this->upload->data();
            }
			$data = array(
		'judul' => $this->input->post('judul',TRUE),
		'harga_sewa' => $this->input->post('harga_sewa',TRUE),
		'stok' => $this->input->post('stok',TRUE),
		'sinopsis' => $this->input->post('sinopsis',TRUE),
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'gambar' => $_FILES['gambar']['name']
	    );
            
            $this->Movie_model->update($this->input->post('id_movie', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('movie'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Movie_model->get_by_id($id);

        if ($row) {
            $this->Movie_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
			$this->load->helper('file');
            delete_files('./uploads/'.$row->gambar);
            redirect(site_url('movie'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('movie'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
	$this->form_validation->set_rules('harga_sewa', 'harga sewa', 'trim|required');
	$this->form_validation->set_rules('stok', 'stok', 'trim|required');
	$this->form_validation->set_rules('sinopsis', 'sinopsis', 'trim|required');
	$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
	//$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
	$this->form_validation->set_rules('id_movie', 'id_movie', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "movie.xls";
        $judul = "movie";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Judul");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga Sewa");
	xlsWriteLabel($tablehead, $kolomhead++, "Stok");
	xlsWriteLabel($tablehead, $kolomhead++, "Sinopsis");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kategori");

	foreach ($this->Movie_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->judul);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_sewa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->stok);
	    xlsWriteLabel($tablebody, $kolombody++, $data->sinopsis);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kategori);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=movie.doc");

        $data = array(
            'movie_data' => $this->Movie_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('movie/movie_doc',$data);
    }

}

/* End of file Movie.php */
/* Location: ./application/controllers/Movie.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-06-06 16:18:22 */
/* http://harviacode.com */