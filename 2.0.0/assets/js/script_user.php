<script src="assets/lib/jquery/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    // function SignIN(action) {
    //     $(document).ready(function () {
    //         var login_identifier = $("#login_identifier").val().trim();
    //         var password = $("#password").val().trim();

    //         if (login_identifier === "" || password === "") {
    //             alert("Username/Email and Password are required.");
    //             return;
    //         }

    //         var formData = new FormData();
    //         formData.append('action', action);
    //         formData.append('login_identifier', login_identifier);
    //         formData.append('password', password);

    //         $.ajax({
    //             url: 'function.php',
    //             type: 'post',
    //             data: formData,
    //             contentType: false,
    //             processData: false,
    //             success: function (response) {
    //                 if (response === "user") {
    //                     window.location.href = 'home.php';
    //                     return;
    //                 }                    
    //                 if (response === "admin") {
    //                     window.location.href = 'dashboard.php';
    //                     return;
    //                 }
    //                  else {
    //                     alert(response);
    //                     return;
    //                 }
    //             }
    //         });
    //     });
    // }

    function submitData(action) {
    $(document).ready(function () {
      var username = $("#username").val().trim();
      var email    = $("#email").val().trim();
      var password = $("#password").val().trim();
      var fullname = $("#fullname").val().trim();
      var avatar   = $("#avatar")[0].files[0];
      var usertype = $("#usertype").val();

      if (username === "" || email === "" || password === "" || fullname === "" || usertype === "") {
        //$("#error-message").html("<p>All fields are required.</p>");
        alert("All fields are required.");
        return;
      }
      
      $('#loading').show();
      var formData = new FormData();
      formData.append('action', action);
      formData.append('id', $("#id").val());
      formData.append('username', username);
      formData.append('email', email);
      formData.append('password', password);
      formData.append('fullname', fullname);
      formData.append('avatar', avatar);
      formData.append('usertype', usertype);


      $.ajax({
        url: 'function.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          $('#loading').hide();
          if (response == "Inserted Successfully" || response == "Updated Successfully") {
            alert("Operation Successful!");
            window.location.href = 'manage-users.php';
          } else {
            alert(response);
          }
        }
      });
    });
  }

  function EditUserMe(action) {
      $(document).ready(function () {
        var username = $("#username").val().trim();
        var email    = $("#email").val().trim();
        var password = $("#password").val().trim();
        var fullname = $("#fullname").val().trim();
        var avatar   = $("#avatar")[0].files[0];

        if (username === "" || email === "" || password === "" || fullname === "") {
          alert("All fields are required.");
          return;
        }

        var formData = new FormData();
        formData.append('action', action);
        formData.append('id', $("#id").val());
        formData.append('username', username);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('fullname', fullname);
        formData.append('avatar', avatar);

        $.ajax({
          url: 'function.php',
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response == "Inserted Successfully" || response == "Updated Successfully") {
              alert("Operation Successful!");
              window.location.href = 'profile.php';
            } else {
              alert(response);
            }
          }
        });
      });
    }

    function ChangePw(action) {
        $(document).ready(function () {
            var oldPassword = $("#old_password").val().trim();
            var newPassword = $("#new_password").val().trim();
            var confirmPassword = $("#confirm_password").val().trim();

            if (oldPassword === "" || newPassword === "" || confirmPassword === "") {
                alert("All fields are required.");
                exit;
            }

            if (newPassword !== confirmPassword) {
                alert("New Password and Confirm Password do not match.");
                exit;
            }

            var formData = new FormData();
            formData.append('action', action);
            formData.append('old_password', oldPassword);
            formData.append('new_password', newPassword);
            formData.append('confirm_password', confirmPassword);

            $.ajax({
                url: 'function.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response === "Password changed successfully") {
                        alert("Password changed successfully!");
                        window.location.href = 'profile.php';
                    } else {
                        alert(response);
                    }
                }
            });
        });
    }


    function deleteUser(id) {
    if (confirm("Are you sure you want to delete this User?")) {
      var formData = new FormData();
      formData.append('action', 'deleteuser');
      formData.append('id', id);

      $.ajax({
        url: 'function.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == "Deleted Successfully") {
            $("#" + id).css("display", "none");
          }
        }
      });
    }
}
</script>
