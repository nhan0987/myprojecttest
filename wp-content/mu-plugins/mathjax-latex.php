<?php
/**
 * Plugin Name: MathJax LaTeX Support (STND)
 * Description: Hiển thị công thức Toán học LaTeX trên frontend, backend và hỗ trợ render động trong Elementor.
 * Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function stnd_enqueue_mathjax_script() {
    ?>
    <script>
        window.MathJax = {
          tex: {
            inlineMath: [['$', '$'], ['\\(', '\\)']],
            displayMath: [['$$', '$$'], ['\\[', '\\]']],
            processEscapes: true,
            processEnvironments: true
          },
          options: {
            skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre'],
            enableMenu: false
          }
        };
    </script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <?php
}

// 1. Chèn vào Frontend (Giao diện người dùng)
add_action( 'wp_head', 'stnd_enqueue_mathjax_script', 100 );

// 2. Chèn vào Backend Admin (Cho Classic Editor và các chỗ khác trong wp-admin)
add_action( 'admin_head', 'stnd_enqueue_mathjax_script', 100 );

// 3. Xử lý render động (live preview) khi gõ trong Elementor Editor
add_action( 'elementor/frontend/after_enqueue_scripts', function() {
    ?>
    <script>
    jQuery(window).on('elementor/frontend/init', function() {
        if (typeof elementorFrontend !== 'undefined') {
            // Lắng nghe sự kiện mỗi khi một widget trong Elementor được render/update
            elementorFrontend.hooks.addAction('frontend/element_ready/widget', function($scope) {
                // Gọi MathJax render lại phần tử ($scope) đó
                if (typeof MathJax !== 'undefined' && MathJax.typesetPromise) {
                    MathJax.typesetPromise([$scope[0]]).catch(function (err) {
                        console.log('MathJax error: ', err.message);
                    });
                }
            });
        }
    });
    </script>
    <?php
} );
