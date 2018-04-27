<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Con_form extends CI_Controller {

	public function index()
	{	
		$this->load->view('view_form');
	}
	public function input_data()
	{
		//tugas 3 ditambahi seperti dibawah ini
		//tahun
		//semester (ganjil, genap)
		$this->load->library('session');	//mengambil data yang diinputakan di view form
		$no = $this->input->post('no');
		$d['kode_mk'] =$this->input->post('kode_mk');
		if (isset($d['kode_mk'])) {			
		$d['nama_mk'] = $this->input->post('nama_mk');
		$d['sks'] = $this->input->post('sks');
		$uts = $this->input->post('uts');
		$uas = $this->input->post('uas');
		$tugas = $this->input->post('tugas');
		
		$nilai_akhir=(30*$uts + 50*$uas + 20*$tugas)/100;	//setelah itu dihitung nilai akhir yang digunakan untuk menghitung grade

		if ($nilai_akhir<50) {	//percabangan
			$d['nilai'] = "E";
			$d['indeks'] =0;
		}
		else if ($nilai_akhir<60) {
			$d['nilai'] = "D";
			$d['indeks'] =1;
		}
		else if ($nilai_akhir<70) {
			$d['nilai'] = "C";
			$d['indeks'] =2;
		}
		else if ($nilai_akhir<75) {
			$d['nilai'] = "C+";
			$d['indeks'] =2.5;
		}
		else if ($nilai_akhir<80) {
			$d['nilai'] = "B";
			$d['indeks'] =3;
		}
		else if ($nilai_akhir<85) {
			$d['nilai'] = "B+";
			$d['indeks'] =3.5;
		}
		else  {
			$d['nilai'] = "A";
			$d['indeks'] =4;
		}
		
		$total_data = count($this->session->userdata('jml'))+($no - 1);	

		$this->session->set_userdata('jml',$total_data); //memasukkan data ke session
		$this->session->set_userdata('record'.$total_data, $d);
		}
		$this->tampil_data(); //menjalankan function tampil_data

	}
	public function tampil_data(){
		$record;
		$this->load->library('session');	//agar session bisa dijalankan di con
		$index = $this->session->userdata('jml');	//
		for ($n=0; $n <= $index; $n++) { 
			$record[$n]= $this->session->userdata('record'.$n);
		}
		$a['data']=$record;
		$a['index']=$index;
		$this->load->view('view_tabel',$a);	//agar data session dapat ditampilkan di view tabel maka diubah ke array dan dimasukkan ke array a. shasil dari array dimasukkan di sini

	}

	public function hapus_data()
	{
		$this->load->library('session');
		$data[0] = "no";
		$data[1] = "kode_mk";
		$data[2] = "nama_mk";
		$data[3] = "sks";
		$data[4] = "uts";
		$data[5] = "uas";
		$data[6] = "tugas";
		//$data = array("no", "kode_mk", "nama_mk", "sks", "uts", "uas", "tugas");
		unset($data[1]);
		//session_unset('kode_mk');	//remove all
		
		$this->tampil_data();
	}
}
?>