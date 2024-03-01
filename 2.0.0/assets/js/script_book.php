<script src="assets/lib/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/lib/jquery/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
  function submitData(action) {
    $(document).ready(function () {
      var title = $("#title").val().trim();
      var text = $("#text").val().trim();
      var category = $("#category").val();
      var url = $("#url").val().trim();
      var cover = $("#cover")[0].files[0];

      if (title === "" || text === "" || url === "" || cover === "") {
        //$("#error-message").html("<p>All fields are required.</p>");
        alert("All fields are required.");
        return;
      }

      var formData = new FormData();
      formData.append('action', action);
      formData.append('id', $("#id").val());
      formData.append('title', title);
      formData.append('text', text);
      formData.append('category', category);
      formData.append('url', url);
      formData.append('cover', cover);

      $.ajax({
        url: 'function.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == "Inserted Successfully" || response == "Updated Successfully") {
            alert("Operation Successful!");
            window.location.href = 'manage-books.php';
          } else {
            alert(response);
          }
        }
      });
    });
  }

  function AddCover(action) {
    $(document).ready(function () {
      var url = $("#url").val().trim();
      var cover = $("#cover")[0].files[0];

      if (url === "" || cover === "") {
        alert("All fields are required.");
        return;
      }

      var formData = new FormData();
      formData.append('action', action);
      formData.append('url', url);
      formData.append('cover', cover);

      $.ajax({
        url: 'function.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == "Inserted Successfully") {
            alert("Operation Successful!");
            window.location.href = 'manage-covers.php';
          } else {
            alert(response);
          }
        }
      });
    });
  }

  function Favorites(action, userid, bookid) {
    $(document).ready(function () {
        if (userid === "null") {
            window.location.href = 'login.php';
            return;
        }

        var formData = new FormData();
        formData.append('action', action);
        formData.append('userid', userid);
        formData.append('bookid', bookid);

        $.ajax({
            url: 'function.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
              if (response == "login") {
                    window.location.href = 'login.php';
                    return;
                }
                if (response == "Book added to favorites successfully") {
                    $('#icon_' + bookid).removeClass('ri-heart-line').addClass('ri-heart-fill');
                    alert("Book added to favorites successfully");

                    $('.favorites #icon_' + bookid).removeClass('ri-heart-line').addClass('ri-heart-fill');
                    return;
                }
                if (response == "Book removed from favorites successfully") {
                    $('#icon_' + bookid).removeClass('ri-heart-fill').addClass('ri-heart-line');
                    alert("Book removed from favorites successfully");

                    $('.favorites #icon_' + bookid).removeClass('ri-heart-fill').addClass('ri-heart-line');
                    return;
                } else {
                    alert(response);
                }
            }
        });
    });
}

function Favorites2(action, userid, bookid) {
    $(document).ready(function () {
        if (userid === "null") {
            window.location.href = 'login.php';
            return;
        }

        var formData = new FormData();
        formData.append('action', action);
        formData.append('userid', userid);
        formData.append('bookid', bookid);

        $.ajax({
            url: '../function.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
              if (response == "login") {
                    window.location.href = '../login.php';
                    return;
                }
                if (response == "Book added to favorites successfully") {
                    $('#icon_' + bookid).removeClass('ri-heart-line').addClass('ri-heart-fill');
                    alert("Book added to favorites successfully");
                    return;
                }
                if (response == "Book removed from favorites successfully") {
                    $('#icon_' + bookid).removeClass('ri-heart-fill').addClass('ri-heart-line');
                    alert("Book removed from favorites successfully");
                    return;
                } else {
                    alert(response);
                }
            }
        });
    });
}

  function AddComment(action) {
    $(document).ready(function () {
        var userid = $("#userid").val().trim();
        var bookid = $("#bookid").val().trim();
        var comment = $("#comment").val().trim();

        if (userid === "null") {
            window.location.href = 'login.php';
            return;
        }
        if (comment === "") {
            alert("Fields are required.");
            return;
        }

        var formData = new FormData();
        formData.append('action', action);
        formData.append('userid', userid);
        formData.append('bookid', bookid);
        formData.append('comment', comment);

        $.ajax({
            url: 'function.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
              if (response == "Comment added successfully") {
                alert("Comment added successfully");
              } else {
                alert(response);
              }
            }
        });
    });
}

  function DeleteBook(id) {
    if (confirm("Are you sure you want to delete this book?")) {
      var formData = new FormData();
      formData.append('action', 'deletebook');
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

function DeleteCover(id) {
    if (confirm("Are you sure you want to delete this cover?")) {
      var formData = new FormData();
      formData.append('action', 'deletecover');
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

function DeleteFavorites(id) {
    if (confirm("Are you sure you want to delete this favorites?")) {
      var formData = new FormData();
      formData.append('action', 'deletefavorites');
      formData.append('id', id);

      $.ajax({
        url: 'function.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == "Book removed from favorites successfully") {
            $("#" + id).css("display", "none");
          }
        }
      });
    }
}
</script>