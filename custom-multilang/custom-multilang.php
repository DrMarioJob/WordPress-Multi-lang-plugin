<?php
/*
Plugin Name: Custom Multilang
Description: Плагін для багатомовності з використанням PHP-файлів для вибірки тексту. Шорткод для відображення списку мов [language_switcher]. В шаблонах вибираємо текст ось так <strong>echo __t('welcome');</strong>. Файли з перекладами ось тут <strong>plugins\custom-multilang\languages</strong>
Version: 1.0
Author: VintageCoder
Author URI: https://t.me/VintageCoder
*/

// Предотвращаем прямой доступ
if (!defined('ABSPATH')) {
    exit;
}

// Подключаем языковые функции
include_once plugin_dir_path(__FILE__) . 'includes/multilang-functions.php';

// Подключаем файл стилей
function custom_multilang_enqueue_styles() {
    wp_enqueue_style(
        'custom-multilang-styles', // Уникальное имя
        plugin_dir_url(__FILE__) . 'assets/styles-multilang.css', // Путь к файлу стилей
        [], // Зависимости
        '1.0', // Версия
        'all' // Для всех типов устройств
    );
}
add_action('wp_enqueue_scripts', 'custom_multilang_enqueue_styles');