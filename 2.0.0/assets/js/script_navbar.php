<script src="assets/lib/jquery/jquery-3.6.4.min.js"></script>
<script src="../assets/lib/jquery/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
function register() {
    window.location.href = 'register.php';
}
function favorites() {
    window.location.href = 'favorites.php';
}
function inbox() {
    window.location.href = 'inbox.php';
}
function Search() {
    $(document).ready(function () {
        var search = $('#search').val().trim();
        
        if(search === ''){
            alert('Please enter a search term.');
            return;
        }

        var formData = new FormData();
        formData.append('search', search);

        $.ajax({
            url: 'search.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                window.location.href = 'search.php?search=' + search;
            }
        });
    });
}

function registerCatg() {
    window.location.href = '../register.php';
}
function favoritesCatg() {
    window.location.href = '../favorites.php';
}
function SearchCatg() {
    $(document).ready(function () {
        var search = $('#search').val().trim();
        
        if(search === ''){
            alert('Please enter a search term.');
            return;
        }

        var formData = new FormData();
        formData.append('search', search);

        $.ajax({
            url: '../search.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                window.location.href = '../search.php?search=' + search;
            }
        });
    });
}
</script>