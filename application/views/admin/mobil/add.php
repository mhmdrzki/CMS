
<?php echo validation_errors(); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-lg-12">
            <h3>Tambah Data Mobil</h3>
            <br>
        </div>
        <!-- /.col-lg-12 -->

        <?php echo form_open_multipart(current_url()); ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-9 col-md-9">
                    <input type="hidden" name="user_id" value="" />
                    <label >Brand *</label>
                    <!-- <?php echo (isset($user)) ? 'readonly' : '' ?>  -->
                    <select name="brand" class="form-control">
                        <option value="Toyota">Toyota</option>
                        <option value="Daihatsu">Daihatsu</option>
                        <option value="Honda">Honda</option>
                    </select>
                    <br>
                    <label >Kode SKU*</label>
                    <input type="text" name="kode_sku" placeholder="Kode SKU" class="form-control" value=""><br>

                    <label >Merek *</label>
                    <input type="text" name="merek" placeholder="Merek" class="form-control" value=""><br>

                    <label >Tahun *</label>
                    <input type="text" name="tahun" placeholder="Tahun" class="form-control" value=""><br>

                    <label >Harga*</label>
                    <input type="text" name="harga" placeholder="Harga" class="form-control" value=""><br>

                    <label >Stok*</label>
                    <input type="text" name="stok" placeholder="Stok" class="form-control" value=""><br>

                    <label >Foto*</label>
                    <input type="file" name="userfile" size="20" placeholder="Foto" class="form-control" value=""><br>
                    

                    
                </div>
                <div class="col-sm-9 col-md-3">
                    <div class="form-group">
                        <button name="action" type="submit" value="upload" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button><br>
                        <a href="<?php echo site_url('admin/mobil'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                        
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>