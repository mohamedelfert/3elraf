<?= form_open_multipart(); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h3><?= empty($advertDetails->advertId) ? 'اضافه اعلان جديد' : 'تعديل : '; ?></h3>
        </div>
    </div>
    <div class="panel-body">
<?= (isset($advertDetails->advertId))? form_hidden("advertId",$advertDetails->advertId):'';?>

        <div class="form-group col-lg-12">
            <label class="control-label col-md-3">
                اسم العميل(Agent Name)
            </label>
            <div class="col-md-9">
                <?= form_error('agentName'); ?>
                <?= form_input('agentName',  set_value("agentName",$advertDetails->agentName),'class="form-control"'); ?>
            </div>
        </div>
        <div class="form-group col-lg-12">
            <label class="control-label col-md-3">
                لينك الاعلان(Advert Link)
            </label>
            <div class="col-md-9">
                <?= form_error('advertLink'); ?>
                <?= form_input('advertLink',  set_value("advertLink",$advertDetails->advertLink),'class="form-control"'); ?>
            </div>
        </div>

        <div class="form-group col-lg-12">
            <label class="control-label col-md-3">
                الثمن(Advert Price)
            </label>
            <div class="col-md-9">
                <?= form_error('advertPrice'); ?>
                <?= form_input('advertPrice',  set_value("advertPrice",$advertDetails->advertPrice),'class="form-control"'); ?>
            </div>
        </div>
        <div class="form-group col-lg-12">
            <label class="control-label col-md-3">
                المندوب(Syndical Name)
            </label>
            <div class="col-md-9">
                <?= form_error('syndicalName'); ?>
                <?= form_input('syndicalName',  set_value("syndicalName",$advertDetails->syndicalName),'class="form-control"'); ?>
            </div>
        </div>
        <div class="form-group col-lg-12">
            <label class="control-label col-md-3">
                تاريخ بداية الاعلان(advert Start)
            </label>
            <div class="col-md-9">
                <?= form_error('advertStart'); ?>
                <?= form_input('advertStart',  set_value("advertStart",$advertDetails->advertStart),'class="form-control datepicker"'); ?>
            </div>
        </div>
        <div class="form-group col-lg-12">
            <label class="control-label col-md-3">
                تاريخ نهايه الاعلان(Advert End)
            </label>
            <div class="col-md-9">
                <?= form_error('advertEnd'); ?>
                <?= form_input('advertEnd',  set_value("advertEnd",$advertDetails->advertEnd),'class="form-control datepicker"'); ?>
            </div>
        </div>

        <div class="form-group col-lg-12">
            <label class="control-label col-md-3">
                صورة الاعلان(Advert Image)
            </label>
            <div class="col-md-7">
                <?= form_upload('advertImg', '','class="form-control styled"'); ?>
            </div>
            <div class="col-md-2">
                <?php
                if(isset($advertDetails->advertImg) && $advertDetails->advertImg != NULL &&
                        is_file('../assets/img/advertImgs/'.$advertDetails->advertImg)){
                    ?>
                <img width="100%" src="<?= base_url('/assets/img/advertImgs/'.$advertDetails->advertImg);?>" alt="<?= $advertDetails->agentName.' Logo'?>">
                <?php }?>
            </div>
        </div>
        <hr>
        <div class="form-actions text-right">
        <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
        </div>                
<?php echo form_close(); ?>
    </div>
</div>

<script>
    $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd',minDate:0 });
</script>