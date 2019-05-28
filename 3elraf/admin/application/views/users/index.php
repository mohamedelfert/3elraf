<div class="tab-content">

    <!-- First tab -->
    <div class="tab-pane active fade in" id="all-tasks">

        <!-- Tasks table -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-paragraph-justify2"></i>Managers</h6>
                <span class="pull-right">
                    <a class="btn btn-primary" href="<?= site_url('users/addAdmin'); ?>">Add New Manager</a>
                </span>
                <span class="pull-right label label-danger"><?= count($users); ?></span>
            </div>
            <div class="datatable">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="task-priority">Email</th>
                            <th class="task-priority">Phone</th>
                            <th style="width: 1px;">Edit</th>
                            <th style="width: 1px;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $key => $user) {?>
                            <tr>
                                <td style="width: 1px;"><?= $key + 1; ?></td>
                                <td><?= $user->bookStoreAdminName; ?></td>
                                <td><?= $user->bookStoreAdminEmail; ?></td>
                                <td><?= $user->bookStoreAdminPhone; ?></td>
                                <td>
                                    <a href="<?= site_url('users/updateAdmin/' . $user->adminId); ?>"><i class="icon-wrench"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('users/delAdmin/' . $user->adminId); ?>"><i class="icon-remove"></i></a>
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


