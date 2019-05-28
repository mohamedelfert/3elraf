<?php $this->load->view('components/page_head'); ?>
<!-- /navbar -->

<!-- Page container -->
<div class="page-container">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-content">


            <!-- Main navigation -->
            <ul class="navigation">
                <li class="<?php
                if ($this->uri->segment(1) == "dashBoard") {
                    echo "active";
                }
                ?>">
                    <a href="<?= site_url('dashBoard'); ?>">
                        <span>DashBoard</span> <i class="icon-screen2"></i>
                    </a>
                </li>
                <li class="<?= ($this->uri->segment(1) == "books" && ($this->uri->segment(2) != "newRequests" && $this->uri->segment(2) != "viewedRequests"))? "active":""; ?>">
                    <a href="<?= site_url('books'); ?>">
                        <span>Books</span> <i class="icon-book"></i>
                    </a>
                    <ul>
                        <li class="<?= ($this->uri->segment(2) == "active") ? 'active': ''?>">
                            <a href="<?=site_url('books/active');?>">
                                Active
                            </a>
                        </li>
                        <li class="<?= ($this->uri->segment(2) == "disabled") ? 'active': ''?>">
                            <a href="<?=site_url('books/disabled');?>">
                                Disabled
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?= ($this->uri->segment(1) == "books" &&
                    ($this->uri->segment(2) == "newRequests" || $this->uri->segment(2) == "viewedRequests"))
                    ? "active":""; ?>">
                    <a href="">
                        <span>Books Requests</span> <i class="icon-plus-circle"></i>
                    </a>
                    <ul>
                        <li class="<?= ($this->uri->segment(2) == "newRequests") ? 'active': ''?>">
                            <a href="<?=site_url('books/newRequests');?>">
                                New Requests
                            </a>
                        </li>
                        <li class="<?= ($this->uri->segment(2) == "viewedRequests") ? 'active': ''?>">
                            <a href="<?=site_url('books/viewedRequests');?>">
                                Old Requests
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?= ($this->uri->segment(1) == "cities")? "active":""; ?>">
                    <a href="<?= site_url('cities'); ?>">
                        <span>Cities</span> <i class="icon-flag"></i>
                    </a>
                </li>
                <li class="<?= ($this->uri->segment(1) == "sections")? "active":""; ?>">
                    <a href="<?= site_url('sections'); ?>">
                        <span>Sections</span> <i class="icon-user4"></i>
                    </a>
                </li>
                <li class="<?= ($this->uri->segment(1) == "adverts")? "active":""; ?>">
                    <a href="<?= site_url('adverts'); ?>">
                        <span>Adverts</span> <i class="icon-flag"></i>
                    </a>
                </li>
                <li class="<?= ($this->uri->segment(1) == "frontUsers")? "active":""; ?>">
                    <a href="<?= site_url('frontUsers'); ?>">
                        <span>users</span> <i class="icon-people"></i>
                    </a>
                </li>
                <li class="<?= ($this->uri->segment(1) == "users")? "active":""; ?>">
                    <a href="<?= site_url('users'); ?>">
                        <span>Managers</span> <i class="icon-people"></i>
                    </a>
                </li>


            </ul>
            <!-- /main navigation -->
        </div>
    </div>
    <!-- /sidebar -->

    <!-- Page content -->
    <div class="page-content">
    <br>

        <?php if (validation_errors() != false || isset($_SESSION['errorMsg'])) { ?>
            <div class="bg-warning with-padding block-inner">
                <?= validation_errors(' ', '/'); ?>
                <?= $this->session->flashdata('errorMsg'); ?>
            </div>
        <?php } elseif (isset($_SESSION['successMsg'])) { ?>
            <div class="bg-success with-padding block-inner">
                <?= $this->session->flashdata('successMsg'); ?>
            </div>

        <?php } ?>


        <?php $this->load->view($sub_view); ?>




        <!-- Footer -->
        <?php $this->load->view('components/page_tail'); ?>