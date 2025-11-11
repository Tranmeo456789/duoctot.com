(function() {
  // --- CSS ---
  const style = document.createElement("style");
  style.innerHTML = `
  #tdoctorChatBtn {
    position: fixed;
    bottom: 50px; right: 0px;
    background: #007bff;
    width: 60px; height: 60px;
    border-radius: 50%;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 28px; z-index: 9999;
  }
  #tdoctorChatPopup {
    position: fixed;
    bottom: 90px; right: 20px;
    width: 380px; height: 520px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    overflow: hidden;
    z-index: 9999;
    display: none;
    flex-direction: column;
  }
  #tdoctorChatPopup iframe {
    width: 100%; height: 100%; border: none;
  }
  #tdoctorCloseBtn {
    position: absolute;
    top: 5px; right: 10px;
    background: rgba(0,0,0,0.3);
    color: #fff; border: none;
    width: 32px; height: 32px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 30px;
    z-index: 10000;
  }

  /* Mobile responsive */
  @media (max-width: 768px) {
    #tdoctorChatPopup {
      width: 100%;
      height: 50vh;
      bottom: 0; right: 0; left: 0;
      border-radius: 16px 16px 0 0;
    }
    #tdoctorChatBtn {
      width: 50px; height: 50px;
      bottom: 50px; right: 0px;
    }
  }
  `;
  document.head.appendChild(style);

  // --- HTML ---
  const btn = document.createElement("div");
  btn.id = "tdoctorChatBtn";
  btn.innerHTML = "💬";
  document.body.appendChild(btn);

  const popup = document.createElement("div");
  popup.id = "tdoctorChatPopup";
  popup.innerHTML = `
    <button id="tdoctorCloseBtn">×</button>
    <iframe id="tdoctorChatFrame"></iframe>
  `;
  document.body.appendChild(popup);

  const iframe = popup.querySelector("#tdoctorChatFrame");
  const closeBtn = popup.querySelector("#tdoctorCloseBtn");

  // --- JS Logic ---
  btn.onclick = () => {
    popup.style.display = "flex";
    btn.style.display = "none";
  };
  closeBtn.onclick = () => {
    popup.style.display = "none";
    btn.style.display = "flex";
  };

  // --- ✅ Truyền URL trang cha an toàn ---
  const parentUrl = encodeURIComponent(window.location.href);
  iframe.src = `https://duoctot.com/page-client-chat?parentUrl=${parentUrl}`;

  // Nếu iframe đã load, gửi lại URL qua postMessage (dự phòng)
  iframe.onload = () => {
    iframe.contentWindow.postMessage({ parentUrl: window.location.href }, "*");
  };

})();
