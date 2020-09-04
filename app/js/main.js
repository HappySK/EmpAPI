$(document).ready(() => {
    $('#empDir').dataTable();
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
            url:'../app/empDir.php',
            type:'POST',
            dataType:'html',
            data:{emp:JSON.stringify(emp)},
            success:function(data)
            {
                alert(data)
            }
        })
    })
})