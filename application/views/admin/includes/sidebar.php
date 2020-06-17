<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('admin/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown <?//php echo $this->uri->segment(2) == 'products' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Garapan</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/garapan') ?>">Semua</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/garapan/Pemilihan') ?>">Pemilihan Mitra</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/garapan/Pengerjaan') ?>">Pengerjaan</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/garapan/Selesai') ?>">Selesai</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/garapan/Kedaluarsa') ?>">Kedaluarsa</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/garapan/Hapus') ?>">Hapus</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/kategori') ?>">
            <i class="fas fa-fw fa-tag"></i>
            <span>Kategori</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/spesifikasi') ?>">
            <i class="fas fa-fw fa-fax"></i>
            <span>Spesifikasi</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/pengguna') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengguna</span></a>
    </li>
    <!--<li class="nav-item">-->
    <!--    <a class="nav-link" href="#">-->
    <!--        <i class="fas fa-fw fa-cog"></i>-->
    <!--        <span>Settings</span></a>-->
    <!--</li>-->
</ul>
