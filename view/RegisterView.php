<?php 

class RegisterView {
    private static $message = "RegisterView::Message";
    private static $username = "RegisterView::UserName";
    private static $password = "RegisterView::Password";
    private static $repeatPassword = "RegisterView::PasswordRepeat";
    private static $registration = "RegisterView::Register";
    private static $link = "Back to login";


    public function showLinkBack(){
        return '
        <a href="?">' . self::$link . '</a>
        ';
    }


    public function generateRegisterForm($message){
        return '
        <h2>Register new user</h2>
        <form action="?register" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Register a new user - Write username and password</legend>
                <p id="' . self::$message . '">' . $message . '</p>
                <label for="' . self::$username . '">Username :</label>
                <input type="text" size="20" name="' . self::$username . '" id="' . self::$username .'" value="' . $_SESSION['usernameValueRegister'] .'">
                <br>
                <label for="' . self::$password .'">Password :</label>
                <input type="password" size="20" name="' . self::$password . '" id="' . self::$password . '" value>
                <br>
                <label for="' . self::$repeatPassword . '">Repeat password :</label>
                <input type="password" size="20" name="' . self::$repeatPassword .'" id="' . self::$repeatPassword . '" value>
                <br>
                <input id="submit" type="submit" name="' . self::$registration . '" value="Register">
                <br>
                </fieldset>
                </form>			
        ';
    }
}