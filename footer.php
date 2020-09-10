    <footer>

    </footer>
    <script>
        function myFunction(id) {
            var form = document.getElementById(`edit-form_${id}`);
            var edit_button = document.getElementById(`edit-button_${id}`);
            var user_post = document.getElementById(`user-post_${id}`);
            if (form.style.display === "none") {
                form.style.display = "block";
                user_post.style.display = "none";
                edit_button.innerHTML = "Cancel";
            } else {
                form.style.display = "none";
                user_post.style = "block";
                edit_button.innerHTML = "Edit";
            }
        }

        document.getElementById("cover-input").onchange = function() {
            document.getElementById("form-submit").click();
        };
    </script>
</body>
</html>