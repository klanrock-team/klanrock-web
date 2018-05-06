<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 26/01/2018
 * Time: 23.12
 */
?>
<section class="content-header">
    <h1>
        Edit Karyawan
        <small>edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">karyawan</a></li>
        <li class="active">Edit</li>
    </ol>
</section><br>
<?php echo form_open('karyawan/update');
echo form_hidden('id', $this->uri->segment(3));?>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                    <?php $this->load->view($form)?>
                <div class="col-md-12">
                    <?php echo form_submit('SUBMIT','SIMPAN', array('class'=>'btn btn-primary btn-flat'));?>
                </div>
            </div><!-- /.row -->
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
<?php echo form_close(); ?>
