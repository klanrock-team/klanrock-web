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
        Edit galery
        <small>edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">galery</a></li>
        <li class="active">Edit</li>
    </ol>
</section><br>
<section class="content">
    <div class="row">
        <?php echo form_open('galery/update');
        echo form_hidden('id', $this->uri->segment(3));?>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                            <?php $this->load->view($form)?>
                        <div class="col-md-12">
                            <button type="button" onclick="kembali()" class="btn btn-default"><i class="fa fa-backward"></i> Kembali</button>
                            <?php echo form_submit('SUBMIT','SIMPAN', array('class'=>'btn btn-primary btn-flat'));?>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
