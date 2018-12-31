<?php 
class M_beli extends MY_Model {
    public $foto;
	function __construct(){
		parent::__construct();
		$this->setTableName('beli');
        $this->load->library('form_validation');
	}
    //member column : id_member, nama, foto, alamat, deskripsi
    public function tambah()
    {
        $inc = (int) $this->input->post('inc');
        $beli_id = $this->input->post('beli_id');
        $no_fak = $this->input->post('no_fak');
        $tipe_transaksi = $this->input->post('tipe_transaksi');
        $tgl_trans = $this->input->post('tgl_trans');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        $supplier_nama = $this->input->post('supplier_nama');
        $no_kendaraan = $this->input->post('no_kendaraan');

        // $this->form_validation->set_rules('id_member', 'ID Member', 'required');
        $this->form_validation->set_rules('inc', 'Nama Member', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('beli_id', 'Alamat Member', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('no_fak', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('tipe_transaksi', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('tgl_trans', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('jam_mulai', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('jam_selesai', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('supplier_nama', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('no_kendaraan', 'Deskripsi Member', 'trim|required|min_length[4]');
        // $this->form_validation->set_rules('foto', 'Foto Member', 'required');
        
        if($this->form_validation->run() == FALSE){

        } else {
            return $this->input_data([
                'inc' => null,
                'beli_id' => null,
                'no_fak' => null,
                'tipe_transaksi' => null,
                'tgl_trans' => null,
                'jam_mulai' => null,
                'jam_selesai' => null,
                'supplier_nama' => null,
                'no_kendaraan' => null,
            ]);
        }
    }

    public function ubah()
    {
        $inc = (int) $this->input->post('inc');
        $beli_id = $this->input->post('beli_id');
        $no_fak = $this->input->post('no_fak');
        $tipe_transaksi = $this->input->post('tipe_transaksi');
        $tgl_trans = $this->input->post('tgl_trans');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        $supplier_nama = $this->input->post('supplier_nama');
        $no_kendaraan = $this->input->post('no_kendaraan');

        // $this->form_validation->set_rules('id_member', 'ID Member', 'required');
        $this->form_validation->set_rules('inc', 'Nama Member', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('beli_id', 'Alamat Member', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('no_fak', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('tipe_transaksi', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('tgl_trans', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('jam_mulai', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('jam_selesai', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('supplier_nama', 'Deskripsi Member', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('no_kendaraan', 'Deskripsi Member', 'trim|required|min_length[4]');
        // $this->form_validation->set_rules('foto', 'Foto Member', 'required');
        
        if($this->form_validation->run() == FALSE){

        } else {
            return $this->update_data([
                'inc' => null,
                'beli_id' => null,
                'no_fak' => null,
                'tipe_transaksi' => null,
                'tgl_trans' => null,
                'jam_mulai' => null,
                'jam_selesai' => null,
                'supplier_nama' => null,
                'no_kendaraan' => null,
            ], [
                'inc' => $inc, 
                'beli_id' => $beli_id
            ]);
        }
    }

    public function hapus()
    {
        $this->delete_data([
            'inc' => $inc, 
            'beli_id' => $beli_id
        ]);
    }

	public function upload($inputfilename, $newname)
	{
        $this->load->library('upload', $this->dataconfig($newname));

        if (!$this->upload->do_upload($inputfilename))
        {
            $data = ['state' => false, 'error' => $this->upload->display_errors()];
        }
        else
        {
            $data = ['state' => true, 'upload_data' => $this->upload->data()];
        }

        return $data;
	}

    public function dataconfig($newname){
        $config['upload_path']          = './media/member';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $newname;
        $config['file_ext_tolower']     = true;
        $config['max_size']             = 1000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        return $config;
    }
}
//not solved try this  https://stackoverflow.com/questions/28001003/extends-model-in-codeigniter