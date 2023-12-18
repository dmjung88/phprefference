<?php

// Content Type JSON
header("Content-type: application/json");

// Database connection
$conn = new mysqli("localhost", "root", "", "test");
if ($conn->connect_error) {
    print mysqli_connect_errno().mysqli_connect_error();
    die($db->connect_errno.$db->connect_error);
}
$res = array('error' => false);

// Read data from database
$action = 'read';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'read') {
    $sql = "SELECT * FROM `users`";
    $result = $conn->query($sql);
    $users  = array();

    while ($row = $result->fetch_assoc()) {
        array_push($users, $row);
    }
    $res['users'] = $users;
}


// Insert data into database
if ($action == 'create') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = $_POST['email'];
    $mobile   = $_POST['mobile'];

    $sql = "INSERT INTO `users` (`username`, `email`, `mobile`) VALUES('$username', '$email', '$mobile')";
    $result = $conn->query($sql);

    if ($result) {
        $res['message'] = "User added successfully";
    } else {
        $res['error']   = true;
        $res['message'] = "User insert failed!";
    }
}


// Update data

if ($action == 'update') {
    $id       = $_POST['id'];
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = $_POST['email'];
    $mobile   = $_POST['mobile'];

    $result = $conn->query("UPDATE `users` SET `username`='$username', `email`='$email', `mobile`='$mobile' WHERE `id`='$id'");

    if ($result) {
        $res['message'] = "User updated successfully";
    } else {
        $res['error']   = true;
        $res['message'] = "User update failed!";
     }
}


// Delete data

if ($action == 'delete') {
    $id       = $_POST['id'];
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $username = $_POST['username'];
    $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
    $email    = $_POST['email'];
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $mobile   = $_POST['mobile'];
    //if (!filter_has_var(INPUT_POST, 'submit')) =  if(isset($_POST['submit']))

    $sql = "DELETE FROM `users` WHERE `id`='$id'";
    $result = $conn->query($sql);

    if ($result) {
        $res['message'] = "User delete success";
    } else {
        $res['error']   = true;
        $res['message'] = "User delete failed!";
    }
}


// Close database connection
$conn->close();

// print json encoded data
echo json_encode($res);
die();

?>


<!DOCTYPE html>
<html lang="en">
<body>
    <div id="root">
        <button @click="showingaddModal = true;">Add User</button>
        <div v-if="errorMessage">
            {{ errorMessage }}
        </div>
        <div v-if="successMessage">
            {{ successMessage }}
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>S/N</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="tbody-custom">
                <tr v-for="user in users">
                    <td>{{user.id}}</td>
                    <td>{{user.username}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.mobile}}</td>
                    <td><button @click="showingeditModal = true; selectUser(user);">Edit</button></td>
                    <td><button @click="showingdeleteModal = true; selectUser(user);">Delete</button></td>
                </tr>
            </tbody>
        </table>
        <!-- insert FORM -->
    <div class="modal col-md-6" id="addmodal" v-if="showingaddModal">
        <input type="text" class="form-control" v-model="newUser.username">
        <input type="text" class="form-control" v-model="newUser.email">
        <input type="text" class="form-control" v-model="newUser.mobile">
        <button type="button" @click="showingaddModal = false; addUser();">Save changes</button>
        <button type="button" @click="showingaddModal = false;">Close</button>
    </div>
        <!-- MODIFY FORM -->
    <div class="modal col-md-6" id="editmodal" v-if="showingeditModal">
        <input type="text" id="uname" class="form-control" v-model="clickedUser.username">
        <input type="text" id="email" class="form-control" v-model="clickedUser.email">
        <input type="text" id="phn" class="form-control" v-model="clickedUser.mobile">
        <button type="button" @click="showingeditModal = false; updateUser();">Save changes</button>
        <button type="button" @click="showingeditModal = false;">Close</button>
    </div>

    <div class="modal col-md-6" id="deletemodal" v-if="showingdeleteModal">
        <button type="button" @click="showingdeleteModal = false; deleteUser();">Yes</button>
        <button type="button" @click="showingdeleteModal = false;">No</button>
    </div>

    </div><!-- id = root -->
</body>
<script>
window.onload = function() {
    var app = new Vue({

    el: "#root",
    data: {
        showingaddModal: false,
        showingeditModal: false,
        showingdeleteModal: false,
        errorMessage: "",
        successMessage: "",
        users: [],
        newUser: {username: "", email: "", mobile: ""},
        clickedUser: {},
    },

    mounted: function () {
        console.log("Vue.js is running...");
        this.getAllUsers();
    },

    methods: {
        getAllUsers: function () {
            axios.get('http://localhost/php-vue/api/v1.php?action=read')
            .then(function (response) {
                console.log(response);

                if (response.data.error) {
                    app.errorMessage = response.data.message;
                } else {
                    app.users = response.data.users;
                }
            })
        },

        addUser: function () {
            var formData = app.toFormData(app.newUser);
            axios.post('http://localhost/php-vue/api/v1.php?action=create', formData)
            .then(function (response) {
                console.log(response);
                app.newUser = {username: "", email: "", mobile: ""};

                if (response.data.error) {
                    app.errorMessage = response.data.message;
                } else {
                    app.successMessage = response.data.message;
                    app.getAllUsers();
                }
            });
        },

        updateUser: function () {
            var formData = app.toFormData(app.clickedUser);
            axios.post('http://localhost/php-vue/api/v1.php?action=update', formData)
            .then(function (response) {
                console.log(response);
                app.clickedUser = {};

                if (response.data.error) {
                    app.errorMessage = response.data.message;
                } else {
                    app.successMessage = response.data.message;
                    app.getAllUsers();
                }
            });
        },

        deleteUser: function () {
            var formData = app.toFormData(app.clickedUser);
            axios.post('http://localhost/php-vue/api/v1.php?action=delete', formData)
            .then(function (response) {
                console.log(response);
                app.clickedUser = {};

                if (response.data.error) {
                    app.errorMessage = response.data.message;
                } else {
                    app.successMessage = response.data.message;
                    app.getAllUsers();
                }
            })
        },

        selectUser(user) {
            app.clickedUser = user;
        },

        toFormData: function (obj) {
            var form_data = new FormData();
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            return form_data;
        },

        clearMessage: function (argument) {
            app.errorMessage   = "";
            app.successMessage = "";
        },
    }
}); //endVUE
}//onload
</script>
</html>