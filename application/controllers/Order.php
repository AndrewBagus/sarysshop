<?php
defined('BASEPATH') or exit('No direct script access allowed');

class order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_featureModel');
		$this->load->model('t_orderModel');
		$this->load->library('form_validation');
		is_logged_in();
	}

	public function index()
	{
		$feature_url = $this->uri->segment(1);
		$get_feature = $this->m_featureModel->getFeature();
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$status = $this->uri->segment(3);
		$page = $this->uri->segment(4);

		$search_option = $this->input->post('search_option');
		$key = $this->input->post('key');

		if ($status == '' || $status == null) {
			$status = 'unpaid';
		}

		$data = [
			'title' => $title['name'],
			'feature' => $get_feature,
			'url' => $title['url'],
			'status' => $status,
			'page' => $page,
			'search_option' => '',
			'key' => ''
		];

		if ($key) {
			$data['search_option'] = $search_option;
			$data['key'] = urlencode($key);
		}
		$this->load->view('main/base', $data);
	}

	public function load_insert($status)
	{
		$feature_url = $this->uri->segment(1);
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();

		$kurir = $this->t_orderModel->getKurir();
		$bank = $this->t_orderModel->getBank();

		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'kurir' => $kurir,
			'bank' => $bank,
			'status' => $status
		];
		$this->load->view('scope/' . $title['url'] . '/insert', $data);
	}

	public function load_edit($id)
	{
		$feature_url = $this->uri->segment(1);
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$result = $this->t_orderModel->getId($id);
		$varian = $this->t_orderModel->getVarian($id);
		$varian_image = $this->t_orderModel->getVarianImage($id);
		$get_kategori_pelanggan = $this->t_orderModel->getKategoriPelanggan();
		$varian_harga = $this->t_orderModel->getVarianHarga($id);


		$get_kategori_produk = $this->t_orderModel->getKategori();
		$get_jenis_produk = $this->t_orderModel->getJenis();
		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'data' => $result,
			'kategori_produk' => $get_kategori_produk,
			'jenis_produk' => $get_jenis_produk,
			'varian' => $varian,
			'varian_image' => $varian_image,
			'varian_harga' => $varian_harga,
			'kategori_pelanggan' => $get_kategori_pelanggan
		];
		$this->load->view('scope/' . $title['url'] . '/edit', $data);
	}

	public function load_table($status)
	{
		$this->load->library('pagination');
		$feature_url = $this->uri->segment(1);
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$status_name = $this->db->get_where('m_order_status', "code = '$status'")->row_array();

		$start = $this->uri->segment(4);

		// pagination config
		$config['base_url'] = '' . base_url() . $feature_url . '/index' . '/' . $status;
		$config['total_rows'] = $this->t_orderModel->countAllData($status_name['id']);
		$config['per_page'] = 8;
		// $config['uri_segment'] = 3;
		// $config['num_links'] = 2;
		// $config['use_page_numbers'] = true;
		// $config['enable_query_strings'] = true;

		//pagination style
		$config['full_tag_open'] = '<nav style="text-align:right"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		// pagination initialize
		$this->pagination->initialize($config);

		$id = $this->t_orderModel->getOrderID($status_name['id'], $config['per_page'], $start);

		$get_table = $this->t_orderModel->getTable($id);

		$get_order_detail = $this->t_orderModel->getOrderDetail($id);

		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'status' => $status,
			'status_name' => $status_name['name'],
			'table' => $get_table,
			'order_detail' => $get_order_detail,
			'start' => $start,
			'total_rows' => $config['total_rows']
		];

		$this->load->view('scope/' . $title['url'] . '/table', $data);
	}

	public function get_produk()
	{
		if ($this->input->get('search_data')) {
			$m_kategori_pelanggan_id = $this->input->get('m_kategori_pelanggan_id');
			$result = $this->t_orderModel->getProduk($this->input->get('search_data'), $m_kategori_pelanggan_id);

			$base_url = base_url();
			if (count($result) > 0) {
				$data = [];
				foreach ($result as $row) {
					$id = $row['id'];
					$varian_id = $row['varian_id'];
					$name = strtoupper($row['name']);
					$harga = number_format($row['harga'], 0, ',', '.');
					$ukuran = strtoupper($row['ukuran']);
					$warna = strtoupper($row['warna']);
					$jenis_produk = $row['jenis_produk'];
					$berat = $row['berat'];
					$tempo_kedatangan_barang = strtoupper($row['tempo_kedatangan_barang']);
					$preorder = $jenis_produk == 'Pre Order' ? "<small class='badge badge-warning'><b>PREORDER $tempo_kedatangan_barang HARI</b></small>" : "<small class='badge badge-info'><b>STOK SENDIRI</b></small>";
					$image_url = $row['image_url'] ? 'app_assets/upload/produk/' . $row['image_url'] : 'app_assets/img/no-image.png';
					$data[] = [
						'id' => $id,
						'text' => "
							<table style='width:100%;border-bottom:solid 1px'>
								<tr>
									<td style='width:10%'>
										<img src='$base_url$image_url' style='max-width:80px;max-height:80px' />
									</td>
									<td style='width:60%'>
										<span>$name</span> <small class='badge badge-info'><b>$ukuran $warna</b></small> $preorder</br>
										<b>Rp $harga</b>
									</td>
									<td style='width:30%'>
										<input type='hidden' class='varian_id' value='$varian_id'>
										<input type='hidden' class='name' value='$name'>
										<input type='hidden' class='harga' value='$harga'>
										<input type='hidden' class='jenis' value='$jenis_produk'>
										<input type='hidden' class='tempo' value='$tempo_kedatangan_barang'>
										<input type='hidden' class='ukuran' value='$ukuran'>
										<input type='hidden' class='warna' value='$warna'>
										<input type='hidden' class='image' value='$image_url'>
										<input type='hidden' class='berat' value='$berat'>
										<input type='text' class='touchspin qty' value='1' data-bts-min='1' data-bts-max='100' />
										<button type='button' onclick='add_cart(this)' class='btn btn-info btn-add-cart' style='float-right'><i class='fa-solid fa-fw fa-cart-shopping'></i> Add Produk </button>
									</td>
								</tr>
							</table>
							<script>
								$('.touchspin').TouchSpin({
									buttondown_class: 'btn btn-info',
									buttonup_class: 'btn btn-info',
								});
								$('#cari_produk').children().remove();
							</script>
						"
					];
				}
				echo json_encode($data);
			}
		}
	}

	public function get_bank()
	{
		$result = $this->t_orderModel->getBank();

		$base_url = base_url();
		if (count($result) > 0) {
			$data = [];
			foreach ($result as $row) {
				$id = $row['id'];
				$name = $row['name'];
				$no_rekening = $row['no_rekening'];
				$no_rekening = $no_rekening == '-' ? '' : ' - ' . $no_rekening;
				$selected = $name . $no_rekening;
				$image_url = $row['image_url'] ? 'app_assets/upload/bank/' . $row['image_url'] : 'app_assets/img/no-image.png';
				$data[] = [
					'id' => $row['id'],
					'html' => "$selected",
					'text' => "
					<table style='width:100%;border-bottom:solid 1px'>
					<tr>
						<td style='width:10%'>
							<img src='$base_url$image_url' style='max-width:100px;max-height:60px' />
						</td>
						<td style='width:60%'>
							<span>$name</span></br>
							<b>$no_rekening</b>
						</td>
					</tr>
				</table>"
				];
			}
			echo json_encode($data);
		}
	}

	public function get_customer()
	{
		if ($this->input->get('term')) {
			$result = $this->t_orderModel->getCustomer($this->input->get('term'));
			if (count($result) > 0) {
				foreach ($result as $row) {
					$arr_result[] = "
						<input type='hidden' id='temp_name_id' value='$row->id'>
						<h5 style='margin-bottom:0px'>$row->name</h5>
						<small style='margin-bottom:0px'>$row->alamat</small><br/>
						<small style='margin-bottom:0px'>Kec. $row->nama_kecamatan, $row->jenis_kabupaten_kota. $row->nama_kabupaten_kota</small><br/>
						<small>$row->nama_propinsi, $row->kode_pos</small>";
				}
				echo json_encode($arr_result);
			}
		}
	}

	public function get_dikirim()
	{
		if ($this->input->get('term')) {
			$result = $this->t_orderModel->getCustomer($this->input->get('term'));
			if (count($result) > 0) {
				foreach ($result as $row) {
					$arr_result[] = "
						<input type='hidden' id='temp_dikirim_id' value='$row->id'>
						<h5 style='margin-bottom:0px'>$row->name</h5>
						<small style='margin-bottom:0px'>$row->alamat</small><br/>
						<small style='margin-bottom:0px'>Kec. $row->nama_kecamatan, $row->jenis_kabupaten_kota. $row->nama_kabupaten_kota</small><br/>
						<small>$row->nama_propinsi, $row->kode_pos</small>";
				}
				echo json_encode($arr_result);
			}
		}
	}

	public function load_detail($id)
	{
		$feature_url = $this->uri->segment(1);
		$title = $this->db->get_where('m_feature', "code = '$feature_url'")->row_array();
		$result = $this->t_orderModel->getId($id);
		$varian = $this->t_orderModel->getVarian($id);
		$varian_image = $this->t_orderModel->getVarianImage($id);
		$get_kategori_pelanggan = $this->t_orderModel->getKategoriPelanggan();
		$varian_harga = $this->t_orderModel->getVarianHarga($id);

		$data = [
			'title' => $title['name'],
			'url' => $title['url'],
			'data' => $result,
			'varian' => $varian,
			'varian_image' => $varian_image,
			'varian_harga' => $varian_harga,
			'kategori_pelanggan' => $get_kategori_pelanggan
		];
		$this->load->view('scope/' . $title['url'] . '/detail', $data);
	}

	public function load_diskon_order()
	{
		$html_string = "
			<div class='col-md-12'>
				<fieldset class='col-sm-6'>
					<h5>Nama</h5>
					<div class='input-group input-group-m'>
						<input id='name_diskon_order' class='form-control cannot-null' type='text' maxlength='25' value='' placeholder='Nama diskon order' />
						<span class='text-danger'></span>
					</div>
				</fieldset>
				<fieldset class='col-md-6'>
					<h5>Nominal</h5>
					<div class='input-group input-group-m'>
						<div class='input-group-prepend'>
							<select class='form-control' onchange='change_diskon(this)' id='diskon_option' style='font-weight:bold' name='diskon_option'>
								<option value='nominal'>Rp</option>
								<option value='persen'>%</option>
							</select>
							<input id='persen' name='persen' class='form-control positive-integer' type='text' onkeyup='this.value = minmax(this.value, 0, 100)' style='width:50%;display:none' value='0'/>
							<input id='nominal' name='nominal' class='form-control format_currency cannot-null' type='text' style='width:150%' value='0'/>
						</div>
					</div>
      	</fieldset>
			</div>
			<div class='form-actions col-md-12'>
				<div class='text-xs-right'>
					<button type='button' onclick='tambah_diskon()' class='btn btn-info'>Tambahkan</button>
				</div>
			</div>
			<script>
				positive_integer_load();
			</script>
		";
		echo $html_string;
	}

	public function load_pembayaran($id)
	{
		$date = date('d-m-Y');
		$html_string = "
			<div class='col-md-12'>
				<fieldset class='col-sm-12' id='cicilan_area'>
					<h5>Cicilan</h5>
					<div class='input-group input-group-lg'>
						<input id='is_cicilan' name='is_cicilan' onchange='set_cicilan()' type='checkbox' class='switchBootstrap form-control' />
						<input type='hidden' id='status_cicilan' name='status_cicilan' value='false'>
					</div>
				</fieldset>
				<fieldset class='col-sm-12'>
					<h5>Tanggal Bayar</h5>
					<div class='input-group input-group-lg'>
						<input type='text' name='tanggal_bayar' id='tanggal_bayar' class='form-control' placeholder='Format tanggal (dd-MM-yyyy)' value='$date'>
						<span class='input-group-addon'><i class='fa fa-calendar'></i></span>
					</div>
					<span class='text-danger'></span>
				</fieldset>
				<fieldset class='col-sm-12'>
					<h5>Bank Pembayaran</h5>
					<div class='input-group input-group-lg'>
						<select class='form-control select2' id='m_bank' name='m_bank' style='width: 100%;'>
						</select>
						<span class='text-danger'></span>
					</div>
				</fieldset>
				<fieldset class='col-sm-12 installment' style='display:none'>
					<h5>Nominal</h5>
					<div class='input-group input-group-lg'>
						<input id='nominal_pembayaran' name='nominal_pembayaran' class='form-control format_currency' type='text' value='' />
					</div>
					<span class='text-danger'></span>
				</fieldset>
			</div>
			<div class='form-actions col-md-12'>
				<div class='text-xs-right'>
					<button type='button' onclick='proses_pembayaran(`$id`)' class='btn btn-info'>Simpan</button>
				</div>
			</div>
			<script>
				positive_integer_load();
				load_bank();
				switch_bootstrap('is_cicilan', 'Ya', 'Tidak');
				function set_cicilan() {
					if ($('#is_cicilan').is(':checked') == true) {
						$('.installment').show();
						$('#nominal_pembayaran').addClass('cannot-null');
						$('#status_cicilan').val('true');
					} else {
						$('.installment').hide();
						$('#nominal_pembayaran').removeClass('cannot-null');
						$('#status_cicilan').val('false');
					}
				}
				$('#tanggal_bayar').datepicker({
					autoclose: true,
					todayHighlight: true,
					todayBtn: true,
					dateFormat: 'dd-mm-yy',
					maxDate: -0,
					orientation: 'bottom'
				});
			</script>
		";
		echo $html_string;
	}

	public function load_pelunasan($id)
	{
		$this->db->order_by('tanggal_pembayaran ASC');
		$pembayaran = $this->db->get_where('t_order_pembayaran', "t_order_id = '$id'")->result_array();
		$date = date('d-m-Y');
		$riwayat_string = "";
		$sum_bayar = 0;
		foreach ($pembayaran as $row) {
			$sum_bayar = $sum_bayar + (int)$row['nominal'];
			$riwayat_string = "
				<p class='col-md-6' style='margin-bottom:10px'>" . date('d-M-Y', strtotime($row['tanggal_pembayaran'])) . "</p>
				<p class='col-md-6' style='margin-bottom:10px'><b>Rp " . number_format($row['nominal'], 0, ',', ',') . "</b></p>
			";
		}
		$order = $this->db->get_where('t_order', "id = '$id'")->row_array();
		$sisa_bayar = number_format(((int)$order['grandtotal'] - (int)$sum_bayar), 0, ',', ',');
		$html_string = "
			<div class='col-md-6'>
				<fieldset class='col-sm-12'>
					<h5>Tanggal Bayar</h5>
					<div class='input-group input-group-lg'>
						<input type='text' name='tanggal_bayar' id='tanggal_bayar' class='form-control' placeholder='Format tanggal (dd-MM-yyyy)' value='$date'>
						<span class='input-group-addon'><i class='fa fa-calendar'></i></span>
					</div>
					<span class='text-danger'></span>
				</fieldset>
				<fieldset class='col-sm-12'>
					<h5>Bank Pembayaran</h5>
					<div class='input-group input-group-lg'>
						<select class='form-control select2' id='m_bank' name='m_bank' style='width: 100%;'>
						</select>
						<span class='text-danger'></span>
					</div>
				</fieldset>
				<fieldset class='col-sm-12'>
					<h5>Sisa bayar</h5>
					<div class='input-group input-group-lg'>
						<input id='nominal_pembayaran' name='nominal_pembayaran' disabled class='form-control format_currency' type='text' value='$sisa_bayar' />
					</div>
					<span class='text-danger'></span>
				</fieldset>
			</div>
			<div class='col-md-6'>
				<fieldset style='margin-bottom:0px'>
					<p class='col-md-8' style='padding:0px;margin-bottom:0px;color:grey'>Riwayat Pembayaran</p>
					<div class='input-group input-group-sm' style='border: 1px solid grey;padding:15px'>
						" . $riwayat_string . "
					</div>
				</fieldset>
			</div>
			<div class='form-actions col-md-12'>
				<div class='text-xs-right'>
					<button type='button' onclick='proses_pembayaran(`$id`)' class='btn btn-info'>Simpan</button>
				</div>
			</div>
			<script>
				positive_integer_load();
				load_bank();
				$('#tanggal_bayar').datepicker({
					autoclose: true,
					todayHighlight: true,
					todayBtn: true,
					dateFormat: 'dd-mm-yy',
					maxDate: -0,
					orientation: 'bottom'
				});
			</script>
		";
		echo $html_string;
	}

	public function load_riwayat($id)
	{
		$this->db->select('t_order_pembayaran.tanggal_pembayaran, t_order_pembayaran.nominal, t_order_pembayaran.jenis_pembayaran, m_bank.bank_name, m_bank.no_rekening, m_bank.atas_nama');
		$this->db->from('m_bank m_bank');
		$this->db->order_by('t_order_pembayaran.tanggal_pembayaran ASC');
		$this->db->where("t_order_pembayaran.t_order_id = '$id' AND t_order_pembayaran.m_bank_id = m_bank.id");
		$pembayaran = $this->db->get('t_order_pembayaran')->result_array();
		$riwayat_string = "";
		$sum_bayar = 0;
		foreach ($pembayaran as $row) {
			$sum_bayar = $sum_bayar + (int)$row['nominal'];
			$no_rek = $row['no_rekening'] == '-' ? '' : ' - ' . $row['no_rekening'];
			$status = $row['jenis_pembayaran'] == 'installment' ? 'DP' : 'Lunas';
			$riwayat_string = "
				<p class='col-md-3' style='margin-bottom:10px'>" . date('d-M-Y', strtotime($row['tanggal_pembayaran'])) . "</p>
				<p class='col-md-4' style='margin-bottom:10px'>" . $row['bank_name'] . $no_rek . "</p>
				<p class='col-md-3' style='margin-bottom:10px'><b>Rp " . number_format($row['nominal'], 0, ',', ',') . "</b></p>
				<p class='col-md-2' style='margin-bottom:10px'><b>" . $status . "</b></p>
			";
		}
		$riwayat_string = $riwayat_string == '' ? 'Belum ada pembayaran' : $riwayat_string;
		$html_string = "
			<div class='col-md-12'>
				<fieldset style='margin-bottom:0px'>
					<div class='input-group input-group-sm' style='border: 1px solid grey;padding:15px'>
						" . $riwayat_string . "
					</div>
				</fieldset>
			</div>
		";
		echo $html_string;
	}

	public function load_pengiriman($id)
	{
		$date = date('d-m-Y');
		$html_string = "
			<div class='col-md-12'>
				<fieldset class='col-sm-12'>
					<h5>Tanggal Pengiriman</h5>
					<div class='input-group input-group-lg'>
						<input type='text' name='tanggal_pengiriman' id='tanggal_pengiriman' class='form-control' placeholder='Format tanggal (dd-MM-yyyy)' value='$date'>
						<span class='input-group-addon'><i class='fa fa-calendar'></i></span>
					</div>
					<span class='text-danger'></span>
				</fieldset>
				<fieldset class='col-sm-12'>
					<h5>No Resi</h5>
					<div class='input-group input-group-lg'>
						<input id='no_resi' name='no_resi' class='form-control positive-integer cannot-null' type='text' value='' />
					</div>
					<span class='text-danger'></span>
				</fieldset>
			</div>
			<div class='form-actions col-md-12'>
				<div class='text-xs-right'>
					<button type='button' onclick='proses_pengiriman(`$id`)' class='btn btn-info'>Simpan</button>
				</div>
			</div>
			<script>
				positive_integer_load();
				$('#tanggal_pengiriman').datepicker({
					autoclose: true,
					todayHighlight: true,
					todayBtn: true,
					dateFormat: 'dd-mm-yy',
					maxDate: -0,
					orientation: 'bottom'
				});
			</script>
		";
		echo $html_string;
	}

	public function load_biaya_order()
	{
		$html_string = "
			<div class='col-md-12'>
				<fieldset class='col-sm-6'>
					<h5>Nama</h5>
					<div class='input-group input-group-m'>
						<input id='name_biaya_order' class='form-control cannot-null' type='text' maxlength='25' value='' placeholder='Nama diskon order' />
						<span class='text-danger'></span>
					</div>
				</fieldset>
				<fieldset class='col-md-6'>
					<h5>Nominal</h5>
					<div class='input-group input-group-m'>
						<div class='input-group-prepend'>
							<select class='form-control' onchange='change_biaya(this)' id='biaya_option' style='font-weight:bold' name='diskon_option'>
								<option value='nominal'>Rp</option>
								<option value='persen'>%</option>
							</select>
							<input id='persen' name='persen' class='form-control positive-integer' type='text' onkeyup='this.value = minmax(this.value, 0, 100)' style='width:50%;display:none' value='0'/>
							<input id='nominal' name='nominal' class='form-control format_currency cannot-null' type='text' style='width:150%' value='0'/>
						</div>
					</div>
      	</fieldset>
			</div>
			<div class='form-actions col-md-12'>
				<div class='text-xs-right'>
					<button type='button' onclick='tambah_biaya()' class='btn btn-info'>Tambahkan</button>
				</div>
			</div>
			<script>
				positive_integer_load();
			</script>
		";
		echo $html_string;
	}

	public function load_edit_cart($varian_id)
	{
		$base_url = base_url();
		$html_string = "
			<div class='col-md-12' id='edit_cart' style='text-align:center'>
				
			</div>
			<div class='form-actions col-md-12'>
				<div class='text-xs-right'>
					<button type='button' onclick='edit_cart(`$varian_id`)' class='btn btn-info'>Simpan</button>
				</div>
			</div>
			<script>
				var image = $('#produk_image_$varian_id').val();
				var name = $('#produk_name_$varian_id').val();
				var keterangan = $('#produk_keterangan$varian_id').val();
				var harga = $('#produk_price_$varian_id').val();
				var qty = $('#produk_qty_$varian_id').val();

				var html_string = `
					<div class='col-md-4'></div>
					<div class='col-md-4'>
						<img src='$base_url` + image + `' style='padding:0px; width:100%'>
					</div>
					<div class='col-md-12'>
						<span>`+name+ ` ` + keterangan + `</span><br/>
						<b>`+harga+`</b>
					</div>
					<div class='col-md-4'></div>
					<div class='col-md-4'>
						<input type='text' id='qty_varian_$varian_id' class='touchspin' value='`+qty+`' data-bts-min='1' data-bts-max='100' />
					</div>
				`;
				$('#edit_cart').html(html_string);

				$('.touchspin').TouchSpin({
					buttondown_class: 'btn btn-info',
					buttonup_class: 'btn btn-info',
				});
			</script>
		";
		echo $html_string;
	}

	public function save()
	{
		$this->form_validation->set_rules('customer_id', 'Customer ID', 'required');
		$this->form_validation->set_rules('dikirim_ke', 'Dikirim ke', 'required');
		$this->form_validation->set_rules('tanggal_order', 'Tanggal Order', 'required');
		$this->form_validation->set_rules('no_varian', 'Varian', 'required');
		$this->form_validation->set_rules('biaya_kurir', 'Biaya Kurir', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => [],
				'message' => 'Validasi gagal'
			];
			print json_encode($msg);
		} else {
			$result = $this->t_orderModel->insertData();
			$msg = [
				'status' => $result,
				'data' => [],
				'message' => 'Order berhasil ditambahkan!'
			];
			$this->session->set_flashdata('flash_success', 'Order berhasil ditambahkan!');
			print json_encode($msg);
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => [],
				'message' => 'Validasi gagal'
			];
			print json_encode($msg);
		} else {
			$result = $this->t_orderModel->editData($id);
			if ($result == 'failed') {
				$msg = [
					'status' => 'failed',
					'data' => [],
					'message' => 'Server eror, Upload gambar gagal!'
				];
				$this->session->set_flashdata('flash_failed', 'Server eror, Upload gambar gagal!');
				print json_encode($msg);
			} else {
				$msg = [
					'status' => $result,
					'data' => [],
					'message' => 'Jenis produk berhasil diubah!'
				];
				$this->session->set_flashdata('flash_success', 'Jenis produk berhasil diubah!');
				print json_encode($msg);
			}
		}
	}

	public function delete($id)
	{
		$result = $this->t_orderModel->deleteData($id);
		$msg = [
			'status' => $result,
			'data' => [],
			'message' => 'Produk berhasil dihapus!'
		];
		$this->session->set_flashdata('flash_success', 'Produk berhasil dihapus!');
		print json_encode($msg);
	}

	public function get_autocomplete()
	{
		if ($this->input->get('term')) {
			$result = $this->t_orderModel->getAutoCompleteName($this->input->get('term'));
			if (count($result) > 0) {
				foreach ($result as $row) {
					$arr_result[] = $row->name;
					// var_dump($arr_result);
					// echo json_encode($arr_result);
				}
				echo json_encode($arr_result);
			}
		}
	}

	public function get_supplier()
	{
		if ($this->input->get('search_data')) {
			$result = $this->t_orderModel->getSupplier($this->input->get('search_data'));
			if (count($result) > 0) {
				$data = [];
				foreach ($result as $row) {
					$data[] = [
						'id' => $row['id'],
						'text' => $row['name']
					];
				}
				echo json_encode($data);
			}
		}
	}

	public function checking_code()
	{
		if ($this->input->post('code')) {
			$result = $this->t_orderModel->checkingCode($this->input->post('code'));
			if ($result > 0) {
				$msg = [
					'status' => false,
					'data' => [],
					'message' => 'Duplicate code!'
				];
				print json_encode($msg);
			} else {
				$msg = [
					'status' => true,
					'data' => [],
					'message' => 'Code ready to use!'
				];
				print json_encode($msg);
			}
		}
	}

	public function proses_pembayaran()
	{
		$this->form_validation->set_rules('id', 'ID', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => [],
				'message' => 'Validasi gagal'
			];
			print json_encode($msg);
		} else {
			$result = $this->t_orderModel->prosesPembayaran();
			$msg = [
				'status' => $result,
				'data' => [],
				'message' => 'Pembayaran berhasil!'
			];
			$this->session->set_flashdata('flash_success', 'Pembayaran berhasil!');
			print json_encode($msg);
		}
	}

	public function proses_pengiriman()
	{
		$this->form_validation->set_rules('id', 'ID', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => [],
				'message' => 'Validasi gagal'
			];
			print json_encode($msg);
		} else {
			$result = $this->t_orderModel->prosesPengiriman();
			$msg = [
				'status' => $result,
				'data' => [],
				'message' => 'Pengiriman berhasil!'
			];
			$this->session->set_flashdata('flash_success', 'Pengiriman berhasil!');
			print json_encode($msg);
		}
	}

	public function proses_orderan()
	{
		$this->form_validation->set_rules('id', 'ID', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => [],
				'message' => 'Validasi gagal'
			];
			print json_encode($msg);
		} else {
			$result = $this->t_orderModel->prosesOrderan();
			$msg = [
				'status' => $result,
				'data' => [],
				'message' => 'Proses berhasil!'
			];
			$this->session->set_flashdata('flash_success', 'Proses berhasil!');
			print json_encode($msg);
		}
	}

	public function diterima_pelanggan()
	{
		$this->form_validation->set_rules('id', 'ID', 'required');
		if (!$this->form_validation->run()) {
			$msg = [
				'status' => 'failed',
				'data' => [],
				'message' => 'Validasi gagal'
			];
			print json_encode($msg);
		} else {
			$result = $this->t_orderModel->diterimaPelanggan();
			$msg = [
				'status' => $result,
				'data' => [],
				'message' => 'Orderan diterima pelanggan!'
			];
			$this->session->set_flashdata('flash_success', 'Orderan diterima pelanggan!');
			print json_encode($msg);
		}
	}
}
