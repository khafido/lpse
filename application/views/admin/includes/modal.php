<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yakin Mau Keluar ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Tekan tombol "keluar" jika anda ingin keluar</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="<?php echo site_url('admin/login/out') ?>">Keluar</a>
      </div>
    </div>
  </div>
</div>

 
<!-- restore-->
<div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Tekan tombol "Pulihkan" jika ingin memulihkan data yang telah terhapus</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-restore" class="btn btn-primary" href="#">Pulihkan</a>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Tekan tombol "Hapus" jika anda akan ingin menghapus data ini</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal Daftar Produk -->
    <div class="modal fade" id="daftarP" tabindex="-1" role="dialog" aria-labelledby="produkModalCenterTitle" aria-hidden="true" style="overflow-y:auto;">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Daftar Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-md-12 card card-body bg-light table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Jml</th>
                      <th scope="col" class="text-right">Biaya</th>
                      <th scope="col">Ukuran</th>
                      <th scope="col">Bahan</th>
                      <th scope="col">Sisi</th>
                      <th scope="col">Laminasi</th>
                      <th scope="col">Catatan</th>
                    </tr>
                  </thead>
                  <tbody id="lproduk">
                      <tr>
                      </tr>
                  </tbody>
                </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Daftar Tawaran -->
    <div class="modal fade" id="daftartawaran" tabindex="-1" role="dialog" aria-labelledby="penawaranModalCenterTitle" aria-hidden="true" style="overflow-y:auto;">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Daftar Penawar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url()?>tawaran/pengajuan" method="post">
                  <div class="row-12" id="tampiltawaran">
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    
   <!-- Modal Detail Deskripsi -->
    <div class="modal fade" id="modaldesk" role="dialog" tabindex="-1" aria-labelledby="modaldeskModalCenterTitle" aria-hidden="true" style="overflow-y:auto;">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Deskripsi Lelang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="isidesk"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>    
