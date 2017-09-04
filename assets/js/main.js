(function() {
  const SERVER_ROOT = '/php-login';
  const form = document.querySelector('form');

  if (form) {
    var API = (form.classList.contains('js-register')) ? `${SERVER_ROOT}/ajax/register.php` : `${SERVER_ROOT}/ajax/login.php`;
    var errorDisplayType = (form.classList.contains('js-register')) ? 'textContent' : 'innerHTML';
    var error = form.querySelector('.js-error');
    var email = form.querySelector('[type="email"]');
    var password = form.querySelector('[type="password"]');

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      var data = {
        email: email.value.toLowerCase(),
        password: password.value
      }

      if (data.email.length < 6) {
        error[errorDisplayType] = 'Please enter a valid email address';
        show(error);
        return false;
      } else if (data.password.length < 11) {
        error[errorDisplayType] = 'Please enter a passphrase that is at least 11 characters long.';
        show(error);
        return false;
      }
      hide(error);

      // sendUserInfo(JSON.stringify(data));
      // PHP can't accept JSON string, who knows what jQuery does behind the scene!?
      sendUserInfo(`email=${email.value.toLowerCase()}&password=${password.value}`);

      return false;
    });
  }


  function sendUserInfo(userInfo) {
    let xhr = new XMLHttpRequest();

    xhr.onload = function() {
      if (xhr.status === 200) {
        const data = JSON.parse(xhr.response);
        if (data.redirect !== undefined) {
          window.location = `${SERVER_ROOT}${data.redirect}`;
        } else if (data.error !== undefined) {
          error[errorDisplayType] = data.error;
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
    xhr.open('POST', API);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(userInfo);
  }

  function show(node, displayType = 'block') {
    node.style.display = displayType;
  }

  function hide(node) {
    node.style.display = 'none';
  }

}());
