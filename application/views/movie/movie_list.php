<html>
<head>
<script type="text/javascript">
  $(function () {
    $("#example1").dataTable();
    $('#example2').dataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false
    });
  });
  
</script>
</head>
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
      <h2 style="margin-top:0px">Movie List</h2>
	 </div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('movie/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('movie/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('movie'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
		<!--<section class="content">
		<div class="col-xs-12">-->
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
				<?php 
				echo anchor(site_url('movie/read/'.$movie->id_movie),'<i class="fa fa-eye"></i>Read',array('tittle'=>'Read','class'=>'btn btn-primary btn-sm')); 
				echo '  '; 
				echo anchor(site_url('movie/update/'.$movie->id_movie),'<i class="fa fa-pencil-square-o"></i>Update',array('tittle'=>'Update','class'=>'btn btn-success btn-sm')); 
				echo '  '; 
				echo anchor(site_url('movie/delete/'.$movie->id_movie),'<i class="fa fa-trash-o"></i>Delete','tittle="Delete" class="btn btn-danger btn-sm", onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
		</tbody>
        </table>
		<!--</div>
		</section>-->
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('movie/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('movie/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    
      <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <!-- /.box-footer -->
  </div>
  <!-- /.box -->

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