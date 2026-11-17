<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Seed the Mazer sidebar menus.
     */
    public function run(): void
    {
        $items = [
            ['type' => Menu::TypeTitle, 'title' => 'Menu', 'title_en' => 'Menu'],
            [
                'title' => 'Dasbor',
                'title_en' => 'Dashboard',
                'icon' => 'bi bi-grid-fill',
                'route_name' => 'mazer.index.html',
            ],
            [
                'title' => 'Menu',
                'title_en' => 'Menus',
                'icon' => 'bi bi-list-ul',
                'route_name' => 'menus.index',
                'route_pattern' => 'menus.*',
            ],
            [
                'title' => 'Komponen',
                'title_en' => 'Components',
                'icon' => 'bi bi-stack',
                'route_pattern' => 'mazer.component-*.html',
                'children' => [
                    ['title' => 'Accordion', 'title_en' => 'Accordion', 'route_name' => 'mazer.component-accordion.html'],
                    ['title' => 'Alert', 'title_en' => 'Alert', 'route_name' => 'mazer.component-alert.html'],
                    ['title' => 'Badge', 'title_en' => 'Badge', 'route_name' => 'mazer.component-badge.html'],
                    ['title' => 'Breadcrumb', 'title_en' => 'Breadcrumb', 'route_name' => 'mazer.component-breadcrumb.html'],
                    ['title' => 'Button', 'title_en' => 'Button', 'route_name' => 'mazer.component-button.html'],
                    ['title' => 'Card', 'title_en' => 'Card', 'route_name' => 'mazer.component-card.html'],
                    ['title' => 'Carousel', 'title_en' => 'Carousel', 'route_name' => 'mazer.component-carousel.html'],
                    ['title' => 'Collapse', 'title_en' => 'Collapse', 'route_name' => 'mazer.component-collapse.html'],
                    ['title' => 'Dropdown', 'title_en' => 'Dropdown', 'route_name' => 'mazer.component-dropdown.html'],
                    ['title' => 'List Group', 'title_en' => 'List Group', 'route_name' => 'mazer.component-list-group.html'],
                    ['title' => 'Modal', 'title_en' => 'Modal', 'route_name' => 'mazer.component-modal.html'],
                    ['title' => 'Navs', 'title_en' => 'Navs', 'route_name' => 'mazer.component-navs.html'],
                    ['title' => 'Pagination', 'title_en' => 'Pagination', 'route_name' => 'mazer.component-pagination.html'],
                    ['title' => 'Progress', 'title_en' => 'Progress', 'route_name' => 'mazer.component-progress.html'],
                    ['title' => 'Spinner', 'title_en' => 'Spinner', 'route_name' => 'mazer.component-spinner.html'],
                    ['title' => 'Toasts', 'title_en' => 'Toasts', 'route_name' => 'mazer.component-toasts.html'],
                    ['title' => 'Tooltip', 'title_en' => 'Tooltip', 'route_name' => 'mazer.component-tooltip.html'],
                ],
            ],
            [
                'title' => 'Komponen Tambahan',
                'title_en' => 'Extra Components',
                'icon' => 'bi bi-collection-fill',
                'route_pattern' => 'mazer.extra-component-*.html',
                'children' => [
                    ['title' => 'Avatar', 'title_en' => 'Avatar', 'route_name' => 'mazer.extra-component-avatar.html'],
                    ['title' => 'Divider', 'title_en' => 'Divider', 'route_name' => 'mazer.extra-component-divider.html'],
                    ['title' => 'Date Picker', 'title_en' => 'Date Picker', 'route_name' => 'mazer.extra-component-date-picker.html'],
                    ['title' => 'Sweet Alert', 'title_en' => 'Sweet Alert', 'route_name' => 'mazer.extra-component-sweetalert.html'],
                    ['title' => 'Toastify', 'title_en' => 'Toastify', 'route_name' => 'mazer.extra-component-toastify.html'],
                    ['title' => 'Rating', 'title_en' => 'Rating', 'route_name' => 'mazer.extra-component-rating.html'],
                ],
            ],
            [
                'title' => 'Tata Letak',
                'title_en' => 'Layouts',
                'icon' => 'bi bi-grid-1x2-fill',
                'route_pattern' => 'mazer.layout-*.html',
                'children' => [
                    ['title' => 'Tata Letak Default', 'title_en' => 'Default Layout', 'route_name' => 'mazer.layout-default.html'],
                    ['title' => '1 Kolom', 'title_en' => '1 Column', 'route_name' => 'mazer.layout-vertical-1-column.html'],
                    ['title' => 'Navbar Vertikal', 'title_en' => 'Vertical Navbar', 'route_name' => 'mazer.layout-vertical-navbar.html'],
                    ['title' => 'Tata Letak RTL', 'title_en' => 'RTL Layout', 'route_name' => 'mazer.layout-rtl.html'],
                    ['title' => 'Menu Horizontal', 'title_en' => 'Horizontal Menu', 'route_name' => 'mazer.layout-horizontal.html'],
                ],
            ],
            ['type' => Menu::TypeTitle, 'title' => 'Formulir & Tabel', 'title_en' => 'Forms & Tables'],
            [
                'title' => 'Elemen Form',
                'title_en' => 'Form Elements',
                'icon' => 'bi bi-hexagon-fill',
                'route_pattern' => 'mazer.form-element-*.html',
                'children' => [
                    ['title' => 'Input', 'title_en' => 'Input', 'route_name' => 'mazer.form-element-input.html'],
                    ['title' => 'Input Group', 'title_en' => 'Input Group', 'route_name' => 'mazer.form-element-input-group.html'],
                    ['title' => 'Select', 'title_en' => 'Select', 'route_name' => 'mazer.form-element-select.html'],
                    ['title' => 'Radio', 'title_en' => 'Radio', 'route_name' => 'mazer.form-element-radio.html'],
                    ['title' => 'Checkbox', 'title_en' => 'Checkbox', 'route_name' => 'mazer.form-element-checkbox.html'],
                    ['title' => 'Textarea', 'title_en' => 'Textarea', 'route_name' => 'mazer.form-element-textarea.html'],
                ],
            ],
            [
                'title' => 'Tata Letak Form',
                'title_en' => 'Form Layout',
                'icon' => 'bi bi-file-earmark-medical-fill',
                'route_name' => 'mazer.form-layout.html',
            ],
            [
                'title' => 'Validasi Form',
                'title_en' => 'Form Validation',
                'icon' => 'bi bi-journal-check',
                'route_pattern' => 'mazer.form-validation-parsley.html',
                'children' => [
                    ['title' => 'Parsley', 'title_en' => 'Parsley', 'route_name' => 'mazer.form-validation-parsley.html'],
                ],
            ],
            [
                'title' => 'Editor Form',
                'title_en' => 'Form Editor',
                'icon' => 'bi bi-pen-fill',
                'route_pattern' => 'mazer.form-editor-*.html',
                'children' => [
                    ['title' => 'Quill', 'title_en' => 'Quill', 'route_name' => 'mazer.form-editor-quill.html'],
                    ['title' => 'CKEditor', 'title_en' => 'CKEditor', 'route_name' => 'mazer.form-editor-ckeditor.html'],
                    ['title' => 'Summernote', 'title_en' => 'Summernote', 'route_name' => 'mazer.form-editor-summernote.html'],
                    ['title' => 'TinyMCE', 'title_en' => 'TinyMCE', 'route_name' => 'mazer.form-editor-tinymce.html'],
                ],
            ],
            [
                'title' => 'Tabel',
                'title_en' => 'Table',
                'icon' => 'bi bi-grid-1x2-fill',
                'route_name' => 'mazer.table.html',
            ],
            [
                'title' => 'Datatables',
                'title_en' => 'Datatables',
                'icon' => 'bi bi-file-earmark-spreadsheet-fill',
                'route_pattern' => 'mazer.table-datatable*.html',
                'children' => [
                    ['title' => 'Datatable', 'title_en' => 'Datatable', 'route_name' => 'mazer.table-datatable.html'],
                    ['title' => 'Datatable (jQuery)', 'title_en' => 'Datatable (jQuery)', 'route_name' => 'mazer.table-datatable-jquery.html'],
                ],
            ],
            ['type' => Menu::TypeTitle, 'title' => 'UI Tambahan', 'title_en' => 'Extra UI'],
            [
                'title' => 'Widget',
                'title_en' => 'Widgets',
                'icon' => 'bi bi-pentagon-fill',
                'route_pattern' => 'mazer.ui-widgets-*.html',
                'children' => [
                    ['title' => 'Chatbox', 'title_en' => 'Chatbox', 'route_name' => 'mazer.ui-widgets-chatbox.html'],
                    ['title' => 'Pricing', 'title_en' => 'Pricing', 'route_name' => 'mazer.ui-widgets-pricing.html'],
                    ['title' => 'To-do List', 'title_en' => 'To-do List', 'route_name' => 'mazer.ui-widgets-todolist.html'],
                ],
            ],
            [
                'title' => 'Ikon',
                'title_en' => 'Icons',
                'icon' => 'bi bi-egg-fill',
                'route_pattern' => 'mazer.ui-icons-*.html',
                'children' => [
                    ['title' => 'Bootstrap Icons', 'title_en' => 'Bootstrap Icons', 'route_name' => 'mazer.ui-icons-bootstrap-icons.html'],
                    ['title' => 'Fontawesome', 'title_en' => 'Fontawesome', 'route_name' => 'mazer.ui-icons-fontawesome.html'],
                    ['title' => 'Dripicons', 'title_en' => 'Dripicons', 'route_name' => 'mazer.ui-icons-dripicons.html'],
                ],
            ],
            [
                'title' => 'Grafik',
                'title_en' => 'Charts',
                'icon' => 'bi bi-bar-chart-fill',
                'route_pattern' => 'mazer.ui-chart-*.html',
                'children' => [
                    ['title' => 'ChartJS', 'title_en' => 'ChartJS', 'route_name' => 'mazer.ui-chart-chartjs.html'],
                    ['title' => 'Apexcharts', 'title_en' => 'Apexcharts', 'route_name' => 'mazer.ui-chart-apexcharts.html'],
                ],
            ],
            [
                'title' => 'Unggah File',
                'title_en' => 'File Uploader',
                'icon' => 'bi bi-cloud-arrow-up-fill',
                'route_name' => 'mazer.ui-file-uploader.html',
            ],
            [
                'title' => 'Peta',
                'title_en' => 'Maps',
                'icon' => 'bi bi-map-fill',
                'route_pattern' => 'mazer.ui-map-*.html',
                'children' => [
                    ['title' => 'Google Map', 'title_en' => 'Google Map', 'route_name' => 'mazer.ui-map-google-map.html'],
                    ['title' => 'JS Vector Map', 'title_en' => 'JS Vector Map', 'route_name' => 'mazer.ui-map-jsvectormap.html'],
                ],
            ],
            [
                'title' => 'Menu Bertingkat',
                'title_en' => 'Multi-level Menu',
                'icon' => 'bi bi-three-dots',
                'route_pattern' => 'mazer.ui-multi-level-menu.html',
                'children' => [
                    [
                        'title' => 'Level Pertama',
                        'title_en' => 'First Level',
                        'route_pattern' => 'mazer.ui-multi-level-menu.html',
                        'children' => [
                            ['title' => 'Level Kedua', 'title_en' => 'Second Level', 'route_name' => 'mazer.ui-multi-level-menu.html'],
                            ['title' => 'Menu Level Kedua', 'title_en' => 'Second Level Menu', 'url' => '#'],
                        ],
                    ],
                    [
                        'title' => 'Menu Lainnya',
                        'title_en' => 'Another Menu',
                        'children' => [
                            ['title' => 'Menu Level Kedua', 'title_en' => 'Second Level Menu', 'url' => '#'],
                        ],
                    ],
                ],
            ],
            ['type' => Menu::TypeTitle, 'title' => 'Halaman', 'title_en' => 'Pages'],
            [
                'title' => 'Aplikasi Email',
                'title_en' => 'Email Application',
                'icon' => 'bi bi-envelope-fill',
                'route_name' => 'mazer.application-email.html',
            ],
            [
                'title' => 'Aplikasi Chat',
                'title_en' => 'Chat Application',
                'icon' => 'bi bi-chat-dots-fill',
                'route_name' => 'mazer.application-chat.html',
            ],
            [
                'title' => 'Galeri Foto',
                'title_en' => 'Photo Gallery',
                'icon' => 'bi bi-image-fill',
                'route_name' => 'mazer.application-gallery.html',
            ],
            [
                'title' => 'Halaman Checkout',
                'title_en' => 'Checkout Page',
                'icon' => 'bi bi-basket-fill',
                'route_name' => 'mazer.application-checkout.html',
            ],
            [
                'title' => 'Autentikasi',
                'title_en' => 'Authentication',
                'icon' => 'bi bi-person-badge-fill',
                'route_pattern' => 'mazer.auth-*.html',
                'children' => [
                    ['title' => 'Masuk', 'title_en' => 'Login', 'route_name' => 'mazer.auth-login.html'],
                    ['title' => 'Daftar', 'title_en' => 'Register', 'route_name' => 'mazer.auth-register.html'],
                    ['title' => 'Lupa Password', 'title_en' => 'Forgot Password', 'route_name' => 'mazer.auth-forgot-password.html'],
                ],
            ],
            [
                'title' => 'Galat',
                'title_en' => 'Errors',
                'icon' => 'bi bi-x-octagon-fill',
                'route_pattern' => 'mazer.error-*.html',
                'children' => [
                    ['title' => '403', 'title_en' => '403', 'route_name' => 'mazer.error-403.html'],
                    ['title' => '404', 'title_en' => '404', 'route_name' => 'mazer.error-404.html'],
                    ['title' => '500', 'title_en' => '500', 'route_name' => 'mazer.error-500.html'],
                ],
            ],
            ['type' => Menu::TypeTitle, 'title' => 'Dukungan', 'title_en' => 'Raise Support'],
            [
                'title' => 'Dokumentasi',
                'title_en' => 'Documentation',
                'icon' => 'bi bi-life-preserver',
                'url' => 'https://zuramai.github.io/mazer/docs',
            ],
            [
                'title' => 'Kontribusi',
                'title_en' => 'Contribute',
                'icon' => 'bi bi-puzzle',
                'url' => 'https://github.com/zuramai/mazer/blob/main/CONTRIBUTING.md',
            ],
            [
                'title' => 'Donasi',
                'title_en' => 'Donate',
                'icon' => 'bi bi-cash',
                'url' => 'https://github.com/zuramai/mazer#donation',
            ],
        ];

        $this->seedTree($items);
    }

    /**
     * Recursively create or update menu items.
     *
     * @param  array<int, array<string, mixed>>  $items
     */
    private function seedTree(array $items, ?int $parentId = null): void
    {
        foreach (array_values($items) as $index => $item) {
            $children = $item['children'] ?? [];
            unset($item['children']);

            $existing = Menu::query()
                ->where('parent_id', $parentId)
                ->where(function ($query) use ($item): void {
                    if (! empty($item['route_name'])) {
                        $query->where('route_name', $item['route_name']);
                    } elseif (! empty($item['url']) && $item['url'] !== '#') {
                        $query->where('url', $item['url']);
                    } else {
                        $query->whereIn('title', array_filter([
                            $item['title'],
                            $item['title_en'] ?? null,
                        ]));
                    }
                })
                ->first();

            $attributes = [
                'parent_id' => $parentId,
                'type' => $item['type'] ?? Menu::TypeItem,
                'title' => $item['title'],
                'title_en' => $item['title_en'] ?? null,
                'icon' => $item['icon'] ?? null,
                'route_name' => $item['route_name'] ?? null,
                'url' => $item['url'] ?? null,
                'route_pattern' => $item['route_pattern'] ?? null,
                'order' => $index + 1,
                'is_active' => $item['is_active'] ?? true,
            ];

            if ($existing) {
                $existing->update($attributes);
                $menu = $existing;
            } else {
                $menu = Menu::query()->create($attributes);
            }

            if ($children !== []) {
                $this->seedTree($children, $menu->id);
            }
        }
    }
}
