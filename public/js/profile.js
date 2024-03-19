window.onload = function() {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    const authButton = document.getElementById('authButton'); 
    const memberRoute = authButton.getAttribute('data-member-route');
    const profileRoute = authButton.getAttribute('data-profile-route');
    
    if (isLoggedIn === 'true') {
        authButton.innerHTML = '<a href="' + memberRoute + '">會員中心</a>';
    } else {
        authButton.innerHTML = '<a href="' + profileRoute + '">註冊 / 登入</a>';
    }
    
};