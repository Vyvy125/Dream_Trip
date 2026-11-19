const togglePassword = document.querySelector('.toggle-password');
const passwordInput = document.querySelector('.password');

if (togglePassword && passwordInput) {
    togglePassword.addEventListener('click', function () {
        // Lấy type hiện tại, nếu là 'password' thì đổi thành 'text', ngược lại đổi về 'password'
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        
        // Set lại type mới cho input
        passwordInput.setAttribute('type', type);
    });
}