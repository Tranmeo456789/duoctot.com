<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin Chat - TDOCTOR</title>
  <style>
    body {
      margin: 0;
      font-family: Segoe UI, Roboto, sans-serif;
      display: flex;
      height: 100vh;
      background: #f6f8fb;
    }

    .sidebar {
      flex: 1;
      background: #fff;
      border-right: 1px solid #ddd;
      overflow-y: auto;
      transition: all 0.3s;
    }

    .wrap-chat {
      flex: 2;
    }

    .user {
      padding: 12px 15px;
      border-bottom: 1px solid #eee;
      cursor: pointer;
    }

    .user.active {
      background: #e7f0ff;
    }

    .chat {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .header {
      background: #007bff;
      color: #fff;
      padding: 10px 16px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .back-btn {
      display: none;
      background: none;
      border: none;
      color: #fff;
      font-size: 25px;
      cursor: pointer;
    }

    .chatbox {
      flex: 1;
      overflow-y: auto;
      padding: 12px;
      display: flex;
      flex-direction: column;
    }

    .msg {
      margin: 6px 0;
      word-break: break-word;
    }

    .msg.user {
      text-align: left;
    }

    .msg.user span {
      background: #e9ecf2;
      padding: 8px 12px;
      border-radius: 18px 18px 18px 4px;
      display: inline-block;
    }

    .msg.bot {
      text-align: right;
    }

    .msg.admin {
      text-align: right;
    }

    .msg.admin span {
      background: #007bff;
      color: #fff;
      padding: 8px 12px;
      border-radius: 18px 18px 4px 18px;
      display: inline-block;
    }

    .msg.bot span {
      background: #007bff;
      color: #fff;
      padding: 8px 12px;
      border-radius: 18px 18px 4px 18px;
      display: inline-block;
    }

    .inputbar {
      display: flex;
      border-top: 1px solid #ddd;
    }

    .inputbar input {
      flex: 1;
      border: none;
      padding: 12px;
      font-size: 14px;
      outline: none;
    }

    .inputbar button {
      background: #007bff;
      color: #fff;
      border: none;
      padding: 12px 18px;
      cursor: pointer;
      font-weight: bold;
    }

    .last-message {
      font-size: 13px;
      color: #666;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: 1.4em;
      max-height: calc(1.4em * 2);
      word-break: break-word;
    }

    .chat-phone {font-weight: bold; color: red;}

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        border-right: none;
        flex: none;
      }

      .chat {
        display: none;
      }

      .chat.active {
        display: flex;
      }

      .back-btn {
        display: inline;
      }
    }
  </style>
</head>

<body>
  <div class="sidebar" id="userList">
    <p style="padding:10px;">Đang tải...</p>
  </div>
  <div class="wrap-chat" style="height: 85vh;">
    <div class="chat" style="height: 85vh;">
      <div class="header" id="chatHeader">
        <button class="back-btn" id="backBtn"><span>⬅</span></button>
        <span id="chatTitle">Chọn người để chat</span>
      </div>
      <div class="chatbox" id="chatBox"></div>
      <div class="inputbar">
        <input type="file" id="imgInput" accept="image/*" style="display:none" />
        <button id="imgBtn"
          style="background:#f3f3f3;padding:8px;cursor:pointer;
         width:42px;height:42px;display:flex;align-items:center;justify-content:center;
         box-shadow:0 2px 6px rgba(0,0,0,0.1);transition:0.2s;">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" stroke="#1d3557" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <circle cx="8.5" cy="8.5" r="1.5"></circle>
            <polyline points="21 15 16 10 5 21"></polyline>
          </svg>
        </button>
        <input id="adminInput" placeholder="Nhập tin nhắn..." />
        <button id="sendBtn">Gửi</button>
      </div>
    </div>
  </div>
  <script>
    const WS_URL = "wss://n8n.tdoctor.net/websoket";
    const API_USERS = "https://n8n.tdoctor.net/webhook/chat_users_duoctot";
    const API_MESSAGES = "https://n8n.tdoctor.net/webhook/chat_messages_duoctot";
    let ws = null,
      selectedSession = null;
    const userList = document.getElementById("userList"),
      chatBox = document.getElementById("chatBox"),
      chatHeader = document.getElementById("chatHeader"),
      adminInput = document.getElementById("adminInput"),
      sendBtn = document.getElementById("sendBtn");
    // ✅ Yêu cầu quyền hiển thị thông báo
    if (Notification.permission === "default") {
      Notification.requestPermission().then(permission => {
        console.log("Notification permission:", permission);
      });
    }
    async function loadUsers() {
      try {
        const res = await fetch(`${API_USERS}?_=${Date.now()}`);
        const data = await res.json();
        const users = data.users || data;

        // Xóa danh sách cũ
        userList.innerHTML = "";

        users.forEach(u => {
          const div = document.createElement("div");
          div.className = "user";

          const name = u.name || u.user_name || "Khách chưa đặt tên";
          const phone = u.phone ?? "";
          const lastMsg = u.last_message ?
            (u.last_message.startsWith("data:image") ? "[Hình ảnh]" : u.last_message) :
            "(Chưa có tin nhắn)";

          div.innerHTML = `
        <b>${name}</b> SĐT: <small class="chat-phone">${phone}</small><br>
        <span class="last-message">${lastMsg}</span>
      `;

          div.onclick = e => selectUser(e, u.session_id, name);
          userList.appendChild(div);
        });

      } catch (e) {
        console.error(e);
        userList.innerHTML = "<p style='padding:10px;color:red'>Đang tải danh sách...</p>";
      }
    }

    async function loadMessages(sid) {
      const r = await fetch(`${API_MESSAGES}?session_id=${sid}&_=${Date.now()}`);
      const d = await r.json();
      chatBox.innerHTML = "";
      (d.messages || d).forEach(m => {
        const div = document.createElement("div");
        div.className = "msg " + (m.role || "bot");

        // ✅ Hiển thị ảnh, link, hoặc text
        if (typeof m.message === "string" && (m.message.startsWith("data:image") || /\.(jpe?g|png|gif|webp|svg)$/i.test(m.message))) {
          div.innerHTML = `<span><img src="${m.message}" style="max-width:200px;border-radius:8px;"></span>`;
        } else if (m.message.startsWith("http")) {
          div.innerHTML = `<span><a href="${m.message}" target="_blank" style="color:#007bff;text-decoration:underline;">${m.message}</a></span>`;
        } else if (m.message.startsWith("Khách đang ở trang: http")) {
          const url = m.message.replace("Khách đang ở trang: ", "").trim();
          div.innerHTML = `<span>Khách đang ở trang: <a href="${url}" target="_blank" style="color:#007bff;text-decoration:underline;">${url}</a></span>`;
        } else {
          div.innerHTML = `<span>${m.message || m.text || ""}</span>`;
        }

        chatBox.appendChild(div);
      });
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    function connectWS() {
      ws = new WebSocket(WS_URL);
      ws.onopen = () => console.log("✅ WS connected");
      ws.onmessage = e => {
        try {
          const msg = JSON.parse(e.data);
          if (msg.operation === "broadcastToAll") {
            if (msg.role === "user") {
              updateUserList(msg.session_id, msg.sender, msg.message);
              // Nếu không đang mở đoạn chat này → phát chuông + popup
              if (msg.session_id !== selectedSession) {
                playNotifySound();
                showNotification(msg.sender || "Khách hàng", msg.message || "Gửi tin nhắn mới", msg.session_id);
              }
            }
            if (!selectedSession || msg.session_id !== selectedSession) return;
            if (msg.image) {
              if (msg.image.startsWith("http")) addUserImage(msg.image);
              else addUserImage("data:image/jpeg;base64," + msg.image);
            } else if (msg.role !== "admin") {
              const div = document.createElement("div");
              div.className = "msg user";

              if (msg.message.startsWith("http")) {
                div.innerHTML = `<span><a href="${msg.message}" target="_blank" style="color:#007bff;text-decoration:underline;">${msg.message}</a></span>`;
              } else if (msg.message.startsWith("Khách đang ở trang: http")) {
                const url = msg.message.replace("Khách đang ở trang: ", "").trim();
                div.innerHTML = `<span>Khách đang ở trang: <a href="${url}" target="_blank" style="color:#007bff;text-decoration:underline;">${url}</a></span>`;
              } else {
                div.innerHTML = `<span>${msg.message}</span>`;
              }

              chatBox.appendChild(div);
              chatBox.scrollTop = chatBox.scrollHeight;
            }
          }
        } catch {}
      };

      ws.onclose = () => setTimeout(connectWS, 3000);
    }

    function addUserMsg(t) {
      const d = document.createElement("div");
      d.className = "msg user";
      d.innerHTML = `<span>${t}</span>`;
      chatBox.appendChild(d);
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    function addAdminImage(b) {
      const d = document.createElement("div");
      d.className = "msg admin";
      d.innerHTML = `<span><img src="${b}" style="max-width:200px;border-radius:8px;"></span>`;
      chatBox.appendChild(d);
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    function addUserImage(b) {
      const d = document.createElement("div");
      d.className = "msg user";
      d.innerHTML = `<span><img src="${b}" style="max-width:200px;border-radius:8px;"></span>`;
      chatBox.appendChild(d);
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    function updateUserList(session_id, name, lastMsg) {
      let existing = [...document.querySelectorAll(".user")]
        .find(u => u.textContent.includes(name));

      if (existing) {
        existing.querySelector("span").textContent = lastMsg.startsWith("data:image") ? "[Hình ảnh]" : lastMsg;
        userList.prepend(existing);
      } else {
        const div = document.createElement("div");
        div.className = "user";
        div.innerHTML = `
      <b>${name}</b><br>
      <span style="font-size:13px;color:#666;">${lastMsg.startsWith("data:image") ? "[Hình ảnh]" : lastMsg}</span>
    `;
        div.onclick = e => selectUser(e, session_id, name);
        userList.prepend(div);
      }
    }

    // 📱 Khi chọn user -> ẩn danh sách, hiện khung chat
    function selectUser(e, sid, name) {
      selectedSession = sid;
      document.querySelectorAll(".user").forEach(x => x.classList.remove("active"));
      e.currentTarget.classList.add("active");

      // ✅ Chỉ đổi nội dung trong span #chatTitle (không đụng nút back)
      const titleSpan = document.getElementById("chatTitle");
      titleSpan.textContent = "Chat với " + name;

      loadMessages(sid);

      // Ẩn danh sách, hiện chat trên mobile
      if (window.innerWidth <= 768) {
        document.querySelector(".sidebar").style.display = "none";
        document.querySelector(".chat").classList.add("active");
      }
    }
    // 📱 Nút back để quay về danh sách
    document.getElementById("backBtn").onclick = () => {
      document.querySelector(".chat").classList.remove("active");
      document.querySelector(".sidebar").style.display = "block";
      // Khi quay lại, đổi text lại mặc định
      document.getElementById("chatTitle").textContent = "Chọn người để chat";
    };
    sendBtn.onclick = () => {
      const txt = adminInput.value.trim();
      if (!txt || !selectedSession || !ws || ws.readyState !== 1) return alert("Chưa chọn người hoặc WS chưa sẵn sàng!");
      ws.send(JSON.stringify({
        session_id: selectedSession,
        user: "Admin",
        phone: "",
        text: txt,
        role: "admin"
      }));
      const d = document.createElement("div");
      d.className = "msg admin";
      d.innerHTML = `<span>${txt}</span>`;
      chatBox.appendChild(d);
      adminInput.value = "";
      chatBox.scrollTop = chatBox.scrollHeight;
    };
    const imgInput = document.getElementById("imgInput"),
      imgBtn = document.getElementById("imgBtn");
    imgBtn.onclick = () => imgInput.click();
    imgInput.onchange = async () => {
      const file = imgInput.files[0];
      if (!file || !selectedSession) return alert("Chưa chọn người để chat!");

      // ✅ 1. Hiển ngay ảnh local trên giao diện admin
      const localURL = URL.createObjectURL(file);
      addAdminImage(localURL);

      // ✅ 2. Gửi tạm placeholder cho client (hiển thị ngay)
      ws.send(JSON.stringify({
        session_id: selectedSession,
        user: "Admin",
        phone: "",
        text: "[Đang tải ảnh...]",
        role: "admin"
      }));

      // ✅ 3. Chuẩn bị FormData upload
      const formData = new FormData();
      formData.append("file", file);
      formData.append("fileName", file.name);

      try {
        // ✅ 4. Upload qua API (nhanh, không cần base64)
        const res = await fetch("https://duoctot.com/api/message/saveMessageImageFileWeb", {
          method: "POST",
          body: formData
        });

        const data = await res.json();

        if (data.success && data.url) {
          // ✅ 5. Gửi URL thật qua WS để server lưu + client nhận realtime
          ws.send(JSON.stringify({
            session_id: selectedSession,
            user: "Admin",
            phone: "",
            text: "",
            role: "admin",
            image: data.url
          }));
        } else {
          addUserMsg("⚠️ Upload ảnh thất bại!");
        }
      } catch (err) {
        console.error("Upload error:", err);
        addUserMsg("⚠️ Upload ảnh thất bại!");
      }

      imgInput.value = "";
    };
    loadUsers();
    connectWS();
    setInterval(() => {
      if (ws && ws.readyState === 1) ws.send(JSON.stringify({
        type: "ping",
        time: Date.now()
      }));
    }, 20000);
    setInterval(loadUsers, 10000);

    function playNotifySound() {
      const audio = document.getElementById("notifySound");
      if (!audio) return;
      audio.currentTime = 0;
      audio.play().catch(err => console.log("Không thể phát âm thanh:", err));
    }

    function showNotification(title, body, sessionId) {
      if (Notification.permission !== "granted") return;

      const notification = new Notification(title, {
        body,
        icon: "https://tdoctor.net/apple-touch-icon.png" // icon nhỏ của bạn
      });

      // Khi bấm vào thông báo → mở lại trang admin
      notification.onclick = () => {
        window.focus();
        if (sessionId) {
          window.location.href = "https://duoctot.com/page-admin-chat?session_id=" + sessionId;
        } else {
          window.focus();
        }
      };
    }
  </script>
  <audio id="notifySound" src="https://tdoctor.net/shop/frontend/css/new-notification-026-380249.mp3" preload="auto"></audio>
</body>

</html>