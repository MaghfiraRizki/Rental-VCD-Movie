<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Penyewaan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Tgl Sewa</th>
		<th>Total Harga</th>
		<th>Id Penyewa</th>
		
            </tr><?php
            foreach ($penyewaan_data as $penyewaan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $penyewaan->tgl_sewa ?></td>
		      <td><?php echo $penyewaan->total_harga ?></td>
		      <td><?php echo $penyewaan->id_penyewa ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>