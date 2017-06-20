window.onload = function () {
    var i = 0;
    var button = document.getElementsByClassName('button');

    for (i = 0; i < button.length; i++) {
        var b = button[i];

        b.onclick = function () {
            var $bgColor = this.style.backgroundColor;
            var $color = this.style.color;
            this.style.backgroundColor = "rgb(0,0,125)";
            this.style.color = "rgb(10,0,0)";

            var self = this;
            function returnBack() {
                self.style.backgroundColor = $bgColor;
                self.style.color = $color;
            }
            setTimeout(returnBack, 100);
        };
    }

    var linkFooter = document.getElementsByClassName('footer')[0].getElementsByTagName('a');

    for (i = 0; i < linkFooter.length; i++) {
        var l = linkFooter[i];

        l.onclick = function () {
            var $border = this.style.border;
            var $color = this.style.color;
            this.style.border = "2px solid blue";
            this.style.color = "blue";
            var self = this;
            function returnBack() {
                self.style.border = $border;
                self.style.color = $color;
            }
            setTimeout(returnBack, 100);
        }
    }
}

