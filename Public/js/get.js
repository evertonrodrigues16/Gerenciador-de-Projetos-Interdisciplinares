    function getValores(id,row,col) {
        var x = document.getElementById(id).rows[row].cells;

        for (var i=0; i < col; i++){
            y = document.getElementById(i);
            if (y.tagName != "SELECT"){
                y.value = x[i].innerHTML;
                /*var str = y.value;
                str = str.replace(/\s{2,}/g, ' ');
                y.value = str;*/
            }
            else{
                for (var j=0; j<y.options.length; j++){
                    var str = x[i].innerHTML;
                    if (y.options[j].innerHTML == str){
                        y.options[j].selected = true;
                        break;
                    }
                }
            }
        }
    }   

