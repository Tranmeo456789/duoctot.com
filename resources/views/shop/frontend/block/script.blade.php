<!-- <script src="{{ asset('/shop/frontend/js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/lightslider.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/jquery.validate.min.js')}}" type="text/javascript"></script> -->

<script src="{{ asset('/shop/frontend/js/combined_library.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/my-js.min.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>
<script src="https://www.googletagmanager.com/gtag/js?id=G-PZKFD196QW" defer></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'G-PZKFD196QW');
</script>
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "url": "https://tdoctor.net",
    "potentialAction": {
      "@type": "SearchAction",
      "target": {
        "@type": "EntryPoint",
        "urlTemplate": "https://tdoctor.net/tim-kiem?s={search_term_string}"
      },
      "query-input": "required name=search_term_string"
    }
  }
</script>
<script id="logo-organization-script" type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "url": "https://tdoctor.net",
    "logo": "https://tdoctor.net/images/shop/logo_topbar3.png"
  }
</script>