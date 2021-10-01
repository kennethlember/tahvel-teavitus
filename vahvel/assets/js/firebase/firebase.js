  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyDIjWCLuS7ZhwwNQXFr4OOH872x4lM2-Fk",
    projectId: "vahvel2",
    messagingSenderId: "700341400097",
    appId: "1:700341400097:web:b640720f42f9f64768a960",
    measurementId: "G-BGQCNWNPYT"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  const messaging = firebase.messaging();
  
askForPermissioToReceiveNotifications = () => {
    const messaging = firebase.messaging();
   Notification.requestPermission().then(async (permission) => {

    if(permission == 'granted') {

        try {

            const token = await messaging.getToken();

            if(token) {

                console.log(token);
                return token;
            }

            else {
                console.log('No Instance ID token available. Request permission to generate one.');
            }
        }

        catch(error) {

            console.log('An error occurred while retrieving token. ', error);


            //BUT THE NEW TOKEN SUCCESSFULY FETCHED
            const token = await messaging.getToken();

            if(token) {

                console.log(token);
                return token;
            }

            else {
                console.log('No Instance ID token available. Request permission to generate one.');
            }
        }
    }

})
.catch(error => console.log(error));
}

  function InitializeFireBaseMessaging() {
askForPermissioToReceiveNotifications();
	  messaging.requestPermission().then(function () { 
		return messaging.getToken();
	  }).then(function (token) {
		$.post( "ajax/users.php", {'RegisterFirebaseToken':"1","type":"3","token":token}, function( data ) { });
	  }).catch(function (reason) {
		  
		  console.log(reason);
		  
	  });
  }
  
  
  messaging.onMessage(function(payload) {
	  console.log(payload.data.click_action);
	  const notificationOption = {
			body: payload.notification.body,
			icon: payload.notification.icon,
			click_action: payload.data.click_action,
			data:payload.data.click_action
	   };
	  if (Notification.permission === "granted") {
		  var notification = new Notification(payload.notification.title,notificationOption);
		  notification.onclick = function(event){
			event.preventDefault();
			window.open(payload.data.click_action,'_blank')
            notification.close();
      };  
	  }
  });
  messaging.onTokenRefresh(function() {
	  messaging.getToken().then(function(newtoken) {
		$.post( "ajax/users.php", {'UpdateFirebaseToken':"1","type":"3","token":newtoken}, function( data ) {});
	  }).catch(function(reason) {
		console.log(reason);	
	  })
  });
  
