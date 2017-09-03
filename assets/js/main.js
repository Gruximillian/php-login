(function() {
  const registerForm = document.querySelector('.js-register');
  const SERVER_ROOT = '/php-login';

  registerForm && registerForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const error = this.querySelector('.js-error');
    const email = this.querySelector('[type="email"]');
    const password = this.querySelector('[type="password"]');
    const data = {
      email: email.value,
      password: password.value
    }

    if (data.email.length < 6) {
      error.textContent = 'Please enter a valid email address';
      error.style.display = 'block';
      return false;
    } else if (data.password.length < 11) {
      error.textContent = 'Please enter a passphrase that is at least 11 characters long.';
      error.style.display = 'block';
      return false;
    }
    error.style.display = 'none';

    registerUser(JSON.stringify(data));

    return false;
  });

  function registerUser(data) {
    let xhr = new XMLHttpRequest();

    xhr.onload = function() {
      if (xhr.status === 200) {
        const data = JSON.parse(xhr.response);
        if (data.redirect !== undefined) {
          window.location = `${SERVER_ROOT}${data.redirect}`;
        }
      }
    }
    xhr.onerror = function() {
      console.log('Error');
    }
    xhr.onloadend = function() {
      console.log('Loading ended');
    }
    xhr.open('POST', `${SERVER_ROOT}/ajax/register.php`);
    xhr.setRequestHeader('Accept', 'application/json');
    xhr.send(data);
  }

}());
