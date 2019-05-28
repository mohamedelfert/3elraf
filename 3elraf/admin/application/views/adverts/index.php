<div class="tab-content">

    <!-- Tasks table -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title"><i class="icon-paragraph-justify2"></i>
                الاعلانات (Adverts)</h6>
            <span class="pull-right">
                <a class="btn btn-primary" href="<?= site_url('adverts/addAdvert/'); ?>">اضافه اعلان جديد</a>
            </span>
            <span class="pull-right label label-danger"><?= count($advertsDetails); ?></span>
        </div>

        <div class="datatable">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 1px;">#</th>
                        <th>العميل</th>
                        <th>المندوب</th>
                        <th>تاريخ البدايه</th>
                        <th>تاريخ النهايه</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($advertsDetails as $key => $advertDetails) {?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td class="task-desc">
                                <?= $advertDetails->agentName; ?>
                            </td>
                            <td class="task-desc">
                                <?= $advertDetails->syndicalName; ?>
                            </td>
                            <td>
                                <?= $advertDetails->advertStart; ?>
                            </td>
                            <td>
                                <?= $advertDetails->advertEnd; ?>
                            </td>
                            <td>
                                <a href="<?= site_url('adverts/updateAdvert/' . $advertDetails->advertId); ?>"><i class="icon-wrench"></i></a>
                            </td>
                            <td class="text-center">
                                <a onclick="return confirm('Are You Sure?')" 
                                   href="<?= site_url('adverts/delAdvert/' . $advertDetails->advertId); ?>"><i class="icon-remove"></i></a>
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
