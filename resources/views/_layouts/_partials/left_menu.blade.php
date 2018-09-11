        <ul class="main-menu">
            <li class="@yield('page_home_li_cls')"><a href="home"><i class="zmdi zmdi-home"></i> Home</a></li>
            <li class="@yield('page_trialbalance_li_cls')"><a href="trialbalance"><i class="zmdi zmdi-format-underlined"></i> TrialBalance</a></li>
            <li class="sub-menu @yield('page_payment_li_cls')">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Payment Due</a>
                <ul>
                    <li class="@yield('page_purchasedue_li_cls')"><a href="purchasedue"><i class="zmdi zmdi-view-list"></i> Purchase Payment</a></li>
                    <li class="@yield('page_paymentduechart_li_cls')"><a href="paymentduechart"><i class="zmdi zmdi-view-list"></i> Payment Due Chart</a></li>
                    <!--li class="@yield('page_salesdue_li_cls')"><a href="salesdue"><i class="zmdi zmdi-view-list"></i> Sales Payment</a></li>
                    <li class="@yield('page_paymentfollowup_li_cls')"><a href="paymentfollowup"><i class="zmdi zmdi-view-list"></i> Payment Followup</a></li-->

                </ul>
            </li>
            <li class="sub-menu @yield('page_stores_li_cls')">
                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Stores</a>
                <ul>
                    <li class="@yield('page_goodsmovement_li_cls')"><a href="goodsmovement"><i class="zmdi zmdi-view-list"></i> Goods Movement</a></li>
                </ul>
            </li>
        </ul>

