<?php
$link = mysqli_connect("localhost", "root") or die(mysqli_connect_error());
mysqli_select_db($link, "miniproject") or die(mysqli_error());

// Generate chart configuration for daily report
$dailyReportQuery = "SELECT DATE(post_createdDate) AS day, COUNT(*) AS count FROM post GROUP BY DATE(post_createdDate)";
$dailyReportResult = mysqli_query($link, $dailyReportQuery);

$dailyChartData = [];
$dailyChartLabels = [];
while ($row = mysqli_fetch_assoc($dailyReportResult)) {
    $dailyChartLabels[] = $row['day'];
    $dailyChartData[] = $row['count'];
}

$dailyChartConfig = [
    'type' => 'bar',
    'data' => [
        'labels' => $dailyChartLabels,
        'datasets' => [
            [
                'label' => 'Daily Post Count',
                'data' => $dailyChartData,
                'backgroundColor' => 'rgba(75, 192, 192, 0.6)',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1
            ]
        ]
    ],
    'options' => [
        'scales' => [
            'y' => [
                'beginAtZero' => true
            ]
        ]
    ]
];

// Generate chart configuration for weekly report
$weeklyReportQuery = "SELECT CONCAT('Week ', WEEK(post_createdDate)) AS week, COUNT(*) AS count FROM post GROUP BY WEEK(post_createdDate)";
$weeklyReportResult = mysqli_query($link, $weeklyReportQuery);

$weeklyChartData = [];
$weeklyChartLabels = [];
while ($row = mysqli_fetch_assoc($weeklyReportResult)) {
    $weeklyChartLabels[] = $row['week'];
    $weeklyChartData[] = $row['count'];
}

$weeklyChartConfig = [
    'type' => 'bar',
    'data' => [
        'labels' => $weeklyChartLabels,
        'datasets' => [
            [
                'label' => 'Weekly Post Count',
                'data' => $weeklyChartData,
                'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1
            ]
        ]
    ],
    'options' => [
        'scales' => [
            'y' => [
                'beginAtZero' => true
            ]
        ]
    ]
];
?>

<canvas id="dailyChart" style="max-width: 30%; height: 200px;"></canvas>
<canvas id="weeklyChart" style="max-width: 30%; height: 200px;"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var dailyChartConfig = <?php echo json_encode($dailyChartConfig); ?>;
    var weeklyChartConfig = <?php echo json_encode($weeklyChartConfig); ?>;

    var dailyChartCtx = document.getElementById('dailyChart').getContext('2d');
    new Chart(dailyChartCtx, dailyChartConfig);

    var weeklyChartCtx = document.getElementById('weeklyChart').getContext('2d');
    new Chart(weeklyChartCtx, weeklyChartConfig);
</script>
