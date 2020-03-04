<!--    <h3>Sign In</h3>-->
<!--    <form>-->
<!--        <input type="text" name="username" placeholder="Username" class="form-control"-->
<!--               value="--><?php //echo $_SESSION['username'] ?><!--">-->
<!--        <input type="password" name="username" placeholder="Password" class="form-control"-->
<!--               value="--><?php //echo $_SESSION['password'] ?><!--">-->
<!---->
<!--    </form>-->
<!--    <hr/>-->

<div class="form form_center">
  <div class="form-content">
      <h1>Welcome!</h1>
      <p>Before we start, how old are you?</p>
      <form name="signup">
          <input type="hidden" name="step" value="1"/>
          <button type="submit" name="signup" value="under13" class="btn-inline btn-small btn-green">I’m under 13</button>
          <!-- TODO the second button should have value="13plus" but for the trial they are the same-->
          <button class="btn-inline btn-small" type="submit" name="signup" value="under13">I’m 13 or over</button>
      </form>
  </div>
</div>
