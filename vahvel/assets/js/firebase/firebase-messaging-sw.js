// Give the service worker access to Firebase Messaging.
importScripts('https://www.gstatic.com/firebasejs/8.0.2/firebase-app.js')
importScripts('https://www.gstatic.com/firebasejs/8.0.2/firebase-messaging.js')


firebase.initializeApp({
    "apiKey": "AIzaSyB8O7caBG8vLLf9s-E5YI1-GPad3htvrKw",
	"messagingSenderId":"880342023714",
    "projectId": "shipper-56f08",
    "appId": "1:880342023714:web:8eb766121b011ea12d147b",
});
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
	console.log(payload);
	const notification = JSON.parse(payload);
	const notificationOption = {
		body:notification.body,
		icon:notification.icon,
		click_action: notification.data.click_action
	};
	return self.registration.showNotification(payload.notification.title,notificationOption);
});