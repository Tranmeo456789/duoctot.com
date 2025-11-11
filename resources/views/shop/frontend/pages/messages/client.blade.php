<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Chat hỗ trợ - Duoctot.com</title>
  <style>
    :root {
      --blue: #007bff;
      --bg: #f5f7fb;
    }

    body {
      margin: 0;
      font-family: Segoe UI, Roboto, Arial, sans-serif;
      background: var(--bg);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .card {
      width: 380px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, .12);
      overflow: hidden;
      display: flex;
      justify-content: space-between;
      flex-direction: column;
      height: 100%;
    }

    .header {
      background: linear-gradient(90deg, #0091ff, #006de6);
      color: #fff;
      padding: 12px 14px;
      font-weight: 700;
      text-align: center;
    }

    .form {
      padding: 12px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 25px;
      flex: auto;
    }

    .form input {
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
      outline: none;
    }

    .btn {
      background: var(--blue);
      color: #fff;
      border: none;
      padding: 11px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
    }

    .chatwrap {
      display: flex;
      flex-direction: column;
      flex: auto;
      height: 300px;
    }

    .hidden {
      display: none !important;
    }

    .chatbox {
      flex: auto;
      padding: 12px;
      overflow-y: auto;
      background: #f7f9fc;
    }

    .chat-input {
      display: flex;
      padding: 10px;
      border-top: 1px solid #eee;
      gap: 8px;
    }

    .chat-input input {
      flex: 1;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      outline: none;
    }

    .msg {
      margin: 8px 0;
      word-break: break-word;
    }

    .msg.user {
      text-align: right;
    }

    .msg.user span {
      background: var(--blue);
      color: #fff;
      padding: 8px 12px;
      border-radius: 18px 18px 18px 4px;
      display: inline-block;
    }

    .msg.bot {
      text-align: left;
    }

    .msg.bot span {
      background: #eceff3;
      color: #111;
      padding: 8px 12px;
      border-radius: 18px 18px 4px 18px;
      display: inline-block;
    }

    input,
    button,
    select,
    textarea {
      font-size: 16px !important;
    }
  </style>
</head>

<body>
  <div class="card">
    <div class="header">Chat với DUOCTOT.COM (hotline/zalo 0393167234)</div>
    <div id="stepForm" class="form">
      <input id="inputName" placeholder="Nhập tên của bạn" required />
      <input id="inputPhone" placeholder="Nhập số điện thoại" required />
      <button id="startBtn" class="btn">Bắt đầu chat</button>
    </div>
    <div id="stepChat" class="hidden chatwrap">
      <div class="chatbox" id="chatBox"></div>
      <div class="chat-input">
        <input type="file" id="imgInput" accept="image/*" style="display:none" />
        <button id="imgBtn"
          style="background:#f3f3f3;padding:8px;cursor:pointer;width:42px;height:42px;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,0.1);transition:0.2s;">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" stroke="#1d3557" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <circle cx="8.5" cy="8.5" r="1.5"></circle>
            <polyline points="21 15 16 10 5 21"></polyline>
          </svg>
        </button>
        <input id="msgInput" placeholder="Nhập tin nhắn..." />
        <button id="sendBtn" class="btn">Gửi</button>
      </div>
    </div>
  </div>
  <script>
    (function() {
      const WS_URL = "wss://n8n.tdoctor.net/websoket";
      const inputName = document.getElementById("inputName");
      const inputPhone = document.getElementById("inputPhone");
      const startBtn = document.getElementById("startBtn");
      const stepForm = document.getElementById("stepForm");
      const stepChat = document.getElementById("stepChat");
      const chatBox = document.getElementById("chatBox");
      const msgInput = document.getElementById("msgInput");
      const sendBtn = document.getElementById("sendBtn");
      const imgInput = document.getElementById("imgInput");
      const imgBtn = document.getElementById("imgBtn");

      let ws = null,
        connected = false,
        user = "",
        phone = "",
        session_id = null,
        pingTimer = null;

      const genSessionId = () => Date.now().toString() + "-" + Math.random().toString(36).substring(2, 8);
      const escapeHtml = s => s.replace(/[&<>"']/g, c => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;'
      } [c]));
      const addUserMsg = t => {
        const d = document.createElement("div");
        d.className = "msg user";
        d.innerHTML = `<span>${escapeHtml(t)}</span>`;
        chatBox.appendChild(d);
        chatBox.scrollTop = chatBox.scrollHeight;
      };
      const addBotMsg = t => {
        const d = document.createElement("div");
        d.className = "msg bot";
        d.innerHTML = `<span>${escapeHtml(t)}</span>`;
        chatBox.appendChild(d);
        chatBox.scrollTop = chatBox.scrollHeight;
      };
      const addUserImage = b => {
        const d = document.createElement("div");
        d.className = "msg user";
        d.innerHTML = `<span><img src="${b}" style="max-width:200px;border-radius:8px;"></span>`;
        chatBox.appendChild(d);
        chatBox.scrollTop = chatBox.scrollHeight;
      };
      const addBotImage = b => {
        const d = document.createElement("div");
        d.className = "msg bot";
        d.innerHTML = `<span><img src="${b}" style="max-width:200px;border-radius:8px;"></span>`;
        chatBox.appendChild(d);
        chatBox.scrollTop = chatBox.scrollHeight;
      };

      function connectWS() {
        if (ws && ws.readyState === 1) return;
        ws = new WebSocket(WS_URL);
        ws.onopen = () => {
          connected = true;
          if (pingTimer) clearInterval(pingTimer);
          pingTimer = setInterval(() => {
            if (ws && ws.readyState === 1) ws.send(JSON.stringify({
              type: "ping",
              time: Date.now()
            }));
          }, 20000);
        };
        ws.onmessage = e => {
          try {
            const msg = JSON.parse(e.data);
            if (msg.operation === "broadcastToAll" && msg.session_id === session_id) {
              if (msg.image) {
                // bỏ qua tin do chính mình gửi ra
                if (msg.role === "user") return;
                if (msg.image.startsWith("http")) addBotImage(msg.image);
                else addBotImage("data:image/jpeg;base64," + msg.image);
              } else {
                if (msg.role === "user") return;
                addBotMsg(msg.message);
              }
            }
          } catch {
            console.warn("Tin không đọc được:", e.data);
          }
        };
        ws.onclose = () => {
          connected = false;
          if (pingTimer) clearInterval(pingTimer);
          setTimeout(connectWS, 3000);
        };
        ws.onerror = () => {
          connected = false;
          //addBotMsg("⚠️ Lỗi kết nối WebSocket.");
        };
      }
      imgBtn.onclick = () => imgInput.click();
      imgInput.onchange = async () => {
        const file = imgInput.files[0];
        if (!file) return;

        // ✅ 1. Hiển thị ngay ảnh local trước cho người dùng
        const localURL = URL.createObjectURL(file);
        addUserImage(localURL);

        // ✅ 2. Gửi tạm placeholder tới admin (để biết đang upload)
        ws.send(JSON.stringify({
          session_id,
          user,
          phone,
          text: "[Đang tải ảnh...]",
          role: "user"
        }));

        // ✅ 3. Chuẩn bị FormData (multipart/form-data)
        const formData = new FormData();
        formData.append("file", file);
        formData.append("fileName", file.name);

        try {
          // ✅ 4. Upload qua API nhanh chóng
          const res = await fetch("https://duoctot.com/api/message/saveMessageImageFileWeb", {
            method: "POST",
            body: formData
          });

          const data = await res.json();

          if (data.success && data.url) {
            // ✅ 5. Gửi URL thật qua WebSocket để server lưu + admin nhận realtime
            ws.send(JSON.stringify({
              session_id,
              user,
              phone,
              text: "",
              role: "user",
              image: data.url
            }));
          } else {
            addBotMsg("⚠️ Upload ảnh thất bại!");
          }
        } catch (err) {
          console.error("Upload error:", err);
          addBotMsg("⚠️ Upload ảnh thất bại!");
        }

        imgInput.value = "";
      };

      startBtn.onclick = async () => {
        user = inputName.value.trim();
        phone = inputPhone.value.trim();

        if (!user) return alert("Vui lòng nhập tên.");
        if (!phone) return alert("Vui lòng nhập số điện thoại.");

        // ✅ Dùng số điện thoại làm session_id
        session_id = phone+'duoctot';

        // ✅ Ẩn form, hiện khung chat
        stepForm.classList.add("hidden");
        stepChat.classList.remove("hidden");

        // ✅ Kết nối WebSocket
        connectWS();

        // Helper gửi message sau khi WS kết nối xong
        const sendWhenConnected = (payload, tries = 0) => {
          if (ws && ws.readyState === 1) {
            ws.send(JSON.stringify(payload));
          } else if (tries < 20) {
            setTimeout(() => sendWhenConnected(payload, tries + 1), 200);
          }
        };

        // ✅ 1. Lấy lịch sử tin nhắn cũ (nếu có)
        try {
          const res = await fetch(`https://n8n.tdoctor.net/webhook/chat_messages_duoctot?session_id=${encodeURIComponent(session_id)}&_=${Date.now()}`);
          const data = await res.json();
          const messages = data.messages || data || [];

          chatBox.innerHTML = "";

          messages.forEach(m => {
            const text = m.message || m.text || "";
            const role = m.role || "user";

            // Nếu là ảnh (base64 hoặc link ảnh)
            if (typeof text === "string" && (text.startsWith("data:image") || /\.(jpe?g|png|gif|webp|svg)$/i.test(text))) {
              if (role === "user") addUserImage(text);
              else if (role === "admin" || role === "bot") addBotImage(text);
            } else {
              // Text bình thường
              if (role === "user") addUserMsg(text);
              else if (role === "admin" || role === "bot") addBotMsg(text);
            }
          });

          chatBox.scrollTop = chatBox.scrollHeight;

          if (messages.length > 0) {
            addBotMsg("💬 Tiếp tục cuộc trò chuyện nhé, " + user + "!");
          } else {
            setTimeout(() => addBotMsg(""), 400);
          }
        } catch (err) {
          console.warn("Không tải được lịch sử chat:", err);
        }

        // ✅ 2. Gửi URL hiện tại cho admin (tin nhắn đầu tiên khi bắt đầu chat)
        let currentUrl = "";

        // 1️⃣ Ưu tiên lấy từ query param
        const params = new URLSearchParams(window.location.search);
        if (params.get("parentUrl")) {
          currentUrl = decodeURIComponent(params.get("parentUrl"));
        } else {
          try {
            currentUrl = window.parent.location.href;
          } catch (e) {
            currentUrl = window.location.href;
          }
        }
        // 2️⃣ Dự phòng qua postMessage
        window.addEventListener("message", (event) => {
          if (event.data.parentUrl) {
            currentUrl = event.data.parentUrl;
          }
        });

        sendWhenConnected({
          session_id,
          user,
          phone,
          text: "Khách đang ở trang: " + currentUrl,
          role: "user"
        });
      };


      sendBtn.onclick = () => {
        const txt = msgInput.value.trim();
        if (!txt) return;
        if (!connected || !ws || ws.readyState !== 1) {
          addBotMsg("⚠️ Mất kết nối, thử lại...");
          connectWS();
          return;
        }
        ws.send(JSON.stringify({
          session_id,
          user,
          phone,
          text: txt,
          role: "user"
        }));
        addUserMsg(txt);
        msgInput.value = "";
      };
      msgInput.addEventListener("keypress", e => {
        if (e.key === "Enter") sendBtn.click();
      });
    })();
  </script>
</body>

</html>