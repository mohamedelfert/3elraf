<div class="panel-body">
    <div class="container col-md-12">
        <div class="primary-block clearfix">
            <div class="row">
                <div class="col-sm-4">
                    <div class="book-cover book detail-book-cover">
                        <?php if ($bookDetails->bookStoreBookImg != null && is_file('../assets/img/usersBooks/' . $bookDetails->bookStoreBookImg)) { ?>
                            <img src="<?= base_url("assets/img/usersBooks/" . $bookDetails->bookStoreBookImg); ?>"
                                 class="img-responsive" alt="">
                        <?php } ?>
                    </div><!-- /.book-cover -->
                </div><!-- /.col -->
                <div class="col-sm-8">
                    <div class="book-detail-header">
                        <h2 class="book-title"> <?= $bookDetails->bookStoreBookTitle; ?> </h2>
                        <p class="book-author">By <span
                                    class="book-author-name"><?= $bookDetails->bookStoreBookWriter; ?></span></p>
                        <div class="star-rating">
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star"></i>
                        </div><!-- /.star-rating -->
                    </div><!-- /.book-detail-header -->
                    <div class="book-detail-body">
                        <div class="detail-cart-button row clearfix">
                            <div class="pull-left col-md-6 col-sm-5 col-xs-12">
                                <div class="detail-book-price">
                                    <b>
                                        <span class="price">
                                        <?= ($bookDetails->bookStoreBookPriceType == 1) ?
                                            "$ " . $bookDetails->bookStoreBookPrice : " Free Book"; ?>
                                        </span>
                                    </b>
                                </div><!-- /.detail-book-price -->
                            </div><!-- /.pull-left -->
                        </div><!-- /.detail-cart-button -->
                        <div class="clearfix"></div>
                        <div class="product-description">
                            <h3>Quick Overview</h3>
                            <p><?= html_entity_decode($bookDetails->bookStoreBookOverView); ?></p>
                        </div><!-- /.product-description -->
                    </div><!-- /.book-detail-body -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="tab-holder clearfix">
                <div class="book-additional-details">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs book-detail-tab">
                        <li class="active" role="presentation"><a href="#more" data-toggle="tab" aria-expanded="true">More
                                About This Book</a></li>
                        <li role="presentation" class=""><a href="#product-details" data-toggle="tab"
                                                            aria-expanded="false">Users
                                Reviews</a></li>

                    </ul><!-- /.nav -->
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="more" role="tabpanel">
                            <h3>About <?= $bookDetails->bookStoreBookTitle; ?></h3>
                            <p><?= html_entity_decode($bookDetails->bookStoreBookDescription); ?></p>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="product-details" role="tabpanel">
                            <div class="container col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <hr/>
                                        <div class="review-block">
                                            <!--                                    first review-->
                                            <?php foreach ($bookReviews as $bookReview) { ?>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <?php if ($bookReview->bookStoreUsersDetailUserProfileImg != null &&
                                                            is_file('./assets/img/usersImgs/' . $bookReview->bookStoreUsersDetailUserProfileImg)
                                                        ) { ?>
                                                            <img src="<?= base_url("assets/img/usersImgs/thumb_" . $bookReview->bookStoreUsersDetailUserProfileImg); ?>"
                                                                 class="img-rounded">
                                                        <?php } else { ?>
                                                            <img src="<?= base_url("assets/img/user-pic.jpg"); ?>"
                                                                 class="img-rounded">
                                                        <?php } ?>
                                                        <div class="review-block-name">
                                                            <a href="<?= base_url("profile/view/$bookReview->bookReviewUserId"); ?>">
                                                                <?= $bookReview->userName; ?>
                                                            </a>
                                                        </div>
                                                        <div class="review-block-date"><?= $bookReview->bookReviewTime; ?>
                                                            <br/></div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="review-block-rate">
                                                            <?php if ($bookReview->bookReviewUserRate >= 1) { ?>
                                                                <button type="button" class="btn btn-warning btn-xs"
                                                                        aria-label="Left Align">
                                                                <span class="icon-star"
                                                                      aria-hidden="true"></span>
                                                                </button>
                                                            <?php } ?>
                                                            <?php if ($bookReview->bookReviewUserRate >= 2) { ?>
                                                                <button type="button" class="btn btn-warning btn-xs"
                                                                        aria-label="Left Align">
                                                                <span class="icon-star"
                                                                      aria-hidden="true"></span>
                                                                </button>
                                                            <?php } ?>
                                                            <?php if ($bookReview->bookReviewUserRate >= 3) { ?>
                                                                <button type="button" class="btn btn-warning btn-xs"
                                                                        aria-label="Left Align">
                                                                <span class="icon-star"
                                                                      aria-hidden="true"></span>
                                                                </button>
                                                            <?php } ?>
                                                            <?php if ($bookReview->bookReviewUserRate >= 4) { ?>
                                                                <button type="button" class="btn btn-warning btn-xs"
                                                                        aria-label="Left Align">
                                                                <span class="icon-star"
                                                                      aria-hidden="true"></span>
                                                                </button>
                                                            <?php } ?>
                                                            <?php if ($bookReview->bookReviewUserRate >= 4.5) { ?>
                                                                <button type="button" class="btn btn-warning btn-xs"
                                                                        aria-label="Left Align">
                                                                <span class="icon-star"
                                                                      aria-hidden="true"></span>
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="review-block-description">
                                                            <?= $bookReview->bookReviewDescription; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.book-additional-details -->
            </div><!-- /.col -->
        </div><!-- /.primary-block -->
    </div>
</div>