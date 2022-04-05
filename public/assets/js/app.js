function add_carrinho(id_produto){

    axios.defaults.withCredentials = true;
    axios.get('?a=add_carrinho&id_produto='+id_produto)
        .then(function(response){
            let total_produtos = response.data;
            document.getElementById('cart_num').innerHTML = total_produtos;
            console.log(response.data)

        }).catch(function(err){
            console.log(err)
    })
}

function set_endereco_alternativo(){
    axios({
        method: 'POST',
        url: '?a=set_endereco_alternativo',
        data: {
            endereco: document.getElementById('endereco').value,
            cidade: document.getElementById('cidade').value,
            email: document.getElementById('email').value,
            telefone: document.getElementById('telefone').value,
        }
    }).then((response)=>{
        console.log('ok')
    })
}

// $('#metodo_pagamento').click( function set_endereco_alternativo(){
//     let endereco = $('#endereco').val();
//     let cidade = $('#cidade').val();
//     let email = $('#email').val();
//     let telefone = $('#telefone').val();
//     console.log(endereco, email, cidade, telefone)
//     $.ajax({
//         url: '?a=set_endereco_alternativo',
//         method: 'POST',
//         dataType: 'json',
//         data: { endereco: endereco, cidade: cidade, email: email, telefone: telefone },
//         success: function(response){
//             console.log(response)
//         }
//     })
// })

function limpar_carrinho(){
    let e = document.getElementById('');
}

$('#confirmar_limpar_carrinho').click(()=>{
    $('.box-confirm').css({display: 'block'});
    $('#box-confirm-off').click(()=>{
        $('.box-confirm').css({display: 'none'});
    })
})

$("#set_endereco_alternativo").hide();
$('#use_endereco_alternativo').click(()=>{
    if(document.getElementById('use_endereco_alternativo').checked) {
        $("#set_endereco_alternativo").show();
    } else {
        $("#set_endereco_alternativo").hide();
    }
})

// $('#metodo_pagamento').click(()=>{
//     let endereco = $('#endereco').val();
//     let cidade = $('#cidade').val();
//     let email = $('#email').val();
//     let telefone = $('#telefone').val();
//     console.log(endereco, email, cidade, telefone)
//     $.ajax({
//         url: '',
//         method: 'POST',
//         data: { endereco: endereco, cidade: cidade, email: email, telefone: telefone },
//         success: function(response){
//             console.log(response)
//             alert('sucesso!')
//         }
//     })
// })

//data-id="<?php echo $produto->id_produto ?>"
// $(document).ready(()=>{
//     let id_produto = $(this).data('id') // will return the string "123"

//     $('#add_cart').click(()=>{
//         alert('meu saco')
//         $.ajax({
//             url: '?a=add_carrinho&id_produto='+id_produto,
//             method: 'GET',
//             success: function(response){
//                 $('#cart_num').html(response.data)
//             },
//             error: function(){
//                 alert('erro geral nessa porra');
//             }
//         })
//     })
// })

//=================
// function limpar_carrinho(){
//     axios.defaults.withCredentials = true;
//     axios.get('?a=limpar_carrinho')
//         .then(function(response){
//             document.getElementById('cart_num').innerHTML = 0;
//         }).catch(function(err){
//             console.log(err)
//     })
// }