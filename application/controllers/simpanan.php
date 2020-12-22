<?php /**
 * 
 */
class simpanan extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model(array(
			"simpanan_model" => "simpanan"));
		date_default_timezone_set('Asia/Jakarta');
        if(empty($this->session->userdata('level'))){
            redirect('c_login/home');
        }
	}

	public function kartu_simpanan_susu()
	{
		# code...
		$id_peternak = $this->input->post("id_peternak");
		if (isset($id_peternak)) {
			# code...
			$data = array (
				'id_peternak' => $id_peternak,
				'detail' => $this->simpanan->getDetails($id_peternak)->result(),
				'peternak' => $this->db->get("peternak")->result(),
				'anggota' => $this->simpanan->anggota($id_peternak)->row(),
			);
			// print_r($data['detail']);exit;
			$this->template->load("template", "laporan_simpanan/kartu_simpanan_susu", $data);
		} else {
			$data = array (
				'id_peternak' => is_null($id_peternak),
				'detail' => $this->simpanan->getDetails($id_peternak)->result(),
				'peternak' => $this->db->get("peternak")->result(),
				'total' => 0,
			);
			$this->template->load("template", "laporan_simpanan/kartu_simpanan_susu", $data);

		}
		// coba dulu 
		// $id_peternak = 'PTRNK_016';
		// $detail = $this->simpanan->getDetails($id_peternak)->result();
		// print_r($detail);exit;


	}
} 
?>