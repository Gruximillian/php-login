(function() {
  const registerForm = document.querySelector('.js-register');
  const SERVER_ROOT = '/php-login';
  const error = registerForm && registerForm.querySelector('.js-error');
  const email = registerForm && registerForm.querySelector('[type="email"]');
  const password = registerForm && registerForm.querySelector('[type="password"]');

  registerForm && registerForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const data = {
      email: email.value.toLowerCase(),
      password: password.value
    }

    if (data.email.length < 6) {
      error.textContent = 'Please enter a valid email address';
      show(error);
      return false;
    } else if (data.password.length < 11) {
      error.textContent = 'Please enter a passphrase that is at least 11 characters long.';
      show(error);
      return false;
    }
    hide(error);

    // registerUser(JSON.stringify(data));
    // PHP can't accept JSON string, who knows what jQuery does behind the scene!?
    registerUser(`email=${email.value.toLowerCase()}&password=${password.value}`);

    return false;
  });

  function registerUser(registrationData) {
    let xhr = new XMLHttpRequest();

    xhr.onload = function() {
      if (xhr.status === 200) {
        console.log('Got back xhr:', xhr.response);
        const data = JSON.parse(xhr.response);
        console.log('Got back object:', data);
        if (data.redirect !== undefined) {
          window.location = `${SERVER_ROOT}${data.redirect}`;
        } else if (data.error !== undefined) {
          error.textContent = data.error;
          show(error);
        }
      }
    }
    xhr.onerror = function() {
      // console.log('Error');
    }
    xhr.onloadend = function() {
      // console.log('Loading ended');
    }
    xhr.open('POST', `${SERVER_ROOT}/ajax/register.php`);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    console.log('Sent:', registrationData);
    xhr.send(registrationData);
  }

  function show(node, displayType = 'block') {
    node.style.display = displayType;
  }

  function hide(node) {
    node.style.display = 'none';
  }

}());
