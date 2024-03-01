<script src="assets/lib/jquery/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
        function deleteMessage(id) {
            if (confirm("Are you sure you want to delete this message?")) {
                var formData = new FormData();
                formData.append('action', 'deletemessage');
                formData.append('id', id);
                $('#loading').show();

                $.ajax({
                    url: 'function.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#loading').hide();
                        if (response == "Deleted Successfully") {
                            $("#" + id).css("display", "none");
                        }
                    }
                });
            }
        }
        function deleteMessageView(id) {
        if (confirm("Are you sure you want to delete this message?")) {
            var formData = new FormData();
            formData.append('action', 'deletemessage');
            formData.append('id', id);

            $.ajax({
                url: 'function.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "Deleted Successfully") {
                        window.location.href = 'inbox.php';
                    }
                }
            });
        }
    }
</script>