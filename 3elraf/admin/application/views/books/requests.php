<!-- Invoice list -->
<div class="block">
    <h6 class="heading-hr">
        <i class="icon-stack"></i> Book requests list
    </h6>
    <div class="datatable">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th style="width:1px;">#</th>

                <?php if (isset($viewTitle)) { ?>
                    <th class="invoice-expand text-center">Book Title</th>
                <?php } ?>
                <th class="invoice-expand text-center">image</th>
                <th class="invoice-expand text-center">userName</th>
                <th class="invoice-expand text-center">email</th>
                <th class="invoice-expand text-center">phone</th>
                <th class="invoice-expand text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($bookRequests as $key => $bookDetails) { ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <?php if (isset($viewTitle)) { ?>
                        <td>
                            <a href="<?= site_url('books/view/'.$bookDetails->bookId); ?>">
                                <?= $bookDetails->bookStoreBookTitle; ?>
                            </a>
                        </td>
                    <?php } ?>
                    <td>
                        <?php if ($bookDetails->bookStoreUsersDetailUserProfileImg != null &&
                            is_file('../assets/img/usersImgs/' . $bookDetails->bookStoreUsersDetailUserProfileImg)
                        ) { ?>
                            <img src="<?= base_url("assets/img/usersImgs/thumb_" . $bookDetails->bookStoreUsersDetailUserProfileImg); ?>"
                                 class="img-rounded">
                        <?php } else { ?>
                            <img src="<?= base_url("assets/img/user-pic.jpg"); ?>"
                                 class="img-rounded">
                        <?php } ?>
                    </td>

                    <td>
                        <a href="<?= base_url("profile/view/$bookDetails->userId"); ?>">
                            <?= $bookDetails->userName; ?>
                        </a>
                    </td>
                    <td>
                        <?= $bookDetails->bookStoreUsersDetailEmail; ?>
                    </td>
                    <td>
                        <?= $bookDetails->bookStoreUsersDetailPhoneNumber; ?>
                    </td>
                    <td><a href="<?= site_url('books/delRequest/' . $bookDetails->bookRequestId); ?>"
                           onclick="return confirm('Are You Sure?')"><i
                                    class="icon-remove"></i></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

