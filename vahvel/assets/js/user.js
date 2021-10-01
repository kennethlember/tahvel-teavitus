$('#RegisterForm').validate({
	ignore: "",
	rules: {
		fname: {
			required:true
		},
		lname: {
			required:true
		},
		email: {
			required:true,
			email:true
		},
		pwd: {
			required:true,
			minlength: 6
		},
		pwd2: {
			required:true,
			minlength:6,
			equalTo: "#pwd"
		},
		terms: {
			required:true
		}
	},
	messages: {
	},
	submitHandler: function(form) {
		var formData = $('#RegisterForm').serializeArray();
        $.ajax({
            type:'POST',
            url: "ajax/users.php",
			dataType: "json",
            data: formData,
            success:function(data){	
				if (data.success === "1") {
					SendUserIdToAndroid(data.user_id);
					localStorage.setItem("user_id", data.user_id);
					location.href = data.url;
				} else {
					Swal.fire({
					  icon: 'error',
					  title: data.msg
					})
				}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

	}
});
$('#VerifyForm').validate({
	ignore: "",
	rules: {
		code: {
			required:true
		}
	},
	messages: {
	},
	submitHandler: function(form) {
		var formData = $('#VerifyForm').serializeArray();
        $.ajax({
            type:'POST',
            url: "ajax/users.php",
			dataType: "json",
            data: formData,
            success:function(data){	
				if (data.success === "1") {
					location.href = data.url;
				} else {
					Swal.fire({
					  icon: 'error',
					  title: data.msg
					}) 
				}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

	}
});
function ResendVerifyCode() {
	$.getJSON( "ajax/users.php", {'ResendVerifyCode':"1"}, function( data ) {
			Swal.fire({
			  icon: 'success',
			  title: data.msg
			})
	});
}
$('#LoginForm').validate({
	ignore: "",
	rules: {
		email: {
			required:true,
			email:true
		}, 
		pwd: {
			required:true,
			minlength: 6
		}
	},
	messages: {
	},
	submitHandler: function(form) {
		var formData = $('#LoginForm').serializeArray();
        $.ajax({
            type:'POST',
            url: "ajax/users.php",
			dataType: "json",
            data: formData,
            success:function(data){	
				if (data.success === "1") {
					SendUserIdToAndroid(data.user_id);
					localStorage.setItem("user_id", data.user_id);
					location.reload();
				} else {
					Swal.fire({
					  title: data.msg,
					  icon: 'error',
					  showConfirmButton: false,
					  timer: 1500
					})
				}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

	}
});
$('#UpdateProfileForm').validate({
	ignore: "",
	rules: {
		fname: {
			required:true
		},
		lname: {
			required:true
		},
		email: {
			required:true,
			email:true
		}
	},
	messages: {
	},
	submitHandler: function(form) {
		var formData = $('#UpdateProfileForm').serializeArray();
        $.ajax({
            type:'POST',
            url: "ajax/users.php",
			dataType: "json",
            data: formData,
            success:function(data){	
				if (data.success === "1") {
					Swal.fire({
					  icon: 'success',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					})
				} else {
					Swal.fire({
					  icon: 'error',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

	}
});
$('#ChangePasswordForm').validate({
	ignore: "",
	rules: {
		password: {
			required:true,
			minlength: 6			
		},
		pwd1: {
			required:true,
			minlength: 6
		},
		pwd2: {
			required:true,
			minlength:6,
			equalTo: "#pwd1"
		},
	},
	messages: {
	},
	submitHandler: function(form) {
		var formData = $('#ChangePasswordForm').serializeArray();
        $.ajax({
            type:'POST',
            url: "ajax/users.php",
			dataType: "json",
            data: formData,
            success:function(data){	
				if (data.success === "1") {
					Swal.fire({
					  icon: 'success',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				} else {
					Swal.fire({
					  icon: 'error',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

	}
});

function EditProfileFunction() {
	$(".modal").modal("hide");
	$("#profileEditModal").modal("show");
}
function ChangePasswordFunction() {
	$(".modal").modal("hide");
	$("#changePasswordModal").modal("show");
}
function ChangeAvatarFunction() {
	$(".modal").modal("hide");
	$("#changeAvatarModal").modal("show");
}
function EditBankFunction() {
	$(".modal").modal("hide");
	$("#changeBankModal").modal("show");
}

function BackToProfile(what) {
	$("#"+what).modal("hide");
	$("#profileModal").modal("show");
}
$(document).on('change', 'input[name=avatar]', function() {
	$('#ChangeAvatarForm').submit();
});

$('#ChangeAvatarForm').validate({
	ignore: "",
	rules: {
		avatar: {
			required:true,
		}
	},
	messages: {
	},
	submitHandler: function(form) {
        var form1 = $('#ChangeAvatarForm')[0];
		var formData = new FormData(form1);
		
		$.ajax({
            type:'POST',
            url: "ajax/users.php",
			dataType: "json",
			data: formData,
			contentType: false,       
			cache: false,             
			processData:false, 
			success:function(data){	
				if (data.success === "1") {
					$(".avatar").attr("src",data.avatar);
					Swal.fire({
					  icon: 'success',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				} else {
					Swal.fire({
					  icon: 'error',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

	}
});

$('#bankAccountAddForm').validate({
	ignore: "",
	rules: {
		name: {
			required:true,
		},
		iban: {
			required:true,
		},
	},
	messages: {
	},
	submitHandler: function(form) {
		var formData = $('#bankAccountAddForm').serializeArray();
        $.ajax({
            type:'POST',
            url: "ajax/users.php",
			dataType: "json",
            data: formData,
            success:function(data){	
				if (data.success === "1") {
					Swal.fire({
					  icon: 'success',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				} else {
					Swal.fire({
					  icon: 'error',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

	}
});
$('#ChangeBankForm').validate({
	ignore: "",
	rules: {
		name: {
			required:true,
		},
		iban: {
			required:true,
		},
	},
	messages: {
	},
	submitHandler: function(form) {
		var formData = $('#ChangeBankForm').serializeArray();
        $.ajax({
            type:'POST',
            url: "ajax/users.php",
			dataType: "json",
            data: formData,
            success:function(data){	
				if (data.success === "1") {
					Swal.fire({
					  icon: 'success',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				} else {
					Swal.fire({
					  icon: 'error',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

	}
});

$('#ContactSupportForm').validate({
	ignore: "",
	rules: {
		subject: {
			required:true,
		},
		message: {
			required:true,
		},
	},
	messages: {
	},
	submitHandler: function(form) {
		var formData = $('#ContactSupportForm').serializeArray();
        $.ajax({
            type:'POST',
            url: "ajax/users.php",
			dataType: "json",
            data: formData,
            success:function(data){	
				if (data.success === "1") {
					Swal.fire({
					  icon: 'success',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
					$("input[name=subject]").val("");
					$("textarea[name=message]").val("");
				} else {
					Swal.fire({
					  icon: 'error',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

	}
});


function CheckIfUserFirstTime() {
	uniqueID = localStorage.getItem('uniqueID');
	if (!uniqueID) {
		$.getJSON( "ajax/users.php", {'CheckIfUserFirstTime':"1",'uniqueID':uniqueID}, function( data ) {
			code = data.code;
			localStorage.setItem('uniqueID', code);
		});	
		$("#StepsTutorialModal").modal("show");
	} 
}
function CheckIfUserLoggedIN() {
	var user_id = localStorage.getItem("user_id");
	if (user_id) {
		$.getJSON( "ajax/users.php", {'CheckIfUserLoggedIN':"1",'user_id':user_id}, function( data ) {
			if (data.success === "1") {
				location.reload();
			}
		});
	}
}

function SendUserIdToAndroid(user_id) {
	var ua = navigator.userAgent.toLowerCase();
	var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
	if(isAndroid) {
		Android.GetUserID(user_id);
	} 
}


$('#ForgotpwdForm').validate({
	ignore: "",
	rules: {
		email: {
			required:true,
			email:true
		}
	},
	messages: {
	},
	submitHandler: function(form) {
		var formData = $('#ForgotpwdForm').serializeArray();
        $.ajax({
            type:'POST',
            url: "ajax/users.php",
			dataType: "json",
            data: formData,
            success:function(data){	
				if (data.success === "1") {
					Swal.fire({
					  icon: 'success',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
					$("input[name=email]").val("");
				} else {
					Swal.fire({
					  icon: 'error',
					  title: data.msg,
					  timer: 2000,
					  showConfirmButton: false
					});
				}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

	}
});
