var logra;
           var bair;
           var cida;
           var esta;
           function limpa_formulário_cep() {
                   //Limpa valores do formulário de cep.
                   document.getElementById(logra).value=("");
                   document.getElementById(bair).value=("");
                   document.getElementById(cida).value=("");
                   document.getElementById(esta).value=("");
           }

           function meu_callback(conteudo) {
               if (!("erro" in conteudo)) {
                   //Atualiza os campos com os valores.
                   document.getElementById(logra).value=(conteudo.logradouro);
                   document.getElementById(bair).value=(conteudo.bairro);
                   document.getElementById(cida).value=(conteudo.localidade);
                   document.getElementById(esta).value=(conteudo.uf);
               } //end if.
               else {
                   //CEP não Encontrado.
                   limpa_formulário_cep();
                   alert("CEP não encontrado.");
               }
           }

           function pesquisacep(valor, log, bai, cid, es) {
               logra = log;
               bair = bai;
               cida = cid;
               esta = es;
               //Nova variável "cep" somente com dígitos.
               var cep = valor.replace(/\D/g, '');

               //Verifica se campo cep possui valor informado.
               if (cep != "") {

                   //Expressão regular para validar o CEP.
                   var validacep = /^[0-9]{8}$/;

                   //Valida o formato do CEP.
                   if(validacep.test(cep)) {

                       //Preenche os campos com "..." enquanto consulta webservice.
                       document.getElementById(logra).value="...";
                       document.getElementById(bair).value="...";
                       document.getElementById(cida).value="...";
                       document.getElementById(esta).value="...";

                       //Cria um elemento javascript.
                       var script = document.createElement('script');

                       //Sincroniza com o callback.
                       script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                       //Insere script no documento e carrega o conteúdo.
                       document.body.appendChild(script);

                   } //end if.
                   else {
                       //cep é inválido.
                       limpa_formulário_cep();
                       alert("Formato de CEP inválido.");
                   }
               } //end if.
               else {
                   //cep sem valor, limpa formulário.
                   limpa_formulário_cep();
               }
           };
