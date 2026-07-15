<?php

namespace App\Services;

/**
 * SEO Score Analyzer riêng cho trang Bài viết (tách biệt hoàn toàn với SeoScoreAnalyzer của Sản phẩm).
 *
 *  - Tiêu đề (Meta Title)              10đ
 *  - Mô tả (Meta Description)          10đ
 *  - Slug/URL                           8đ
 *  - Thẻ H1                             6đ
 *  - Thẻ H2 đầu tiên                    6đ
 *  - Phân bổ H2/H3 còn lại               3đ
 *  - Độ dài nội dung (1500-2500 từ)     8đ
 *  - Mật độ từ khóa                    10đ
 *  - Hình ảnh (ALT + title)             8đ
 *  - Internal link                      8đ
 *  - Mở bài                             6đ
 *  - Câu hỏi thường gặp (5 câu)        10đ
 *  - Kết bài                            7đ
 *  ------------------------------------
 *  Tổng                               100đ
 */
class ArticleSeoScoreAnalyzer
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
        'title'               => 10,
        'meta_description'    => 10,
        'slug'                => 8,
        'h1'                  => 6,
        'h2_first'             => 6,
        'heading_distribution' => 3,
        'content_length'       => 8,
        'keyword_density'      => 10,
        'images'                => 8,
        'internal_links'        => 8,
        'opening_paragraph'     => 6,
        'faq'                   => 10,
        'closing_paragraph'     => 7,
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
        $this->checkHeadingStructure();
        $this->checkContentLength();
        $this->checkKeywordDensity();
        $this->checkImages();
        $this->checkInternalLinks();
        $this->checkOpeningParagraph();
        $this->checkFaq();
        $this->checkClosingParagraph();

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
            $this->addCheck('title', 'Tiêu đề bài viết', 'bad', 'Chưa nhập tiêu đề.', 0);
            return;
        }
        $hasKeyword = $this->containsKeyword($this->title);
        if ($len > 60) {
            $this->addCheck('title', 'Tiêu đề bài viết', 'warning', "Tiêu đề dài {$len} ký tự, nên rút gọn dưới 60 ký tự.", $hasKeyword ? 6 : 3);
        } elseif (!$hasKeyword) {
            $this->addCheck('title', 'Tiêu đề bài viết', 'warning', 'Độ dài tốt nhưng thiếu từ khóa chính.', 4);
        } else {
            $this->addCheck('title', 'Tiêu đề bài viết', 'good', "Độ dài {$len} ký tự và có chứa từ khóa chính.", 10);
        }
    }

    protected function checkMetaDescription()
    {
        $len = mb_strlen($this->metaDescription);
        if ($this->metaDescription === '') {
            $this->addCheck('meta_description', 'Mô tả ngắn', 'bad', 'Chưa nhập mô tả.', 0);
            return;
        }
        $hasKeyword = $this->containsKeyword($this->metaDescription);
        if ($len > 155) {
            $this->addCheck('meta_description', 'Mô tả ngắn', 'warning', "Mô tả dài {$len} ký tự, nên rút gọn dưới 155 ký tự.", $hasKeyword ? 6 : 3);
        } elseif (!$hasKeyword) {
            $this->addCheck('meta_description', 'Mô tả ngắn', 'warning', 'Độ dài tốt nhưng thiếu từ khóa chính.', 4);
        } else {
            $this->addCheck('meta_description', 'Mô tả ngắn', 'good', "Độ dài {$len} ký tự và có chứa từ khóa chính.", 10);
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
            $this->addCheck('slug', 'Đường dẫn (Slug/URL)', 'good', 'Slug đúng chuẩn, có chứa từ khóa và độ dài hợp lý.', 8);
        } else {
            $score = 8 - (count($issues) * 3);
            $this->addCheck(
                'slug',
                'Đường dẫn (Slug/URL)',
                count($issues) >= 2 ? 'bad' : 'warning',
                'Slug ' . implode('; ', $issues) . '.',
                max($score, 0)
            );
        }
    }

    /** Lấy toàn bộ thẻ H1/H2/H3 theo đúng thứ tự xuất hiện trong nội dung */
    protected function extractHeadings()
    {
        preg_match_all('/<(h1|h2|h3)\b[^>]*>(.*?)<\/\1>/is', $this->contentHtml, $m, PREG_SET_ORDER);
        $headings = array();
        foreach ($m as $match) {
            $headings[] = array(
                'tag'  => strtolower($match[1]),
                'text' => trim(strip_tags($match[2])),
            );
        }
        return $headings;
    }

    protected function checkHeadingStructure()
    {
        $headings = $this->extractHeadings();
        $h1s = array();
        $h2s = array();
        $h3s = array();
        foreach ($headings as $h) {
            if ($h['tag'] === 'h1') $h1s[] = $h['text'];
            if ($h['tag'] === 'h2') $h2s[] = $h['text'];
            if ($h['tag'] === 'h3') $h3s[] = $h['text'];
        }

        // H1
        if (count($h1s) > 0) {
            $this->addCheck('h1', 'Thẻ H1', 'warning', 'Có ' . count($h1s) . ' thẻ H1, chỉ nên dùng đúng 1 thẻ H1 duy nhất.', 2);
        } else {
            $this->addCheck('h1', 'Thẻ H1', 'good', 'Có đúng 1 thẻ H1 chứa từ khóa chính.', 6);
        }
        // H2 đầu tiên
        if (count($h2s) === 0) {
            $this->addCheck('h2_first', 'Thẻ H2 đầu tiên', 'bad', 'Chưa có thẻ H2 nào trong nội dung.', 0);
        } elseif (!$this->containsKeyword($h2s[0])) {
            $this->addCheck('h2_first', 'Thẻ H2 đầu tiên', 'warning', 'H2 đầu tiên chưa chứa từ khóa chính.', 2);
        } else {
            $this->addCheck('h2_first', 'Thẻ H2 đầu tiên', 'good', 'H2 đầu tiên có chứa từ khóa chính.', 6);
        }

        // Phân bổ H2/H3 còn lại (đủ mục lục là được, không bắt buộc chứa từ khóa)
        $totalOtherHeadings = count($h2s) + count($h3s) - (count($h2s) > 0 ? 1 : 0);
        if ($totalOtherHeadings >= 3) {
            $this->addCheck('heading_distribution', 'Phân bổ H2/H3', 'good', "Có {$totalOtherHeadings} tiêu đề mục khác, nội dung được chia bố cục rõ ràng.", 3);
        } elseif ($totalOtherHeadings >= 1) {
            $this->addCheck('heading_distribution', 'Phân bổ H2/H3', 'warning', "Chỉ có {$totalOtherHeadings} tiêu đề mục khác, nên chia nội dung thành nhiều mục hơn.", 1);
        } else {
            $this->addCheck('heading_distribution', 'Phân bổ H2/H3', 'bad', 'Nội dung chưa được chia thành các mục H2/H3 rõ ràng.', 0);
        }
    }

    protected function checkContentLength()
    {
        $text = $this->stripHtml($this->contentHtml);
        $words = $this->wordCount($text);

        if ($words >= 1500 && $words <= 2500) {
            $this->addCheck('content_length', 'Độ dài bài viết', 'good', "Bài viết có {$words} từ, nằm trong khoảng 1.500-2.500 từ.", 8);
        } elseif (($words >= 1000 && $words < 1500) || ($words > 2500 && $words <= 3000)) {
            $this->addCheck('content_length', 'Độ dài bài viết', 'warning', "Bài viết có {$words} từ, gần đạt khoảng khuyến nghị 1.500-2.500 từ.", 5);
        } else {
            $this->addCheck('content_length', 'Độ dài bài viết', 'bad', "Bài viết có {$words} từ, nên viết trong khoảng 1.500-2.500 từ.", $words > 0 ? 2 : 0);
        }
    }

    protected function checkKeywordDensity()
    {
        if ($this->keyword === '') {
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'bad', 'Chưa có từ khóa chính để kiểm tra.', 0);
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
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'good', "Từ khóa xuất hiện {$occurrences} lần, mật độ {$densityRounded}% (đạt 1-2%).", 10);
        } elseif ($density > 0 && $density < 1) {
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'warning', "Mật độ {$densityRounded}%, hơi thấp, nên tăng nhẹ (mục tiêu 1-2%).", 5);
        } elseif ($density > 2 && $density <= 3.5) {
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'warning', "Mật độ {$densityRounded}%, hơi cao, tránh nhồi nhét từ khóa (mục tiêu 1-2%).", 5);
        } else {
            $this->addCheck('keyword_density', 'Mật độ từ khóa', 'bad', "Mật độ {$densityRounded}%, quá thấp hoặc quá cao so với mục tiêu 1-2%.", 1);
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
            $this->addCheck('images', 'Hình ảnh (ALT/Title)', 'good', 'Chưa có hình ảnh nào (không bắt buộc).', 8);
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
            $this->addCheck('images', 'Hình ảnh (ALT/Title)', 'good', "Tất cả {$total} ảnh đều có ALT + title chứa từ khóa và tên file chuẩn không dấu.", 8);
        } elseif ($ratio >= 0.5) {
            $this->addCheck('images', 'Hình ảnh (ALT/Title)', 'warning', "{$goodCount}/{$total} ảnh đạt chuẩn, cần chú ý " . implode(', ', array_unique($badLabels)) . " còn thiếu ALT/title/tên file chuẩn.", 5);
        } else {
            $this->addCheck('images', 'Hình ảnh (ALT/Title)', 'bad', "Chỉ {$goodCount}/{$total} ảnh đạt chuẩn, cần chú ý " . implode(', ', array_unique($badLabels)) . " còn thiếu ALT/title/tên file chuẩn.", 1);
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
            $this->addCheck('internal_links', 'Liên kết nội bộ', 'good', "Có {$count} link, đạt khuyến nghị ít nhất 3-5 link.", 8);
        } elseif ($count > 0) {
            $this->addCheck('internal_links', 'Liên kết nội bộ', 'warning', "Chỉ có {$count} link, nên thêm để đạt ít nhất 3-5 link.", 3);
        } else {
            $this->addCheck('internal_links', 'Liên kết nội bộ', 'bad', 'Chưa có link nào trỏ đến bài viết/sản phẩm liên quan.', 0);
        }
    }

    protected function getParagraphs()
    {
        preg_match_all('/<p\b[^>]*>(.*?)<\/p>/is', $this->contentHtml, $m);
        $paragraphs = array();
        if (isset($m[1])) {
            foreach ($m[1] as $p) {
                $text = trim(strip_tags($p));
                if ($text !== '') {
                    $paragraphs[] = $text;
                }
            }
        }
        return $paragraphs;
    }

    protected function checkOpeningParagraph()
    {
        $paragraphs = $this->getParagraphs();
        if (empty($paragraphs)) {
            $this->addCheck('opening_paragraph', 'Mở bài', 'bad', 'Chưa có đoạn văn (thẻ <p>) nào trong nội dung.', 0);
            return;
        }
        if ($this->containsKeyword($paragraphs[0])) {
            $this->addCheck('opening_paragraph', 'Mở bài', 'good', 'Đoạn mở bài có chứa từ khóa chính.', 6);
        } else {
            $this->addCheck('opening_paragraph', 'Mở bài', 'warning', 'Đoạn mở bài chưa chứa từ khóa chính.', 2);
        }
    }

    protected function checkClosingParagraph()
    {
        $paragraphs = $this->getParagraphs();
        if (empty($paragraphs)) {
            $this->addCheck('closing_paragraph', 'Kết bài', 'bad', 'Chưa có đoạn văn (thẻ <p>) nào trong nội dung.', 0);
            return;
        }
        $last = $paragraphs[count($paragraphs) - 1];
        if ($this->containsKeyword($last)) {
            $this->addCheck('closing_paragraph', 'Kết bài', 'good', 'Đoạn kết bài có chứa từ khóa chính.', 7);
        } else {
            $this->addCheck('closing_paragraph', 'Kết bài', 'warning', 'Đoạn kết bài chưa chứa từ khóa chính.', 3);
        }
    }

    /** Tìm mục "Câu hỏi thường gặp" (H2) và các câu hỏi con (H3) bên dưới nó */
    protected function checkFaq()
    {
        $headings = $this->extractHeadings();

        $faqIndex = -1;
        foreach ($headings as $i => $h) {
            if ($h['tag'] === 'h2') {
                $normalized = self::removeAccents($h['text']);
                if (strpos($normalized, 'cau hoi thuong gap') !== false) {
                    $faqIndex = $i;
                    break;
                }
            }
        }

        if ($faqIndex === -1) {
            $this->addCheck('faq', 'Câu hỏi thường gặp', 'bad', 'Chưa tìm thấy mục "Câu hỏi thường gặp" (thẻ H2) trong nội dung.', 0);
            return;
        }

        $questions = array();
        for ($i = $faqIndex + 1; $i < count($headings); $i++) {
            if ($headings[$i]['tag'] === 'h2') {
                break; // hết mục FAQ khi gặp H2 tiếp theo
            }
            if ($headings[$i]['tag'] === 'h3') {
                $questions[] = $headings[$i]['text'];
            }
        }

        $totalQuestions = count($questions);
        $goodQuestions = 0;
        foreach ($questions as $q) {
            if ($this->containsKeyword($q)) {
                $goodQuestions++;
            }
        }

        if ($totalQuestions === 0) {
            $this->addCheck('faq', 'Câu hỏi thường gặp', 'bad', 'Có mục "Câu hỏi thường gặp" nhưng chưa có câu hỏi (thẻ H3) nào bên dưới.', 0);
        } elseif ($totalQuestions >= 5 && $goodQuestions >= 5) {
            $this->addCheck('faq', 'Câu hỏi thường gặp', 'good', "Có {$totalQuestions} câu hỏi, tất cả đều chứa từ khóa chính.", 10);
        } else {
            $score = (int) round(10 * $goodQuestions / 5);
            $this->addCheck(
                'faq',
                'Câu hỏi thường gặp',
                $goodQuestions > 0 ? 'warning' : 'bad',
                "Có {$totalQuestions} câu hỏi, trong đó {$goodQuestions} câu chứa từ khóa chính (mục tiêu: 5 câu, đều có từ khóa).",
                $score
            );
        }
    }
}