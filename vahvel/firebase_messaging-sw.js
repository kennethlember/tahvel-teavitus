// Give the service worker access to Firebase Messaging.
importScripts('https://www.gstatic.com/firebasejs/8.0.2/firebase-app.js')
importScripts('https://www.gstatic.com/firebasejs/8.0.2/firebase-messaging.js')


firebase.initializeApp({
    "apiKey": "AIzaSyDIjWCLuS7ZhwwNQXFr4OOH872x4lM2-Fk",
	"messagingSenderId":"700341400097",
    "projectId": "vahvel2",
    "appId": "1:700341400097:web:b640720f42f9f64768a960",
});
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
	console.log(payload);
});