// ==============================
//    Validate Register form
// ==============================

jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return /^\w+$/i.test(value);
}, "Only letters, numbers and underscores can be used.");


jQuery(document).ready(function() {
   $("#register_form").validate({
      rules: {
         email: {
            email: true,
            maxlength: 255,
         },
         username: {
         	minlength: 4,
         	alphanumeric: true,
         },
         password: {
         	minlength: 6
         },
         confirm_pass: {
         	minlength: 6,
      		equalTo: "#password"
         },
         code : {
         	alphanumeric: true
         }
      },
      messages: {
      	confirm_pass: {
      		equalTo: "Passwords do not match"
      	},
      }
   });
});