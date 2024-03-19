// 切換登入註冊
function showForm(formType) {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    const changeBtn = document.querySelector(".change");
    // 以class中是否有active來顯示表單
    // 有則顯示，無則隱藏
    if (formType === 'login') {
        loginForm.classList.add('active');
        registerForm.classList.remove('active');
    } else if (formType === 'register') {
        registerForm.classList.add('active');
        loginForm.classList.remove('active');
    }

    changeBtn.addEventListener('click', function(e) {
        if (e.target.getAttribute('id') == 'login') {
            login.classList.add('change-active');
            register.classList.remove('change-active');
        } else {
            login.classList.remove('change-active');
            register.classList.add('change-active');
        }
    });
}

// 密碼顯示及隱藏功能
function showPassword(btn) {
    const passwordInput = btn.closest('form').querySelector('.register_password, .login_password');

    if (passwordInput.value == '') {
        alert('請先輸入密碼');
    } else {

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            btn.innerHTML = '隱藏';
        } else {
            passwordInput.type = 'password';
            btn.innerHTML = '顯示';
        }
    };
}

// 註冊功能
function sendRegistrationRequest(event) {
    event.preventDefault();
    var form = document.getElementById("registerForm");

    var userName = form.querySelector("#user_name").value;
    var userPhone = form.querySelector("#user_phone").value;
    var userEmail = form.querySelector("#user_email").value;
    var userPassword = form.querySelector("#user_password").value;

    // 檢查是否有任何一個欄位的值為空
    if (userName === "" || userPhone === "" || userEmail === "" || userPassword === "") {
        alert("請確實填寫所有欄位！");
        return; // 如果有任何一個欄位的值為空，停止執行並顯示警告訊息
    }

    const formData = new FormData(document.getElementById('registerForm'));
    const route = document.getElementById('registerForm').getAttribute('data-register-route');
    fetch(route, {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            return response.json();
        })
        .then(data => {
            if (data && data.message) {
                alert(data.message); // 註冊成功
                clearForm(); // 清空表單
            } else if (data && data.errors) {
                handleFormErrors(data.errors); // 處理表單驗證錯誤
            }
        })
        .catch(error => {
            console.error('註冊失敗:', error.message);
        });
}

// 註冊成功後表單清空
function clearForm() {
    document.getElementById("registerForm").reset();
}

// 註冊的錯誤訊息處理
function handleFormErrors(errors) {
    const errorMessages = [];

    Object.keys(errors).forEach(field => {
        // 取得目前欄位對應的錯誤訊息
        const fieldErrors = errors[field];
        fieldErrors.forEach(errorMessage => {
            errorMessages.push({
                field,
                message: errorMessage
            });
        });
    });
    // 處理所有錯誤訊息
    if (errorMessages.length > 0) {
        var error = errorMessages[0]; // 獲取第一個錯誤訊息

        switch (error.field) {
            case 'user_phone':
                alert('手機號碼已被使用或輸入錯誤!');
                break;
            case 'user_email':
                alert('Email已被使用或格式輸入錯誤!');
                break;
            case 'user_password':
                alert('密碼必須包含至少6個字符!');
                break;
            default:
                alert('註冊失敗，請聯繫客服!');
                break;
        }
    }
}

// 登入功能
function submitLoginForm(event) {
    event.preventDefault();
    const formData = new FormData(document.getElementById('loginForm'));
    const route = document.getElementById('loginForm').getAttribute('data-login-route');
    const homeRoute = document.getElementById('loginForm').getAttribute('data-home-route');
    const memberRoute = authButton.getAttribute('data-member-route');
    const profileRoute = authButton.getAttribute('data-profile-route');

    fetch(route, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('登入失敗');
            }
            return response.json();
        })
        .then(data => {
            if (data.loggedIn) {
                authButton.innerHTML = '<a href="' + memberRoute + '" onclick="logout()">登出</a>';
                let user_id = data.user.user_id;
                // 儲存本地登入狀態
                localStorage.setItem('isLoggedIn', 'true');
                // 儲存本地使用者資訊
                localStorage.setItem('userData', user_id);
                alert(data.user.user_name + "您好，歡迎參觀選購!");
                window.location.href = homeRoute;
            } else {
                authButton.innerHTML = '<a href="' + profileRoute + '">註冊 / 登入</a>';
                // 移除本地登入狀態
                localStorage.removeItem('isLoggedIn');
                // 移除本地使用者資訊
                localStorage.removeItem('userData');
            }
            clearForm();
        })
        .catch(error => {
            alert('登入失敗，請確認信箱及密碼是否輸入錯誤!');
        });
}