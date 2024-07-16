const btnToggle = document.getElementById("btnToggle");
const btnToggleMenu = document.getElementById("btnToggleMenu");
const divMenu = document.getElementById("divMenu");


btnToggle.addEventListener("click", () => {
	divMenu.style.top = "0";
});

btnToggleMenu.addEventListener("click", () => {
	divMenu.style.top = "-950px";
});

const inputSearch = document.querySelector('#s');
if (inputSearch) {
	inputSearch.value = '';
	inputSearch.placeholder = 'Search for...';
}
