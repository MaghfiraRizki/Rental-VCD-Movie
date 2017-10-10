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
       <h2 style="margin-top:0px">Penyewaan <?php echo $button ?></h2>
        <form action="<?php echo site_url('penyewaan/pengembalian'); ?>" class="form-inline" method="get">
			<div class="input-group">
				<input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
				<span class="input-group-btn">
					<?php 
						if ($q <> '')
						{
							?>
							<a href="<?php echo site_url('penyewaan/pengembalian'); ?>" class="btn btn-default">Reset</a>
							<?php
						}
					?>
				  <button class="btn btn-primary" type="submit">Search</button>
				</span>
			</div>
		</form>
		<form action="<?php echo $action; ?>" method="post">
		<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>ID Sewa</th>
		<th>Tgl Sewa</th>
		<th>Total Harga</th>
		<th>Penyewa</th>
		<th>Tgl Kembali</th>
		<th>Action</th>
            </tr><?php
            foreach ($penyewaan_data as $penyewaan)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $penyewaan->id_sewa ?></td>
			<td><?php echo $penyewaan->tgl_sewa ?></td>
			<td><?php echo $penyewaan->total_harga ?></td>
			<td><?php echo $penyewaan->nama ?></td>
			<td><?php echo $penyewaan->tgl_kembali ?></td>
			<td><button type="submit" class="btn btn-primary" name="id_sewa" value="<?php echo $penyewaan->id_sewa ?>"><?php echo $button ?></button> </td>
		</tr>
                <?php
            }
            ?>
        </table>
	    <!--<input type="hidden" name="id_sewa" value="<?php echo $id_sewa; ?>" /> -->
		<input type="hidden" name="total_harga" value="null" /> 
	    
	    <a href="<?php echo site_url('penyewaan') ?>" class="btn btn-default">Cancel</a>
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