<script>
  window.addEventListener("load", function () {
      const images = document.querySelectorAll(".lazy");
      const observer = new IntersectionObserver((entries, observer) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  const img = entry.target;
                  const realSrc = img.dataset.src;
                  if (realSrc) {
                      img.src = realSrc;
                      img.classList.add("loaded");
                  }
                  observer.unobserve(img);
              }
          });
      }, {
          rootMargin: "300px 0px",
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
