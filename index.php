<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Data Ringkasan</h2>
<table class="summary-table">
    <tr><th>Suhu Max</th><td id="suhu-max"></td></tr>
    <tr><th>Suhu Min</th><td id="suhu-min"></td></tr>
    <tr><th>Suhu Rata-Rata</th><td id="suhu-rata"></td></tr>
</table>

<h2>Hasil Suhu Max & Humidity Max</h2>
<table class="data-table">
    <tr>
        <th>Indeks</th>
        <th>Suhu</th>
        <th>Humidity</th>
        <th>Kecerahan</th>
        <th>Timestamp</th>
    </tr>
    <tbody id="data-body"></tbody>
</table>

<h2>Humidity Tertinggi per Bulan-Tahun</h2>
<table class="data-table">
    <tr>
        <th>Bulan-Tahun</th>
        <th>Humidity</th>
    </tr>
    <tbody id="humidity-body"></tbody>
</table>

<script>
    // ambil json
    fetch('data_fetch.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('suhu-max').textContent = data.suhumax;
            document.getElementById('suhu-min').textContent = data.suhumin;
            document.getElementById('suhu-rata').textContent = data.suhu_rata.toFixed(2);

            // Display tb_cuaca data
            const dataBody = document.getElementById('data-body');
            data.tb_cuaca.forEach((row, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${row.suhu}</td>
                    <td>${row.humid}</td>
                    <td>${row.lux}</td>
                    <td>${row.ts}</td>
                `;
                dataBody.appendChild(tr);
            });

            const humidityBody = document.getElementById('humidity-body');
            data.month_year_max.forEach(entry => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${entry.month_year}</td>
                    <td>${entry.humid ?? 'N/A'}</td>
                `;
                humidityBody.appendChild(tr);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>

</body>
</html>
