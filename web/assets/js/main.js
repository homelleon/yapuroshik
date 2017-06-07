window.onload = function () {
	var button = document.getElementsByClassName('button');
	
	for(var i = 0; i < button.length; i++) {
		var b = button[i];
		
		b.onmouseover = function() {
			this.style.color = "red";
			this.style.backgroundColor = "blue";
		};
		
		b.onmouseout = function() {
			this.style.color = "";
			this.style.backgroundColor = "";
		};
		
		b.onclick = function() {
			this.style.backgroundColor = "rgb(0,0,125)";
			this.style.color = "rgb(10,0,0)";
			
			var self = this;
			function returnBack() {
				self.style.color = "red";
				self.style.backgroundColor = "blue";
			}
			setTimeout(returnBack, 100);
		};
	}
	
	var linkFooter = document.getElementsByClassName('footer')[0].getElementsByTagName('a');
	
	for(var i = 0; i < linkFooter.length; i++) {
		var l = linkFooter[i];
		
		l.onmouseover = function() {
			this.style.color = "white";
			this.style.border = "2px solid white";
		}
		
		l.onmouseout = function() {
			this.style.color = "";
			this.style.border = "";
		}
		
		l.onclick = function() {
			this.style.color = "blue";
			this.style.border = "2px solid blue";
			var self = this;
			function returnBack() {
				self.style.color = "white";
				self.style.border = "2px solid white";
			}
			setTimeout(returnBack, 100);
		}
	}
}

