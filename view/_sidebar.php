<div class="sidebar cfont-sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse collapse">
        <ul class="nav" id="side-menu">
            <li class="<?=($menu == "index")? 'active' : ''?>"><a href="index.php" class="material-ripple"><i class="material-icons">devices_other</i> خانه</a>
            </li>
             

            <li class="<?=($menu == "category")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="material-icons">view_week</i>کتگوری<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "add_category")? 'active' : ''?>"><a href="add_category.php"><i class="material-icons">playlist_add</i>ثبت کتگوری</a></li>
                    <li class="<?=($sub == "list_category")? 'active' : ''?>"><a href="list_category.php"><i class="material-icons">playlist_add_check</i>لیست کتگوری</a></li>
                </ul>
            </li>

            <li class="<?=($menu == "customer")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="material-icons">account_circle</i>مشتری<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "add_customer")? 'active' : ''?>"><a href="add_customer.php"><i class="fa fa-user-plus"></i>ثبت مشتری</a></li>
                    <li class="<?=($sub == "list_customer")? 'active' : ''?>"><a href="list_customer.php"><i class="fa fa-list-alt"></i>لیست مشتری</a></li>
                </ul>
            </li>

            <li class="<?=($menu == "stock")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="material-icons">business</i>گدام<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "add_stock")? 'active' : ''?>"><a href="add_stock.php"><i class="fa fa-plus-circle"></i>ثبت گدام</a></li>
                    <li class="<?=($sub == "list_stock")? 'active' : ''?>"><a href="list_stock.php"><i class=" fa fa-window-restore"></i>لیست گدام</a></li>
                </ul>
            </li>

            <li class="<?=($menu == "drug")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="fa fa-sitemap"></i>دوا<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "add_drug")? 'active' : ''?>"><a href="add_drug.php"><i class="fa fa-plus-square-o"></i>ثبت دوا</a></li>
                    <li class="<?=($sub == "list_drug")? 'active' : ''?>"><a href="list_drug.php"><i class="fa fa-sliders"></i>لیست دوا</a></li>
                </ul>
            </li>


            <li class="<?=($menu == "buy_factor")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="fa fa-cart-arrow-down"></i>فاکتور خرید<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "add_buy_factor")? 'active' : ''?>"><a href="add_buy_factor.php"><i class="fa fa-plus-square"></i>ثبت  فاکتور خرید</a></li>
                    <li class="<?=($sub == "list_buy_factor")? 'active' : ''?>"><a href="list_buy_factor.php"><i class="fa fa-list-ul"></i>لیست فاکتور خرید</a></li>
                </ul>
            </li>

            <li class="<?=($menu == "sell_factor")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="fa fa-sellsy"></i>فاکتور  فروش<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "add_sell_factor")? 'active' : ''?>"><a href="add_sell_factor.php"><i class="fa fa-save"></i>ثبت  فاکتور فروش  </a></li>
                    <li class="<?=($sub == "list_sell_factor")? 'active' : ''?>"><a href="list_sell_factor.php"><i class="fa fa-list-ol"></i>لیست فاکتور فروش</a></li>
                </ul>
            </li>

            <li class="<?=($menu == "transform_money")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="fa fa-sellsy"></i>حواله جات<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "add_transform_money")? 'active' : ''?>"><a href="add_transform_money.php"><i class="fa fa-save"></i>ثبت  حواله  </a></li>
                    <li class="<?=($sub == "list_transform_money")? 'active' : ''?>"><a href="list_transform_money.php"><i class="fa fa-list-ol"></i>لیست حواله جات</a></li>
                </ul>
            </li>

            <!-- <li class="<?=($menu == "transfer_drug")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="fa fa-cube"></i>انتقال دوا<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "add_transfer_durg")? 'active' : ''?>"><a href="transfer_drug.php"><i class="fa fa-save"></i>ثبت   انتقال دوا  </a></li>
                    <li class="<?=($sub == "list_transfer_drug")? 'active' : ''?>"><a href="list_transfer_drug.php"><i class="fa fa-align-justify"></i>لیست  انتقال دوا</a></li>
                </ul>
            </li> -->

            <li class="<?=($menu == "transaction")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="fa fa-check-square-o"></i>رسید و برد<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "add_transaction")? 'active' : ''?>"><a href="add_transaction.php"><i class="fa fa-vcard-o"></i> رسید و برد و  اشخاص / دفاتر </a></li>
                    <li class="<?=($sub == "list_transaction")? 'active' : ''?>"><a href="list_transaction.php"><i class="fa fa-align-justify"></i>لیست   رسید و برد اشخاص / دفاتر</a></li>
                </ul>
            </li>

            <li class="<?=($menu == "report")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="fa fa-bar-chart-o"></i>گزارشات<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "report_expiry_date")? 'active' : ''?>"><a href="report_expiry_date.php"><i class="fa fa-clipboard"></i> گزارش تاریخ انقضا  </a></li>
                    <!-- <li class="<?=($sub == "report_customer")? 'active' : ''?>"><a href="report_customer.php"><i class="fa fa-vcard-o"></i> گزارش مشتری ها </a></li> -->
                    <li class="<?=($sub == "report_exit_durg")? 'active' : ''?>"><a href="report_exit_durg.php"><i class="fa fa-files-o"></i> گزارش موجودی دوا  </a></li>
                    <li class="<?=($sub == "report_buy_drug")? 'active' : ''?>"><a href="report_buy_drug.php"><i class="fa fa-file-text-o"></i>  گزارش خرید دوا  </a></li>
                    <li class="<?=($sub == "report_sell_drug")? 'active' : ''?>"><a href="report_sell_drug.php"><i class="fa fa-list-ol"></i>  گزارش فروش  دوا  </a></li>
                    <li class="<?=($sub == "report_debt_customer")? 'active' : ''?>"><a href="report_debt_customer.php"><i class="fa fa-list-ul"></i>  لیست قرض  داران   </a></li>
                    <li class="<?=($sub == "report_credit_customer")? 'active' : ''?>"><a href="report_credit_customer.php"><i class="fa fa-list-ul"></i>  لیست طلب  داران   </a></li>
                    <li class="<?=($sub == "report_primery_customer")? 'active' : ''?>"><a href="report_primery_cusotmer.php"><i class="fa fa-list-ul"></i>   حساب های متفرقه   </a></li>
                </ul>
            </li>

            <li class="<?=($menu == "user")? 'active' : ''?>">
                <a  href="#" class="material-ripple"><i class="fa fa-users"></i>کاربران<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=($sub == "add_user")? 'active' : ''?>"><a href="add_user.php"><i class="fa fa-user-plus"></i>ثبت کاربر</a></li>
                    <li class="<?=($sub == "list_user")? 'active' : ''?>"><a href="list_user.php"><i class="fa fa-list"></i>لیست کاربر</a></li>
                </ul>
            </li>


            <li><a href="NovaVTeam.php" class="material-ripple" target="_blank"><i class="material-icons">bookmark</i> ﺭﻫﻨﻤﺎ ﻭ ﻣﺪﯾﺮﯾﺖ</a></li>


        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
