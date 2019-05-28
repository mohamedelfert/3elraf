<br>
<div class="modal-body">
    <?= form_open(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">
                <i class="icon-bug"></i>
                <?= empty($userData->adminId) ? 'Add Manager' : 'Updata profile: ' . $userData->bookStoreAdminName; ?>
            </h6>
        </div>
        <div class="panel-body">
            <?php if (!empty($userData->adminId)) { ?>
                <?= form_hidden('adminId', set_value('adminId', $userData->adminId), 'class="form-control"'); ?>
            <?php } ?>

            <div class="form-group col-lg-12">
                <div class="col-md-2">
                    <label>اسم المدير</label>
                </div>
                <div class="col-md-10">
                    <?= form_input('bookStoreAdminName', set_value('bookStoreAdminName', $userData->bookStoreAdminName), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="col-md-2">
                    <label>البريد الالكترونى</label>
                </div>
                <div class="col-md-10">
                    <?= form_input('bookStoreAdminEmail', set_value('bookStoreAdminEmail', $userData->bookStoreAdminEmail),
                        'class="form-control"'); ?>
                </div>

            </div>
            <div class="form-group col-lg-12">
                <div class="col-md-2">
                    <label>رقم الهاتف</label>
                </div>
                <div class="col-md-10">
                    <?= form_input('bookStoreAdminPhone', set_value('bookStoreAdminPhone', $userData->bookStoreAdminPhone), 'class="form-control"'); ?>
                </div>
            </div>

            <div class="form-group col-lg-12">
                <label class="col-md-2">الرقم السرى</label>
                <div class="col-md-10">
                    <?= form_password('password', '', 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="col-md-2">
                    <label>تاكيد الرقم السري</label>
                </div>
                <div class="col-md-10">
                    <?= form_password('password_confirm', '', 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group col-lg-12">
                <div class="col-md-2">
                    <label>نوع المدير</label>
                </div>
                <div class="col-md-10">
                    <div class="col-md-6">
                        <?= form_radio('bookStoreAdminType', 1,
                            ($userData->bookStoreAdminType == 1) ? true : false, 'class="styled"'); ?>
                        مدير عام
                    </div>
                    <div class="col-md-6">
                        <?= form_radio('bookStoreAdminType', 2,
                            ($userData->bookStoreAdminType == 2) ? true : false, 'class="styled"'); ?>
                        مدير فرعى
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-12 adminPrivileges" style="<?=($userData->bookStoreAdminType == 2)? 'display:block':'display:none';?>">
                <div class="col-md-2">
                    <label>صلاحيات المدير</label>
                </div>
                <div class="col-md-10">
                    <?php
                    $prev = [];
                    foreach ($adminPrevilleges as $adminPrevillege) {
                        $prev[] = $adminPrevillege->privilegeId;
                    }
                    foreach ($privileges as $privilege) {
                        if (in_array($privilege->privilegeId, $prev)) {
                            $isChecked = TRUE;
                        } else {
                            $isChecked = FALSE;
                        } ?>
                        <div class="col-md-3">
                            <?= form_checkbox('adminPrivileges[]', $privilege->privilegeId, $isChecked, 'class="styled"'); ?>
                            <?= $privilege->privilegeTitle; ?>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>

            <div class="form-group col-lg-12">
                <div class="col-md-2">
                    <label>بيانات اخرى</label>
                </div>
                <div class="col-md-10">
                    <?= form_textarea('bookStoreAdminAnotherData', set_value('bookStoreAdminAnotherData', $userData->bookStoreAdminAnotherData), 'class="form-control"'); ?>
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






