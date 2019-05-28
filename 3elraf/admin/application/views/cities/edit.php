<?= form_open(); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="pull-right"><?php echo empty($city->id) ? 'اضافه مدينه جديده' : 'تعديل : ' . $city->cityName; ?></h3>
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="control-label">
                اسم البلد
            </label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="cityName" value="<?= $city->cityName; ?>"/>
            </div>
        </div>
        <hr>
        <div class="form-actions text-right">
            <?php echo form_submit('submit', 'حفظ', 'class="btn btn-primary"'); ?>
        </div>                
        <?php echo form_close(); ?>
    </div>
</div>
