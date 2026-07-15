{{--
    Widget "Thang điểm SEO" — nhúng vào form Sản phẩm.
    Từ khóa chính lấy tự động từ ô "Tên ngắn gọn thuốc" (#name_short).
--}}
<div id="seo-score-widget" class="card mb-3" data-analyze-url="{{ route('admin.seo-score.analyze') }}" data-csrf="{{ csrf_token() }}">
    <div class="card-header d-flex align-items-center justify-content-between">
        <strong>Phân tích SEO (sản phẩm)</strong>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <small class="text-muted">Từ khóa chính (lấy tự động từ "Tên ngắn gọn thuốc"): <strong id="seo-current-keyword">--</strong></small>
        </div>
        <ul id="seo-score-checklist" class="list-unstyled mb-0">
            <li class="text-muted">Đang chấm điểm...</li>
        </ul>
    </div>
</div>

<style>
    #seo-score-widget .seo-check-item { display:flex; align-items:flex-start; gap:10px; padding:8px 0; border-bottom:1px solid #f0f0f0; }
    #seo-score-widget .seo-check-item:last-child { border-bottom:none; }
    #seo-score-widget .seo-dot { flex:0 0 12px; width:12px; height:12px; border-radius:50%; margin-top:4px; }
    #seo-score-widget .seo-dot.good { background:#2ecc71; }
    #seo-score-widget .seo-dot.warning { background:#f39c12; }
    #seo-score-widget .seo-dot.bad { background:#e74c3c; }
    #seo-score-widget .seo-check-label { font-weight:600; margin-bottom:2px; }
    #seo-score-widget .seo-check-message { color:#555; font-size:13px; }
    #seo-score-circle-product.grade-green { background:#2ecc71; color:#fff; }
    #seo-score-circle-product.grade-orange { background:#f39c12; color:#fff; }
    #seo-score-circle-product.grade-red { background:#e74c3c; color:#fff; }
</style>

<script>
(function () {
    // === Field thật trong form sản phẩm ===
    const SELECTOR_KEYWORD = '#name_short';       // Tên ngắn gọn thuốc = từ khóa chính
    const SELECTOR_TITLE = '#name';                // Tên thuốc (tiêu đề)
    const SELECTOR_DESCRIPTION = '#meta_description';
    const SELECTOR_SLUG = '#slug';
    const SELECTOR_ALT_IMAGE = '#alt_image';        // ALT ảnh đại diện
    const SELECTOR_TITLE_IMAGE = '#title_image';    // Title ảnh đại diện
    const CONTENT_IDS = ['elements', 'benefit', 'dosage', 'note', 'preserve', 'general_info']; // gộp theo thứ tự

    const widgetEl = document.getElementById('seo-score-widget');
    const ANALYZE_URL = widgetEl.dataset.analyzeUrl;
    const CSRF_TOKEN = widgetEl.dataset.csrf;
    // ==============================================================

    let debounceTimer = null;
    let bound = false;

    function getEditorHtml(id) {
        try {
            if (window.jQuery && jQuery('#' + id).length && jQuery('#' + id).data('summernote')) {
                return jQuery('#' + id).summernote('code');
            }
        } catch (e) {}
        const el = document.getElementById(id);
        return el ? el.value : '';
    }

    function getFullContentHtml() {
        return CONTENT_IDS.map(getEditorHtml).join(' ');
    }

    function collectAndAnalyze() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(runAnalyze, 700);
    }

    function runAnalyze() {
        const keyword = (document.querySelector(SELECTOR_KEYWORD) || {}).value || '';
        const title = (document.querySelector(SELECTOR_TITLE) || {}).value || '';
        const description = (document.querySelector(SELECTOR_DESCRIPTION) || {}).value || '';
        const slug = (document.querySelector(SELECTOR_SLUG) || {}).value || '';
        const altImage = (document.querySelector(SELECTOR_ALT_IMAGE) || {}).value || '';
        const titleImage = (document.querySelector(SELECTOR_TITLE_IMAGE) || {}).value || '';
        const content = getFullContentHtml();

        document.getElementById('seo-current-keyword').textContent = keyword || '(chưa nhập)';

        fetch(ANALYZE_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                keyword: keyword,
                title: title,
                meta_description: description,
                slug: slug,
                content: content,
                alt_image: altImage,
                title_image: titleImage,
            }),
        })
            .then(function (res) { return res.json(); })
            .then(renderResult)
            .catch(function (err) { console.error('SEO score error:', err); });
    }

    function renderResult(data) {
        const circle = document.getElementById('seo-score-circle-product');
        circle.textContent = data.score + '/' + data.max_score;
        circle.className = 'badge grade-' + data.grade.color;
        circle.title = data.grade.label;
        const scoreInput = document.getElementById('score_seo');
        if (scoreInput) {
            scoreInput.value = data.score;
        } else {
            console.warn('Không tìm thấy input #score_seo để lưu điểm SEO.');
        }
        const list = document.getElementById('seo-score-checklist');
        list.innerHTML = '';
        data.checks.forEach(function (check) {
            const li = document.createElement('li');
            li.className = 'seo-check-item';
            li.innerHTML =
                '<span class="seo-dot ' + check.status + '"></span>' +
                '<div>' +
                    '<div class="seo-check-label">' + escapeHtml(check.label) + ' (' + check.score + '/' + check.max_score + 'đ)</div>' +
                    '<div class="seo-check-message">' + escapeHtml(check.message) + '</div>' +
                '</div>';
            list.appendChild(li);
        });
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function trySummernoteReady() {
        // Kiểm tra Summernote đã init xong hết chưa (my-js.js có thể init hơi trễ)
        const allReady = window.jQuery && CONTENT_IDS.every(function (id) {
            return jQuery('#' + id).length && jQuery('#' + id).data('summernote');
        });
        return allReady;
    }

    function bindEvents(attempt) {
        attempt = attempt || 0;

        [SELECTOR_KEYWORD, SELECTOR_TITLE, SELECTOR_DESCRIPTION, SELECTOR_SLUG, SELECTOR_ALT_IMAGE, SELECTOR_TITLE_IMAGE].forEach(function (sel) {
            const el = document.querySelector(sel);
            if (el && !el.dataset.seoBound) {
                el.addEventListener('input', collectAndAnalyze);
                el.dataset.seoBound = '1';
            }
        });

        if (trySummernoteReady()) {
            CONTENT_IDS.forEach(function (id) {
                jQuery('#' + id).on('summernote.change', collectAndAnalyze);
            });
            bound = true;
            runAnalyze();
        } else if (attempt < 20) {
            // Chưa init xong, thử lại sau 300ms (tối đa ~6 giây)
            setTimeout(function () { bindEvents(attempt + 1); }, 300);
        } else {
            console.warn('SEO score: Summernote chưa init được sau nhiều lần thử, dùng fallback textarea input.');
            CONTENT_IDS.forEach(function (id) {
                const el = document.getElementById(id);
                if (el) el.addEventListener('input', collectAndAnalyze);
            });
            runAnalyze();
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        bindEvents();
    });
})();
</script>