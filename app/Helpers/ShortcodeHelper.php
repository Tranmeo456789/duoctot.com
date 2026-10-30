<?php

namespace App\Helpers;
class ShortcodeHelper
{
    public static function parse($content)
    {
        if (!is_string($content) || $content === '') {
            return $content;
        }
        return preg_replace_callback(
            '/\[shortcode_(\d+)\]/',
            function ($matches) {
                $viewName = 'shop.shortcodes.shortcode_' . $matches[1];
                // Kiểm tra file Blade có tồn tại không
                if (!view()->exists($viewName)) {
                    return $matches[0];
                }
                // Hiển thị nội dung shortcode
                return view($viewName)->render();
            },
            $content
        );
    }
}
