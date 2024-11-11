const firstName = document.querySelector('#firstname'),
      lastName = document.querySelector('#lastname'),
      email = document.querySelector('#email'),
      password = document.querySelector('#password'),
      confirmPassword = document.querySelector('#confirm-password'),
      form = document.querySelector('form'),
      notice = document.querySelector('.notice');

let error = false;

form.addEventListener('submit', (e)=>{
    if(firstName.value.trim() == ''){
        alert("Please input your first name");
        e.preventDefault()
    }

    if(lastName.value.trim() === ''){
        alert("Please input your last name");
        e.preventDefault()
    }

    if(email.value.trim() === ''){
        alert('Please enter your email');
        e.preventDefault()
    }

    if(password.value.trim() === ''){
        alert("Please enter your password");
        e.preventDefault();
    }else{
        if(password.value !== confirmPassword.value){
            alert('The passwords do not match');
            e.preventDefault();
        }
    }

    if(password.value <= 8){
        alert("Password should contain atleast 8 characters ");
        e.preventDefault();
    }

})

password.addEventListener('input',()=>{
    if(password.value !== confirmPassword.value){
        notice.innerHTML = "Password do not match";
    }else {
        notice.innerHTML = "";
    }

confirmPassword.addEventListener('input',()=>{
    if(password.value !== confirmPassword.value){
        notice.innerHTML = "Password do not match";
    }else {
        notice.innerHTML = "";
    }
})
})



// let input1 = Number(prompt('Please enter the first number'));
// let input2 = Number(prompt('Please enter the second number'));
// let sum;

// if(input1 === input2){
//     sum = 3*(input1 + input2);
// }else {
//     sum = input1 + input2;
// }

// alert(sum)

// function factorial(n){
//     let counter = 1;
//     let i = 1;
//     while(i <= n){
//         counter*=i;
//         i++
//     }

//     return counter;
// }

// console.log(factorial(5))


