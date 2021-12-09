<?php 
class SubmitHandler {
    public function __construct(array $method, array $keywords)
    {
        $this->method = $method;
        $this->keywords = $keywords;
        $this->submittedData = $this->getSubmittedData();
    }

    public function getSubmittedData():array {
        $keysOut = [];
        foreach ($this->keywords as $keyword) {
            $keysOut[$keyword] = $this->method[$keyword];
        }
        return $keysOut;
    }

    public function emptyField(array $input):bool {
        foreach ($input as $data) {
            if (empty($data)) {
                return true;
            }
        }
        return false;
    }

    public function validEmail(string $email):bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    } 

    public function validUsername(string $username):bool {
        // check if username only has letters
        // return ctype_alpha($username);
        return true;
    }
    
    public function compatibleUsernameAndPassword(string $username, string $pwd):bool {
        if ($username != $pwd) {
            return true;
        }
        return false;
    }

    public function passwordsMatch(string $pwd, string $pwdRepeat):bool {
        return $pwd == $pwdRepeat;
    }

    public function sendUserTo(string $filename, string $keywords=""):void {
        header("Location: " .$filename. "?" .$keywords);
    }
}