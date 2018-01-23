var arg;
var arg2;
var arg3;
var arg4;
var arg5;
var arg6;
var arg7;
var arg8;
var arg9;
var url;
var met;
var cam1;
var cam2;
var ele;

function filtrarAjax(local){
    url = local;
    arg = document.getElementById("textFiltro").value;
    $.post(url, {submit:"filtrar", argumento:arg}, function (tabela){ document.getElementById("ajax").innerHTML = tabela; }, "html");            
}
function ajax(local,metodo, id, element, campo1, campo2){
    url = local;
    arg = id;
    met = metodo;
    ele = element;
    cam1 = campo1;
    cam2 = campo2;
    $.post(url, {submit:met, argumento:arg, camp1:cam1, camp2:cam2}, function (tabela){ document.getElementById(ele).innerHTML = tabela; }, "html");
}
function ajax2(local,metodo, id, id2, element, campo1, campo2){
    url = local;
    arg = id;
    arg2 = id2;
    met = metodo;
    ele = element;
    cam1 = campo1;
    cam2 = campo2;
    $.post(url, {submit:met, argumento:arg, argumento2:arg2, camp1:cam1, camp2:cam2}, function (tabela){ document.getElementById(ele).innerHTML = tabela; }, "html");
}
function ajax3(local,metodo, id, id2, id3, element, campo1, campo2){
    url = local;
    arg = id;
    arg2 = id2;
    arg3 = id3;
    met = metodo;
    ele = element;
    cam1 = campo1;
    cam2 = campo2;
    $.post(url, {submit:met, argumento:arg, argumento2:arg2, argumento3:arg3, camp1:cam1, camp2:cam2}, function (tabela){ document.getElementById(ele).innerHTML = tabela; }, "html");
}
function ajax4(local,metodo, id, id2, id3, id4, element, campo1, campo2){
    url = local;
    arg = id;
    arg2 = id2;
    arg3 = id3;
    arg4 = id4;
    met = metodo;
    ele = element;
    cam1 = campo1;
    cam2 = campo2;
    $.post(url, {submit:met, argumento:arg, argumento2:arg2, argumento3:arg3, argumento4:arg4,  camp1:cam1, camp2:cam2}, function (tabela){ document.getElementById(ele).innerHTML = tabela; }, "html");
}
function ajax5(local,metodo, id,id2, id3, id4, id5, element, campo1, campo2){
    url = local;
    arg = id;
    arg2 = id2;
    arg3 = id3;
    arg4 = id4;
    arg5 = id5;
    met = metodo;
    ele = element;
    cam1 = campo1;
    cam2 = campo2;
    $.post(url, {submit:met, argumento:arg, argumento2:arg2, argumento3:arg3, argumento4:arg4, argumento5:arg5, camp1:cam1, camp2:cam2}, function (tabela){ document.getElementById(ele).innerHTML = tabela; }, "html");
}
function ajaxConsultarprojeto(nome, palavras_chave, cod_curso){
    url = '/consultaprojeto';
    arg = nome;
    arg2 = palavras_chave;
    arg3 = cod_curso;
    $.post(url, {submit:'filtrar', nome_projeto:arg, palavras_chave:arg2, cod_curso:arg3}, 
            function (tabela){ document.getElementById('ajax').innerHTML = tabela; }, "html");
}
function ajaxEditarMatricula(id){
    url = '/editarmatricula';
    arg = id;
    $.post(url, {submit:"index", codAluno:arg}, function (tabela){ document.getElementById("modal2").innerHTML = tabela; }, "html");
}