function playClickSound(event)
{
	if (event.target.tagName === "BUTTON")
	{
		document.getElementById("menu-select-1").play();
	}
	else if (event.target.tagName === "INPUT" && event.target.classList[0] !== "submit-button")
	{
		document.getElementById("menu-select-2").play();
	}
	else if (event.target.tagName === "A")
	{
		document.getElementById("menu-link").play();
	}
}


var last;
function playHoverSound(event)
{
	if (event.target.tagName === "BUTTON")
	{
		document.getElementById("menu-mouseover").play();
		document.getElementById(event.target.id).style.opacity = 1;
		last = document.getElementById(event.target.id);
	}
	else
	{
		last.style.opacity = 0.3;
	}
}

function drawSpeaker()
{
	const canvas = document.getElementById("speaker");
	canvas.width = 100;
	canvas.height = 100;

	const c = canvas.getContext('2d');

	c.fillStyle = "rgba(255, 255, 255, 0.5)";
	c.strokeStyle = "white";

	c.rect(0, 30, 20, 40);
	c.fill();
	c.stroke();

	c.beginPath();
	c.moveTo(20, 30);
	c.lineTo(60, 10);
	c.lineTo(60, 90);
	c.lineTo(20, 70);
	c.fill();
	c.stroke();

	c.beginPath();
	c.arc(60, 50, 10, Math.PI / 4, -Math.PI / 4, true);
	c.stroke();
	c.beginPath();
	c.arc(60, 50, 20, Math.PI / 4, -Math.PI / 4, true);
	c.stroke();
	c.beginPath();
	c.arc(60, 50, 30, Math.PI / 4, -Math.PI / 4, true);
	c.stroke();
}

function toggleMusic()
{
	const music = document.getElementById("background-video");
	const line = document.getElementById("line");
	line.classList.toggle('mute');
	music.muted = !music.muted;
}

function toggleLine()
{
	const line = document.getElementById("line");
	line.classList.toggle('mute-hover');
}

function connectButton(button, color)
{
	document.querySelectorAll(".con-login").forEach(function(e, i, arr) {
		arr[i].style.backgroundColor = "white";
	});
	document.querySelectorAll(".login-line").forEach(function(e, i, arr) {
		arr[i].style.backgroundColor = "white";
	});
	document.querySelectorAll(".con-credits").forEach(function(e, i, arr) {
		arr[i].style.backgroundColor = "white";
	});
	document.querySelectorAll(".credits-line").forEach(function(e, i, arr) {
		arr[i].style.backgroundColor = "white";
	});

	document.querySelectorAll(".con-" + button).forEach(function(e, i, arr) {
		arr[i].style.backgroundColor = color;
	});
	document.querySelectorAll("." + button + "-line").forEach(function(e, i, arr) {
		arr[i].style.backgroundColor = color;
	});
}

function toggleModal()
{
	document.querySelectorAll(".con-credits").forEach(function(e, i, arr) {
		arr[i].style.display = "none";
	});
	if (this.id === "login-button")
	{
		document.querySelectorAll(".credits-line").forEach(function(e, i, arr) {
			arr[i].style.display = "block";
		});
		document.getElementById("credits").style.display = "none";
		if (document.getElementById("login").style.display !== "flex")
		{
			connectButton("login", "orange");
			document.getElementById("login").style.display = "flex";
		}
		else
		{
			connectButton("login", "white");
			document.getElementById("login").style.display = "none";
		}
	}
	else if (this.id === "credits-button")
	{
		document.getElementById("login").style.display = "none";
		if (document.getElementById("credits").style.display !== "flex")
		{
			document.querySelectorAll(".credits-line").forEach(function(e, i, arr) {
				arr[i].style.display = "block";
			});
			document.querySelectorAll(".con-credits").forEach(function(e, i, arr) {
				arr[i].style.display = "block";
			});
			connectButton("credits", "green");
			document.getElementById("credits").style.display = "flex";
		}
		else
		{
			connectButton("credits", "white");
			document.getElementById("credits").style.display = "none";
		}
	}
}

function validateLogin()
{
	// cancel form default submit action
	// create ajax request
	// call ajax to the url connected to action in form
}

