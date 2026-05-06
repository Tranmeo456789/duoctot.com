<script>
window.addEventListener("load", function () {
    const placeholder = "{{ asset('fileUpload/product/anh-san-pham-mac-dinh-blur1.jpg') }}"; // ảnh dự phòng
    const images = document.querySelectorAll(".lazy"); // chỉ ảnh lazy
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                const realSrc = img.dataset.src;
                // Nếu có data-src → load ảnh thật
                if (realSrc) {
                    img.src = realSrc;
                }
                // 2s sau nếu chưa load hoặc load lỗi → dùng placeholder
                const timeoutId = setTimeout(() => {
                    if (!img.complete || img.naturalWidth === 0) {
                        img.src = placeholder;
                        img.classList.add("loaded");
                    }
                }, 6000);
                // Khi load xong → hủy timeout và fade
                img.addEventListener("load", () => {
                    clearTimeout(timeoutId);
                    img.classList.add("loaded");
                });
                // Khi load lỗi → fallback ngay
                img.addEventListener("error", () => {
                    clearTimeout(timeoutId);
                    img.src = placeholder;
                    img.classList.add("loaded");
                });
                observer.unobserve(img); // ngừng quan sát
            }
        });
    }, {
        rootMargin: "100px 0px", // cách 300px mới load
        threshold: 0
    });
    images.forEach(img => observer.observe(img));
});
</script>
<script src="{{ asset('/shop/frontend/js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/combined_library.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/my-js.min.js')}}?v={{ filemtime(public_path('/shop/frontend/js/my-js.min.js')) }}" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/chat-widget.js')}}" type="text/javascript"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-96P2DL9CDP"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-96P2DL9CDP');
</script>
