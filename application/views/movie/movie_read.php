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
      
    <h2 style="margin-top:0px">Movie Read</h2>
        <table class="table">
	    <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
		<tr><td>Gambar</td>
			<td>
				<div class="thumbnail-img">
					<img src="<?=base_url();?>uploads/<?=$gambar;?>" alt="Product Image"/>
				</div>
			</td>
		</tr>
	    <tr><td>Harga Sewa</td><td><?php echo $harga_sewa; ?></td></tr>
	    <tr><td>Stok</td><td><?php echo $stok; ?></td></tr>
	    <tr><td>Sinopsis</td><td><?php echo $sinopsis; ?></td></tr>
	    <tr><td>Kategori</td><td><?php echo $nama_kategori; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('movie') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
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