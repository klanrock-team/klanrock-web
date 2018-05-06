<ul class="sidebar-menu">
    <li class="header">Main Navigation</li>
    <li class="<?php if ($this->uri->segment(1)== 'home'){echo 'active';}?>"><a href="<?php echo base_url()?>home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class="treeview <?php if ($this->uri->segment(1)== 'kategori' || $this->uri->segment(1)== 'jabatan'){echo 'active';}?>">
        <a href="#">
            <i class="fa fa-briefcase"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>kategori"><i class="fa fa-minus"></i>Kategori</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>jabatan"><i class="fa fa-minus"></i>Jabatan</a></li>
        </ul>
    </li>
    <li class="treeview <?php if ($this->uri->segment(1)== 'galery' || $this->uri->segment(1)== 'paket'){echo 'active';}?>">
        <a href="#">
            <i class="fa fa-briefcase"></i> <span>KlanrocK</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>galery"><i class="fa fa-minus"></i>Galery</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>paket"><i class="fa fa-minus"></i>Paket</a></li>
        </ul>
    </li>
</ul>
