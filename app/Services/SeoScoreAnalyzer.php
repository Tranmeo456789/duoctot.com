<?php

namespace App\Services;

/**
 * SEO Score Analyzer - chấm điểm SEO on-page theo kiểu Yoast SEO / Rank Math.
 *
 *  - Tiêu đề (name)                15đ
 *  - Mô tả (meta_description)      15đ
 *  - Slug/URL                      10đ
 *  - Tiêu đề mục H2/H3 đầu tiên    15đ
 *  - Độ dài nội dung               10đ
 *  - Mật độ từ khóa                15đ
 *  - Hình ảnh (ALT/tên file)       10đ
 *  - Link trong nội dung           10đ
 *  ------------------------------------
 *  Tổng                           100đ
 */
class SeoScoreAnalyzer
{
    protected $keyword;
    protected $title;
    protected $metaDescription;
    protected $slug;
    protected $contentHtml;
    protected $currentHost;

    protected $checks = array();
    protected $score = 0;

    protected static $maxScores = array(
        'title'            => 15,
        'meta_description' => 15,
        'slug'             => 10,
        'heading'          => 15,
        'content_length'   => 10,
        'keyword_density'  => 15,
        'images'           => 10,
        'internal_links'   => 10,
    );

    protected $altImage;
    protected $titleImage;

    public function __construct($keyword, $title, $metaDescription, $slug, $contentHtml, $currentHost = null, $altImage = '', $titleImage = '')
    {
        $this->keyword = trim($keyword);
        $this->title = trim($title);
        $this->metaDescription = trim($metaDescription);
        $this->slug = trim($slug);
        $this->contentHtml = $contentHtml !== null ? $contentHtml : '';
        $this->currentHost = $currentHost;
        $this->altImage = trim($altImage);
        $this->titleImage = trim($titleImage);
    }

    public function analyze()
    {
        $this->checks = array();
        $this->score = 0;

        $this->checkTitle();
        $this->checkMetaDescription();
        $this->checkSlug();
        $this->checkHeading();
        $this->checkContentLength();
        $this->checkKeywordDensity();
        $this->checkImages();
        $this->checkInternalLinks();

        return array(
            'score'     => $this->score,
            'max_score' => array_sum(self::$maxScores),
            'grade'     => $this->grade($this->score),
            'checks'    => $this->checks,
        );
    }

    protected function grade($score)
    {
        if ($score >= 80) {
            return array('label' => 'Tốt', 'color' => 'green');
        }
        if ($score >= 50) {
            return array('label' => 'Trung bình', 'color' => 'orange');
        }
        return array('label' => 'Kém', 'color' => 'red');
    }

    protected function addCheck($key, $label, $status, $message, $score)
    {
        $score = max(0, min($score, self::$maxScores[$key]));
        $this->checks[] = array(
            'key'       => $key,
            'label'     => $label,
            'status'    => $status, // good | warning | bad
            'message'   => $message,
            'score'     => $score,
            'max_score' => self::$maxScores[$key],
        );
        $this->score += $score;
    }

    protected function containsKeyword($text)
    {
        if ($this->keyword === '') {
            return false;
        }
        return mb_stripos($text, $this->keyword) !== false;
    }

    protected function stripHtml($html)
    {
        $text = preg_replace('/<(script|style)\b[^>]*>.*?<\/\1>/is', ' ', $html);
        if ($text === null) $text = $html;
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        $clean = preg_replace('/\s+/u', ' ', $text);
        if ($clean !== null) $text = $clean;
        return trim($text);
    }

    protected function wordCount($text)
    {
        $text = trim($text);
        if ($text === '') {
            return 0;
        }
        return count(preg_split('/\s+/u', $text));
    }

    /** Bỏ dấu tiếng Việt, dùng để kiểm tra slug / tên file ảnh */
    public static function removeAccents($str)
    {
        $str = mb_strtolower($str, 'UTF-8');
        $accents = array(
            'à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă','ằ','ắ','ặ','ẳ','ẵ',
            'è','é','ẹ','ẻ','ẽ','ê','ề','ế','ệ','ể','ễ',
            'ì','í','ị','ỉ','ĩ',
            'ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ','ờ','ớ','ợ','ở','ỡ',
            'ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ',
            'ỳ','ý','ỵ','ỷ','ỹ','đ',
        );
        $noAccents = array(
            'a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
            'e','e','e','e','e','e','e','e','e','e','e',
            'i','i','i','i','i',
            'o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o',
            'u','u','u','u','u','u','u','u','u','u','u',
            'y','y','y','y','y','d',
        );
        return str_replace($accents, $noAccents, $str);
    }

    public static function slugify($str)
    {
        $str = self::removeAccents($str);
        $clean = preg_replace('/[^a-z0-9\s-]/', '', $str);
        if ($clean !== null) $str = $clean;
        $clean = preg_replace('/[\s-]+/', '-', trim($str));
        if ($clean !== null) $str = $clean;
        return trim($str, '-');
    }

    protected function checkTitle()
    {
        $len = mb_strlen($this->title);
        if ($this->title === '') {
            $this->addCheck('title', 'Tiêu đề tên thuốc', 'bad', 'Chưa nhập tiêu đề.', 0);
            return;
        }
        $hasKeyword = $this->containsKeyword($this->title);
        if ($len > 60) {
            $this->addCheck('title', 'Tiêu đề tên thuốc', 'warning', "Tiêu đề dài {$len} ký tự, nên rút gọn dưới 60 ký tự.", $hasKeyword ? 8 : 4);
        } elseif ($len < 30) {
            $this->addCheck('title', 'Tiêu đề tên thuốc', 'warning', "Tiêu đề hơi ngắn ({$len} ký tự), nên viết 30-60 ký tự.", $hasKeyword ? 10 : 5);
        } elseif (!$hasKeyword) {
            $this->addCheck('title', 'Tiêu đề tên thuốc', 'warning', 'Độ dài tốt nhưng thiếu từ khóa chính (tên ngắn gọn thuốc).', 6);
        } else {
            $this->addCheck('title', 'Tiêu đề tên thuốc', 'good', "Độ dài {$len} ký tự và có chứa từ khóa chính.", 15);
        }
    }

    protected function checkMetaDescription()
    {
        $len = mb_strlen($this->metaDescription);
        if ($this->metaDescription === '') {
            $this->addCheck('meta_description', 'Mô tả (Meta Description)', 'bad', 'Chưa nhập mô tả.', 0);
            return;
        }
        $hasKeyword = $this->containsKeyword($this->metaDescription);
        if ($len > 155) {
            $this->addCheck('meta_description', 'Mô tả (Meta Description)', 'warning', "Mô tả dài {$len} ký tự, nên rút gọn dưới 155 ký tự.", $hasKeyword ? 8 : 4);
        } elseif ($len < 120) {
            $this->addCheck('meta_description', 'Mô tả (Meta Description)', 'warning', "Mô tả hơi ngắn ({$len} ký tự), nên viết 120-155 ký tự.", $hasKeyword ? 10 : 5);
        } elseif (!$hasKeyword) {
            $this->addCheck('meta_description', 'Mô tả (Meta Description)', 'warning', 'Độ dài tốt nhưng thiếu từ khóa chính.', 6);
        } else {
            $this->addCheck('meta_description', 'Mô tả (Meta Description)', 'good', "Độ dài {$len} ký tự và có chứa từ khóa chính.", 15);
        }
    }

    protected function checkSlug()
    {
        if ($this->slug === '') {
            $this->addCheck('slug', 'Đường dẫn (Slug/URL)', 'bad', 'Chưa nhập slug.', 0);
            return;
        }
        $len = mb_strlen($this->slug);
        $isCleanFormat = (bool) preg_match('/^[a-z0-9]+(-[a-z0-9]+)*$/', $this->slug);
        $keywordSlug = $this->keyword !== '' ? self::slugify($this->keyword) : '';
        $hasKeyword = $keywordSlug !== '' && strpos($this->slug, $keywordSlug) !== false;
        $issues = array();
        if (!$isCleanFormat) {
            $issues[] = 'còn dấu/khoảng trắng/ký tự lạ, chỉ nên dùng chữ thường không dấu và gạch ngang';
        }
        if ($len > 75) {
            $issues[] = "dài {$len} ký tự, nên dưới 75 ký tự";
        }
        if (!$hasKeyword) {
            $issues[] = 'thiếu từ khóa chính';
        }
        if (empty($issues)) {
            $this->addCheck('slug', 'Đường dẫn (Slug/URL)', 'good', 'Slug đúng chuẩn, có chứa từ khóa và độ dài hợp lý.', 10);
        } else {
            $score = 10 - (count($issues) * 3);
            $this->addCheck(
                'slug',
                'Đường dẫn (Slug/URL)',
                count($issues) >= 2 ? 'bad' : 'warning',
                'Slug ' . implode('; ', $issues) . '.',
                max($score, 0)
            );
        }
    }

    // protected function checkHeading()
    // {
    //     preg_match_all('/<h([23])[^>]*>(.*?)<\/h\1>/is', $this->contentHtml, $m, PREG_SET_ORDER);
    //     if (empty($m)) {
    //         $this->addCheck('heading', 'Tiêu đề mục (H2/H3) đầu tiên', 'warning', 'Chưa có thẻ H2/H3 nào trong nội dung (VD: "3.1 Liều dùng").', 0);
    //         return;
    //     }
    //     $firstHeadingText = trim(strip_tags($m[0][2]));
    //     if ($this->containsKeyword($firstHeadingText)) {
    //         $this->addCheck('heading', 'Tiêu đề mục (H2/H3) đầu tiên', 'good', 'Tiêu đề mục đầu tiên có chứa từ khóa chính.', 15);
    //     } else {
    //         $this->addCheck('heading', 'Tiêu đề mục (H2/H3) đầu tiên', 'warning', 'Tiêu đề mục đầu tiên chưa chứa từ khóa chính.', 6);
    //     }
    // }

    protected function checkHeading()
    {
        if ($this->keyword === '') {
            $this->addCheck('heading', 'Tiêu đề mục (Công dụng/Thành phần)', 'bad', 'Chưa nhập từ khóa chính để kiểm tra.', 0);
            return;
        }
        $this->addCheck('heading', 'Tiêu đề mục (Công dụng/Thành phần)', 'good', 'Đã có từ khóa chính, mặc định các tiêu đề mục (H2/H3) đầu bài đạt chuẩn.', 15);
    }
    protected function checkContentLength()
    {
        $text = $this->stripHtml($this->contentHtml);
        $words = $this->wordCount($text);

        if ($words >= 1000 && $words <= 2000) {
            $this->addCheck('content_length', 'Độ dài nội dung', 'good', "Nội dung có {$words} từ, nằm trong khoảng 1.000-2.000 từ.", 10);
        } elseif (($words >= 700 && $words < 1000) || ($words > 2000 && $words <= 2500)) {
            $this->addCheck('content_length', 'Độ dài nội dung', 'warning', "Nội dung có {$words} từ, gần đạt khoảng khuyến nghị 1.000-2.000 từ.", 6);
        } else {
            $this->addCheck('content_length', 'Độ dài nội dung', 'bad', "Nội dung có {$words} từ, nên viết trong khoảng 1.000-2.000 từ.", $words > 0 ? 2 : 0);
        }
    }

    protected function checkKeywordDensity()
    {
        if ($this->keyword === '') {
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'bad', 'Chưa có từ khóa chính (name_short) để kiểm tra.', 0);
            return;
        }
        $text = $this->stripHtml($this->contentHtml);
        $totalWords = $this->wordCount($text);
        if ($totalWords === 0) {
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'bad', 'Chưa có nội dung.', 0);
            return;
        }
        $keywordWordCount = count(preg_split('/\s+/u', trim($this->keyword)));
        $pattern = '/' . preg_quote($this->keyword, '/') . '/iu';
        $occurrences = preg_match_all($pattern, $text);
        $density = ($occurrences * $keywordWordCount / $totalWords) * 100;
        $densityRounded = round($density, 2);
        if ($density >= 1 && $density <= 2) {
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'good', "Từ khóa xuất hiện {$occurrences} lần, mật độ {$densityRounded}% (đạt 1-2%).", 15);
        } elseif ($density > 0 && $density < 1) {
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'warning', "Mật độ {$densityRounded}%, hơi thấp, nên tăng nhẹ (mục tiêu 1-2%).", 8);
        } elseif ($density > 2 && $density <= 3.5) {
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'warning', "Mật độ {$densityRounded}%, hơi cao, tránh nhồi nhét từ khóa (mục tiêu 1-2%).", 8);
        } else {
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'bad', "Mật độ {$densityRounded}%, quá thấp hoặc quá cao so với mục tiêu 1-2%.", 2);
        }
    }

    protected function checkImages()
    {
        preg_match_all('/<img\b[^>]*>/i', $this->contentHtml, $m);
        $imgTags = isset($m[0]) ? $m[0] : array();

        // Gộp cả ảnh đại diện (nếu có nhập ALT/title) vào danh sách kiểm tra chung
        $images = array();
        foreach ($imgTags as $tag) {
            preg_match('/alt=["\']([^"\']*)["\']/i', $tag, $altM);
            preg_match('/title=["\']([^"\']*)["\']/i', $tag, $titleM);
            preg_match('/src=["\']([^"\']*)["\']/i', $tag, $srcM);
            $images[] = array(
                'alt'   => isset($altM[1]) ? $altM[1] : '',
                'title' => isset($titleM[1]) ? $titleM[1] : '',
                'src'   => isset($srcM[1]) ? $srcM[1] : '',
                'is_featured' => false,
            );
        }
        if ($this->altImage !== '' || $this->titleImage !== '') {
            $images[] = array(
                'alt'   => $this->altImage,
                'title' => $this->titleImage,
                'src'   => '', // không kiểm tra tên file cho ảnh đại diện, chỉ có input ALT/title
                'is_featured' => true,
            );
        }

        if (empty($images)) {
            $this->addCheck('images', 'Hình ảnh (ALT/Title)', 'good', 'Chưa có hình ảnh nào (không bắt buộc).', 10);
            return;
        }

        $goodCount = 0;
        $badLabels = array();
        foreach ($images as $img) {
            $altOk = $img['alt'] !== '' && $this->containsKeyword($img['alt']);
            $titleOk = $img['title'] !== '' && $this->containsKeyword($img['title']);

            $fileOk = true;
            if ($img['src'] !== '') {
                $path = parse_url($img['src'], PHP_URL_PATH);
                $fileName = basename($path ? $path : $img['src']);
                $fileNameOnly = $fileName !== '' ? pathinfo($fileName, PATHINFO_FILENAME) : '';
                $fileOk = $fileNameOnly === '' || (!preg_match('/\s/', $fileNameOnly) && self::removeAccents($fileNameOnly) === mb_strtolower($fileNameOnly, 'UTF-8'));
            }

            if ($altOk && $titleOk && $fileOk) {
                $goodCount++;
            } else {
                $badLabels[] = $img['is_featured'] ? 'ảnh đại diện' : 'ảnh trong nội dung';
            }
        }

        $total = count($images);
        $ratio = $goodCount / $total;

        if ($ratio == 1) {
            $this->addCheck('images', 'Hình ảnh (ALT/Title)', 'good', "Tất cả {$total} ảnh đều có ALT + title chứa từ khóa và tên file chuẩn không dấu.", 10);
        } elseif ($ratio >= 0.5) {
            $this->addCheck('images', 'Hình ảnh (ALT/Title)', 'warning', "{$goodCount}/{$total} ảnh đạt chuẩn, cần chú ý " . implode(', ', array_unique($badLabels)) . " còn thiếu ALT/title/tên file chuẩn.", 6);
        } else {
            $this->addCheck('images', 'Hình ảnh (ALT/Title)', 'bad', "Chỉ {$goodCount}/{$total} ảnh đạt chuẩn, cần chú ý " . implode(', ', array_unique($badLabels)) . " còn thiếu ALT/title/tên file chuẩn.", 2);
        }
    }

    protected function checkInternalLinks()
    {
        preg_match_all('/<a\b[^>]*href=["\']([^"\']+)["\'][^>]*>/i', $this->contentHtml, $m);
        $hrefs = isset($m[1]) ? $m[1] : array();
        $count = 0;
        foreach ($hrefs as $href) {
            if ($href === '' || strpos($href, '#') === 0 || strpos($href, 'javascript:') === 0 || strpos($href, 'mailto:') === 0) {
                continue;
            }
            $count++;
        }
        if ($count >= 3) {
            $this->addCheck('internal_links', 'Liên kết trong nội dung', 'good', "Có {$count} link, đạt khuyến nghị ít nhất 3-5 link.", 10);
        } elseif ($count > 0) {
            $this->addCheck('internal_links', 'Liên kết trong nội dung', 'warning', "Chỉ có {$count} link, nên thêm để đạt ít nhất 3-5 link.", 4);
        } else {
            $this->addCheck('internal_links', 'Liên kết trong nội dung', 'bad', 'Chưa có link nào trong nội dung.', 0);
        }
    }
}