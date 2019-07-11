<?php 
 
class admin extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		// $this->load->model('unit_model');
		// $this->load->model('divisi_model');
		$this->load->library('form_validation');
		$this->load->model('m_pendaftar');
		$this->load->model('divisi_model');
		$this->load->model('unit_model');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Auth"));
		}
	}
 
	function index(){
		$this->template->load('Template', 'dashboard');
		
	}
	
	function index_unit_usaha(){
		#$data['judul'] = 'Unit usaha';
		$data['unit'] = $this->unit_model->getAllunit(); 
		$this->template->load('Template', 'tambahunit',$data);
		#$this->load->view('v_admin',$data);
		#$this->load->view('unit/index',$data);
	}

	function tambah_unit(){
		$this->form_validation->set_rules('nama_unit','Nama Unit','trim|required|min_length[1]|max_length[30]|is_unique[unit_usaha.nama_unit]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');

		#$data['judul'] = 'Unit usaha';
		if($this->form_validation->run()==false){
		$this->template->load('Template', 'form_tambah_unit');
		#$this->load->view('v_admin',$data);
		#$this->load->view('unit/form_tambah_unit');
		} else{
			$this->unit_model->input_unit();
			$this->session->set_flashdata('flash', 'Ditambahkan');
			redirect('admin/tambah_unit');
		}
	}

	function hapus_unit($id){
		$this->unit_model->hapusdataunit($id);
		$this->session->set_flashdata('tambah', 'Dihapus');
		redirect('admin/index_unit_usaha');
	}

	function detail_unit($id)
	{
		$data['unit'] = $this->unit_model->detailunit($id);
		$this->template->load('Template', 'detail_unit' , $data);
		
	}

	function ubah_unit($id)
	{
		$data['unit']=$this->unit_model->detailunit($id);
		
		// $data['unit']=$this->unit_model->detailunit($id);
		$this->form_validation->set_rules('nama_unit','Nama Unit','trim|required|min_length[1]|max_length[30]|is_unique[unit_usaha.nama_unit]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		// $data['judul']='Halaman | Ubah Unit';

		if($this->form_validation->run()==false){
		$this->template->load('Template', 'ubah_unit', $data );
		} else{
			$this->unit_model->ubah_unit();
			$this->session->set_flashdata('tambah', 'Diubah');
			redirect('admin/index_divisi');
		}
	}

	function index_divisi()
	{
		$data['divisi'] = $this->divisi_model->getAlldivisi(); 
		$this->template->load('Template', 'tambahdivisi',$data);
		// $data['judul'] = 'Divisi';
		// $this->load->view('v_admin',$data);
		// $this->load->view('divisi/index',$data);
	}

	function tambah_divisi()
	{
		
		$this->form_validation->set_rules('nama_div','Nama Divisi','trim|required|min_length[1]|max_length[30]');
		// $data['judul'] = 'Tambah Divisi';
		$data['tempat']=$this->divisi_model->ambil_tempat();
		
		if ($this->form_validation->run()==false) {
			$this->template->load('Template', 'form_tambah_divisi',$data); 
		// 	#var_dump($data); die;
		}else{
		 	$this->divisi_model->input_divisi();
		 	$this->session->set_flashdata('flash', 'Ditambahkan');
		 	redirect('admin/tambah_divisi');
		 	}
	}

	function detail_divisi($id)
	{
		
		$data['divisi'] = $this->divisi_model->detail_divisi($id);
		$this->template->load('Template', 'detail_divisi' , $data);
	}

	function hapus_divisi($id){
		$this->divisi_model->hapusdatadivisi($id);
		$this->session->set_flashdata('tambah', 'Dihapus');
		redirect('admin/index_divisi');
	}

	function ubah_divisi($id)
	{
		$data['divisi']=$this->divisi_model->detail_divisi($id);
		$this->form_validation->set_rules('nama_divisi','Nama Divisi','trim|required|min_length[1]|max_length[30]');
		//$data['judul'] = 'Tambah Divisi';
		#$data['tempat']=$this->divisi_model->ambil_tempat();
		if ($this->form_validation->run()==false) {
			$this->template->load('Template', 'ubah_divisi' , $data);
			// $this->load->view('v_admin',$data);
			// $this->load->view('divisi/ubah_divisi',$data); 
			#var_dump($data); die;
		}else{
			$this->divisi_model->ubah_divisi();
			$this->session->set_flashdata('flash', 'Diubah');
			redirect('admin/index_divisi');
			}
	}

	function data_pendaftar(){

		$data['pendaftar'] =$this->m_pendaftar->getallpendaftar();
		$this->template->load('Template', 'datapendaftar' , $data);

	}

	 function detail($id){
		$data['pengaju'] = $this->m_pendaftar->getpendaftarById($id);
		$data['peserta'] = $this->m_pendaftar->getpesertaById($id);
		$this->template->load('Template', 'detail', $data);

	}

	function status_terima($id){
		$data['status'] = $this->m_pendaftar->status_terima($id);
		$data['pengaju'] = $this->m_pendaftar->getpendaftarById($id);
		$data['peserta'] = $this->m_pendaftar->getpesertaById($id);
		$this->template->load('Template', 'detail', $data);
		$this->session->set_flashdata('flash', 'Di Terima');
		redirect('admin/data_pendaftar');

	}

	function status_tolak($id){
		$data['status'] = $this->m_pendaftar->status_tolak($id);
		$data['pengaju'] = $this->m_pendaftar->getpendaftarById($id);
		$data['peserta'] = $this->m_pendaftar->getpesertaById($id);
		$this->template->load('Template', 'detail', $data);
		$this->session->set_flashdata('flash', 'Di Tolak');
		redirect('admin/data_pendaftar');


	}

	
}