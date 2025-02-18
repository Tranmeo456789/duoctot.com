<style>
.contact-menu {
    position: fixed;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    z-index: 100;
    display: block;
    opacity: 1;
    transition: opacity 0.3s ease-in-out;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 40px;
    padding: 20px 8px 10px 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.contact-menu li {
    text-align: center;
}
.contact-menu a {
    text-decoration: none;
    color: #0d6799;
    display: block;
    font-size: 12px;
    font-weight: bold;
}
.contact-menu img {
    width: 30px;
    height: 30px;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .contact-menu {
        top: auto !important;
        bottom: 0 !important;
        right: 0;
        left: 0;
        transform: none;
        width: 100%;
        border-radius: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
    }
    .contact-menu ul {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
    }
}
</style>
<contact-menu class="contact-menu">
    <ul>
        <li id="icon-fixed__facebook">
            <a class="image-contact" href="https://www.facebook.com/tdoctoronline/" rel="nofollow" target="_blank" title="Facebook" previewlistener="true">
                <img src="https://nhakhoathuyanh.com/wp-content/uploads/2024/05/fb.webp" alt="Facebook">
            </a>
            <a href="https://www.facebook.com/tdoctoronline/" rel="nofollow" target="_blank" title="Facebook Tdoctor" previewlistener="true">Facebook</a>
        </li>
        <li id="icon-fixed__messenger">
            <a class="image-contact" href='tel:0393167234' rel="nofollow" title="Gọi điện" previewlistener="true">
                <img src="{{asset('images/shop/icon-call-green.jpg')}}" alt="Gọi điện Tdoctor">
            </a>
            <a href='tel:0393167234' rel="nofollow" title="Call Tdoctor" previewlistener="true">Call</a>
        </li>
        <li id="icon-fixed__zalo">
            <a class="image-contact" href="https://zalo.me/0393167234" rel="nofollow" target="_blank" title="Zalo" previewlistener="true">
                <img src="https://nhakhoathuyanh.com/wp-content/uploads/2024/05/zalo.webp" alt="Zalo Tdoctor">
            </a>
            <a href="https://zalo.me/0393167234" rel="nofollow" target="_blank" title="Zalo Tdoctor" previewlistener="true">Zalo</a>
        </li>
        <li id="icon-fixed__youtube">
            <a class="image-contact" href="https://www.youtube.com/@tdoctor8100" rel="nofollow" target="_blank" title="Youtube" previewlistener="true">
                <img src="https://nhakhoathuyanh.com/wp-content/uploads/2024/05/yt.webp" alt="Youtube Tdoctor">
            </a>
            <a href="https://www.youtube.com/results?search_query=tdoctor" rel="nofollow" target="_blank" title="Youtube Tdoctor" previewlistener="true">Youtube</a>
        </li>
    </ul>
</contact-menu>