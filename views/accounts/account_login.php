<link rel="stylesheet" href="assets/css/accounts/account_login.css">
<link rel="stylesheet" href="assets/css/components/button.css">
<div class="container">
    <section class="section-auth">
        <div class="nav__change-view">
            <div class="nav__group <?php if($_GET['type'] == 'signup'){ echo "actived-border-bottom"; }?>">
                <label for="nav__register" class="nav__label">Sign Up</label>
                <input type="radio" name="nav__view"  class="nav__input" id="nav__register" />
            </div>
            <div class="nav__group <?php if($_GET['type'] == 'signin'){ echo "actived-border-bottom"; }?>">
                <label for="nav__login" class="nav__label">Sign In</label>
                <input type="radio" name="nav__view" class="nav__input" id="nav__login" value="Sign In">
            </div>
        </div>
        <div class="card">
            <div class="card__size card__size--front <?php if($_GET['type'] == 'signup'){ echo "actived"; }?>" >
                <form action="index.php?controller=account&action=registerAccount" class="form__register" id="form__register" method="POST" enctype="multipart/form-data">
                    <div class="form__group form__heading">
                        <h3 class="form__heading-secondary">
                            Welcome to
                        </h3>
                        <h3 class="form__heading-secondary">
                            Learning Foreign
                        </h3>
                        <h2 class="form__heading-primary">
                            Register Form
                        </h2>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="account_id">Username</label>
                        <input class="form__input" type="text" id="account_id" name="account_id">
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="register_password">Password</label>
                        <input class="form__input" type="password" id="register_password" name="password">
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="register_repassword">Re-password</label>
                        <input class="form__input" type="password" id="register_repassword" name="repassword">
                    </div>
                    <div class="form__button">
                        <input type="submit" class="btn btn--register btn--gradient" value="Register">
                    </div>
                </form>
            </div>
            <div class="card__size card__size--back <?php if($_GET['type'] == 'signin'){ echo "actived"; }?>" >
                <form action="index.php?controller=account&action=loginAccount " method="post" id="form__login" class="form__login">
                    <div class="form__group form__heading">
                        <h3 class="form__heading-secondary">
                            Welcome back to
                        </h3>
                        <h2 class="form__heading-primary">
                            Learning Foreign
                        </h2>
                    </div>
                    <div class="form__group">
                        <label for="username" class="form__label">Username</label>
                        <input type="text" name="account_id" id="username" class="form__input">
                    </div>
                    <div class="form__group">
                        <label for="password" class="form__label">Password</label>
                        <input type="password" name="password" id="password" class="form__input">
                    </div>
                    <div class="form__button">
                        <input type="submit" class="btn btn--login btn--gradient" value="Login"/>
                        <div class="button__foget-password">
                            <a href="index.php?controller=account&action=resetPassword">Fogot password??</a>
                        </div>
                        <div class="button__register">
                            Don't have an account?
                            <a href="index.php?controller=account">Sign Up</a>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        
    </section>

</div>
<script src="assets/javascripts/accounts/account_auth.js"></script>