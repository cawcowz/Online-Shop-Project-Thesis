

const searchProduct = ()=>{
    let filter = document.getElementById('search').value.toUpperCase();

    let myTable = document.getElementById('myTable');

    let tr = myTable.getElementsByTagName('tr');

    for(var i = 0; i < tr.length ; i++){
        let td = tr[i].getElementsByTagName('tr')[3];
        if(td){
            let textValue = td.textContent || td.innerHTML;
            if(textValue.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display ='';
            }else{
                tr[i].style.display = 'none';   
            }
        }
    }
}