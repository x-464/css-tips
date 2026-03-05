
const task1Btn = document.querySelector(".task1");
const task2Btn = document.querySelector(".task2");
const task3Btn = document.querySelector(".task3");

task1Btn.addEventListener("click", (e) => {
    fetch("task1.html")
    .then(res => res.text())
    .then(html => {
        document.querySelector(".taskWrapper").innerHTML = html;
    });
})

task2Btn.addEventListener("click", (e) => {
    fetch("task2.html")
    .then(res => res.text())
    .then(html => {
        document.querySelector(".taskWrapper").innerHTML = html;
    });
})