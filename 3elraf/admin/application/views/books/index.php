<!-- Invoice list -->
<div class="block">
    <h6 class="heading-hr">
        <i class="icon-stack"></i> Books list
        <div class="label label-danger pull-right">
            <a style="color: white" href="<?= site_url('books/addBook'); ?>">Add New Book</a>
        </div>
    </h6>
    <div class="datatable">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="invoice-number">#</th>
                <th>Title</th>
                <th class="invoice-expand text-center">state</th>
                <th class="invoice-expand text-center">requests</th>
                <th class="invoice-expand text-center">view</th>
                <th class="invoice-expand text-center">Edit</th>
                <th class="invoice-expand text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($booksDetails as $key => $bookDetails) { ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $bookDetails->bookStoreBookTitle; ?></td>
                    <td>
                        <?php if ($bookDetails->state == 1) { ?>
                            <a href="<?= site_url('books/disableBook/' . $bookDetails->bookStoreBookId); ?>">
                                        &#xe06d;
                            </a>
                        <?php } else { ?>
                            <a href="<?= site_url('books/activateBook/' . $bookDetails->bookStoreBookId); ?>">
                                        &#xe06e;
                            </a>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="<?= site_url("books/requests/$bookDetails->bookStoreBookId"); ?>">
                            <i class="icon-plus-circle"></i>
                        </a>
                    </td>
                    <td>
                        <a href="<?= site_url("books/view/$bookDetails->bookStoreBookId"); ?>">
                            <i class="icon-book"></i>
                        </a>
                    </td>


                    <td><a href="<?= site_url('books/updateBook/' . $bookDetails->bookStoreBookId); ?>"><i
                                    class="icon-wrench"></i></a></td>

                    <td><a href="<?= site_url('books/delBook/' . $bookDetails->bookStoreBookId); ?>"
                           onclick="return confirm('By Deleting a Book You Delete All its likes, reviews and requests. Are You Sure You Want To?')"><i
                                    class="icon-remove"></i></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

