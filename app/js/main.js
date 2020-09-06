$(document).ready(() => {
    load_data();
    $('form').submit(() => {
        var name = $('#emp-name').val()
        var email = $('#emp-email').val()
        var option = document.getElementById('Designation')
        var desg = option.options[option.selectedIndex].value
        var date = $('#emp-hire-date').val()
        var salary = $('#emp-salary').val()
        var emp = { 
            name:name,
            email:email,
            desg:desg,
            date:date,
            salary:salary
        }
        $.ajax({
            url:'../app/data.php',
            type:'POST',
            dataType:'html',
            data:{emp:JSON.stringify(emp),action:'post'},
            success:function(data)
            {
                $('#feedback').text(data)
            }
        }).complete(load_data());
    })

    function load_data()
    {
        $.ajax({
            url:'../app/data.php',
            type:'GET',
            data:{action:'getEmpDetails'},
            dataType:'JSON',
            success:function(data)
            {
                $('tbody').empty()
                data.forEach(function(item,index)
                {
                    row = document.createElement('tr')
                    let i = 0;
                    while(i<6)
                    {
                        td =document.createElement('td')
                        td.setAttribute('id',index)
                        text = document.createTextNode(item[i])
                        td.appendChild(text)
                        row.appendChild(td)
                        i++
                    }
                    document.getElementsByTagName('tbody')[0].appendChild(row)
                })
                $('#empDir').dataTable({
                    pageLength: 5,
                    bDestroy:'true'
                });
            }
        })
    }
})