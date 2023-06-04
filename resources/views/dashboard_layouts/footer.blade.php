                    </div>
                </div>
            </div>
        </div>
        <!-- content modal start -->
        <!-- content modal end -->
        <!-- content @e -->
        <!-- footer @s -->
        <div class="nk-footer">
            <div class="container-fluid">
                <div class="nk-footer-wrap">
                    <div class="nk-footer-copyright"> &copy; {{ date('Y') }} {{ env('APP_NAME') }}.</div>
                </div>
            </div>
        </div>
        <!-- footer @e -->
        </div>
        <!-- wrap @e -->
        </div>
        <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <!-- JavaScript -->

        <script src="{{ asset('dashboard_assets/js/bundle.js?ver=2.9.1') }}"></script>
        <script src="{{ asset('dashboard_assets/js/scripts.js?ver=2.9.1') }}"></script>
        <!-- vanilla toast script -->
        <script src="{{ asset('dashboard_assets/js/libs/toastify.js') }}"></script>
        <!-- dataTable script -->
        <script src="{{ asset('dashboard_assets/js/libs/datatable-btns.js') }} "></script>
        <script type="text/javascript" src="{{ asset('js/helper.js') }}"></script>
        @yield('dashboard_layouts/script')
    </body>
</html>
