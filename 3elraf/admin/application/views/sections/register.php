<br>
<div class="modal-body">
    <?= form_open_multipart(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">
                <?= empty($sectionData->bookSectionId) ? 'اضافه قسم' : 'تعديل: ' . $sectionData->bookSectionTitle; ?>
            </h6>
        </div>
        <div class="panel-body">
            <?php if (!empty($sectionData->bookSectionId)) { ?>
                <?= form_hidden('bookSectionId', set_value('bookSectionId', $sectionData->bookSectionId), 'class="form-control"'); ?>
            <?php } ?>
            <div class="form-group col-lg-12">
                <div class="col-md-2">
                    <label>اسم القسم</label>
                </div>
                <div class="col-md-10">
                    <?= form_input('bookSectionTitle', set_value('bookSectionTitle', $sectionData->bookSectionTitle), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="col-md-2">
                    <label>عرض فى الرئيسيه</label>
                </div>
                <div class="col-md-10">
                    <div class="col-md-6">
                        <label>لا</label>
                        <?=form_radio("showInHome",0, set_value('showInHome', $sectionData->showInHome),"class='styled'");?>
                    </div>
                    <div class="col-md-6">
                        <label>نعم</label>
                        <?=form_radio("showInHome",1, set_value('showInHome', $sectionData->showInHome),"class='styled'");?>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-12 ">
                <div class="col-md-12">
                    <?php echo form_submit('submit', 'Save', 'class="btn btn-primary pull-right"'); ?>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
