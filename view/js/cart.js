var products = document.getElementById('product-list');
products.addEventListener('click',function(event) {
	addToCart(event);
});
var orders = [];
var cart = document.getElementById("cart");
var cartItems = document.getElementById("cart-items");
cart.addEventListener('click',makeCheckout);
function checkAvailability(quantity, requiredQuantity) {
	if(quantity<requiredQuantity || isNaN(requiredQuantity) || requiredQuantity<1) {
			alert('please enter a valid quantity enter a maximum of '+ quantity);
			return false;
		}
		return true;
}

function addToCart(event) {
	var product = event.srcElement;
	if(product.classList.contains('cart-button')) {
		var productId = product.parentNode.parentNode.dataset.id;
		var requiredQuantity = parseInt(product.parentNode.firstChild.value);
		var quantity = parseInt(product.parentNode.firstChild.getAttribute('max'));
		if(!isAlreadyOrdered(productId, requiredQuantity, quantity )) {
			if(checkAvailability(quantity,requiredQuantity)) {
				var order = {};
				order['product_id'] = productId;
				order['order_quantity'] = requiredQuantity;
				orders.push(order);
				console.log(orders);
				createOrder(order);
			}
		}
	} 
}

function isAlreadyOrdered(productId, requiredQuantity, quantity) {
	for(var i=0; i < orders.length; i++){
		console.log(orders[i]['product_id'],productId);
		if(orders[i]['product_id'] == productId){
			requiredQuantity = requiredQuantity + orders[i]['order_quantity'];
			if(checkAvailability(quantity,requiredQuantity)){
				orders[i]['order_quantity'] = requiredQuantity;
			}
			return true;
		}
	}
	return false;
}

function createOrder(order) {
	var div = document.createElement('div');
	var content = document.createElement('p');
	content.innerHTML = "product Id : "+order['product_id']+" order quantity : "+order['order_quantity'];
	div.insertBefore(content,div.childNodes[0]);
	cartItems.appendChild(div);
}

function makeCheckout() {
	document.getElementById("json").value = JSON.stringify(orders);
}

function checkout() {
	var http_request = new XMLHttpRequest();
    try{
        // Opera 8.0+, Firefox, Chrome, Safari
        http_request = new XMLHttpRequest();
    }catch (e){
        // Internet Explorer Browsers
        try{
            http_request = new ActiveXObject('Msxml2.XMLHTTP');
        
        }catch (e) {
      
            try{
                http_request = new ActiveXObject('Microsoft.XMLHTTP');
            }catch (e){
                // Something went wrong
                alert('Your browser broke!');
                return false;
            }
        
        }
    }
    
    http_request.onreadystatechange = function(){
    
        if (http_request.readyState == 4  ){
            console.log(http_request.responseText);     
        }
    }
    http_request.open('POST', "http://localhost/invoice/view/product/checkout.php" , true);
    http_request.send(JSON.stringify(orders));
	
}
