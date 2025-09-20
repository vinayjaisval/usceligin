<?php
// Simple PHP debug script - no Laravel dependencies
echo "<h1>OTP System Debug</h1>";
echo "<style>body{font-family:Arial;margin:20px;} .success{color:green;} .error{color:red;}</style>";

// Check database connection
try {
    $host = '127.0.0.1';
    $port = '3307';
    $dbname = 'us_devceligin';
    $username = 'root';
    $password = '';

    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    echo "<p class='success'>✅ Database connection successful!</p>";

    // Check if tables exist
    $tables = ['users', 'otp_verifications', 'migrations'];
    foreach($tables as $table) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if($stmt->rowCount() > 0) {
            echo "<p class='success'>✅ Table '$table' exists</p>";
        } else {
            echo "<p class='error'>❌ Table '$table' missing</p>";
        }
    }

    // Check otp_verifications table structure
    $stmt = $pdo->query("DESCRIBE otp_verifications");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "<p class='success'>✅ OTP table has " . count($columns) . " columns</p>";

} catch(PDOException $e) {
    echo "<p class='error'>❌ Database error: " . $e->getMessage() . "</p>";
}

echo "<hr><p>Now test the sign-in page: <a href='/sign-in'>Click here</a></p>";
?>