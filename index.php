<?php
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// No need for database connection check for now
include 'includes/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Push Notification Dashboard</h1>
    
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="notificationTabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#basic">Basic</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#image">With Image</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#scheduled">Scheduled</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#subtitle">With Subtitle</a>
                </li>
            </ul>
        </div>
        
        <div class="card-body">
            <div class="tab-content">
                <!-- Basic Notification Form -->
                <div class="tab-pane fade show active" id="basic">
                    <form action="send_notification.php" method="POST">
                        <input type="hidden" name="type" value="basic">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>
                </div>

                <!-- Image Notification Form -->
                <div class="tab-pane fade" id="image">
                    <form action="send_notification.php" method="POST">
                        <input type="hidden" name="type" value="image">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image URL</label>
                            <input type="url" class="form-control" name="image_url" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>
                </div>

                <!-- Scheduled Notification Form -->
                <div class="tab-pane fade" id="scheduled">
                    <form action="send_notification.php" method="POST">
                        <input type="hidden" name="type" value="scheduled">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Schedule Date/Time</label>
                            <input type="datetime-local" class="form-control" name="scheduled_at" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Schedule Notification</button>
                    </form>
                </div>

                <!-- Subtitle Notification Form -->
                <div class="tab-pane fade" id="subtitle">
                    <form action="send_notification.php" method="POST">
                        <input type="hidden" name="type" value="subtitle">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subtitle</label>
                            <input type="text" class="form-control" name="subtitle" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification History -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Notification History</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                        if ($conn->connect_error) {
                            throw new Exception("Connection failed: " . $conn->connect_error);
                        }
                        
                        $result = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC LIMIT 10");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                echo "</tr>";
                            }
                            $result->close();
                        }
                        $conn->close();
                    } catch (Exception $e) {
                        echo "<tr><td colspan='5' class='text-center text-danger'>Error loading notification history</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 