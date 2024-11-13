// Import Firebase SDK từ CDN
importScripts('/shop/template/js/firebase-app.js');
importScripts('/shop/template/js/firebase-messaging.js');

// Cấu hình Firebase của bạn
const firebaseConfig = {
    apiKey: "AIzaSyBtRw2cCyz26QmkcPRwAyeQIvTaSt-adY4",
    authDomain: "taxiapp-32ae8.firebaseapp.com",
    projectId: "taxiapp-32ae8",
    storageBucket: "taxiapp-32ae8.firebasestorage.app",
    messagingSenderId: "745488519850",
    appId: "1:745488519850:web:b97cd88e5df55fa70636d3",
    measurementId: "G-LS3CE114LL"
};

// Khởi tạo Firebase
firebase.initializeApp(firebaseConfig);

// Khởi tạo Firebase Messaging
const messaging = firebase.messaging();

// Xử lý thông báo đẩy trong nền (background)
messaging.onBackgroundMessage(function(payload) {
    console.log("Background Message received: ", payload);

    // Tạo thông báo đẩy tùy chỉnh (optional)
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon
    };

    // Hiển thị thông báo
    self.registration.showNotification(notificationTitle, notificationOptions);
});
