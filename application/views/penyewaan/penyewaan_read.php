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
      <h2 style="margin-top:0px">Penyewaan Read</h2>
        <table class="table">
	    <tr><td>Tgl Sewa</td><td><?php echo $tgl_sewa; ?></td></tr>
		<tr><td>Tgl Kembali</td><td><?php echo $tgl_kembali; ?></td></tr>
	    <tr><td>Penyewa</td><td><?php echo $nama; ?></td></tr>
	</table>
    <table class="table table-striped" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Judul</th>
		<th>Harga</th>
            </tr><?php
			$i=1;
            foreach ($query->result_array() as $cd)
            {
                ?>
                <tr>
			<td width="80px"><?php echo $i ?></td>
			<td><?php echo $cd['judul'] ?></td>
			<td><?php echo "Rp."." ".$cd['harga_sewa'] ?></td>
		</tr>
                <?php
				$i++;
            }
            ?>
		<tr><td colspan="2">Total Harga</td><td><?php echo "Rp."." ".$total_harga; ?></td></tr>
		<tr><td colspan="2">Denda</td><td><?php echo "Rp."." ".$denda; ?></td></tr>
		<tr><td colspan="2">Total Bayar</td><td><?php echo "Rp."." ".($total_harga + $denda); ?></td></tr>
		<tr><td></td><td><a href="<?php echo site_url('penyewaan') ?>" class="btn btn-default">Cancel</a></td></tr>
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