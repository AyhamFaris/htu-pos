<div class="container">
  <div class="screen">
    <div class="screen__content">
      <form class="login" action="/authenticate" method="POST">
        <div class="login__field">
          <i class="login__icon fas fa-user"></i>
          <input type="text" name="username" class="login__input" placeholder="User name">
        </div>
        <div class="login__field">
          <i class="login__icon fas fa-lock"></i>
          <input type="password" name="password" class="login__input" placeholder="Password">
        </div>
        <button class="button login__submit">
          <span class="button__text">Log In Now</span>
          <i class="button__icon fas fa-chevron-right"></i>
        </button>
      </form>
      <div class="social-login">
        <div class="social-icons">
          <label for="vehicle1">Remeber me</label>
          <input type="checkbox" id="vehicle1" name="remember_me" value="Bike">
        </div>
      </div>
    </div>
    <div class="screen__background">
      <span class="screen__background__shape screen__background__shape4"></span>
      <span class="screen__background__shape screen__background__shape3"></span>
      <span class="screen__background__shape screen__background__shape2"></span>
      <span class="screen__background__shape screen__background__shape1"></span>
    </div>
  </div>
</div>