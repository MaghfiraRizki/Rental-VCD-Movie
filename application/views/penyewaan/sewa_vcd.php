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
        <form action="<?php echo $action; ?>" method="post">
	   
		<table id="example2" class="table table-bordered table-striped" style="margin-bottom: 10px">
		<thead>
            <tr>
                <th>No</th>
		<th>ID Movie</th>
		<th>Gambar</th>
		<th>Judul</th>
		<th>Harga Sewa</th>
		<th>Stok</th>
		<th>Kategori</th>
		<th>Action</th>
            </tr>
		</thead>
        <tbody>
			<?php
            foreach ($movie_data as $movie)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $movie->id_movie ?></td>
			<td>
				<div class="thumbnail">
					<img src="<?=base_url();?>uploads/<?=$movie->gambar;?>" alt="Product Image"/>
				</div>
			</td>
			<td><?php echo $movie->judul ?></td>
			<td><?php echo $movie->harga_sewa ?></td>
			<td><?php echo $movie->stok ?></td>
			<td><?php echo $movie->nama_kategori ?></td>
			<td style="text-align:center" width="340px">
				<button type="submit" class="btn btn-primary" name="id_movie" value="<?php echo $movie->id_movie ?>"><?php echo $button ?></button> 
			</td>
		</tr>
                <?php
            }
            ?>
		</tbody>
        </table>
	    <input type="hidden" name="id_detail" value="<?php echo $id_detail; ?>" /> 
		<input type="hidden" name="id_sewa" value="<?php echo $id_sewa; ?>" /> 
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