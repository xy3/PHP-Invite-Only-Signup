// ==============================
//    Validate Register form
// ==============================

jQuery(document).ready(function() {
   $("#register_form").validate({
      rules: {
         email: {
            required: true,
            email: true,
            maxlength: 255,
         },
         user: {
         	required: true,
         	minlength: 4
         },
         pass: {
         	required: true,
         	minlength: 6
         },
         confirm_pass: {
         	required: true,
         	minlength: 6,
      		equalTo: "#password"
         }
      },
      messages: {
      	email: {
      		required: "Please enter your email",
      	},
      	user: {
      		required: "Please enter your username",
      		minlength: "Minimum username length is 4"
      	},
      	pass: {
      		required: "Please enter your password",
      		minlength: "Minimum password length is 6"
      	},
      	confirm_pass: {
      		required: "Please enter your password",
      		minlength: "Minimum password length is 6",
      		equalTo: "Passwords do not match"
      	},
      }
   });
});