<!-- 
<script src="{{ asset('/shop/frontend/js/jquery.validate.min.js')}}?t=@php echo time() @endphp" type="text/javascript"></script> -->
<script src="{{ asset('/shop/frontend/js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/combined_library.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/my-js.min.js')}}" type="text/javascript"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-96P2DL9CDP"></script>

<link rel="stylesheet" href="https://tdoctor.net/shop/frontend/css/chatbot.css">
<!-- <script src="https://tdoctor.net/shop/frontend/js/chatbot.js" defer></script> -->

<div id="chatbot">
  <input type="text" id="chat-name" placeholder="Tên">
  <input type="text" id="chat-phone" placeholder="Số điện thoại">
  <button id="chat-start">Bắt đầu Chat</button>
  <div id="chat-messages"></div>
  <input type="text" id="chat-input" placeholder="Nhập tin nhắn">
  <button id="chat-send">Gửi</button>
</div>

<script>
let userId = null;

document.getElementById("chat-start").addEventListener("click", async () => {
  const name = document.getElementById("chat-name").value;
  const phone = document.getElementById("chat-phone").value;

  const res = await fetch("https://n8n.tdoctor.net/webhook/chat-init", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ name, phone })
  });
  const data = await res.json();
  userId = data.user_id;

  document.getElementById("chat-messages").innerHTML = "Chat đã khởi tạo. Bạn có thể gửi tin nhắn.";
});

document.getElementById("chat-send").addEventListener("click", async () => {
  const message = document.getElementById("chat-input").value;
  if (!userId) { alert("Vui lòng khởi tạo chat trước!"); return; }

  const res = await fetch("https://n8n.tdoctor.net/webhook/chat-message", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ user_id: userId, message })
  });
  const data = await res.json();
  document.getElementById("chat-messages").innerHTML += `<div><b>Bạn:</b> ${message}</div>`;
  document.getElementById("chat-messages").innerHTML += `<div><b>Bot:</b> ${data.reply}</div>`;
  document.getElementById("chat-input").value = "";
});
</script>

<!-- <script data-name-bot="Chat Bot Tdoctor"
	src="https://app.preny.ai/embed-global.js"
	data-button-style="width:300px;height:300px;"
	data-language="vi"
	async
	defer
	data-preny-bot-id="68ed2a29bd7aa11c0f3d4743"
></script> -->

<!-- <script>var LHC_API = LHC_API||{};
LHC_API.args = {mode:'widget',lhc_base_url:'//chat.duoctot.com/index.php/',wheight:450,wwidth:350,pheight:520,pwidth:500,domain:'duoctot.com',department:["1"],check_messages:false,lang:'site_admin/'};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.setAttribute('crossorigin','anonymous'); po.async = true;
var date = new Date();po.src = '//chat.duoctot.com/design/defaulttheme/js/widgetv2/index.js?'+(""+date.getFullYear() + date.getMonth() + date.getDate());
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
<style>
	@media (max-width: 768px) {
  iframe#lhc_widget_v2.lhc-mobile.lhc-mode-widget {
    height: 50vh !important;    /* nửa chiều cao màn hình */
    max-height: 50vh !important;
    bottom: 0 !important;       /* bám sát cạnh dưới */
    top: auto !important;   
	min-height: auto !important;    /* không chiếm phần trên */
  }
}
</style> -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-96P2DL9CDP');
</script>
