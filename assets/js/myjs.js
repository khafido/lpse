
    // Ajukan Tawaran
        
    function setLid(id){
        var lid = $('#'+id).data('lid');
        // var anggaran = $('#'+id).data('hpsku').toLocaleString();
        var anggaran = formatNumber($('#'+id).data('hpsku'));
        $("input[name='lid']").val(lid);    
        $("input[name='anggaran']").val(anggaran);
        $("#penawaran").modal("show");
        // $("input[name='anggaran']").focus();
    }
    
    $('.modal').on('shown.bs.modal', function() {
      $(this).find('[autofocus]').focus();
    });
    // --------------------------------------------------------------------------
    
    // Tambah Lelang
    
    window.undef;
    window.dataB = '[]';
    
// 	$.validator.addMethod("noSpace", function(value, element) {
// 		return $.trim($("#name").val()).length!=0;
// 	}, "<span class='danger_label'>No space please and don't leave it empty</span>");
	
	$('#add').on('click',function(){
		window.type = "POST";
// 		$('#parent').prop('disabled',false);
// 		$('#sub').prop('disabled',false);
		$('#satuan').val("");
		$('#bahan').val("");
		$('#harga').val("");
		$('#catatan').html("");
	});
    
	$('#formTambahProduk').validate({
		rules: {
			produk: {
				required: true
			},
			ukuran: {
			    required: true
			},
			bahan: {
			    required: true
			},
			jumlah: {
			    required: true
			},
			harga: {
			    required: true
			}
		},
		messages: {
			produk: {
				required: "Silahkan pilih Produk!"
			},
			ukuran: {
				required: "Silahkan pilih / masukkan Satuan!"
			},
			bahan: {
				required: "Silahkan pilih / masukkan Bahan!"
			},
			jumlah: {
				required: "Masukkan jumlah Produk!"
			},
			harga: {
				required: "Masukkan jumlah HPS!"
			}
		}
// 		,
// 		submitHandler: function(form) {
// 			return true;
// 		},
//         invalidHandler: function(e, validation){
//             console.log("invalidHandler : event", e);
//             console.log("invalidHandler : validation", validation);
//             return false;
//         }
	});	
    
    show_list_produk();
    
    // Custom Ukuran & Bahan
    var selectUkuran = '';
    $('#checku').change(function (){
        if($(this).is(':checked')){
            // $("input[name='ukuran']").val("");
            selectUkuran = $('#isiukuran').html();
            $('#isiukuran').html('<input onchange="ambil_harga()" id="ukuran" name="ukuran" placeholder="Custom Ukuran. . ." class="form-control" required/>');    
        } else {
            $('#isiukuran').html(selectUkuran);
        }
        ambil_harga();
    });
    
    var selectBahan = '';
    $('#checkb').change(function (){
        if($(this).is(':checked')){
            // $("input[name='ukuran']").val("");
            selectBahan = $('#isibahan').html();
            $('#isibahan').html('<input onchange="ambil_harga()" id="bahan" name="bahan" placeholder="Custom Bahan. . ." class="form-control" required/>');    
        } else {
            $('#isibahan').html(selectBahan);
        }
        ambil_harga();
    });
    
    // -----------------------------------------------------------------------------
    
    $('#parent').change(function show_sub(){
		var id = $('#parent').val();
// 		$('.sub>.nice-select>.list').html(null);
        $.ajax({
            url : "<?php echo base_url();?>kategori/getSub",
            method : "POST",
            data : {id: id},
            async : false,
            dataType : 'json',
            success: function(data){
                // var html = '<option value="0"></option>';
                var html = '';
                // var nice = '';
                var i;
                for(i=0; i<data.length; i++){
                    // nice += '<li data-value="'+data[i].kategori_id+'" class="option">'+data[i].kategori_nama+'</li>';
                    html += '<option value="'+data[i].kategori_id+'">'+data[i].kategori_nama+'</option>';
                }
                // $('.sub>.nice-select>.list').html(nice);
                $('#sub').html(html);
            },
            error: function (response) {
              console.log(response);
            }
        });
    });
    
    function show_produk(){
		var id = $('#sub').val();
        $.ajax({
            url : "<?php echo base_url();?>kategori/getProduk",
            method : "POST",
            data : {id: id},
            async : false,
            dataType : 'json',
            success: function(data){
                var produk = '';
                var i;
                if(id!==null){
                    for(i=0; i<data.length; i++){
                        produk += '<option value="'+data[i].kategori_id+'">'+data[i].kategori_nama+'</option>';
                    }
                }
                $('#produk').html(produk);
            },
            error: function (response) {
              console.log(response);
            }
        });
    } 
    
    $('#btnTambah').click(function(event){
        show_produk();
        $("input[name='bahan']").val("");
        $("input[name='ukuran']").val("");
        $("input[name='jumlah']").val(1);
        $("input[name='harga']").val(0);
        $("input[name='catatan']").html("");
        show_ukuran_bahan();
        ambil_harga();
        // $("input[name='tambahProduk']").modal("show");
        $("#tambahProduk").modal("show");
    });
    
    // function simpan_produk(){
    $('#simpanProduk').click(function(){
        if ($('#formTambahProduk').valid()) {

    		var produkid = $('select[name="produk"]').val();
            var produk   = $('select[name="produk"] :selected').text();
            var ukuran   = $('#ukuran').val();
            var bahan    = $('#bahan').val();
            var jumlah   = parseFloat($('input[name="jumlah"]').val().replace(/,/g, ''));
            var harga    = parseFloat($('input[name="harga"]').val().replace(/,/g, ''));
            var catatan  = $('textarea[name="catatan"]').val();
            var sisi = $('#sisi').val();
            var laminasi = $('#laminasi').val();
            var checku = $('#checku').is(':checked')?'custom':null;
            var checkb = $('#checkb').is(':checked')?'custom':null;
            
            var data = JSON.parse(window.dataB);
            data.push({"produkid":produkid, "produk":produk, "ukuran":ukuran, "bahan":bahan, "jumlah":jumlah, "harga":harga, "catatan":catatan, "sisi":sisi, "laminasi":laminasi, "customu":checku, "customb":checkb});
            window.dataB = JSON.stringify(data);
            show_list_produk();
            $("#tambahProduk").modal("hide");
        }
    });
    // }
    
    function show_list_produk(){
        var listB = "";
        var total = 0;
        $("input[name='pekerjaan']").val(window.dataB);
        var data = JSON.parse(window.dataB);
        var panjang = 0;
        if(data!==window.undef){
            panjang = data.length;
        }
        for(i=0; i < panjang; i++){
  listB += '<tr>'+
              '<td scope="row">'+(i+1)+'</td>'+
              '<td>'+data[i].produk+'</td>'+
            //   '<td class="text-right">'+parseInt(data[i].jumlah).toLocaleString()+'</td>'+
              '<td class="text-right">'+formatNumber(parseInt(data[i].jumlah))+'</td>'+
            //   '<td class="text-right">Rp. '+parseInt(data[i].harga).toLocaleString()+'</td>'+
              '<td class="text-right">Rp.&nbsp;'+formatNumber(parseInt(data[i].harga))+'</td>'+
              '<td>'+data[i].ukuran+'</td>'+
              '<td>'+data[i].bahan+'</td>'+
              '<td>'+data[i].sisi+'</td>'+
              '<td>'+data[i].laminasi+'</td>'+
              '<td class="text-center">'+data[i].catatan+'</td>'+
              '<td><a id="hapusProduk" href="#" data-hapus="'+i+'" class="text text-xl-right text-danger"><i class="fas fa-close"></i>&nbsp;</a></td>'+
            '</tr>';
            total += data[i].harga;
        }
        // listB += '<tr><td></td><td><b>Total HPS :</b></td><td></td><td class="text-right"><b>Rp. '+parseInt(total).toLocaleString()+'</b></td><td></td><td></td><td></td></tr>';
        listB += '<tr><td></td><td><b>Total HPS&nbsp;:</b></td><td></td><td class="text-right"><b>Rp.&nbsp;'+formatNumber(parseInt(total))+'</b></td><td></td><td></td><td></td><td></td><td></td></tr>';
        // Disabled
        if(panjang>0){
            $("#parent").prop("disabled",true);
        } else {
            $("#parent").prop("disabled",false);
        }
        $("input[name='total']").val(total);
        $('#listProduk').html(listB);
    }  
    
    $('#listProduk').on('click','#hapusProduk',function(){
        var id = $(this).data('hapus');
        var data = JSON.parse(window.dataB);
        data.splice(id,1);
        window.dataB = JSON.stringify(data);
        show_list_produk();
    });
    
    function clickDetail(id){
        var desk = $('#'+id).data('desk');
        $("#isidesk").html(desk);
        $("#modaldesk").modal("show");
    }
    
    $('#prov').change(function show_kota(){
	    var id = $('#prov').val();
        $.ajax({
            url : "<?php echo base_url();?>indonesia/getKota",
            method : "POST",
            data : {provinsi_id: id},
            async : false,
            dataType : 'json',
            success: function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value="'+data[i].id+'">'+data[i].nama+'</option>';
                }
                $('#kota').html(html);
            },
            error: function (response) {
              console.log(response);
            }
        });
    });
    
    $("#produk").change(function(){
        show_ukuran_bahan();
        ambil_harga();
    });
    
    function show_ukuran_bahan(){
        $('#satuan').val("");
		$('#bahan').val("");
		$('#sisi').val("");
		$('#laminasi').val("");
        var pid = $('#produk').val();
        
        $.ajax({
            url : "<?php echo base_url();?>lelang/selectSpec/",
            method : "POST",
            data : {pid:pid},
            async : false,
            dataType : 'json',
            success: function(spec){
                console.log(spec);
                var bahanhtml = '<select onchange="ambil_harga()" name="bahan" id="bahan" class="form-control" required>';
                var ukuranhtml = '<select onchange="ambil_harga()" name="ukuran" id="ukuran" class="form-control" required>';
                var sisihtml = '';
                var laminasihtml = '';
                
                var bahan = spec[0].bahan;
                if(bahan.length>0){
                    for(var i=0; i < bahan.length; i++){
                        bahanhtml += '<option value="'+bahan[i]+'">'+bahan[i]+'</option>';
                    }
                    bahanhtml += "</select>"
                    $("#labelb").show();
                    $("#checkb").prop('checked', false);
                    $('#showbahan').show();
                } else {
                    bahanhtml = '';
                    if(spec[0].checkB){
                        bahanhtml = '<input onchange="ambil_harga()" id="bahan" name="bahan" value="N/A" class="form-control" required/>';
                        $('#showbahan').hide();
                        $( "#checkb").prop('checked', false);
                    } else {
                        bahanhtml = '<input onchange="ambil_harga()" id="bahan" name="bahan" placeholder="Custom Bahan. . ." class="form-control" required/>';
                        $( "#labelb").hide();
                        $( "#checkb").prop('checked', true);
                    }
                }
                
                var ukuran = spec[0].ukuran;
                if(ukuran.length>0){
                    for(var j=0; j < ukuran.length; j++){
                        ukuranhtml += '<option value="'+ukuran[j]+'">'+ukuran[j]+'</option>';
                    }
                    ukuranhtml += "</select>"
                    $( "#labelu").show();
                    $( "#checku").prop('checked', false);
                    $('#showukuran').show();
                } else {
                    ukuranhtml = '';
                    if(spec[0].checkU){
                        ukuranhtml = '<input onchange="ambil_harga()" id="ukuran" name="ukuran" value="N/A" class="form-control" required/>';
                        $('#showukuran').hide();
                        $( "#checku").prop('checked', false);
                    } else {
                        ukuranhtml = '<input onchange="ambil_harga()" id="ukuran" name="ukuran" placeholder="Custom Ukuran. . ." class="form-control" required/>';
                        $( "#labelu").hide();
                        $( "#checku").prop('checked', true);
                    }
                }
                
                var sisi = spec[0].sisi;
                if(sisi.length>0){
                    for(var k=0; k < sisi.length; k++){
                        sisihtml += '<option value="'+sisi[k]+'">'+sisi[k]+'</option>';
                        // sisihtml += '<label class="radio-inline"><input class="ml-3" type="radio" name="sisi" value="'+sisi[k]+'" checked>&ensp;'+sisi[k]+' Sisi</label>';
                    }
                    $('#isiSisi').show();
                } else {
                    sisihtml += '<option value="N/A">N/A</option>';
                    $('#isiSisi').hide();
                }
                
                var laminasi = spec[0].laminasi;
                if(laminasi.length>0){
                    for(var l=0; l < laminasi.length; l++){
                        laminasihtml += '<option value="'+laminasi[l]+'">'+laminasi[l]+'</option>';
                    }
                    $('#isiLaminasi').show();
                } else {
                    laminasihtml += '<option value="N/A">N/A</option>';
                    $('#isiLaminasi').hide();
                }
                
                // sisihtml += '</select>';
                // laminasihtml += '</select>';
                
                $('#isibahan').html(bahanhtml);
                $('#isiukuran').html(ukuranhtml);
                $('#sisi').html(sisihtml);
                $('#laminasi').html(laminasihtml);
            },
            error: function (response) {
              console.log(response.responseText);
            }
        });        
    }    
    
    function ambil_harga(){
        var pid = $('#produk').val();
        var ukuran = $('#checku').is(':checked')?'custom':$('#ukuran').val();
        var bahan = $('#checkb').is(':checked')?'custom':$('#bahan').val();
        var sisi = $('#sisi').val();
        var laminasi = $('#laminasi').val();
        
        $.ajax({
            url : "<?php echo base_url();?>lelang/hargaProduk/",
            method : "POST",
            data : {pid:pid, ukuran:ukuran, bahan:bahan, sisi:sisi, laminasi:laminasi},
            async : false,
            dataType : 'json',
            success: function(spec){
                if(spec.length>0){
                    $('#satuanb').html(spec[0].satuan);
                    // $("input[name='hargas']").val(parseInt(spec[0].harga).toLocaleString());
                    $("input[name='hargas']").val(formatNumber(parseInt(spec[0].harga)));
                    $("input[name='hargas']").prop('disabled', true);
                } else {
                    $('#satuanb').html('');
                    $("input[name='hargas']").prop('disabled', false);
                    $("input[name='hargas']").val(1);
                }
                console.log(pid);
                console.log(ukuran);
                console.log(bahan);
                console.log(sisi);
                console.log(laminasi);
                console.log(spec);
                hitungHPS('hargas');
            },
            error: function (response) {
              console.log(response.responseText);
            }
        });        
    }
    
    function hitungHPS(id){
        setFormat(id);
        var jumlah = parseFloat($('input[name="jumlah"]').val().replace(/\D/g, ""))
        var hargas = parseFloat($('input[name="hargas"]').val().replace(/\D/g, ""))
        
        var total = jumlah*hargas;
        // $("input[name='harga']").val(parseInt(total).toLocaleString());
        $("input[name='harga']").val(formatNumber(parseInt(total)));
    }
    //-----------------------------------------------------------------------------
    
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
              '<td class="text-right">Rp. '+formatNumber(parseInt(dataP[i].harga))+'</td>'+
              '<td>'+dataP[i].ukuran+'</td>'+
              '<td>'+dataP[i].bahan+'</td>'+
              '<td>'+dataP[i].sisi+'</td>'+
              '<td>'+dataP[i].laminasi+'</td>'+
              '<td class="text-center">'+dataP[i].catatan+'</td>'+
            '</tr>';
            total += parseInt(dataP[i].harga);
	    }
	   // html += '<tr><td></td><td><b>Total HPS :</b></td><td></td><td class="text-right"><b>Rp. '+parseInt(total).toLocaleString()+'</b></td><td></td><td></td><td></td></tr>';
	    html += '<tr><td></td><td><b>Total HPS&nbsp;:</b></td><td></td><td class="text-right"><b>Rp. '+formatNumber(parseInt(total))+'</b></td><td></td><td></td><td></td><td></td><td></td></tr>';
	    $('#lproduk').html(html);
	    $("#daftarP").modal("show");
	}
	
	function tampiltawaran(id){
	    var datat = $('#'+id).data('listtawaran');
	    var html = '';
	    if(datat.length==0){
	        html = '<label class="mx-auto">Belum ada Tawaran</label>';    
	    } else {
    	   	for(var i = 0; i < datat.length; i++){
    	html += '<div class="card card-body" style="margin-bottom: 10px;"><div class="row"><div class="col-xs-4 pad1 pl-2">'+
                    // '<img style="height : 60px; width : 60px;" src="<?=base_url()?>assets/images/'+datat[i].foto+'" alt="">'+
                    '<img style="height : 60px; width : 60px;" src="<?=base_url()?>assets/images/register.png" alt="">'+
                '</div>'+
                '<div class="col-xs-8 pad1 pl-3">'+
                    '<div><a href="#" class="linkdetail"> '+datat[i].nama+'</a><br /></div>'+
                    // '<div>Rp '+parseInt(datat[i].hps).toLocaleString()+'</div>'+
                    '<div>Rp '+formatNumber(parseInt(datat[i].hps))+'</div>'+
                '</div></div></div>';
    	    }
	    }
	    $('#tampiltawaran').html(html);
	    $("#daftartawaran").modal("show");
	}    
    //-----------------------------------------------------------------------------
    function increaseValue() {
      var value = parseInt(document.getElementById('number').value, 10);
      value = parseFloat(document.getElementById('number').value.replace(/\D/g, ""));
      value = isNaN(value) ? 1 : value;
      value++;
    //   document.getElementById('number').value = parseInt(value).toLocaleString();
      document.getElementById('number').value = formatNumber(parseInt(value));
      hitungHPS('number');
    }
    
    function decreaseValue() {
      var value = parseInt(document.getElementById('number').value, 10);
      value = parseFloat(document.getElementById('number').value.replace(/\D/g, ""));
      value = isNaN(value) ? 1 : value;
      value < 2 ? value = 2 : '';
      value--;
    //   document.getElementById('number').value = parseInt(value).toLocaleString();
      document.getElementById('number').value = formatNumber(parseInt(value));
      hitungHPS('number');
    }
    
    function setFormat(id) {
      if (document.getElementById(id).value != "") {
        var hasil = parseFloat(document.getElementById(id).value.replace(/\D/g, ""))
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        if(hasil == "NaN" || hasil==0){
              document.getElementById(id).value = 1
          } else {
              document.getElementById(id).value = parseFloat(document.getElementById(id).value.replace(/\D/g, ""))
              .toString()
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
          }
      } else {
          document.getElementById(id).value = 1;
      }
    }
    
    function readmore() {
      var dots = document.getElementById("dots");
      var moreText = document.getElementById("more");
      var btnText = document.getElementById("myBtn");
    
      if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more"; 
        moreText.style.display = "none";
      } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less"; 
        moreText.style.display = "inline";
      }
    }
    	
	$('.list').on('click', function() {
		$('.fas', this)
		.toggleClass('fas fa-angle-right')
		.toggleClass('fas fa-angle-down');
	});
	
    $(document).ready(function() {
    	
    	setTimeout(function(){
    		$('body').addClass('loaded');
    	}, 1500);
    	
    });
    
    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    
    // function pencarian(id, ide){
    //     var value = $('#'+id).val().toLowerCase();
    //     $("#"+ide+" *").filter(function() {
    //       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //     });
    // }