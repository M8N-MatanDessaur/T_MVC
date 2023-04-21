<form class="form card" method="post" action="../Controller/signup.php">
  <div class="card_header">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
      <path fill="none" d="M0 0h24v24H0z"></path>
      <path fill="currentColor" d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z"></path>
    </svg>
    <h1 class="form_heading">Sign up</h1>
  </div>
  <div class="field">
    <label for="username">Username</label>
    <input class="input" autocomplete="off" name="email" type="text" placeholder="Username" id="email">
  </div>
  <div class="field">
    <label for="username">Full Name</label>
    <input class="input" autocomplete="off" name="fullName" type="text" placeholder="Full Name" id="email">
  </div>
  <div class="field">
    <label for="password">Password</label>
    <input class="input" autocomplete="off" name="password" type="password" placeholder="Password" id="password">
  </div>
  <div class="field">
    <button class="button">Sign up</button>
    <br> <br>
    <a href="./login.php">Got an account?</a>
  </div>
</form>