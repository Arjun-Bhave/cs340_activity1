<!DOCTYPE html>

<html>
	<head>
		<title>Songs</title>
		<link rel="stylesheet" href="index.css">
	</head>
	<body>
<?php	
include("connect.php");

// Get genre filter from GET param (if any)
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';

// Category dropdown options
$categories = ["Pop", "Rock", "R&B", "Metal", "Country", "Rap"];

// Build SQL query
if ($genre) {
    $like_genre = "%" . $genre . "%";
    $stmt = $conn->prepare("SELECT * FROM songs WHERE genre LIKE ?");
    $stmt->bind_param("s", $like_genre);
} else {
    $stmt = $conn->prepare("SELECT * FROM songs");
}
$stmt->execute();
$result = $stmt->get_result();

// HTML header
echo "<div class='header'>";
echo "<h1>Song List</h1>";
echo "</div>";

// Filter dropdown
echo "<form method='get'>";
echo "<label for='genre'>Filter by Category:</label>";
echo "<select name='genre'  onchange='this.form.submit()'>";
echo "<option value=''>-- All Categories --</option>";
foreach ($categories as $cat) {
    $selected = ($cat == $genre) ? "selected" : "";
    echo "<option value='$cat' $selected>$cat</option>";
}
echo "</select></form><br>";


// Display results
echo "<table id='songs'>";
echo "<tr><th>Title</th><th>Artist</th><th>Album</th><th>Year</th><th>Genre</th><th>Duration (sec)</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['title']}</td>";
    echo "<td>{$row['artist']}</td>";
    echo "<td>{$row['album']}</td>";
    echo "<td>{$row['release_year']}</td>";
    echo "<td>{$row['genre']}</td>";
    echo "<td>{$row['duration_seconds']}</td>";
    echo "</tr>";
}
echo "</table>";

$stmt->close();
$conn->close();
?>

</body>
</html>
