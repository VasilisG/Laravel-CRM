<x-head title="CRM Login"></x-head>
<div class="login-container relative w-full h-full flex justify-center items-center">
  <img class="login-background-image absolute w-full h-full" src="{{ URL::to('assets/images/login-background.jpg') }}"/>
  <div class="login-container-inner z-10 p-6 bg-white rounded-xl shadow-lg max-w-[500px]">
    <div class="login-prompt-container text-center">
      <p class="login-prompt text-2xl font-bold">Login with your email.</p>
      <p class="login-info text-gray-300 text-gray-400 mt-2 font-semibold">Use your email and the password given to you in order to login and access the admin.</p>
    </div>
    <form id="login-form" action="" method="POST">
      <div class="login-field email-field">
        <label for="login-email-field">Email</label>
        <input id="login-email-field" type="text"/>
      </div>
      <div class="login-field password-field">
        <label for="login-password-field">Password</label>
        <input id="login-password-field" type="password"/>
      </div>
      <div class="login-actions">
        <button class="login-button" type="submit">Login</button>
      </div>
    </form>
  </div>
</div>