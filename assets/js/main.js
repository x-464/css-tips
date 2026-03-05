
const taskBtns = document.querySelectorAll(".tasks");

let lastPressed = null;
let arrowPos = 0;

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
                        if (arrowPos === 0){
                            openReminderBox();
                            arrowPos = 1;
                        }
                        else{
                            closeReminderBox();
                            arrowPos = 0;
                        };
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

function openReminderBox() {

    const reminderBox = document.querySelector(".task2Reminder");
    reminderBox.style.left = "0";

    const reminderArrow = document.querySelector(".arrow");
    reminderArrow.style.transform = "translateX(7px) rotateY(0deg) rotateZ(-135deg)";
};

function closeReminderBox() {

    const reminderBox = document.querySelector(".task2Reminder");
    reminderBox.style.left = "-290px";

    const reminderArrow = document.querySelector(".arrow");
    reminderArrow.style.transform = "translateX(-7px) rotateY(180deg) rotateZ(-135deg)";
};