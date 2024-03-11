const loginBtn = document.getElementById('login');
const signupBtn = document.getElementById('signup');
if(verificarParametro404()){
    loginBtn.parentNode.parentNode.classList.remove('slide-up')
}

loginBtn.addEventListener('click', (e) => {
	let parent = e.target.parentNode.parentNode;
	Array.from(e.target.parentNode.parentNode.classList).find((element) => {
		if(element !== "slide-up") {
			parent.classList.add('slide-up')
		}else{
			signupBtn.parentNode.classList.add('slide-up')
			parent.classList.remove('slide-up')
		}
	});
});

signupBtn.addEventListener('click', (e) => {
	let parent = e.target.parentNode;
	Array.from(e.target.parentNode.classList).find((element) => {
		if(element !== "slide-up") {
			parent.classList.add('slide-up')
		}else{
			loginBtn.parentNode.parentNode.classList.add('slide-up')
			parent.classList.remove('slide-up')
		}
	});
});


function success() {
    Swal.fire({
        icon: 'success',
        title: 'Cadastrado realizado com sucesso!',   
        confirmButtonColor: "#008000",
        focusConfirm: false,
        customClass: {
            confirmButton: 'text-light fw-bold',
        },
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        timer: 3000,
        timerProgressBar: true,

    })



}
function limparUrl() {
    let url = window.location.href;
    let novaURL = url.split('?')[0];
    window.location.replace(novaURL)
}


function verificarParametro404() {
    // Obter a URL atual
    let urlAtual = window.location.href;

    return urlAtual.includes('404');
    
}

