<?php 

class M_legalisir extends CI_Model{	
    
	function tampilProduk(){
		return $this->db->get('produk');
    }
    
    function cekKeranjang(){
			$pemesan = $this->session->userdata('username');
			$this->db->select('id_transaksi');
			$this->db->from('transaksi');
			$this->db->where('status_pesanan','0');
			$this->db->where('id_pemesan',$pemesan);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}

		function cekProdukKeranjang($id){
			$pemesan = $this->session->userdata('username');
			$this->db->select('detail_transaksi.id_produk, detail_transaksi.jumlah_produk, detail_transaksi.id_detail_transaksi');
			$this->db->from('transaksi');
			$this->db->join('detail_transaksi','transaksi.id_transaksi = detail_transaksi.id_transaksi');
			$this->db->where('detail_transaksi.id_transaksi',$id);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}

		function cekPesanan(){
			$pemesan = $this->session->userdata('username');
			$this->db->select('id_transaksi');
			$this->db->from('transaksi');
			$this->db->where('status_pesanan','1');
			$this->db->where('id_pemesan',$pemesan);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		function cekDetailTransaksi($id_transaksi){
			$this->db->select('id_transaksi');
			$this->db->from('detail_transaksi');
			$this->db->where('id_transaksi',$id_transaksi);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
    }

    function getIdTransaksiTerbesar(){
			$this->db->select('id_transaksi');
			$this->db->from('transaksi');
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
    }

    function getIdProdukDetailTransaksi(){
			$pemesan = $this->session->userdata('username');
			$this->db->select('*');
			$this->db->from('transaksi');
			$this->db->join('detail_transaksi','transaksi.id_transaksi = detail_transaksi.id_transaksi');
			$this->db->where('transaksi.status_pesanan','0');
			$this->db->where('transaksi.id_pemesan',$pemesan);
			$query=$this->db->get();
			return $query->result();
    }

    function getTransaksiKeranjang($status_pesanan){
			$id_pemesan = $this->session->userdata('username');
			$this->db->select('*');
			$this->db->from('transaksi');
			$this->db->join('detail_transaksi','transaksi.id_transaksi = detail_transaksi.id_transaksi');
			$this->db->join('produk','produk.id_produk = detail_transaksi.id_produk');
			$this->db->where('transaksi.status_pesanan', $status_pesanan);
			$this->db->where('transaksi.id_pemesan',$id_pemesan);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}

		function getTransaksiById($id_transaksi){
			$id_pemesan = $this->session->userdata('username');
			$this->db->select('*');
			$this->db->from('transaksi');
			$this->db->join('detail_transaksi','transaksi.id_transaksi = detail_transaksi.id_transaksi');
			$this->db->join('produk','produk.id_produk = detail_transaksi.id_produk');
			$this->db->where('transaksi.id_transaksi',$id_transaksi);
			$this->db->where('transaksi.id_pemesan',$id_pemesan);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
	
		
		function cekIdTransaksi($id_transaksi){
			$this->db->select('id_transaksi');
			$this->db->from('transaksi');
			$this->db->where('id_transaksi',$id_transaksi);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		function getPesananSaya(){
			$id_pemesan = $this->session->userdata('username');
			$this->db->select('*');
			$this->db->from('transaksi');
			$this->db->join('status_pesanan','status_pesanan.id_status = transaksi.status_pesanan');
			$this->db->where('id_pemesan',$id_pemesan);
			$this->db->order_by('transaksi.tanggal_transaksi', 'ASC');
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		function getDetailPesananSaya($id_transaksi){
			$this->db->select('*');
			$this->db->from('transaksi');
			$this->db->join('status_pesanan','status_pesanan.id_status = transaksi.status_pesanan');
			$this->db->where('transaksi.id_transaksi',$id_transaksi);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		function getProdukPesananSaya($id_transaksi){
			$id_pemesan = $this->session->userdata('username');
			$this->db->select('*');
			$this->db->from('detail_transaksi');
			$this->db->join('produk','produk.id_produk = detail_transaksi.id_produk');
			$this->db->where('detail_transaksi.id_transaksi',$id_transaksi);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}

		}

		function cekProdukDetailTransaksi($id_transaksi){
			$this->db->select('*');
			$this->db->from('detail_transaksi');
			$this->db->where('id_transaksi',$id_transaksi);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}



		function getDataTransaksi($number,$offset){
			$status = $this->input->post('status_pesanan');
			$operator = $this->session->userdata('status');
			$this->db->select('*');
			$this->db->join('status_pesanan','transaksi.status_pesanan = status_pesanan.id_status');
			$this->db->join('alumni','transaksi.id_pemesan = alumni.username');
			if($operator == "keuangan"){
				if($status == null){
					$this->db->where('transaksi.status_pesanan >= ','3');
				}else if($status == '3'){
					$this->db->where('transaksi.status_pesanan','3');
				}else{
					$this->db->where('transaksi.status_pesanan >= ','4');
				}
				if($this->db->affected_rows() > 0){
					$query = $this->db->get('transaksi',$number,$offset);
					return 	$query->result();	
				}else{
					return false;
				}
			}elseif($operator == "recording"){
				if($status == null){
					$this->db->where('transaksi.status_pesanan >= ','4');
				}else if($status == '4'){
					$this->db->where('transaksi.status_pesanan','4');
				}else if($status == '5'){
					$this->db->where('transaksi.status_pesanan','5');
				}else if($status == '6'){
					$this->db->where('transaksi.status_pesanan','6');
				}else{
					$this->db->where('transaksi.status_pesanan','7');
				}
				if($this->db->affected_rows() > 0){
					$query = $this->db->get('transaksi',$number,$offset);
					return 	$query->result();	
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		
		function getTotalPembayaran($id_transaksi){
			$this->db->select('total_pembayaran');
			$this->db->from('transaksi');
			$this->db->where('id_transaksi',$id_transaksi);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
	 
		function jumlah_data(){
			$status = $this->input->post('status_pesanan');
			$operator = $this->session->userdata('status');
			$this->db->select('*');
			$this->db->join('status_pesanan','transaksi.status_pesanan = status_pesanan.id_status');
			$this->db->join('alumni','transaksi.id_pemesan = alumni.username');
			if($operator == "keuangan"){
				if($status == null){
					$this->db->where('transaksi.status_pesanan >= ','3');
				}else if($status == '3'){
					$this->db->where('transaksi.status_pesanan','3');
				}else{
					$this->db->where('transaksi.status_pesanan >= ','4');
				}
			}
			if($operator == "recording"){
				if($status == null){
					$this->db->where('transaksi.status_pesanan >= ','4');
				}else if($status == '4'){
					$this->db->where('transaksi.status_pesanan','4');
				}else if($status == '5'){
					$this->db->where('transaksi.status_pesanan >=','5');
				}else if($status == '6'){
					$this->db->where('transaksi.status_pesanan >=','6');
				}else{
					$this->db->where('transaksi.status_pesanan >= ','7');
				}
			}
			$query = $this->db->get('transaksi');
			if($this->db->affected_rows() > 0){
				return 	$query->num_rows();	
			}else{
				return false;
			}
		}

		// function data($number,$offset){
		// 	return $query = $this->db->get('transaksi',$number,$offset)->result();		
		// }
	 
		// function jumlah_data(){
		// 	return $this->db->get('transaksi')->num_rows();
		// }
	
		function getBuktiTransfer($id_transaksi){
			$this->db->select('bukti_transfer');
			$this->db->from('transaksi');
			$this->db->where('id_transaksi',$id_transaksi);
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
	
		function getJumlahTransaksiBaru(){
			$operator = $this->session->userdata('status');
			$this->db->select('id_transaksi ,count(id_transaksi) as jumlah_transaksi_baru');
			$this->db->from('transaksi');
			if($operator == "keuangan"){
				$this->db->where('transaksi.status_pesanan','3');
			}elseif($operator == "recording"){
				$this->db->where('transaksi.status_pesanan','4');
			}else{
				$this->db->where('transaksi.status_pesanan','asd');
			}
			$query=$this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}

		function tampilIjazah(){
			return $this->db->get('ijazah');
		}
		
}