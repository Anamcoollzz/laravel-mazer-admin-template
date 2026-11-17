<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('mazer-assets/css/bootstrap.css') }}">

    @yield('vendor-css')
    <link rel="stylesheet" href="{{ asset('mazer-assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('mazer-assets/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('mazer.index.html') }}"><img src="{{ asset('mazer-assets/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.index.html') ? 'active' : '' }}">
                            <a href="{{ route('mazer.index.html') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.component-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Components</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.component-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.component-alert.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-alert.html') }}">Alert</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-badge.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-badge.html') }}">Badge</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-breadcrumb.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-breadcrumb.html') }}">Breadcrumb</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-button.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-button.html') }}">Button</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-card.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-card.html') }}">Card</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-carousel.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-carousel.html') }}">Carousel</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-dropdown.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-dropdown.html') }}">Dropdown</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-list-group.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-list-group.html') }}">List Group</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-modal.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-modal.html') }}">Modal</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-navs.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-navs.html') }}">Navs</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-pagination.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-pagination.html') }}">Pagination</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-progress.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-progress.html') }}">Progress</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-spinner.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-spinner.html') }}">Spinner</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.component-tooltip.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.component-tooltip.html') }}">Tooltip</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.extra-component-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Extra Components</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.extra-component-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.extra-component-avatar.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.extra-component-avatar.html') }}">Avatar</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.extra-component-sweetalert.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.extra-component-sweetalert.html') }}">Sweet Alert</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.extra-component-toastify.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.extra-component-toastify.html') }}">Toastify</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.extra-component-rating.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.extra-component-rating.html') }}">Rating</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.extra-component-divider.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.extra-component-divider.html') }}">Divider</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.layout-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Layouts</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.layout-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.layout-default.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.layout-default.html') }}">Default Layout</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.layout-vertical-1-column.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.layout-vertical-1-column.html') }}">1 Column</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.layout-vertical-navbar.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.layout-vertical-navbar.html') }}">Vertical with Navbar</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.layout-horizontal.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.layout-horizontal.html') }}">Horizontal Menu</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">Forms &amp; Tables</li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.form-element-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-hexagon-fill"></i>
                                <span>Form Elements</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.form-element-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.form-element-input.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.form-element-input.html') }}">Input</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.form-element-input-group.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.form-element-input-group.html') }}">Input Group</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.form-element-select.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.form-element-select.html') }}">Select</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.form-element-radio.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.form-element-radio.html') }}">Radio</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.form-element-checkbox.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.form-element-checkbox.html') }}">Checkbox</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.form-element-textarea.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.form-element-textarea.html') }}">Textarea</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.form-layout.html') ? 'active' : '' }}">
                            <a href="{{ route('mazer.form-layout.html') }}" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Form Layout</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.form-editor-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-pen-fill"></i>
                                <span>Form Editor</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.form-editor-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.form-editor-quill.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.form-editor-quill.html') }}">Quill</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.form-editor-ckeditor.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.form-editor-ckeditor.html') }}">CKEditor</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.form-editor-summernote.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.form-editor-summernote.html') }}">Summernote</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.form-editor-tinymce.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.form-editor-tinymce.html') }}">TinyMCE</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.table.html') ? 'active' : '' }}">
                            <a href="{{ route('mazer.table.html') }}" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Table</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.table-datatable.html') ? 'active' : '' }}">
                            <a href="{{ route('mazer.table-datatable.html') }}" class='sidebar-link'>
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>Datatable</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Extra UI</li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.ui-widgets-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-pentagon-fill"></i>
                                <span>Widgets</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.ui-widgets-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.ui-widgets-chatbox.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.ui-widgets-chatbox.html') }}">Chatbox</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.ui-widgets-pricing.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.ui-widgets-pricing.html') }}">Pricing</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.ui-widgets-todolist.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.ui-widgets-todolist.html') }}">To-do List</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.ui-icons-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-egg-fill"></i>
                                <span>Icons</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.ui-icons-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.ui-icons-bootstrap-icons.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.ui-icons-bootstrap-icons.html') }}">Bootstrap Icons </a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.ui-icons-fontawesome.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.ui-icons-fontawesome.html') }}">Fontawesome</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.ui-icons-dripicons.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.ui-icons-dripicons.html') }}">Dripicons</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.ui-chart-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-bar-chart-fill"></i>
                                <span>Charts</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.ui-chart-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.ui-chart-chartjs.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.ui-chart-chartjs.html') }}">ChartJS</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.ui-chart-apexcharts.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.ui-chart-apexcharts.html') }}">Apexcharts</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.ui-file-uploader.html') ? 'active' : '' }}">
                            <a href="{{ route('mazer.ui-file-uploader.html') }}" class='sidebar-link'>
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                                <span>File Uploader</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.ui-map-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-map-fill"></i>
                                <span>Maps</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.ui-map-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.ui-map-google-map.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.ui-map-google-map.html') }}">Google Map</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.ui-map-jsvectormap.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.ui-map-jsvectormap.html') }}">JS Vector Map</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">Pages</li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.application-email.html') ? 'active' : '' }}">
                            <a href="{{ route('mazer.application-email.html') }}" class='sidebar-link'>
                                <i class="bi bi-envelope-fill"></i>
                                <span>Email Application</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.application-chat.html') ? 'active' : '' }}">
                            <a href="{{ route('mazer.application-chat.html') }}" class='sidebar-link'>
                                <i class="bi bi-chat-dots-fill"></i>
                                <span>Chat Application</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.application-gallery.html') ? 'active' : '' }}">
                            <a href="{{ route('mazer.application-gallery.html') }}" class='sidebar-link'>
                                <i class="bi bi-image-fill"></i>
                                <span>Photo Gallery</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.application-checkout.html') ? 'active' : '' }}">
                            <a href="{{ route('mazer.application-checkout.html') }}" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Checkout Page</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.auth-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Authentication</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.auth-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.auth-login.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.auth-login.html') }}">Login</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.auth-register.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.auth-register.html') }}">Register</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.auth-forgot-password.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.auth-forgot-password.html') }}">Forgot Password</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('mazer.error-*.html') ? 'active' : '' }} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-x-octagon-fill"></i>
                                <span>Errors</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('mazer.error-*.html') ? 'active' : '' }}">
                                <li class="submenu-item {{ request()->routeIs('mazer.error-403.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.error-403.html') }}">403</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.error-404.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.error-404.html') }}">404</a>
                                </li>
                                <li class="submenu-item {{ request()->routeIs('mazer.error-500.html') ? 'active' : '' }}">
                                    <a href="{{ route('mazer.error-500.html') }}">500</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">Raise Support</li>

                        <li class="sidebar-item  ">
                            <a href="https://zuramai.github.io/mazer/docs" class='sidebar-link'>
                                <i class="bi bi-life-preserver"></i>
                                <span>Documentation</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="https://github.com/zuramai/mazer/blob/main/CONTRIBUTING.md" class='sidebar-link'>
                                <i class="bi bi-puzzle"></i>
                                <span>Contribute</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="https://github.com/zuramai/mazer#donate" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Donate</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('page-heading')
            @yield('page-content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @yield('vendor-js')

    <script src="{{ asset('mazer-assets/js/main.js') }}"></script>
</body>

</html>