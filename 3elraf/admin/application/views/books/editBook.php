<?= form_open_multipart(); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo empty($bookDetails->bookStoreBookId) ? 'add Book' : 'update : ' . $bookDetails->bookStoreBookTitle; ?></h3>
    </div>
    <div class="panel-body">

        <div class="form-group col-md-12">
            <label class="control-label">
                Book Title
            </label>
            <div class="col-md-10">
                <?= form_error('b_tl'); ?>
                <?= form_input('b_tl', set_value('b_tl', (isset($bookDetails->bookStoreBookTitle) ? $bookDetails->bookStoreBookTitle : '')),
                    'class="form-control" required="" placeholder="Book Title"') ?>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="control-label">
                book Section
            </label>
            <div class="col-md-10">
                <?= form_error('b_sec'); ?>
                <?= form_dropdown('b_sec', $booksSections, set_value('b_sec', (isset($bookDetails->bookStoreBookSection) ? $bookDetails->bookStoreBookSection : '')),
                    'class="form-control" required=""') ?>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="control-label">
                book Description
            </label>
            <div class="col-md-10">
                <?= form_error('b_ds'); ?>
                <?= form_textarea('b_ds', set_value('b_ds', (isset($bookDetails->bookStoreBookDescription) ? $bookDetails->bookStoreBookDescription : '')),
                    'class="form-control" required="" placeholder="Book Description"') ?>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label class="control-label">
                Book Writer
            </label>
            <div class="col-md-10">
                <?= form_error('b_wrt'); ?>
                <?= form_input("b_wrt",
                    set_value("b_wrt", (isset($bookDetails->bookStoreBookWriter) ? $bookDetails->bookStoreBookWriter : '')),
                    'class="form-control" required="" placeholder="Book Writer"'); ?>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label class="control-label">
                Book OverView
            </label>
            <div class="col-md-10">
                <?= form_error('b_ov'); ?>
                <?= form_textarea("b_ov", set_value("b_ov", (isset($bookDetails->bookStoreBookOverView) ? $bookDetails->bookStoreBookOverView : '')), 'class="form-control" required="" placeholder="Book OverView"'); ?>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label class="control-label">
                Price Type
            </label>
            <div class="col-md-10">
                <?= form_error('b_prctp'); ?>
                <div class="col-sm-6">
                    <label>Free</label>
                    <?= form_radio("b_prctp", 0,
                        set_value("b_prc", ((isset($bookDetails->bookStoreBookPriceType) &&
                            $bookDetails->bookStoreBookPriceType == 0) ? true : false)),
                        'class="styled" required="" type="number"'); ?>
                </div>
                <div class="col-md-6">
                    <label>Paid</label>
                    <?= form_radio("b_prctp", 1,
                        set_value("b_prc", ((isset($bookDetails->bookStoreBookPriceType) &&
                            $bookDetails->bookStoreBookPriceType == 1) ? true : false)),
                        'class="styled" required="" placeholder="Book Rate" type="number"'); ?>
                </div>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label>Book Rate</label>
            <div class="col-md-10">
                <?= form_error('b_rt'); ?>
                <?= form_input("b_rt", set_value("b_prc", (isset($bookDetails->bookStoreBookRate) ? $bookDetails->bookStoreBookRate : '')), 'class="form-control" required="" type="number"'); ?>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label>Book Price</label>
            <div class="col-md-10">
                <?= form_error('b_prc'); ?>
                <?= form_input("b_prc", set_value("b_prc", (isset($bookDetails->bookStoreBookPrice) ? $bookDetails->bookStoreBookPrice : '')), 'class="form-control" placeholder="Book Price"'); ?>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label class="control-label col-md-2">
                Book File
            </label>
            <div class="col-md-10">
                <?= form_upload("bookFile", "", 'class="styled"'); ?>
            </div>
        </div>


        <div class="form-group col-md-12">
            <label class="control-label col-md-2">
                Book Image
            </label>
            <div class="col-md-8">
                <input class="styled" type="file" name="bookImg"/>
            </div>
            <div class="col-md-2">
                <?php if (isset($bookDetails) && $bookDetails->bookStoreBookImg != null && is_file('./assets/img/usersBooks/' . $bookDetails->bookStoreBookImg)) { ?>
                    <img src="<?= base_url("assets/img/usersBooks/" . $bookDetails->bookStoreBookImg); ?>"
                         class="media-object user-pic pic-lg">
                <?php } ?>
            </div>
        </div>
        <hr>
        <div class="form-actions text-right">
            <?php echo form_submit('submit', 'save', 'class="btn btn-primary"'); ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>