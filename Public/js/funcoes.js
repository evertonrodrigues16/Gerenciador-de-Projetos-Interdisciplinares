/*!
* Funções genéricas do Sistema Risk Manager
* Todos os direitos reservados - Cybersoft Sistemas Web
*/


    function myFunction(instrucao, btnNovo, btnSalvar, btnAtualizar, btnEditar, btnCancelar, btnExcluir, elemento){
        switch(instrucao) {
            case "novoAlternativo":
                document.getElementById(btnNovo).disabled = true;
                document.getElementById(btnSalvar).disabled = false;
                document.getElementById(btnAtualizar).disabled = true;
                document.getElementById(btnEditar).disabled = true;
                document.getElementById(btnCancelar).disabled = false;
                document.getElementById(btnExcluir).disabled = true;
                document.getElementById("1").readonly = false;                   
            break;
            case "novo":
                document.getElementById(btnNovo).disabled = true;
                document.getElementById(btnSalvar).disabled = false;
                document.getElementById(btnAtualizar).disabled = true;
                document.getElementById(btnEditar).disabled = true;
                document.getElementById(btnCancelar).disabled = false;
                document.getElementById(btnExcluir).disabled = true;
                document.getElementById("1").readonly = false;
                
                var x = document.getElementsByTagName("INPUT");
                
                var i = 0;
                for (i=1; i <x.length; i++){
                    x[i].readOnly = false;
                    x[i].value = "";                    
                }
                
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = false;
                    y[j].options[0].selected = true;                    
                }
                
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = false;
                    z[i].value = "";                    
                }
                
                document.getElementById("textFiltro").readOnly = true;                    
            break;
            case "inicial":
                document.getElementById(btnNovo).disabled = false;
                document.getElementById(btnSalvar).disabled = true;
                document.getElementById(btnAtualizar).disabled = true;
                document.getElementById(btnEditar).disabled = true;
                document.getElementById(btnCancelar).disabled = true;
                document.getElementById(btnExcluir).disabled = true;
                var x = document.getElementsByTagName("INPUT");
                var i = 0;
                for (i=0; i <x.length; i++){
                    x[i].readOnly = true;
                    }  
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = true;
                    y[j].options[0].selected = true;                    
                }
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = true;             
                }
                document.getElementById("textFiltro").readOnly = false; 
            break;
            case "salvar":
                document.getElementById(btnNovo).disabled = false;
                document.getElementById(btnSalvar).disabled = true;
                document.getElementById(btnAtualizar).disabled = true;
                document.getElementById(btnEditar).disabled = true;
                document.getElementById(btnCancelar).disabled = true;
                document.getElementById(btnExcluir).disabled = true;
                var x = document.getElementsByTagName("INPUT");
                var i = 0;
                for (i=0; i <x.length; i++){
                    x[i].readOnly = true;
                    }    
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = true;
                    y[j].options[0].selected = true;                    
                }
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = true;             
                }
                document.getElementById("textFiltro").readOnly = false;
            break;
            case "atualizar":
                document.getElementById(btnNovo).disabled = false;
                document.getElementById(btnSalvar).disabled = true;
                document.getElementById(btnAtualizar).disabled = true;
                document.getElementById(btnEditar).disabled = true;
                document.getElementById(btnCancelar).disabled = true;
                document.getElementById(btnExcluir).disabled = true;
                var x = document.getElementsByTagName("INPUT");
                var i = 0;
                for (i=0; i <x.length; i++){
                    x[i].readOnly = true;
                    }  
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = true;
                    y[j].options[0].selected = true;                    
                }
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = true;            
                }
                document.getElementById("textFiltro").readOnly = false;  
            break;
            case "excluir":
                document.getElementById(btnNovo).disabled = false;
                document.getElementById(btnSalvar).disabled = true;
                document.getElementById(btnAtualizar).disabled = true;
                document.getElementById(btnEditar).disabled = true;
                document.getElementById(btnCancelar).disabled = true;
                document.getElementById(btnExcluir).disabled = true;
                var x = document.getElementsByTagName("INPUT");
                var i = 0;
                for (i=0; i <x.length; i++){
                    x[i].readOnly = true;
                    }  
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = true;
                    y[j].options[0].selected = true;                    
                }
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = true;          
                }
                document.getElementById("textFiltro").readOnly = false;  
            break;
            case "cancelar":
                document.getElementById(btnNovo).disabled = false;
                document.getElementById(btnSalvar).disabled = true;
                document.getElementById(btnAtualizar).disabled = true;
                document.getElementById(btnEditar).disabled = true;
                document.getElementById(btnCancelar).disabled = true;
                document.getElementById(btnExcluir).disabled = true;
                var x = document.getElementsByTagName("INPUT");
                var i = 0;
                for (i=0; i <x.length; i++){
                    x[i].readOnly = true;
                    x[i].value = "";
                    }  
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = true;
                    y[j].options[0].selected = true;                    
                }
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = true;  
                    z[i].value = "";  
                }
                document.getElementById("textFiltro").readOnly = false;  
            break;
            case "bloqueado":
                var x = document.getElementsByTagName("INPUT");
                var i = 0;
                for (i=0; i <x.length; i++){
                    x[i].readOnly = true;
                    //x[i].value = "";
                    }  
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = true;
                    //y[j].options[0].selected = true;                    
                }
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = true;  
                    //z[i].value = "";  
                }
                document.getElementById("textFiltro").readOnly = false;  
            break;
            case "editar":
                document.getElementById(btnNovo).disabled = true;
                document.getElementById(btnSalvar).disabled = true;
                document.getElementById(btnAtualizar).disabled = false;
                document.getElementById(btnEditar).disabled = true;
                document.getElementById(btnCancelar).disabled = false;
                document.getElementById(btnExcluir).disabled = false;
                var x = document.getElementsByTagName("INPUT");
                var i = 0;
                for (i=1; i <x.length; i++){
                    x[i].readOnly = false;
                    }   
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = false;
                    //y[j].options[0].selected = true;                    
                }
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = false;                
                }
                document.getElementById("textFiltro").readOnly = true;  
            break;
            case "grid2":
                document.getElementById(btnNovo).disabled = true;
                document.getElementById(btnSalvar).disabled = true;
                document.getElementById(btnAtualizar).disabled = false;
                document.getElementById(btnEditar).disabled = true;
                document.getElementById(btnCancelar).disabled = false;
                document.getElementById(btnExcluir).disabled = false;
                var x = document.getElementsByTagName("INPUT");
                var i = 0;
                for (i=1; i <x.length; i++){
                    x[i].readOnly = false;
                    }      
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = false;
                    //y[j].options[0].selected = true;                    
                }
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = false;           
                }
                document.getElementById("textFiltro").readOnly = true;             
            break;
            case "grid":
                document.getElementById(btnNovo).disabled = true;
                document.getElementById(btnSalvar).disabled = true;
                document.getElementById(btnAtualizar).disabled = true;
                document.getElementById(btnEditar).disabled = false;
                document.getElementById(btnCancelar).disabled = false;
                document.getElementById(btnExcluir).disabled = false;                 
                var x = document.getElementsByTagName("INPUT");
                var i = 0;
                for (i=1; i <x.length; i++){
                    x[i].readOnly = true;
                    } 
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = true;
                    //y[j].options[0].selected = true;                    
                }
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = true;            
                }
                document.getElementById("textFiltro").readOnly = true; 
            break;
            case "buscar":
                document.getElementById(btnNovo).disabled = true;
                document.getElementById(btnSalvar).disabled = true;
                document.getElementById(btnAtualizar).disabled = true;
                document.getElementById(btnEditar).disabled = false;
                document.getElementById(btnCancelar).disabled = false;
                document.getElementById(btnExcluir).disabled = false;
                var x = document.getElementsByTagName("INPUT");
                var i = 0;
                for (i=0; i <x.length; i++){
                    x[i].readOnly = true;
                    } 
                var y = document.getElementsByTagName("SELECT");
                for (var j=0; j<y.length; j++){
                    y[j].disabled = true;
                    y[j].options[0].selected = true;                    
                }
                var z = document.getElementsByTagName("TEXTAREA");
                
                var i = 0;
                for (i=0; i <z.length; i++){
                    z[i].readOnly = true;         
                }
                document.getElementById("textFiltro").readOnly = false;   
            break;
            default:
            break;
        }
        
    }
    
    