var nav = document.getElementsByClassName('top-nav')[0];
nav.addEventListener('click', function (event) { performEvent(event)});
var currentForm = null;
function performEvent(event) {
	var link = event.srcElement;
	if(currentForm!=null){
		currentForm.classList.remove('show');
	}
	var form = document.getElementById(link.getAttribute('href').substr(1));
	form.classList.add('show');
	console.log(form);
	currentForm = form;
}