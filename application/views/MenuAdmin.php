<ul class="sidebar-menu">
    <li class="header">Main Navigation</li>
    <li class="<?php if ($this->uri->segment(1)== 'home'){echo 'active';}?>"><a href="<?php echo base_url()?>home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class="treeview <?php if ($this->uri->segment(1)== 'kategori'){echo 'active';}?>">
        <a href="#">
            <i class="fa fa-briefcase"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>kategori"><i class="fa fa-minus"></i>Kategori</a></li>
        </ul>
    </li>
</ul>
