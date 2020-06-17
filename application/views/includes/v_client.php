<section class="after-header">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
        <div class="list-group">
          <div class="text-center">
            <img style="height : 100px; width : 100px;" src="<?=base_url()?>assets/images/register.png" alt="">
            <div style="font-size: 18;">Indra Rachmawan</div>
            <div>Bergabung pada 11/05/2019</div><br>
          </div>
        </div>
        <div class="list-group">
          <a href="<?=base_url()?>client/" class="list-group-item active">
            <i class="fas fa-tachometer-alt"></i> Dashboard
          </a>
          <a href="<?=base_url()?>client/profil" class="list-group-item ">
            <i class="far fa-user"></i> Profil
          </a>
          <a href="<?=base_url()?>lelang/" class="list-group-item ">
            <i class="fas fa-hammer"></i> Lelang
          </a>
          <a href="<?=base_url()?>client/#" class="list-group-item ">
            <i class="fas fa-map-marker-alt"></i> Alamat
          </a>
          <a href="<?=base_url()?>client/#" class="list-group-item ">
            <i class="far fa-save"></i> Wishlist
          </a>
          <a href="<?=base_url()?>client/#" class="list-group-item">
            <i class="fas fa-shopping-cart"></i> Keranjang Belanja
          </a>
          <a href="<?=base_url()?>client/#" class="list-group-item ">
            <i class="far fa-money-bill-alt"></i> Transaksi
          </a>
          <a href="<?=base_url()?>login/logout" class="list-group-item ">
            <i class="fas fa-door-closed"></i> Keluar
          </a>
        </div>
      </div>
      <div class="col-md-4 col-lg-9 mb-4 mb-md-0 konten-profil">
          <?php $this->load->view("profil/".$content); ?>
      </div>
    </div>
  </div>
</section>
