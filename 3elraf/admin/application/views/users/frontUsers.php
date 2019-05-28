<div class="tab-content">

    <!-- First tab -->
    <div class="tab-pane active fade in" id="all-tasks">

        <!-- Tasks table -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-paragraph-justify2"></i>users</h6>
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
                            <td><?= $user->bookStoreUsersDetailFirstName ." ".$user->bookStoreUsersDetailLastName; ?></td>
                            <td><?= $user->bookStoreUsersDetailEmail; ?></td>
                            <td><?= $user->bookStoreUsersDetailPhoneNumber; ?></td>
                            <td>
                                <?php if ($user->bookStoreUsersDetailUserProfileImg != null &&
                                    is_file('../assets/img/usersImgs/' . $user->bookStoreUsersDetailUserProfileImg)
                                ) { ?>
                                    <img src="<?= base_url("assets/img/usersImgs/thumb_" . $user->bookStoreUsersDetailUserProfileImg); ?>"
                                         class="img-rounded">
                                <?php } else { ?>
                                    <img src="<?= base_url("assets/img/user-pic.jpg"); ?>"
                                         class="img-rounded">
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= site_url('frontUsers/delUser/' . $user->bookStoreUsersDetailId); ?>"><i class="icon-remove"></i></a>
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


