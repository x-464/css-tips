
// search bar and results div selection
const searchBar = document.querySelector(".searchBar");
const results = document.querySelector(".searchResults")

// sets up debounce timer, great for server performance
// search can only happen once every 300ms
let debounceTimer;

// checks for input on the search bar
searchBar.addEventListener("input", async (e) => {

    // resets the debounce timer
    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(async () => {
        const data = await fetch(`includes/search.php?q=${e.target.value}`);

        const html = await data.text();

        results.innerHTML = html;
    }, 300)

})