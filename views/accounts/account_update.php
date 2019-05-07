<link rel="stylesheet" href="assets/css/accounts/account_update.css">
<link rel="stylesheet" href="assets/css/components/button.css">

<div class="container">
    <section class="section-update">
        <form action="index.php?controller=account&action=changePassword" class="form__register" id="form__register" method="POST" enctype="multipart/form-data">
            <div class="form__group form__heading">
                <h3 class="form__heading-secondary">
                    Learning Foreign
                </h3>
                <h2 class="form__heading-primary">
                    Change Password
                </h2>
            </div>
            <div class="form__group">
                <label class="form__label" for="update_oldpassword">Password</label>
                <input class="form__input" type="password" id="update_oldpassword" name="oldpassword"/>
            </div>
            <div class="form__group">
                <label class="form__label" for="update_password">New Password</label>
                <input class="form__input" type="password" id="update_password" name="newpassword"/>
            </div>
            <div class="form__group">
                <label class="form__label" for="update_repassword">Re-type New Password</label>
                <input class="form__input" type="password" id="update_repassword" name="enternewpassword"/>
            </div>
            <div class="form__button">
                <input type="submit" class="btn btn--register btn--gradient" value="Update">
            </div>
        </form>
    </section>
</div>
<script src="assets/javascripts/accounts/account_update.js"></script>