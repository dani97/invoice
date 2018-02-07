function  formDataToJson(form) {
	var formData = new FormData(form);
	var json = {};
	for(const [key,value] of formData.entries()){
		json[key] = value;
	}

	return json;
}

var form = document.getElementsByClassName("form")[0];
form.onsubmit = function(event) {
	event.preventDefault();
	var json = JSON.stringify(formDataToJson(form));
	console.log(json);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myObj = JSON.parse(this.responseText);
        console.log(myObj);
    }
};
xmlhttp.open("POST", "http://localhost/invoice/user/login.php", true);
xmlhttp.send(json);
}