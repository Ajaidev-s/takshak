<?php session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] === "super_user")
    {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration Form</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="event_reg.css">
</head>
<body>

    <div class="form-container">
        <div class="form-header">
            <h2>Event Registration Form</h2>
        </div>
        <form action="/admin/event_submit.php" method="post">
            <div class="form-group">
                <label for="event-id">Event ID:</label>
                <input type="text" id="event-id" name="event-id" required>
            </div>

            <div class="form-group">
                <label for="event-name">Event Name:</label>
                <input type="text" id="event-name" name="event-name" required>
            </div>

            <div class="form-group">
                <label for="coordinator-name">Coordinator Name:</label>
                <input type="text" id="coordinator-name" name="coordinator-name" required>
            </div>

            <div class="form-group">
                <label for="coordinator-phone">Coordinator Phone Number:</label>
                <input type="tel" id="coordinator-phone" name="coordinator-phone" pattern="[0-9]{10}" required>
            </div>

            <div class="form-group">
                <label for="subcoordinator-name">Sub-Coordinator Name:</label>
                <input type="text" id="subcoordinator-name" name="subcoordinator-name" required>
            </div>

            <div class="form-group">
                <label for="subcoordinator-phone">Sub-Coordinator Phone Number:</label>
                <input type="tel" id="subcoordinator-phone" name="subcoordinator-phone" pattern="[0-9]{10}" required>
            </div>

            <div class="form-group">
                <label for="participants">Number of Participants:</label>
                <input type="number" id="participants" name="participants" min="1" required>
            </div>
            <div class="form-group">
                <label for="strength">Strength Of a Group:</label>
                <input type="number" id="grp_strenght" name="grp_strenght" min="1" >
            </div>


            <div class="form-group">
                <label for="image-url">Image URL:</label>
                <input type="text" id="image-url" name="image-url" >
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

</body>
</html>
<?php
    }
    else{
        //header("Location:server/restricted.php");
        echo "<script>window.location.href = 'server/restricted.php';</script>";
    }
?>
