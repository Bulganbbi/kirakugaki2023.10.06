document.getElementById("likeButton").addEventListener("click", function() {
    var currentCount = parseInt(document.getElementById("likeCount").textContent);
    currentCount += 1;
    document.getElementById("likeCount").textContent = currentCount;
});
