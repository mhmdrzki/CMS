
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-lg-12">
            <h3>Update Data Mobil</h3>
            <br>
        </div>
        <!-- /.col-lg-12 -->

        <?php echo form_open_multipart(current_url()); ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-9 col-md-9">
                    <input type="hidden" name="id" value="<?= $result->id;?>" />
                    <label >Brand *</label>
                    <!-- <?php echo (isset($user)) ? 'readonly' : '' ?>  -->
                    <input name="brand" type="text"  placeholder="Brand" value="<?= $result->brand;?>" class="form-control" value=""><br>
                    <label >Kode SKU*</label>
                    <input type="text" name="kode_sku" placeholder="Kode SKU" value="<?= $result->kode_sku;?>" class="form-control" value=""><br>

                    <label >Merek *</label>
                    <input type="text" name="merek" placeholder="Merek" value="<?= $result->merek;?>" class="form-control" value=""><br>

                    <label >Tahun *</label>
                    <input type="text" name="tahun" placeholder="Tahun" value="<?= $result->tahun_buat;?>" class="form-control" value=""><br>

                    <label >Harga*</label>
                    <input type="text" name="harga" placeholder="Harga" value="<?= $result->harga;?>" class="form-control" value="<?= $result->harga;?>" value=""><br>

                    <label >Stok*</label>
                    <input type="text" name="stok" value="<?= $result->stok;?>" placeholder="Stok" class="form-control" value=""><br>

                    <label >Foto*</label>
                    <input type="file" name="userfile" value="upload" class="form-control" value=""><br>
                    

                    
                </div>
                <div class="col-sm-9 col-md-3">
                    <div class="form-group">
                        <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button><br>
                        <a href="<?php echo site_url('admin/mobil'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                        
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>