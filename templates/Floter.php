<div id="id01" class="modal">

    <form class="modal-content animate" action="../Login.php" method="post">
        <!--onclick="window.location.href='/page2'" can also be used in loing button to have the same effect-->
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

        </div>

        <div class="container">
            <label for="uname" style="color: #E1E1E1"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw" style="color: #E1E1E1"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button class="logins_buttons" type="submit">Login</button>
            <label style="color: #E1E1E1">
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color: #202020;">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">
                Cancel
            </button>

        </div>
    </form>
</div>
