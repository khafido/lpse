<!--<section class="after-header">-->
  <div class="container">
      <div class="panel panel-primary form-search" style="width:100%;">
        <div class="panel-body">
        <?php echo form_open_multipart('lelang/proses'); ?>
            <div class="row">
               <div class="section-intro text-center col-md-12">
                 <div class="section-intro__style">
                   <img src="<?=base_url()?>assets/web/img/home/news.png" alt="">
                 </div>
                 <h2 class="label-form">Pasang Garapan</h2>
               </div>
               <div class="col-md-12 mt-3"></div>
               <div class="form-group col-md-6">
                 <label for="parent">Kategori Utama :</label>
                 <select name="parent" id="parent" class="form-control" required>
                    <option></option>
                    <?php foreach($parent as $val){ ?>
                        <option value="<?=$val->kategori_id?>"><?=$val->kategori_nama?></option>
                    <?php } ?>
                 </select>
               </div>
               <div class="form-grup col-md-6 sub">
                 <label for="sub">Sub Kategori :</label>
                 <select name="sub" id="sub" class="form-control" required>
                 </select>
               </div>
               <div class="form-group col-md-12 mt-3">
                 <label for="text">Daftar Produk :</label>
                 <div class="col-md-12 table-responsive">
                 <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Qty</th>
                      <th scope="col" class="text-right">Harga</th>
                      <th scope="col">Ukuran</th>
                      <th scope="col">Bahan</th>
                      <th scope="col">Sisi</th>
                      <th scope="col">Laminasi</th>
                      <th scope="col">Catatan</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody id="listProduk">
                  </tbody>
                </table>
                </div>
                 <!--<button style="width:100px;" type="button" id="btnTambah" class="bg-success text-white" data-toggle="modal" data-target="#tambahProduk"><i class="fas fa-plus"></i>&nbsp; Produk</button>-->
                 <button style="width:100px;" type="button" id="btnTambah" class="bg-success text-white"><i class="fas fa-plus"></i>&nbsp; Produk</button><br/>
                 <input type="text" name="pekerjaan" style="opacity:0; width:0; height:0;" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="text">Nama Garapan :</label>
                  <input type="text" id="judul" name="judul" placeholder="Nama Garapan" maxlength="40" class="form-control" required>
                </div>
               <!--<div class="form-group col-md-4">-->
               <!--  <label for="text">Tanggal Selasai :</label>-->
               <!--  <input type="datetime-local" id="tglselesai" name="tglselesaii"  class="form-control" required />-->
               <!--</div>-->
                <div class="form-group col-md-3">
                    <label for="text">Tanggal Selesai :</label>
                    <input size="16" class="bg-transparent" type="text" name="tglselesai" id="tglselesai" value="" readonly required>
                </div>
                <div class="form-group col-md-3">
                    <label for="text">Jam Selesai :</label>
                    <input size="16" class="bg-transparent" type="text" name="jamselesai" id="jamselesai" value="" readonly required>
                </div>
                <div class="form-group col-md-3">
                  <label for="parent">Pembayaran :</label>
                  <select name="pembayaran" id="pembayaran" class="form-control" required>
                     <?php 
                         foreach($pembayaran as $key => $value){
                            echo "<option value='$key'>$value</option>";
                        }
                    ?>
                 </select>
               </div>
               <div class="form-group col-md-6">
                 <label for="parent">Provinsi :</label>
                 <select name="prov" id="prov" class="form-control" required>
                     <option value="0"></option>
                     <?php foreach($prov as $val){ ?>
                        <option value="<?=$val->id?>"><?=$val->nama?></option>
                    <?php } ?>
                 </select>
               </div>
               <div class="form-grup col-md-6">
                 <label for="kota">Kabupaten / Kota :</label>
                 <select name="kota" id="kota" class="form-control" required>
                 </select>
               </div>
               <div class="form-group col-md-6">
                 <label for="text">Alamat :</label>
                 <div class="form-group">
                   <textarea name="alamat" id="alamat" style="width:100%; height:100px;" placeholder="   Isikan alamat lengkap anda . . ." required></textarea>
                 </div>
               </div>
               <div class="form-group col-md-6">
                 <label for="text">Deskripsi / Catatan Lelang :</label>
                 <div class="form-group">
                   <textarea name="deskripsi" id="deskripsi" style="width:100%; height:100px;" placeholder="   Isikan deskripsi / catatan lelang . . ." required></textarea>
                 </div>
               </div>
               <div class="form-group col-md-4">
                <label for="text">Upload File :</label>
                <input type="file" name="file" accept=".jpg, .png, .docx, .doc, .jpeg, .pdf" class="form-control" />
               </div>
               <div class="form-group col-md-12 pull-right">
                 <input type="hidden" name="total">
                 <button id="pasang" type="submit" class="btn btn-info btn-block">Pasang Garapan</button>
               </div>
           </div>
             </form>
         </div>
       </div>
    </div>