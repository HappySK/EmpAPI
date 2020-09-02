$(document).ready(() => {
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
        console.log(JSON.stringify(emp))
    })
})