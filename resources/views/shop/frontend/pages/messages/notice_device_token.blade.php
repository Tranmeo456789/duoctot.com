<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCM Device Token</title>
</head>

<body>
    <h1>Get Device Token</h1>
    <button id="getTokenButton">Get Device Token</button>
    <p id="deviceToken"></p>

    <!-- Import Firebase SDKs -->
    <script type="module">
        // Import Firebase SDKs
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
        import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-messaging.js";

        const firebaseConfig = {
            apiKey: "AIzaSyBtRw2cCyz26QmkcPRwAyeQIvTaSt-adY4",
            authDomain: "taxiapp-32ae8.firebaseapp.com",
            databaseURL: "https://taxiapp-32ae8-default-rtdb.firebaseio.com",
            projectId: "taxiapp-32ae8",
            storageBucket: "taxiapp-32ae8.firebasestorage.app",
            messagingSenderId: "745488519850",
            appId: "1:745488519850:web:b97cd88e5df55fa70636d3",
            measurementId: "G-LS3CE114LL"
        };

        // Khởi tạo Firebase
        const app = initializeApp(firebaseConfig);

        // Khởi tạo Firebase Messaging
        const messaging = getMessaging(app);

        // Đảm bảo rằng Service Worker đã được đăng ký
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/shop/template/js/firebase-messaging-sw.js')  // Đảm bảo đường dẫn đúng tới service worker
                .then(function (registration) {
                    console.log('Service Worker registered with scope:', registration.scope);
                })
                .catch(function (error) {
                    console.error('Service Worker registration failed:', error);
                });
        }

        // Khi người dùng nhấn vào nút "Get Device Token"
        document.getElementById('getTokenButton').addEventListener('click', function () {
            Notification.requestPermission().then(permission => {
                if (permission === "granted") {
                    console.log("Notification permission granted.");
                    // Lấy Device Token
                    getDeviceToken();
                } else {
                    console.log("Notification permission denied.");
                }
            });
        });

        // Lấy Device Token từ Firebase Messaging
        function getDeviceToken() {
            getToken(messaging, {
                vapidKey: "BGyGbxlXbWiQvDcZa9BgdaLQEiDiw1dOFoWr7ok23SW-gouerLB0uWOZUerDCstyopbOju1zwwuYwWpawI7mBJQ"  // VAPID Key của bạn
            }).then((currentToken) => {
                if (currentToken) {
                    // Hiển thị token lên trang web hoặc gửi lên server
                    console.log("Device Token:", currentToken);
                    document.getElementById('deviceToken').innerText = currentToken;
                } else {
                    console.log("No registration token available.");
                }
            }).catch((err) => {
                console.error("Error getting token: ", err);
            });
        }
    </script>
</body>

</html>
