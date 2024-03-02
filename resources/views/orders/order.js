let form1 = document.querySelector('#form')

let tab1 = []
let tab2 = []
let input = form1.querySelectorAll('input')
let select = form1.querySelectorAll('select')
form1.addEventListener('submit',function(e){
    e.preventDefault()
    tab1.push(
        {
            customer : select[0].value ,
            adress : input[0].value ,
            number : input[1].value,
            product : select[1].value,
            quantity : input[2].value,
            price : input[3].value,
            order_quantity : input[4].value,

        }

    )
    display()
    localStorage.setItem('form',JSON.stringify(tab1))
    return window.location.reload()

})
function display() {
    let infos=`
            <thead>
                        <tr>
                            <th>Product</th>
                            <th>Order Quantity</th>
                            <th>Customer</th>
                        </tr>
             </thead>
        `
    for (let i = 0; i < tab1.length; i++) {
        infos+=`
                <tr>
                <td>${i+1}</td>
                <td>${tab1[i].product}</td>
                <td>${tab1[i].order_quantity}</td>
                <td>${tab1[i].customer}</td>
                <td>
                <button onclick="Modifier(${i})">Modifier</button>
                <button onclick="Supprimer(${i})" >Supprimer</button>
                </td>
                </tr>`
    }
    document.querySelector('#table').innerHTML = infos

}
