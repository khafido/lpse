<!DOCTYPE html>
<html lang="en">
<body id="page-top">
<div id="wrapper">

	<?php $this->load->view("admin/includes/sidebar.php") ?>

	<div id="content-wrapper">
	<div class="container-fluid">
	<?php $this->load->view("admin/includes/breadcrumb.php") ?>
	    
		<div class="card mb-3">
		<!--<div class="card-header">-->
		<!--	<a href="<?//php echo site_url('admin/products/add') ?>"><i class="fas fa-plus"></i> Add New</a>-->
		<!--</div>-->
		<div class="card-body">

			<div class="table-responsive">
				<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Judul</th>
							<th>Anggaran</th>
							<th>Pembayaran</th>
							<th>Deskripsi</th>
							<th>Provinsi</th>
							<th>Kota/Kabupaten</th>
							<th>Tgl&nbspMulai</th>
							<th>Tgl&nbspSelesai</th>
							<?php if (!$this->uri->segment(3)) { ?>
							<th>Status</th>
							<?php } ?>
							<?php if ($this->uri->segment(3)==="Pemilihan" || $this->uri->segment(3)==="Pengerjaan" || $this->uri->segment(3)==="Selesai") { ?>
							<th>Produk</th>
							<?php } ?>
							<?php if ($this->uri->segment(3)==="Pemilihan" || $this->uri->segment(3)==="Pengerjaan") { ?>
							<th>Penawar</th>
							<?php } ?>
							<?php if ($this->uri->segment(3)==="Selesai") { ?>
							<th>Pemenang</th>
							<?php } ?>
							<?php if ($this->uri->segment(3)!=="Selesai") { ?>
							<th>Action</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach ($lelangs as $lelang){ ?>
						<tr>
							<td>
								<?php echo $lelang->lelang_judul ?>
							</td>
							<td>
								<?php echo "Rp.&nbsp".number_format($lelang->lelang_anggaran) ?>
							</td>	
							<td>
								<?php echo $pembayaran[$lelang->lelang_pembayaran]?>
							</td>
                            <td>
								<?php echo substr($lelang->lelang_deskripsi, 0, 120) ?></td>
							<td>
								<?php $kabprov = $controller->getKabProv($lelang->lelang_kota); echo "$kabprov->prov ";?>
							</td>
							<td>
								<?php echo "$kabprov->kab ";?>
							</td>							
							<td>
							    <?php echo date_format(new DateTime($lelang->lelang_tglmulai), 'd M Y'); ?>
							</td>
							<td>
							    <?php echo date_format(new DateTime($lelang->lelang_tglselesai), 'd M Y'); ?>
							</td>
							<?php if ($this->uri->segment(3)==="Pemilihan" || $this->uri->segment(3)==="Pengerjaan" || $this->uri->segment(3)==="Selesai") { ?>
							<td>
							    <span>
                                    <a onclick="tampilproduk(this.id)" id="clickproduk<?=$i?>" href="#daftarP" class="text-primary" data-listproduk='<?php echo json_encode($controller->getDaftarProduk($lelang->lelang_id)); ?>'>
                                        <span class="badge badge-danger" id="lihatProduk"><?php echo $controller->getJumlahProduk($lelang->lelang_id); ?></span> Lihat 
                                    </a>
                                </span>
							</td>
							<?php } ?>
							<?php if ($this->uri->segment(3)==="Pemilihan") { ?>
							<td>
                                <span>
                                    <?php $jmltaw = $controller->getJumlahTawaran($lelang->lelang_id); ?>
                                    <a onclick="tampiltawaran(this.id)" id="clicktawaran<?=$i?>" href="#daftartawaran" class="text-primary" data-jmltaw="<?=$jmltaw?>" data-listtawaran='<?php echo json_encode($controller->getDaftarTawaran(array('lelang_id'=>$lelang->lelang_id, 'tawaran_status'=>3)));?>' data-listp='<?php echo json_encode($controller->getDaftarProduk($lelang->lelang_id)); ?>'>
                                        <span class="badge badge-info" id="jumtaw"><?php echo $jmltaw; ?> </span> Lihat 
                                    </a>
                                </span>
							</td>
							<?php } ?>
							<?php if ($this->uri->segment(3)==="Selesai" || $this->uri->segment(3)==="Pengerjaan") { ?>
							<td>
							<?php echo $controller->getpemanang($lelang->lelang_id);?>
							</td>
							<?php } ?>
							<?php if (!$this->uri->segment(3)) { ?>
							<td>
							<?php echo $statuslelang[$lelang->lelang_status]?>
							</td>
							<?php } ?>
							<!--<td width="200">-->
							<?php if ($this->uri->segment(3)!=="Hapus" && $this->uri->segment(3)!=="Selesai") { ?>
							<td>
								<a onclick="deleteConfirm('<?php echo site_url('admin/garapan/delete/'.$lelang->lelang_id) ?>')"
								 href="#" class="btn btn-small text-danger"><i class="fas fa-trash"></i>&nbspHapus</a>
							</td>
							<?php } if($this->uri->segment(3)==="Hapus") {?>
							<td>
								<a onclick="restoreConfirm('<?php echo site_url('admin/garapan/restore/'.$lelang->lelang_id) ?>')"
								 href="#" class="btn btn-small text-primary"><i class="fas fa-history "></i>&nbspPulihkan</a>
							</td>
							<?php } ?>
						</tr>
						<?php $i++; } ?>

					</tbody>
				</table>
			</div>
		</div>
		</div>
	</div>
	
    
		<!-- Sticky Footer -->
		<?php $this->load->view("admin/includes/footer.php") ?>

	</div>
	<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->


<?//php $this->load->view("admin/_partials/scrolltop.php") ?>
<?php $this->load->view("admin/includes/modal.php") ?>
<?//php $this->load->view("admin/includes/js.php") ?>
<script>
window.base_url = "<?php echo base_url(); ?>";
// Lihat Produk & Tawaran
	function tampilproduk(id){
	    var dataP = $('#'+id).data('listproduk');
	    var html = '';
	    var total = 0;
	   	for(var i = 0; i < dataP.length; i++){
	        html += '<tr>'+
              '<td scope="row">'+(i+1)+'</td>'+
              '<td>'+dataP[i].nama+'</td>'+
            //   '<td>'+parseInt(dataP[i].jumlah).toLocaleString()+'</td>'+
              '<td>'+formatNumber(parseInt(dataP[i].jumlah))+'</td>'+
            //   '<td class="text-right">Rp. '+parseInt(dataP[i].harga).toLocaleString()+'</td>'+
              '<td class="text-right">Rp.&nbsp'+formatNumber(parseInt(dataP[i].harga))+'</td>'+
              '<td>'+dataP[i].ukuran+'</td>'+
              '<td>'+dataP[i].bahan+'</td>'+
              '<td>'+dataP[i].sisi+'</td>'+
              '<td>'+dataP[i].laminasi+'</td>'+
              '<td class="text-center">'+dataP[i].catatan+'</td>'+
            '</tr>';
            total += parseInt(dataP[i].harga);
	    }
	   // html += '<tr><td></td><td><b>Total HPS :</b></td><td></td><td class="text-right"><b>Rp. '+parseInt(total).toLocaleString()+'</b></td><td></td><td></td><td></td></tr>';
	    html += '<tr><td></td><td><b>Total&nbspBiaya&nbsp:</b></td><td></td><td class="text-right"><b>Rp.&nbsp'+formatNumber(parseInt(total))+'</b></td><td></td><td></td><td></td><td></td><td></td></tr>';
	    $('#lproduk').html(html);
	    $("#daftarP").modal("show");
	}
	
	function tampiltawaran(id){
	    var datat = $('#'+id).data('listtawaran');
	    var datap = $('#'+id).data('listp');
	    var jmltaw = $('#'+id).data('jmltaw');
	    var html = '';
	    var skip = 0;
	   // console.log(datat);
	   // console.log(datap);
	   // var flag = 0;
	    if(datat.length===0){
	        html = '<label class="mx-auto">Belum ada Tawaran</label>';    
	    } else {
    	   	for(var i = 0; i < parseInt(jmltaw); i++){
    	html += '<div class="card card-body bg-light" style="margin-bottom: 10px;"><div class="row"><div class="col-xs-4 pad1 pl-2">'+
                    '<img style="height : 60px; width : 60px;" src="'+window.base_url+'assets/images/foto/'+datat[skip].foto+'" alt="">'+
                    // '<img style="height : 60px; width : 60px;" src="'+window.base_url+'assets/images/register.png" alt="">'+
                '</div>'+
                '<div class="col-xs-8 pad1 pl-3">'+
                    '<div><a href="#" class="linkdetail"> '+datat[skip].unama+'</a><br /></div>'+
                    '<div class="">Total: <b>Rp '+formatNumber(datat[skip].total)+'</b></div>'+
                '</div>'+
                '<div class="col-md-12 pad1">'+
                '<table class="table mt-2">'+
                '<thead>'+
                    '<tr>'+
                        '<th scope="col">#</th>'+
                        '<th scope="col">Nama</th>'+
                        '<th scope="col">Qty</th>'+
                        '<th scope="col">Tawaran Satuan</th>'+
                        '<th scope="col">Sub Total</th>'+
                    '</tr>'+
                '</thead>'+
                    '<tbody>';
                        var flag = 0;
                        for(var k=0; k < datap.length * parseInt(jmltaw); k++){
                            if(datap.length>k){
                                html += '<tr>';
                                html += '<th>'+(k+1)+'</th>';
                                html += '<th>'+datap[flag].nama+'</th>';
                                html += '<th>'+formatNumber(datap[flag].jumlah)+'</th>';
                                html += '<th>Rp.&nbsp'+formatNumber(datat[skip].hargap / datap[flag].jumlah)+'</th>';
                                html += '<th>Rp.&nbsp'+formatNumber(datat[skip].hargap)+'</th>';
                                html += '</tr>';
                                skip++;
                            }
                            flag++;
                        }
                html += '</tbody>'+
                '</table>'+
                '</div>'+
                '</div></div>';
    	    }
	    }
	    $('#tampiltawaran').html(html);
	    $("#daftartawaran").modal("show");
	}
	
	function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }

	function deleteConfirm(url){
		$('#btn-delete').attr('href', url);
		$('#deleteModal').modal();
	}
	
	function restoreConfirm(url){
		$('#btn-restore').attr('href', url);
		$('#restoreModal').modal();
	}
</script>
    
</body>
</html>
