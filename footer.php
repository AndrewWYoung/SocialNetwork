    <footer>

    </footer>
    <script>
        function EditPost(id) {
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

        // Menu
        document.getElementById("cover-input").onchange = function() {
            console.log("ERERE");
            document.getElementById("cover-form").submit();
        };

        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>