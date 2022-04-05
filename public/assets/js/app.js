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