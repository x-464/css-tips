
const taskBtns = document.querySelectorAll(".tasks");

let lastPressed = null;

taskBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
        if (lastPressed === btn){
            document.querySelector(".taskWrapper").innerHTML = "";
            lastPressed = null;
        }
        else{
            fetch(e.target.dataset.file)
            .then(res => res.text())
            .then(html => {
                document.querySelector(".taskWrapper").innerHTML = html;
                showText();

                if (btn.classList.contains("task2")) {

                    document.querySelector(".arrow").addEventListener("click", () => {
                            reminderBoxChangeState()
                    });
                };
            });
            lastPressed = btn;
        };
    });
});


function showText() {

    document.querySelectorAll(".taskWrapper li").forEach((item, index) => {
        item.style.opacity = "0";
        item.style.transform = "translateY(-5px)";
        item.style.transition = "opacity 0.25s ease-in-out, transform 0.25s ease-in-out";

        setTimeout(() => {
            item.style.opacity = "1";
            item.style.transform = "translateY(0)";
        }, index * 10);
    });

};


function reminderBoxChangeState() {
    const reminderBox = document.querySelector(".task2Reminder");
    const reminderArrow = document.querySelector(".arrow");
    reminderBox.classList.toggle("active");
    reminderArrow.classList.toggle("active");
};

// function openReminderBox() {
//     const reminderBox = document.querySelector(".task2Reminder");
//     const reminderArrow = document.querySelector(".arrow");
//     reminderBox.classList.toggle("active");
//     reminderArrow.classList.toggle("active");
// };

// function closeReminderBox() {
//     const reminderBox = document.querySelector(".task2Reminder");
//     const reminderArrow = document.querySelector(".arrow");
//     reminderBox.classList.toggle("active");
//     reminderArrow.classList.toggle("active");
// };