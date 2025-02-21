<?php
/*
Plugin Name: Quick Call Button
Description: Hiển thị nút gọi nhanh qua Messenger hoặc Zalo trên trang web với tùy chọn bật/tắt từng kênh chat.
Version: 1.0
Author: Nguyen Tien Thanh
*/

if (!defined('ABSPATH')) {
    exit; // Ngăn truy cập trực tiếp
}

// Hàm hiển thị nút gọi nhanh
function qcb_display_call_button() {
    $phone = get_option('qcb_phone', '0326484073'); // Số điện thoại Zalo
    $messenger_link = get_option('qcb_messenger_link', 'https://m.me/NguyenTienThanh.Ha'); // Liên kết Messenger
    $label = get_option('qcb_label', 'Gọi ngay');   // Nội dung nút
    $bg_color_messenger = '#0084ff'; // Màu nền Messenger
    $bg_color_zalo = '#00a1ff'; // Màu nền Zalo
    $text_color = get_option('qcb_text_color', '#ffffff'); // Màu chữ
    $show_messenger = get_option('qcb_show_messenger', '1'); // Bật/Tắt Messenger
    $show_zalo = get_option('qcb_show_zalo', '1'); // Bật/Tắt Zalo

    $html = '<div class="quick-call-button" style="position: fixed; bottom: 20px; right: 20px; display: flex; flex-direction: column; gap: 10px; z-index: 1000;">';

    // Nút Messenger
    if ($show_messenger === '1') {
        $html .= '<a href="' . esc_url($messenger_link) . '" class="quick-call-link" style="background-color: ' . esc_attr($bg_color_messenger) . '; color: ' . esc_attr($text_color) . '; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px; display: inline-flex; align-items: center; gap: 10px;">';
        $html .= '<i class="fab fa-facebook-messenger"></i>'; // Icon Messenger
        $html .= esc_html($label) . ' qua Messenger';
        $html .= '</a>';
    }

    // Nút Zalo
    if ($show_zalo === '1') {
        $html .= '<a href="https://zalo.me/' . esc_attr($phone) . '" class="quick-call-link" style="background-color: ' . esc_attr($bg_color_zalo) . '; color: ' . esc_attr($text_color) . '; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px; display: inline-flex; align-items: center; gap: 10px;">';
        $html .= '<img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" alt="Zalo" style="width: 20px; height: 20px;">'; // Biểu tượng Zalo
        $html .= esc_html($label) . ' qua Zalo';
        $html .= '</a>';
    }

    $html .= '</div>';

    echo $html; // Hiển thị nút
}

// Thêm nút gọi vào footer
add_action('wp_footer', 'qcb_display_call_button');

// Đăng ký Font Awesome
add_action('wp_enqueue_scripts', 'qcb_enqueue_font_awesome');
function qcb_enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}

// Thêm menu cài đặt vào WordPress Admin
add_action('admin_menu', 'qcb_add_settings_menu');
function qcb_add_settings_menu() {
    add_menu_page(
        'Quick Call Settings',        // Tiêu đề trang
        'Quick Call',                 // Tên menu
        'manage_options',             // Quyền truy cập
        'quick-call-settings',        // Slug trang
        'qcb_settings_page',          // Hàm hiển thị nội dung
        'dashicons-phone',            // Icon menu
        100                           // Vị trí menu
    );
}

// Hàm hiển thị nội dung trang cài đặt
function qcb_settings_page() {
    ?>
    <div class="wrap">
        <h1>Cài đặt Nút Gọi Nhanh</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('qcb_settings_group');
            do_settings_sections('quick-call-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Đăng ký cài đặt
add_action('admin_init', 'qcb_register_settings');
function qcb_register_settings() {
    register_setting('qcb_settings_group', 'qcb_phone');
    register_setting('qcb_settings_group', 'qcb_label');
    register_setting('qcb_settings_group', 'qcb_bg_color');
    register_setting('qcb_settings_group', 'qcb_text_color');
    register_setting('qcb_settings_group', 'qcb_messenger_link');
    register_setting('qcb_settings_group', 'qcb_show_messenger');
    register_setting('qcb_settings_group', 'qcb_show_zalo');

    add_settings_section(
        'qcb_settings_section',
        'Cấu hình Nút Gọi',
        'qcb_settings_section_callback',
        'quick-call-settings'
    );

    add_settings_field(
        'qcb_phone',
        'Số điện thoại Zalo',
        'qcb_phone_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );

    add_settings_field(
        'qcb_label',
        'Nội dung nút',
        'qcb_label_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );

    add_settings_field(
        'qcb_bg_color',
        'Màu nền',
        'qcb_bg_color_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );

    add_settings_field(
        'qcb_text_color',
        'Màu chữ',
        'qcb_text_color_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );

    add_settings_field(
        'qcb_messenger_link',
        'Liên kết Messenger',
        'qcb_messenger_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );

    add_settings_field(
        'qcb_show_messenger',
        'Hiện nút Messenger',
        'qcb_show_messenger_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );

    add_settings_field(
        'qcb_show_zalo',
        'Hiện nút Zalo',
        'qcb_show_zalo_callback',
        'quick-call-settings',
        'qcb_settings_section'
    );
}

// Callback cho phần cài đặt
function qcb_settings_section_callback() {
    echo '<p>Cấu hình các tùy chọn cho nút gọi nhanh.</p>';
}

// Callback cho các trường cài đặt
function qcb_phone_callback() {
    $value = get_option('qcb_phone', '0123456789');
    echo '<input type="text" name="qcb_phone" value="' . esc_attr($value) . '" class="regular-text">';
}

function qcb_label_callback() {
    $value = get_option('qcb_label', 'Gọi ngay');
    echo '<input type="text" name="qcb_label" value="' . esc_attr($value) . '" class="regular-text">';
}

function qcb_bg_color_callback() {
    $value = get_option('qcb_bg_color', '#28a745');
    echo '<input type="color" name="qcb_bg_color" value="' . esc_attr($value) . '">';
}

function qcb_text_color_callback() {
    $value = get_option('qcb_text_color', '#ffffff');
    echo '<input type="color" name="qcb_text_color" value="' . esc_attr($value) . '">';
}

function qcb_messenger_callback() {
    $value = get_option('qcb_messenger_link', 'https://m.me/your_messenger_link');
    echo '<input type="text" name="qcb_messenger_link" value="' . esc_attr($value) . '" class="regular-text">';
}

function qcb_show_messenger_callback() {
    $checked = get_option('qcb_show_messenger', '1') === '1' ? 'checked' : '';
    echo '<input type="checkbox" name="qcb_show_messenger" value="1" ' . $checked . '> Hiện nút Messenger';
}

function qcb_show_zalo_callback() {
    $checked = get_option('qcb_show_zalo', '1') === '1' ? 'checked' : '';
    echo '<input type="checkbox" name="qcb_show_zalo" value="1" ' . $checked . '> Hiện nút Zalo';
}