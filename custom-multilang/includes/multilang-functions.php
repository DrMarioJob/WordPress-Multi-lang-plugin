<?php

function load_language_file($lang) {
    $file_path = plugin_dir_path(__FILE__) . '../languages/' . $lang . '.php';
    if (file_exists($file_path)) {
        return include $file_path;
    }
    // Файл языка по умолчанию
    return include plugin_dir_path(__FILE__) . '../languages/ua.php';
}

function set_language() {
    if (isset($_GET['lang'])) {
        $lang = sanitize_text_field($_GET['lang']);
        setcookie('site_language', $lang, time() + (3600 * 24 * 30), '/');
    } elseif (isset($_COOKIE['site_language'])) {
        $lang = sanitize_text_field($_COOKIE['site_language']);
    } else {
        $lang = 'ua'; // Язык по умолчанию
    }
    return $lang;
}

add_action('init', function () {
    global $current_language, $lang_texts;
    $current_language = set_language();
    $lang_texts = load_language_file($current_language);
});

function __t($key) {
    global $lang_texts;
    return isset($lang_texts[$key]) ? $lang_texts[$key] : $key;
}

add_shortcode('translate', function ($atts) {
    $atts = shortcode_atts(['key' => ''], $atts);
    return __t($atts['key']);
});

function display_language_switcher() {
    echo '<div class="navLang">';
    echo '<a href="?lang=ua"><img src="https://flagicons.lipis.dev/flags/4x3/ua.svg" width="30"></a>';
    echo '<a href="?lang=en"><img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" width="30"></a>';
    echo '<a href="?lang=cn"><img src="https://flagicons.lipis.dev/flags/4x3/cn.svg" width="30"></a>';
    echo '</div>';
}
add_shortcode('language_switcher', 'display_language_switcher');
