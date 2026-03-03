
document.querySelector(".loginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const password = document.querySelector(".passwordField").value;

    try{ 
        const res = await fetch("https://felixhornby.com/api/cheatsheet/auth.php", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({password})
        })

        const data = await res.json();

        if (data.success){
            sessionStorage.setItem("loggedIn", "true");
            window.location.href = "sheet.html";
        }
        else{
            password.value = "";
        }
    }
    catch(error) {
        console.error(error);
    }
})