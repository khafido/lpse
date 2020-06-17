// $(document).ready(function() {
    "use strict";
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
	
// 	$('#add').on('click',function(){
// 		window.type = "POST";
// 		$('#parent').prop('disabled',false);
// 		$('#sub').prop('disabled',false);

// 		$('#satuan').val("");
// 		$('#bahan').val("");
// 		$('#harga').val("");
// 		$('#catatan').html("");
// 	});
    
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
    window.cukuran = '<div class="input-group" id="gantiUkuran">'+
                        '<input type="text" id="ukuran0" min="0" oninput="setFormat(this.id)" name="ukuran[0]" placeholder="100" class="form-control" required>'+
                        '<input type="text" value="x" class="form-control text-center col-md-1" disabled>'+
                        '<input type="text" id="ukuran1" min="0" oninput="setFormat(this.id)" name="ukuran[1]" placeholder="100" class="form-control" required>'+
                        '<input list="satuan" id="satuanu" name="satuanu" placeholder="cm" value="cm" class="form-control col-md-2">'+
                        '<datalist id="satuan">'+
                            '<option value="mm">mm</option>'+
                            '<option value="cm">cm</option>'+
                            '<option value="m">m</option>'+
                        '</datalist>'+
                    '</div>';
                    
    var selectUkuran = '';
    $('#checku').change(function (){
        if($(this).is(':checked')){
            // $("input[name='ukuran']").val("");
            selectUkuran = $('#isiukuran').html();
            $('#isiukuran').html(window.cukuran);
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
            // url : "'+<?php echo base_url();?>+'kategori/getSub",
            url : window.base_url+"kategori/getSub",
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
            url : window.base_url+"kategori/getProduk",
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
        $("#tambahProduk").modal("show");
        // $("input[name='bahan']").val("");
        // $("input[name='ukuran']").val("");
        // $("input[name='harga']").val(1);
        
        show_produk();
        $("input[name='jumlah']").val(1);
        $("#catatan").html("");
        show_ukuran_bahan();
        ambil_harga();
        
        // $("input[name='tambahProduk']").modal("show");
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
            // var checku = $('#checku').is(':checked')?'custom':null;
            // var checkb = $('#checkb').is(':checked')?'custom':null;
            if($('#checku').is(':checked')){
                var ukuran0 = $('#ukuran0').val();
                var ukuran1 = $('#ukuran1').val();
                var satuanu = $('#satuanu').val();
                ukuran = ukuran0+' x '+ukuran1+' '+satuanu;
            }
            var data = JSON.parse(window.dataB);
            data.push({"produkid":produkid, "produk":produk, "ukuran":ukuran, "bahan":bahan, "jumlah":jumlah, "harga":harga, "catatan":catatan, "sisi":sisi, "laminasi":laminasi});
            window.dataB = JSON.stringify(data);
            show_list_produk();
            $("#tambahProduk").modal("hide");
        }
    });
    // }
    
    function show_list_produk(){
        var listB = "";
        var total = 0;
        if(window.dataB!="[]"){
            $("input[name='pekerjaan']").val(window.dataB);    
        }
        var data = JSON.parse(window.dataB);
        var panjang = 0;
        if(data!==window.undef){
            panjang = data.length;
        }
        for(var i=0; i < panjang; i++){
  listB += '<tr>'+
              '<td scope="row">'+(i+1)+'</td>'+
              '<td>'+data[i].produk+'</td>'+
            //   '<td class="text-right">'+parseInt(data[i].jumlah).toLocaleString()+'</td>'+
              '<td class="text-right">'+formatNumber(parseInt(data[i].jumlah))+'</td>'+
            //   '<td class="text-right">Rp.&nbsp'+parseInt(data[i].harga).toLocaleString()+'</td>'+
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
        // listB += '<tr><td></td><td><b>Total HPS :</b></td><td></td><td class="text-right"><b>Rp.&nbsp'+parseInt(total).toLocaleString()+'</b></td><td></td><td></td><td></td></tr>';
        listB += '<tr><td></td><td><b>Total Biaya :</b></td><td></td><td class="text-right"><b>Rp.&nbsp;'+formatNumber(parseInt(total))+'</b></td><td></td><td></td><td></td><td></td><td></td></tr>';
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
            url : window.base_url+"indonesia/getKota",
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
    
    $("select[name='produk']").change(function(){
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
            url : window.base_url+"lelang/selectSpec/",
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
                    bahanhtml += "</select>";
                    if(spec[0].checkBC) {
                        $("#labelb").show();
                    } else {
                        $("#labelb").hide();
                    }
                    $("#checkb").prop('checked', false);
                    $('#showbahan').show();
                } else {
                    bahanhtml = '';
                    if(spec[0].checkB){
                        bahanhtml = '<input id="bahan" name="bahan" value="N/A" class="form-control" disabled/>';
                        $('#showbahan').hide();
                        $( "#checkb").prop('checked', false);
                    } else if(spec[0].checkBC){
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
                    ukuranhtml += "</select>";
                    if(spec[0].checkUC) {
                        $( "#labelu").show();
                    } else {
                        $( "#labelu").hide();
                    }
                    $( "#checku").prop('checked', false);
                    $('#showukuran').show();
                } else {
                    ukuranhtml = '';
                    if(spec[0].checkU){
                        ukuranhtml = '<input id="ukuran" name="ukuran" value="N/A" class="form-control" disabled/>';
                        $('#showukuran').hide();
                        $( "#checku").prop('checked', false);
                    } else if(spec[0].checkUC) {
                        ukuranhtml = window.cukuran;
                        $('#showukuran').show();
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
        
        console.log(pid);
        console.log(ukuran);
        console.log(bahan);
        console.log(sisi);
        console.log(laminasi);
        
        $.ajax({
            url : window.base_url+"lelang/hargaProduk/",
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
                } 
                if (spec.length==0 || spec[0].harga==0){
                    $('#satuanb').html('');
                    $("input[name='hargas']").prop('disabled', false);
                    $("input[name='hargas']").val(1);
                    $("input[name='hargas']").focus();
                }
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
        var jumlah = parseFloat($('input[name="jumlah"]').val().replace(/\D/g, ""));
        var hargas = parseFloat($('input[name="hargas"]').val().replace(/\D/g, ""));
        
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
            //   '<td class="text-right">Rp.&nbsp'+parseInt(dataP[i].harga).toLocaleString()+'</td>'+
              '<td class="text-right">Rp.&nbsp'+formatNumber(parseInt(dataP[i].harga))+'</td>'+
              '<td>'+dataP[i].ukuran+'</td>'+
              '<td>'+dataP[i].bahan+'</td>'+
              '<td>'+dataP[i].sisi+'</td>'+
              '<td>'+dataP[i].laminasi+'</td>'+
              '<td class="text-center">'+dataP[i].catatan+'</td>'+
            '</tr>';
            total += parseInt(dataP[i].harga);
	    }
	   // html += '<tr><td></td><td><b>Total HPS :</b></td><td></td><td class="text-right"><b>Rp.&nbsp'+parseInt(total).toLocaleString()+'</b></td><td></td><td></td><td></td></tr>';
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
                '<table class="table table-responsive mt-2">'+
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
	
    // 	Tapil Ajukan Penawaran
    function tampilpengajuan(id){
        var lid = $('#'+id).data('lid');
        var datap = $('#'+id).data('listp');
        var tawaranku = $('#'+id).data('tawaranku');
        // console.log(tawaranku);
        var totdata = datap.length;
        var html = '';
        var totalhs = 0;
        var htaw = '';
        var tothtaw = 0;
        // console.log(totdata);
        if(totdata>0){
            var desc = totdata;
    	   	for(var i = 0; i < totdata; i++){
    	   	    var hs = parseFloat(datap[i].harga);
    	   	   // totalhs += hs / datap[i].jumlah;
    	   	    if(tawaranku!==0){
    	   	       // if(datap[i].idp==tawaranku[i].pid){
    	   	            htaw = formatNumber(tawaranku[i].hargap / datap[i].jumlah); 
    	   	            tothtaw += parseFloat(tawaranku[i].hargap);
    	   	       // }
    	   	       //console.log(tawaranku[i].hargap);
    	   	       //console.log(datap[i].jumlah);
    	   	    }
    	   	    html += '<tr><th>'+(i+1)+'</th><th>'+datap[i].nama+'</th><th class="text-right">'+formatNumber(datap[i].jumlah)+'<input type="hidden" value="'+formatNumber(datap[i].jumlah)+'" name="qty['+i+']" id="qty'+i+'""/></th><th class="text-right">Rp.&nbsp'+formatNumber(hs/datap[i].jumlah)+'</th><th class="text-right"><input type="hidden" name="idp['+i+']" value="'+datap[i].idp+'"/>Rp.&nbsp<input type="text" onclick="select()" oninput="hitungTotTaw('+totdata+', this.id)" value="'+htaw+'" name="htawaran['+i+']" id="htawaran'+i+'" style="width:99px; direction:rtl;" required/></th></tr>';
    	   	}
    	   	html += '<tr><th></th><th>Total&nbspBiaya&nbsp: </th><th class="text-right" id="tottaw">Rp.&nbsp'+formatNumber(tothtaw)+'</th><th></th><th class="text-right"></th></tr>';
        }
        html += '<input type="hidden" name="totaltaw" id="totaltaw" />';
        $('#ltawaran').html(html);
        $("input[name='lid']").val(lid);
        $("#penawaran").modal("show");
    }
    
    function hitungTotTaw(totdata, id){
        setFormat(id);
        var total = 0;
        for(var i = 0; i < totdata; i++){
            total += parseFloat(parseFloat($('#htawaran'+i).val().replace(/,/g, '')) * parseFloat($('#qty'+i).val().replace(/,/g, '')));
        }
        if(!isNaN(total)){
            $('#tottaw').html('Rp.&nbsp'+formatNumber(total));
            $('#totaltaw').html(total);
        }
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
      if (document.getElementById(id).value !== "") {
        var hasil = parseFloat(document.getElementById(id).value.replace(/\D/g, ""))
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        if(hasil == "NaN" || hasil=="0"){
              document.getElementById(id).value = 1;
          } else {
              document.getElementById(id).value = parseFloat(document.getElementById(id).value.replace(/\D/g, ""))
              .toString()
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
    	
// 	$('.list').on('click', function() {
// 		$('.fas', this)
// 		.toggleClass('fas fa-angle-right')
// 		.toggleClass('fas fa-angle-down');
// 	});
	
    	setTimeout(function(){
    		$('body').addClass('loaded');
    	}, 1500);
    	
    
    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
// });