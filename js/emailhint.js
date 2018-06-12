function Hint(str){
	    if (str.length == 0){
	        document.getElementById("demo").innerHTML = "";
	        return;
	    }
	    else{
	        var xmlhttp = new XMLHttpRequest();
	        xmlhttp.onreadystatechange = function(){
	            if (this.readyState == 4 && this.status == 200){
	            	var text = this.responseText.replace(/ /g,'');
	            	if(text == "Perfect"){
	            		document.getElementById("demo").style.color = "blue";
	            		document.getElementById("demo").innerHTML ="Perfect" ;
	            		document.getElementById("isvalid").value=1;	
	            	}
	            	else{
	              		document.getElementById("demo").style.color = "red";
	              		document.getElementById("isvalid").value=0;
	             		document.getElementById("demo").innerHTML ="Email already exist" ;
	            	}
	            }
	        };
	        xmlhttp.open("GET", "emailhint.php?q=" + str, true);
	        xmlhttp.send();
	    }
}