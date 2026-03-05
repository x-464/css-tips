
const taskBtn = document.querySelectorAll(".tasks");

taskBtn.forEach(element => {
    element.addEventListener("click", (e) => {
        fetch(e.target.dataset.file)
        .then(res => res.text())
        .then(html => {
            document.querySelector(".taskWrapper").innerHTML = html;
        });
    })
});