function oklogin(){
	var u = document.getElementById('username');
	var p = document.getElementById('password');
	
	if((u.value != '' && u.value.length >0) && (p.value != '' && p.value.length >0)){
		return true;
	}else{
		return false;
	}
}