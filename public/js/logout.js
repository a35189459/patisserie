function logout(event) {
    event.preventDefault();
    const logoutRoute = document.getElementById('logoutBtn').getAttribute('data-logout-route');
    const homeRoute = document.getElementById('logoutBtn').getAttribute('data-home-route');
    
    fetch(logoutRoute, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (response.ok) {
            localStorage.removeItem('isLoggedIn');
            localStorage.removeItem('cart');

            alert('登出成功!');
            window.location.href = homeRoute;
        } else {
            console.error('登出失敗');
        }
    })
    .catch(error => {
        console.error('登出失敗:', error);
    });
}
