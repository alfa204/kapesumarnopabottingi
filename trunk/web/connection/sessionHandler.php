<?php
class SessionHandler {

    // ATTRIBUTE
    public $isOn;
    public $isLoggedIn;
    // sesi yang disimpan
    public $activeUser = NULL;
    
    public $name;
    public $username;
    public $password;
    public $email;
    public $statusAdmin;

// METHOD
    // konstruktor
    public function __construct() {
        $this->isOn = session_start();
        if ($this->isOn) {
            $this->isLoggedIn = false;
            $this->getSession();
        } else {
            echo "Sesi tidak dapat dibuat";
        }
    }

    // fungsi untuk mengambil data sesi
    public function getSession() {
        if (isset($_SESSION['activeUser'])) {
            $this->isLoggedIn = true;
            $this->activeUser = $_SESSION['activeUser'];
            $this->statusAdmin = $this->activeUser['status_admin'];
            $this->name = $this->activeUser['name'];
            $this->username = $this->activeUser['username'];
            $this->password = $this->activeUser['password'];
            $this->email = $this->activeUser['email'];
     
        }
    }

    // fungsi untuk men-set semua sesi yang dibutuhkan
    public function setSession($activeUser) {
        $this->activeUser = $activeUser;
        $this->statusAdmin = $this->activeUser['status_admin'];
        $this->name = $this->activeUser['name'];
        $this->username = $this->activeUser['username'];
        $this->password = $this->activeUser['password'];
        $this->email = $this->activeUser['email'];
        $_SESSION['activeUser'] = $this->activeUser;
    }

    // menghapus sesi saat logout
    public function destroySession() {
        unset($_SESSION['activeUser']);
        session_destroy();
    }
}

?>
