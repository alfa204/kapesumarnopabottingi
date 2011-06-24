<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<div class="container">
    <div class="content" style="width: 678px; height: 500px; border-style: solid">
        <div class="content">
            <div class="content">
                <button>HOME</button>
            </div>
            <div class="content">
                <button>PRODUK</button>
            </div>
            <div class="content">
                <button>ABOUT</button>
            </div>
            <div class="content">
                <button>KONTAK</button>
            </div>
        </div>
        <div class="clearboth"></div>
        <div class="content">
            isinya, pake ajax?
        </div>
    </div>
    <div class="content" style="width: 250px; height: 500px; border-style: solid">
        <div id="content">
            <form action="process/login.php" method="POST">
                <div class="item">
                    <label style="">Username :</label>
                    <input type="text" id="username" name="username">
                </div>
                <div class="item">
                    <label>Password :</label>
                    <input type="text" id="password" name="password">
                </div>
                <div class="item">
                    <input type="submit" value="Login!">
                </div>
            </form>
        </div>
        <div id="content">
            <form action="process/registration.php" method="POST">
                <div class="item">
                    <label>Name :</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="item">
                    <label>Username :</label>
                    <input type="text" id="username" name="username">
                </div>
                <div class="item">
                    <label>Password :</label>
                    <input type="text" id="password" name="password">
                </div>
                <div class="item">
                    <label>Email :</label>
                    <input type="text" id="email" name="email">
                </div>
                <div class="item">
                    <input type="submit" value="Register!">
                </div>
            </form>
        </div>
    </div>
    <div class="clearboth"></div>
</div>
