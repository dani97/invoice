var nav = document.getElementsByClassName('top-nav')[0];
console.log(nav);
nav.addEventListener('click', function (event) { performEvent(event)});
var currentForm = null;
var list = document.getElementById("product-list");


function performEvent(event) {
	var link = event.srcElement;
	list.classList.remove('hide');
	if(currentForm!=null){
		currentForm.classList.remove('show');
	}
	var form = document.getElementById(link.getAttribute('href').substr(1));
	console.log('form');
	if(form!=list){
		form.classList.add('show');
		console.log(form);
		currentForm = form;
		list.classList.add('hide');
	}else{
		list.classList.remove('hide');
	}
}