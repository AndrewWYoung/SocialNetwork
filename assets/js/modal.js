// MODAL
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
function DisplayPostModal() {
    modal.style.display = "block";
    var textArea = document.getElementById("comment");
    textArea.focus();
    textArea.style.fontSize = "18px";
}

btn.onclick = function() {
    modal.style.display = "block";
    var textArea = document.getElementById("comment");
    textArea.focus();
    textArea.style.fontSize = "18px";
}

// When the user clicks on <span> (x), close the modal
function ClosePostModal() {
    modal.style.display = "none";
}

span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        ClosePostModal();
    }
}

var urlString = "";
// preview image
function previewImage() {
    var preview = document.getElementById("image-preview");
    var imagePreview = document.createElement("div");

    urlString = "url(" + URL.createObjectURL(event.target.files[0]) + ")";
    imagePreview.setAttribute("style", "width: 100%");
    imagePreview.setAttribute("style", "height: 200px");
    // imagePreview.setAttribute("style", "background-position: center");
    // imagePreview.setAttribute("style", "background-size: cover");
    imagePreview.style.backgroundSize = "cover";
    imagePreview.style.backgroundPosition = "center";
    imagePreview.style.backgroundImage = urlString;

    preview.appendChild(imagePreview);
}

function VerifyContent(){
    var comment = document.getElementById('comment');
    if(comment.value.length > 0) { 
        document.getElementById('post-submit').disabled = false; 
    } else { 
        document.getElementById('post-submit').disabled = true;
    }
}