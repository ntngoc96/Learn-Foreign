<link rel="stylesheet" href="assets/css/components/button.css">
<link rel="stylesheet" href="assets/css/users/user_update.css">
    <div class="container">
        <section class="section-register">
            <form action="index.php?controller=users&action=updateInformation" class="form__register" method="POST" enctype="multipart/form-data">
                <div class="form__group form__heading">
                    <h2 class="form__heading-primary">
                        Update Information
                    </h2>
                </div>
                <div class="form__group">
                    <label class="form__label">
                        Full Name
                    </label>
                    <input class="form__input" type="text" value="<?php if(!empty($user)){ echo $user->FullName; }?>" name="full_name">
                </div>
                <div class="form__group">
                    
                    <label class="form__label">
                        Date of Birth
                    </label>
                    <input class="form__input" type="date" value="<?php if(!empty($user)){ echo $user->Dob; }?>" name="dob">
                </div>
                <div class="form__group">
                    
                    <label class="form__label">
                        Gender
                    </label>
                    <?php if(!empty($user)){
                        switch ($user->Gender) {
                            case 'Male':
                                echo <<<_RENDER_MALE
                                <div class="group--gender">
                                    <input type="radio" name="gender" id="gender" value="Male" checked>
                                    <label for="Male" class="form__label">Male</label>
                                    <input type="radio" name="gender" id="gender" value="Female">
                                    <label for="Female" class="form__label">Female</label>
                                    <input type="radio" name="gender" id="gender" value="Other">
                                    <label for="Other" class="form__label">Other</label>
                                </div>
_RENDER_MALE;
                                break;
                            case 'Female':
                                echo <<<_RENDER_FEMALE
                                <div class="group--gender">
                                    <input type="radio" name="gender" id="gender" value="Male" >
                                    <label for="Male" class="form__label">Male</label>
                                    <input type="radio" name="gender" id="gender" value="Female" checked>
                                    <label for="Female" class="form__label">Female</label>
                                    <input type="radio" name="gender" id="gender" value="Other">
                                    <label for="Other" class="form__label">Other</label>
                                </div>
_RENDER_FEMALE;
                                break;
                            case 'Other':
                                echo <<<_RENDER_OTHER
                                <div class="group--gender">
                                    <input type="radio" name="gender" id="gender" value="Male" >
                                    <label for="Male" class="form__label">Male</label>
                                    <input type="radio" name="gender" id="gender" value="Female">
                                    <label for="Female" class="form__label">Female</label>
                                    <input type="radio" name="gender" id="gender" value="Other" checked>
                                    <label for="Other" class="form__label">Other</label>
                                </div>
_RENDER_OTHER;
                                break;
                            
                            default:
                                echo <<<_RENDER_MALE
                                <div class="group--gender">
                                    <input type="radio" name="gender" id="gender" value="Male" checked>
                                    <label for="Male" class="form__label">Male</label>
                                    <input type="radio" name="gender" id="gender" value="Female">
                                    <label for="Female" class="form__label">Female</label>
                                    <input type="radio" name="gender" id="gender" value="Other">
                                    <label for="Other" class="form__label">Other</label>
                                </div>
_RENDER_MALE;
                                break;
                        }
                    } else {
                        echo <<<_RENDER_MALE
                                <div class="group--gender">
                                    <input type="radio" name="gender" id="gender" value="Male" checked>
                                    <label for="Male" class="form__label">Male</label>
                                    <input type="radio" name="gender" id="gender" value="Female">
                                    <label for="Female" class="form__label">Female</label>
                                    <input type="radio" name="gender" id="gender" value="Other">
                                    <label for="Other" class="form__label">Other</label>
                                </div>
_RENDER_MALE;
                    }
                    
                    ?>
                    
                </div>
                <div class="form__group">
                    
                    <label class="form__label">
                        Address
                    </label>
                    <input class="form__input" type="text" value="<?php if(!empty($user)){ echo $user->Address; }?>" name="address">
                </div>
                <div class="form__group">
                    
                    <label class="form__label">
                        School Id
                    </label>
                    <input class="form__input" type="text" value="<?php if(!empty($user)){ echo $user->SchoolId; }?>" name="school_id">
                </div>
                <div class="form__group">
                    
                    <label class="form__label">
                        Avatar
                    </label>
                    <input class="form__input" type="file" value="<?php if(!empty($user)){ echo $user->Avatar; }?>" name="avatar">
                </div>
                    
                <div class="form__button">
                        <input type="submit" class="btn btn--light btn--update" value="Update">
                        <input type="reset" class="btn btn--light btn--clear" value="&nbsp;Clear &nbsp;">
                </div>

                </div>
            </form>
        </section>
    </div>
