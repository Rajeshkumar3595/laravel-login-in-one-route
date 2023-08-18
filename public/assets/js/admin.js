$(document).ready(function(){
    $('.create-user').click(function(){
        alert('hello');
    })
})
$(function () {
$(".create-user").validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 20,
                },
                last_name: {
                	required: true,
                    maxlength: 20,
                   
                },
                email: {
                	 required: true,
                    email: true,
                    maxlength: 50
                    
                },
                password: {
                    required: true,
                    minlength: 5
                },
                profile_image: {
		            required: true,
		            extension: "jpg|jpeg|png|ico|bmp"
		        }
		    },
            messages: {
                first_name: {
                    required: "First Name is required",
                    maxlength: "Name cannot be more than 20 characters"
                },
                last_name: {
                    required: "Last Name is required",
                    maxlength: "Name cannot be more than 20 characters"
                },
                email: {
                	required: "Email is required",
                    email: "Email must be a valid email address",
                    maxlength: "Email cannot be more than 30 characters",
                    
                },
                password: {
                    required: "Password is required",
                    minlength: "Password must be at least 5 characters",
                },
                profile_image: {
		            required: "Please upload file.",
		            extension: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
		        },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        
	});
});