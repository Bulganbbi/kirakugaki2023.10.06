document.getElementById("likeButton").addEventListener("click", function() {
    var currentCount = parseInt(document.getElementById("likeCount").textContent);
    currentCount += 1;
    document.getElementById("likeCount").textContent = currentCount;

    // ボタンのクラスを変更して写真を切り替える
    var likeButton = document.getElementById("likeButton");
    likeButton.classList.remove("not-liked");
    likeButton.classList.add("liked");
});

//drop textarea
const questions = document.querySelectorAll('.question');

questions.forEach(question => {
    question.addEventListener('click', () => {
        const answer = question.querySelector('.answer');
        if (answer.style.display === 'block') {
            answer.style.display = 'none';
        } else {
            answer.style.display = 'block';
        }
    });
});
