function show(guest, done) {
	if (!guest && !participant)
	{
		document.getElementById("enter").style.display = "block";
	}
	if (!guest && done)
	{
		document.querySelector(".container").style.display = "block";
	}
}

function enterTour() {
	
}
