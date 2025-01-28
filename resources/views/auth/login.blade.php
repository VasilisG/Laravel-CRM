<x-head title="CRM Login"></x-head>
<div class="login-container relative w-full h-full flex justify-center items-center">
  <img class="login-background-image absolute w-full h-full brightness-75" src="{{ URL::to('assets/images/login-background.jpg') }}"/>
  <div class="login-container-inner z-10 p-6 bg-white rounded-xl shadow-lg max-w-[500px]">
    <div class="login-prompt-container text-center">
      <p class="login-prompt text-2xl font-bold">Login with your email.</p>
      <p class="login-info text-gray-300 text-gray-400 mt-3 font-semibold">Use your email and the password given to you in order to login and access the admin.</p>
    </div>
    <form id="login-form" class="mt-6" action="{{ route('login') }}" method="POST">
      @csrf
      <div class="login-field email-field">
        <label for="login-email-field" class="sr-only">Email</label>
        <div class="input-container flex items-center gap-2 p-3 border border-gray-100 rounded-xl bg-gray-100">
          <span class="field-icon block w-[20px] text-gray-500">@svg("envelope")</span>
          <input id="login-email-field" class="bg-gray-100 outline-none w-full" type="text" placeholder="Email" name="email" required/>
        </div>
      </div>
      <div class="login-field password-field mt-3">
        <label for="login-password-field" class="sr-only">Password</label>
        <div class="input-container flex items-center gap-2 p-3 border border-gray-100 rounded-xl bg-gray-100">
          <span class="field-icon block w-[20px] text-gray-500">@svg("lock")</span>
          <input id="login-password-field" class="bg-gray-100 outline-none w-full" type="password" placeholder="Password" name="password" required/>
        </div>
      </div>
      <div class="login-actions mt-6 flex justify-center">
        <button class="login-button block w-1/2 p-3 rounded-xl text-white font-bold bg-gray-800 hover:bg-gray-600 transition-colors duration-300" type="submit">Login</button>
      </div>
    </form>
    <x-messages.all></x-messages.all>
  </div>
</div>