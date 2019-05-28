<div class="tab-content">

    <!-- First tab -->
    <div class="tab-pane active fade in" id="all-tasks">

        <!-- Tasks table -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-paragraph-justify2"></i>الاقسام (Sections)</h6>
                <span class="pull-right">
                    <a class="btn btn-primary" href="<?= site_url('sections/addSection'); ?>">Add New Section</a>
                </span>
                <span class="pull-right label label-danger"><?= count($sections); ?></span>
            </div>
            <div class="datatable">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th style="width: 1px;">Edit</th>
                            <th style="width: 1px;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sections as $key => $section) { ?>
                            <tr>
                                <td style="width: 1px;"><?= $key + 1; ?></td>
                                <td><?= $section->bookSectionTitle; ?></td>
                                <td>
                                    <a href="<?= site_url('sections/updateSection/' . $section->bookSectionId); ?>">
                                        <i class="icon-wrench"></i></a>
                                </td>
                                <td class="text-center">
                                    <a onclick="return confirm('بحذف هذا القسم لن تستطيع استرجاع البيانات نهائيا .. هل انت متاكد؟')"
                                       href="<?= site_url('sections/delSection/' . $section->bookSectionId); ?>"><i class="icon-remove"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /tasks table -->

    </div>
    <!-- /first tab -->
</div>
