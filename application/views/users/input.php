<?php

?>
<section class="content-header">
    <h1>
        Input users
        <small>new</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">users</a></li>
        <li class="active">Input</li>
    </ol>
</section><br>
<section class="content">
    <div class="row">
        <?php echo form_open('users/insert');echo form_hidden('id', $this->uri->segment(3));?>
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
