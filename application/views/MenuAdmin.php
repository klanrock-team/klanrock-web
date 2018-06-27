<ul class="sidebar-menu">
    <li class="header">Main Navigation</li>
    <li class="<?php if ($this->uri->segment(1)== 'home' || $this->uri->segment(1)== ''){echo 'active';}?>"><a href="<?php echo base_url()?>home"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
    <li class="treeview <?php if ($this->uri->segment(1)== 'kategori' || $this->uri->segment(1)== 'jabatan'){echo 'active';}?>">
        <a href="#">
            <i class="fa fa-briefcase"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>kategori"><i class="fa fa-minus"></i>Kategori</a></li>
            <li><a href="<?php echo base_url()?>jabatan"><i class="fa fa-minus"></i>Jabatan</a></li>
        </ul>
    </li>
    <li class="treeview <?php if ($this->uri->segment(1)== 'galery' || $this->uri->segment(1)== 'jadwal' || $this->uri->segment(1)== 'karyawan' || $this->uri->segment(1)== 'paket'){echo 'active';}?>">
        <a href="#">
            <i class="fa fa-xing"></i> <span>KlanrocK</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>karyawan"><i class="fa fa-minus"></i>Karyawan</a></li>
            <li><a href="<?php echo base_url()?>jadwal"><i class="fa fa-minus"></i>Jadwal</a></li>
        </ul>
    </li>
    <li class="treeview <?php if ($this->uri->segment(1)== 'galery' || $this->uri->segment(1)== 'paket'){echo 'active';}?>">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Content Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>galery"><i class="fa fa-minus"></i>Galery</a></li>
            <li><a href="<?php echo base_url()?>paket"><i class="fa fa-minus"></i>Paket</a></li>
        </ul>
    </li>
    <li class="treeview <?php if ($this->uri->segment(1)== 'transaksi' || $this->uri->segment(1)== 'invoice'){echo 'active';}?>">
        <a href="#">
            <i class="fa fa-balance-scale"></i> <span>Transaksi</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>transaksi"><i class="fa fa-minus"></i>Transaksi Valid</a></li>
            <li><a href="<?php echo base_url()?>transaksi/invoice"><i class="fa fa-minus"></i>Invoice</a></li>
        </ul>
    </li>
    <li class="<?php if ($this->uri->segment(1)== 'laporan'){echo 'active';}?>"><a href="<?php echo base_url()?>home"><i class="fa fa-pie-chart"></i> <span>Laporan</span></a></li>
    <li class="<?php if ($this->uri->segment(1)== 'profil'){echo 'active';}?>"><a href="<?php echo base_url()?>home"><i class="fa fa-user"></i> <span>My Profile</span></a></li>
</ul>
