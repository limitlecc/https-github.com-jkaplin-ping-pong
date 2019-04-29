function draw_win() {
	var grid = document.createElement('CANVAS');
	grid.id = "win";
	grid.width = 0.9 * window.innerWidth;
	grid.height = 0.4 * window.innerHeight;
	document.body.appendChild(grid);
}

function draw_lose() {

}
