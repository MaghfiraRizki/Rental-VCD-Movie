<html>
<body>
<?php
$this->simple_login->cek_login();       
$this->load->view('design/header');
?>
<div class="row">
    <div class="col-md-8">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h2 style="margin-top:0px">Movie <?php echo $button ?></h2>
        <form enctype="multipart/form-data" action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Judul <?php echo form_error('judul') ?></label>
            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Harga Sewa <?php echo form_error('harga_sewa') ?></label>
            <input type="text" class="form-control" name="harga_sewa" id="harga_sewa" placeholder="Harga Sewa" value="<?php echo $harga_sewa; ?>" />
        </div>
	    <!--<div class="form-group">
            <label for="int">Stok <?php echo form_error('stok') ?></label>
            <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" />
        </div>-->
		<input type="hidden" name="stok" value="1" /> 
	    <div class="form-group">
            <label for="sinopsis">Sinopsis <?php echo form_error('sinopsis') ?></label>
            <textarea class="form-control" rows="3" name="sinopsis" id="sinopsis" placeholder="Sinopsis"><?php echo $sinopsis; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="int">Kategori <?php echo form_error('id_kategori') ?></label>
			<br/>
			<?php
			foreach ($query->result_array() as $row)
			{
					$options[$row['id_kategori']]=$row['nama_kategori']."</br>";
			}
			echo form_dropdown('id_kategori', $options, set_value('id_kategori'));
			?>
            <!--<input type="text" class="form-control" name="id_kategori" id="id_kategori" placeholder="Id Kategori" value="<?php //echo $id_kategori; ?>" />-->
        </div>
	    <input type="hidden" name="id_movie" value="<?php echo $id_movie; ?>" /> 
		
            <label for="gambar">Gambar<?php echo form_error('gambar') ?></label>
            <input type="file" name="gambar" id="gambar" value="<?php echo $gambar; ?>" />
        
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('movie') ?>" class="btn btn-default">Cancel</a>
	</form>
    
      <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <!-- /.box-footer -->
  </div>
  <!-- /.box -->
</div><!-- /.col -->
   <!-- /.col -->



   <div class="col-md-4">
      <!-- PRODUCT LIST -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Member of our Team</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <ul class="products-list product-list-in-box">
            <li class="item">
              <div class="product-img">
                <img src="<?=base_url();?>assets/dist/img/ilham.jpg" alt="Product Image"/>
              </div>
              <div class="product-info">
                <a href="javascript::;" class="product-title">M3113074 <span class="label label-info pull-right">TID</span></a>
                <span class="product-description">
                  Ilham Muhammad
                </span>
              </div>
            </li><!-- /.item -->
            <li class="item">
              <div class="product-img">
                <img src="<?=base_url();?>assets/dist/img/lingga.jpg" alt="Product Image"/>
              </div>
              <div class="product-info">
                <a href="javascript::;" class="product-title">M3114080 <span class="label label-danger pull-right">TID</span></a>
                <span class="product-description">
                  Ilham Lingga Agatha
                </span>
              </div>
            </li><!-- /.item -->
            <li class="item">
              <div class="product-img">
                <img src="<?=base_url();?>assets/dist/img/fira.jpg" alt="Product Image"/>
              </div>
              <div class="product-info">
                <a href="javascript::;" class="product-title">M3114098 <span class="label label-success pull-right">TID</span></a>
                <span class="product-description">
                  Maghfira Rizki Maulani
                </span>
              </div>
            </li><!-- /.item -->
          </ul>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
    </div><!-- /.col -->
    </div><!-- /.row -->

</body>
</html>