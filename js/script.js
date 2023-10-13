// var settingsmenu = document.querySelector(".settings-menu");
// var whiteBtn = document.getElementById("white-btn");

// function settingsMenuToggle(){
//     settingsmenu.classList.toggle("settings-menu-height");

// }
// whiteBtn.onclick = function(){
//     whiteBtn.classList.toggle("white-btn-on");
//     document.body.classList.toggle("white-theme");
// }

const questions = document.querySelectorAll('.question');
        questions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementElementSibling;
                answer.style.display = answer.style.display === 'none' ? 'block' : 'none';
            });
        });