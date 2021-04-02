<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3 class="">
            Daftar Mobil
        </h3><br>
        <span class="pull-right">
            <a href="<?=base_url()?>admin/mobil/add" class="btn btn-sm btn-default"  ><i class="glyphicon glyphicon-plus"></i> Tambah</a>               
        </span>
<div>
    <?php echo form_open(base_url().'admin/mobil/search', array('method' => 'post')) ?>
    <div class="row">                
        <div class="col-md-2">                 
            <select name="jenis" class="form-control">
                <option value="brand">Brand</option>
                <option value="merek">Merek</option>
                <option value="tahun">Tahun</option>
                <option value="harga">Harga</option>
            </select>           
        </div>
        <div class="col-md-3" style="margin-left: 0;padding-left: 0">                 
            <input autofocus type="text" name="keyword"  placeholder="Pencarian" class="form-control">            
        </div>                   
        <input type="submit" class="btn btn-success" value="Cari">
    </div>
</div>
<?php echo form_close() ?>
</div>
<?php echo validation_errors() ?>
<br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="gradient">
                <tr>    
                        <th>No</th>
                        <th>Brand</th>
                        <th>Kode SKU</th>
                        <th>Merek</th>
                        <th>Tahun</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Foto</th>
                        <th>Aksi</th>

                </tr>
            </thead>
            <?php               
            if ($result) {
                $no = 1;
                foreach ($result as $row) { 
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['brand'];?></td>
                            <td><?php echo $row['kode_sku'];?></td>
                            <td><?php echo $row['merek'];?></td>
                            <td><?php echo $row['tahun_buat'];?></td>
                            <td><?php echo $row['harga'];?></td>
                            <td><?php echo $row['stok'];?></td>
                            <td><img height="30px" src="<?=base_url();?>media/images/<?= $row['foto'];?>"></td>
                                
                            <td>
                            <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/mobil/edit/' . $row['id']); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                            <a class="btn btn-danger btn-xs" href="<?php echo site_url('admin/mobil/delete/' . $row['id']); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                               
                                
                            </tr>
                        </tbody>
                        <?php
                        $no++;
                    
                    } 
                } else {
                    ?>
                    <tbody>
                        <tr id="row">
                            <td colspan="5" align="center">Data Kosong</td>
                        </tr>
                    </tbody>
                    <?php
                }
                ?>   
        </table>
    </div>
</div>
</div>

