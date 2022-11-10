function calcularMedia(){
    var nota1 = document.getElementById('nota1').value;
    var nota2 = document.getElementById('nota2').value;
    var nota3 = document.getElementById('nota3').value;
    var nota4 = document.getElementById('nota4').value;
    
    if (nota1 == "" , nota2 == "" , nota3 == "" , nota4 == ""){
        alert("Insira alguma nota em todos os espaços.");
    }else{
        var media = (parseFloat(nota1) + parseFloat(nota2) + parseFloat(nota3)  + parseFloat(nota4)) / 4 ;
        if (isNaN(media)){
            alert("Alguma nota deu errado ou está vazia.")
        }else{
            document.getElementById('media').innerText = "MÉDIA =" + media;
        }
    }
}

// Anderson | João Pedro | Júlio