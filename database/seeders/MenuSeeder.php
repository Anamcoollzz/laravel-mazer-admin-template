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
        if (Menu::query()->exists()) {
            return;
        }

        $items = [
            ['type' => Menu::TypeTitle, 'title' => 'Menu'],
            [
                'title' => 'Dashboard',
                'icon' => 'bi bi-grid-fill',
                'route_name' => 'mazer.index.html',
            ],
            [
                'title' => 'Menus',
                'icon' => 'bi bi-list-ul',
                'route_name' => 'menus.index',
                'route_pattern' => 'menus.*',
            ],
            [
                'title' => 'Components',
                'icon' => 'bi bi-stack',
                'route_pattern' => 'mazer.component-*.html',
                'children' => [
                    ['title' => 'Accordion', 'route_name' => 'mazer.component-accordion.html'],
                    ['title' => 'Alert', 'route_name' => 'mazer.component-alert.html'],
                    ['title' => 'Badge', 'route_name' => 'mazer.component-badge.html'],
                    ['title' => 'Breadcrumb', 'route_name' => 'mazer.component-breadcrumb.html'],
                    ['title' => 'Button', 'route_name' => 'mazer.component-button.html'],
                    ['title' => 'Card', 'route_name' => 'mazer.component-card.html'],
                    ['title' => 'Carousel', 'route_name' => 'mazer.component-carousel.html'],
                    ['title' => 'Collapse', 'route_name' => 'mazer.component-collapse.html'],
                    ['title' => 'Dropdown', 'route_name' => 'mazer.component-dropdown.html'],
                    ['title' => 'List Group', 'route_name' => 'mazer.component-list-group.html'],
                    ['title' => 'Modal', 'route_name' => 'mazer.component-modal.html'],
                    ['title' => 'Navs', 'route_name' => 'mazer.component-navs.html'],
                    ['title' => 'Pagination', 'route_name' => 'mazer.component-pagination.html'],
                    ['title' => 'Progress', 'route_name' => 'mazer.component-progress.html'],
                    ['title' => 'Spinner', 'route_name' => 'mazer.component-spinner.html'],
                    ['title' => 'Toasts', 'route_name' => 'mazer.component-toasts.html'],
                    ['title' => 'Tooltip', 'route_name' => 'mazer.component-tooltip.html'],
                ],
            ],
            [
                'title' => 'Extra Components',
                'icon' => 'bi bi-collection-fill',
                'route_pattern' => 'mazer.extra-component-*.html',
                'children' => [
                    ['title' => 'Avatar', 'route_name' => 'mazer.extra-component-avatar.html'],
                    ['title' => 'Divider', 'route_name' => 'mazer.extra-component-divider.html'],
                    ['title' => 'Date Picker', 'route_name' => 'mazer.extra-component-date-picker.html'],
                    ['title' => 'Sweet Alert', 'route_name' => 'mazer.extra-component-sweetalert.html'],
                    ['title' => 'Toastify', 'route_name' => 'mazer.extra-component-toastify.html'],
                    ['title' => 'Rating', 'route_name' => 'mazer.extra-component-rating.html'],
                ],
            ],
            [
                'title' => 'Layouts',
                'icon' => 'bi bi-grid-1x2-fill',
                'route_pattern' => 'mazer.layout-*.html',
                'children' => [
                    ['title' => 'Default Layout', 'route_name' => 'mazer.layout-default.html'],
                    ['title' => '1 Column', 'route_name' => 'mazer.layout-vertical-1-column.html'],
                    ['title' => 'Vertical Navbar', 'route_name' => 'mazer.layout-vertical-navbar.html'],
                    ['title' => 'RTL Layout', 'route_name' => 'mazer.layout-rtl.html'],
                    ['title' => 'Horizontal Menu', 'route_name' => 'mazer.layout-horizontal.html'],
                ],
            ],
            ['type' => Menu::TypeTitle, 'title' => 'Forms & Tables'],
            [
                'title' => 'Form Elements',
                'icon' => 'bi bi-hexagon-fill',
                'route_pattern' => 'mazer.form-element-*.html',
                'children' => [
                    ['title' => 'Input', 'route_name' => 'mazer.form-element-input.html'],
                    ['title' => 'Input Group', 'route_name' => 'mazer.form-element-input-group.html'],
                    ['title' => 'Select', 'route_name' => 'mazer.form-element-select.html'],
                    ['title' => 'Radio', 'route_name' => 'mazer.form-element-radio.html'],
                    ['title' => 'Checkbox', 'route_name' => 'mazer.form-element-checkbox.html'],
                    ['title' => 'Textarea', 'route_name' => 'mazer.form-element-textarea.html'],
                ],
            ],
            [
                'title' => 'Form Layout',
                'icon' => 'bi bi-file-earmark-medical-fill',
                'route_name' => 'mazer.form-layout.html',
            ],
            [
                'title' => 'Form Validation',
                'icon' => 'bi bi-journal-check',
                'route_pattern' => 'mazer.form-validation-parsley.html',
                'children' => [
                    ['title' => 'Parsley', 'route_name' => 'mazer.form-validation-parsley.html'],
                ],
            ],
            [
                'title' => 'Form Editor',
                'icon' => 'bi bi-pen-fill',
                'route_pattern' => 'mazer.form-editor-*.html',
                'children' => [
                    ['title' => 'Quill', 'route_name' => 'mazer.form-editor-quill.html'],
                    ['title' => 'CKEditor', 'route_name' => 'mazer.form-editor-ckeditor.html'],
                    ['title' => 'Summernote', 'route_name' => 'mazer.form-editor-summernote.html'],
                    ['title' => 'TinyMCE', 'route_name' => 'mazer.form-editor-tinymce.html'],
                ],
            ],
            [
                'title' => 'Table',
                'icon' => 'bi bi-grid-1x2-fill',
                'route_name' => 'mazer.table.html',
            ],
            [
                'title' => 'Datatables',
                'icon' => 'bi bi-file-earmark-spreadsheet-fill',
                'route_pattern' => 'mazer.table-datatable*.html',
                'children' => [
                    ['title' => 'Datatable', 'route_name' => 'mazer.table-datatable.html'],
                    ['title' => 'Datatable (jQuery)', 'route_name' => 'mazer.table-datatable-jquery.html'],
                ],
            ],
            ['type' => Menu::TypeTitle, 'title' => 'Extra UI'],
            [
                'title' => 'Widgets',
                'icon' => 'bi bi-pentagon-fill',
                'route_pattern' => 'mazer.ui-widgets-*.html',
                'children' => [
                    ['title' => 'Chatbox', 'route_name' => 'mazer.ui-widgets-chatbox.html'],
                    ['title' => 'Pricing', 'route_name' => 'mazer.ui-widgets-pricing.html'],
                    ['title' => 'To-do List', 'route_name' => 'mazer.ui-widgets-todolist.html'],
                ],
            ],
            [
                'title' => 'Icons',
                'icon' => 'bi bi-egg-fill',
                'route_pattern' => 'mazer.ui-icons-*.html',
                'children' => [
                    ['title' => 'Bootstrap Icons', 'route_name' => 'mazer.ui-icons-bootstrap-icons.html'],
                    ['title' => 'Fontawesome', 'route_name' => 'mazer.ui-icons-fontawesome.html'],
                    ['title' => 'Dripicons', 'route_name' => 'mazer.ui-icons-dripicons.html'],
                ],
            ],
            [
                'title' => 'Charts',
                'icon' => 'bi bi-bar-chart-fill',
                'route_pattern' => 'mazer.ui-chart-*.html',
                'children' => [
                    ['title' => 'ChartJS', 'route_name' => 'mazer.ui-chart-chartjs.html'],
                    ['title' => 'Apexcharts', 'route_name' => 'mazer.ui-chart-apexcharts.html'],
                ],
            ],
            [
                'title' => 'File Uploader',
                'icon' => 'bi bi-cloud-arrow-up-fill',
                'route_name' => 'mazer.ui-file-uploader.html',
            ],
            [
                'title' => 'Maps',
                'icon' => 'bi bi-map-fill',
                'route_pattern' => 'mazer.ui-map-*.html',
                'children' => [
                    ['title' => 'Google Map', 'route_name' => 'mazer.ui-map-google-map.html'],
                    ['title' => 'JS Vector Map', 'route_name' => 'mazer.ui-map-jsvectormap.html'],
                ],
            ],
            [
                'title' => 'Multi-level Menu',
                'icon' => 'bi bi-three-dots',
                'route_pattern' => 'mazer.ui-multi-level-menu.html',
                'children' => [
                    [
                        'title' => 'First Level',
                        'route_pattern' => 'mazer.ui-multi-level-menu.html',
                        'children' => [
                            ['title' => 'Second Level', 'route_name' => 'mazer.ui-multi-level-menu.html'],
                            ['title' => 'Second Level Menu', 'url' => '#'],
                        ],
                    ],
                    [
                        'title' => 'Another Menu',
                        'children' => [
                            ['title' => 'Second Level Menu', 'url' => '#'],
                        ],
                    ],
                ],
            ],
            ['type' => Menu::TypeTitle, 'title' => 'Pages'],
            [
                'title' => 'Email Application',
                'icon' => 'bi bi-envelope-fill',
                'route_name' => 'mazer.application-email.html',
            ],
            [
                'title' => 'Chat Application',
                'icon' => 'bi bi-chat-dots-fill',
                'route_name' => 'mazer.application-chat.html',
            ],
            [
                'title' => 'Photo Gallery',
                'icon' => 'bi bi-image-fill',
                'route_name' => 'mazer.application-gallery.html',
            ],
            [
                'title' => 'Checkout Page',
                'icon' => 'bi bi-basket-fill',
                'route_name' => 'mazer.application-checkout.html',
            ],
            [
                'title' => 'Authentication',
                'icon' => 'bi bi-person-badge-fill',
                'route_pattern' => 'mazer.auth-*.html',
                'children' => [
                    ['title' => 'Login', 'route_name' => 'mazer.auth-login.html'],
                    ['title' => 'Register', 'route_name' => 'mazer.auth-register.html'],
                    ['title' => 'Forgot Password', 'route_name' => 'mazer.auth-forgot-password.html'],
                ],
            ],
            [
                'title' => 'Errors',
                'icon' => 'bi bi-x-octagon-fill',
                'route_pattern' => 'mazer.error-*.html',
                'children' => [
                    ['title' => '403', 'route_name' => 'mazer.error-403.html'],
                    ['title' => '404', 'route_name' => 'mazer.error-404.html'],
                    ['title' => '500', 'route_name' => 'mazer.error-500.html'],
                ],
            ],
            ['type' => Menu::TypeTitle, 'title' => 'Raise Support'],
            [
                'title' => 'Documentation',
                'icon' => 'bi bi-life-preserver',
                'url' => 'https://zuramai.github.io/mazer/docs',
            ],
            [
                'title' => 'Contribute',
                'icon' => 'bi bi-puzzle',
                'url' => 'https://github.com/zuramai/mazer/blob/main/CONTRIBUTING.md',
            ],
            [
                'title' => 'Donate',
                'icon' => 'bi bi-cash',
                'url' => 'https://github.com/zuramai/mazer#donation',
            ],
        ];

        $this->seedTree($items);
    }

    /**
     * Recursively create menu items.
     *
     * @param  array<int, array<string, mixed>>  $items
     */
    private function seedTree(array $items, ?int $parentId = null): void
    {
        foreach (array_values($items) as $index => $item) {
            $children = $item['children'] ?? [];
            unset($item['children']);

            $menu = Menu::query()->create([
                'parent_id' => $parentId,
                'type' => $item['type'] ?? Menu::TypeItem,
                'title' => $item['title'],
                'icon' => $item['icon'] ?? null,
                'route_name' => $item['route_name'] ?? null,
                'url' => $item['url'] ?? null,
                'route_pattern' => $item['route_pattern'] ?? null,
                'order' => $index + 1,
                'is_active' => $item['is_active'] ?? true,
            ]);

            if ($children !== []) {
                $this->seedTree($children, $menu->id);
            }
        }
    }
}
