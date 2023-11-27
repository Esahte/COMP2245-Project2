<h2>New User</h2>
<form method="post" action="insert_user.php">
    <div class="first_name">
        <label for="username">First Name</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="e.g. John"/>
    </div>

    <div class="last_name">
        <label for="username">Last Name</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="e.g. Doe"/>
    </div>

    <div class="email">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="form-control" placeholder="something@example.com"/>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control"/>
    </div>

    <div>
        <label for="role">Role</label>
        <select name="role" id="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="member">Member</option>
        </select>
    </div>
    <div class="save">
        <input type="submit" value="Send">
    </div>
</form>
